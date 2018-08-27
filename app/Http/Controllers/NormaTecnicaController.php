<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

use Yajra\Datatables\Datatables;

use App\Models\NormaTecnica;

use App\User;
use App\Biblioteca;

class NormaTecnicaController extends Controller
{
    /**
     * Tela inicial dos usuários
     */
    public function index()
    {
        // Captura o usuário logado
        $user = Auth::user();

        //captura todos os usuários
        $registros = NormaTecnica::all();

        //retorna a view
        return View::make('admin.norma_tecnica.index')->with('user', $user)->with('registros', $registros);
    }

    /**
     * Tela inicial dos usuários
     */
    public function novo()
    {
        // Captura o usuário logado
        $user = Auth::user();

        //retorna a view
        return View::make('admin.norma_tecnica.form')->with('user', $user);
    }

    /**
     * Exibe tela de alterar usuário
     */
    public function alterar($id)
    {
        // Captura o usuário logado
        $user = Auth::user();

        //captura o usuário
        $registro = NormaTecnica::find($id);

        //retorna a view
        return View::make('admin.norma_tecnica.form')->with('user', $user)->with('registro', $registro);
    }

    /**
     * Exclui um registro
     * @return mensagem com o resultado da operação
     */
    public function delete($id)
    {
        //captura o registro
        $registro = NormaTecnica::find($id);
        
        //verifica se deletou com sucesso
        if($registro->delete())
        {
            return __('mensagens.excluir.sucesso');
        }
        else
        {
            return __('mensagens.excluir.erro');
        }
    }

    /**
     * Tela inicial dos registros
     */
    public function salvar(Request $request)
    { 
        //verifica se está no alterar ou no salvar
        if($request->id != "")
        {
            //se o usuário já existir, encontra ele
            $registro = NormaTecnica::find($request->id);
        }
        else
        {
            //cria um novo usuário
            $registro = new NormaTecnica;
        }
        
        //preenche os campos
        $registro->fill($request->all());

        //salva o registro
        $registro->save();

        //retorna a view sem erro
        return redirect()->back()
            ->with('success', __('mensagens.salvar.sucesso'));
    }

    /**
     * Prepara os campos do datatable.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function datatable()
    {
        return Datatables::of(NormaTecnica::query())
        ->addColumn('action', function ($registro) {

            //prepara a função de deletar com o link certo
            $funcaodeletar = "js: deletarRegistro('".route('admin.norma_tecnica.delete', $registro->id)."')";

            //exibe os ícones de alterar e excluir
            $html = '<a data-toggle="tooltip" title="Alterar" href="'.route('admin.norma_tecnica.alterar', $registro->id).'" class="fas fa-edit"></a>';
            $html .= '<a data-toggle="tooltip" title="Excluir" onclick="'.$funcaodeletar.'" class="fas fa-trash"></a>';
            
            return $html;
        })
        ->make(true);
    }
}
