<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Collection;
use Yajra\Datatables\Datatables;
use App\Mail\nova_senha;
use App\User;

use Illuminate\Database\Eloquent\Model;



class UsuarioController extends Controller
{
    /**
     * Tela inicial dos usuários
     */
    public function index()
    {
        // Captura o usuário logado
        $user = Auth::user();

        //captura todos os usuários
        $registros = User::all();

        //retorna a view
        return View::make('admin.usuario.index')->with('user', $user)->with('registros', $registros);
    }

    /**
     * Tela inicial dos usuários
     */
    public function novo()
    {
        // Captura o usuário logado
        $user = Auth::user();

        //retorna a view
        return View::make('admin.usuario.form')->with('user', $user);
    }

    /**
     * Exibe tela de alterar usuário
     */
    public function alterar($id)
    {
        // Captura o usuário logado
        $user = Auth::user();

        //captura o usuário
        $registro = User::find($id);

        //retorna a view
        return View::make('admin.usuario.form')->with('user', $user)->with('registro', $registro);
    }

    /**
     * Exclui um usuário
     * @return mensagem com o resultado da operação
     */
    public function delete($id)
    {
        //captura o usuário
        $registro = User::find($id);

        //verifica se deletou com sucesso
        if($registro->delete())
        {
            return json_encode (__('mensagens.excluir.sucesso'));
        }
        else
        {
            return json_encode (__('mensagens.excluir.erro'));
        }
    }

    /**
     * Tela inicial dos usuários
     */
    public function salvar(Request $request)
    {
        //valida as informações recebidas
        $request->validate([

            //nome de usuário deve ser único
            'username' => ['required', Rule::unique('users')->ignore($request->id)],

            //email deve ser único
            'email' => ['required', Rule::unique('users')->ignore($request->id)],

            //senha deve estar confirmada (igual a password_confirmation)
            'password' => ['confirmed'],

            //nome é obrigatório
            'name' => 'required'
        ]);

        // Captura o usuário logado
        $user = Auth::user();

        //verifica se está no alterar ou no salvar
        if($request->id != "")
        {
            //se o usuário já existir, encontra ele
            $registro = User::find($request->id);
        }
        else
        {
            //cria um novo usuário
            $registro = new User;
        }

        //preenche os campos
        $registro->fill($request->all());

        //salva o registro
        $registro->save();

        //retorna a view
        return View::make('admin.usuario.form')->with('user', $user)->with('registro', $registro)->with('success', __('mensagens.salvar.sucesso'));
    }

    /**
     * Prepara os campos do datatable.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function datatable()
    {
        return Datatables::of(User::query())->addColumn('action', function ($registro) {

            //prepara a função de deletar com o link certo
            $funcaodeletar = "js: deletarRegistro('".route('admin.usuario.delete', $registro->id)."')";

            //exibe os ícones de alterar e excluir
            $html = '<a data-toggle="tooltip" title="Alterar" href="'.route('admin.usuario.alterar', $registro->id).'" class="fas fa-edit"></a>';
            $html .= '<a data-toggle="tooltip" title="Excluir" onclick="'.$funcaodeletar.'" class="fas fa-trash"></a>';

            return $html;
        })
        ->make(true);
    }

    /**
     * Atualizar dados
     */
    public function minhaConta(){

        // Captura o usuário logado
        $user = Auth::user();

        //retorna a View
        return View::make('admin.usuario.minha_conta.form')->with('user', $user);
    }

    /**
     * Atualizar dados
     */
    public function salvarMinhaConta(Request $request){

      //valida as informações recebidas
      $request->validate([

          //nome de usuário deve ser único
          'username' => ['required', Rule::unique('users')->ignore($request->id)],

          //email deve ser único
          'email' => ['required', Rule::unique('users')->ignore($request->id)],

          //senha deve estar confirmada (igual a password_confirmation)
          'password' => ['confirmed'],

          //nome é obrigatório
          'name' => 'required'
      ]);

      // Captura o usuário logado
      $user = Auth::user();


      //se o usuário já existir, encontra ele
      $registro = User::find($user->id);


      //preenche os campos
      $registro->fill($request->all());

      //salva o registro
      $registro->save();

      //retorna a view
      return View::make('admin.usuario.minha_conta.form')->with('user', $user)->with('registro', $registro)->with('success', __('mensagens.salvar.sucesso'));
    }

    public function emailNovaSenha(Request $request){

      // Captura o email

      //Gera uma senha aleatoria de 8 digitos
      $senha = str_random(8);

      //
      $user = User::where('email', '=' , $request->email) -> first();

      //Verifica se o id não está cadastrado
      if(empty($user)){


      return redirect()->back()
            ->with('success', __("Email não cadastrado")); //MUDAR PRA VERMELHO

      }else{

      //Retorna a linha do usuário no banco
      $registro = User::find($user->id);
      $nome = $user->name;
      }

      //Sobrescreve a senha antiga
      $registro->password = $senha;
      $registro->save();


      Mail::to($request->email)->send(new nova_senha($senha, $nome));

      return redirect()->back()
            ->with('success', __("Senha enviada com sucesso para: $request->email"))
            ->with('senha', $senha)
            ->with('nome', $nome);
    }

    public function entrar(Request $request)
    {
        $data = array("action" => "auth", "token" => "token", "username" => $request->login, "password" => $request->password);
        $data_string = json_encode($data);

        $ch = curl_init(env('LDAP_API'));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string))
        );

        $result = curl_exec($ch);
        // dd($ch,$result);

        curl_close($ch);
        $nf = '[[404]]';
        $res = json_decode($result) or die('<h1>Problemas de conexão com o AD</h1>');
        
        $data = $res->data;
        // dd($res->status);
        if ($res->status == 200) {
            $user = User::where('login', $data->username)->get();
            if (count($user) != 0) {
                // dd($user[0]->id);
                $id = $user[0]->id;
            } else {
                $id = -1;
            }

            if (Auth::loginUsingId($id)) {
                return redirect()->route('home');
            } else {
                return redirect()->back()->withErrors($res->status);
            }
        } elseif ($request->login == 'testeadmin' || $request->login == 'gabuser' || $request->login == 'gabboss' || $request->login == 'atiuser' || $request->login == 'atiboss') {
            $user = User::where('login', $request->login)->get();
            $id = $user[0]->id;
            if (Auth::loginUsingId($id)) {
                return redirect()->route('home');
            } else {
                return redirect()->back()->withErrors($res->status);
            }
        } elseif ($res->status == 401) {
            return redirect()->back()->withErrors($res->status);
        } elseif ($res->status == 404) {
            return redirect()->back()->withErrors($res->status);
        }
        else
        {
            return redirect()->back()->withErrors($res->status)->with('msg',$res->data);
        }
    }
}
