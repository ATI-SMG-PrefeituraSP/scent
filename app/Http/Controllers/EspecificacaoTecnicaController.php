<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

use Yajra\Datatables\Datatables;
use Rap2hpoutre\FastExcel\FastExcel;

use App\Models\EspecificacaoTecnica;
use \App\Models\TipoEspecificacao;

use App\User;
use App\Biblioteca;

class EspecificacaoTecnicaController extends Controller
{
    /**
     * Tela inicial dos usuários
     */
    public function index()
    {
        // Captura o usuário logado
        $user = Auth::user();

        //captura todos os usuários
        $registros = EspecificacaoTecnica::all();

        //retorna a view
        return View::make('admin.especificacao_tecnica.index')->with('user', $user)->with('registros', $registros);
    }

    /**
     * Tela inicial dos usuários
     */
    public function novo()
    {
        // Captura o usuário logado
        $user = Auth::user();

        //carrega os resumos de provimento para alimentar os combos
        $tipo_especificacaos = TipoEspecificacao::orderBy('nome', 'asc')->get(['id', 'nome'])->pluck('nome', 'id');

        //retorna a view
        return View::make('admin.especificacao_tecnica.form')->with('user', $user)->with('tipo_especificacaos', $tipo_especificacaos);
    }

    /**
     * Exibe tela de alterar usuário
     */
    public function alterar($id)
    {
        // Captura o usuário logado
        $user = Auth::user();

        //captura o usuário
        $registro = EspecificacaoTecnica::find($id);

        //carrega os resumos de provimento para alimentar os combos
        $tipo_especificacaos = TipoEspecificacao::orderBy('nome', 'asc')->get(['id', 'nome'])->pluck('nome', 'id');

        //retorna a view
        return View::make('admin.especificacao_tecnica.form')->with('user', $user)->with('registro', $registro)->with('tipo_especificacaos', $tipo_especificacaos);
    }

    /**
     * Exclui um registro
     * @return mensagem com o resultado da operação
     */
    public function delete($id)
    {
        //captura o registro
        $registro = EspecificacaoTecnica::find($id);
        
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
        //valida as informações recebidas
        $request->validate([
            //valida consistencia
            'data_criacao' => 'date_format:"d/m/Y"',
            'data_revisao' => 'date_format:"d/m/Y"',
        ]);

        //verifica se está no alterar ou no salvar
        if($request->id != "")
        {
            //se o usuário já existir, encontra ele
            $registro = EspecificacaoTecnica::find($request->id);
        }
        else
        {
            //cria um novo usuário
            $registro = new EspecificacaoTecnica;
        }
        
        //preenche os campos
        $registro->fill($request->all());

        //converte os campos de data
        $registro->data_criacao = Biblioteca::strToDate($registro->data_criacao);
        $registro->data_revisao = Biblioteca::strToDate($registro->data_revisao);

        //verifica se possui arquivo
        if ($request->arquivo) {

            //verifica se já existia um arquivo salvo
            if($registro->arquivo)
            {
                //deleta o arquivo anterior
                Storage::delete($registro->arquivo);
            }

            //troca o nome da pasta
            $nomearq = "especificacao_tecnica_arquivo_".$registro->id;

            //salva o arquivo e guarda o caminho
            $registro->arquivo = $request->arquivo->store($nomearq);
        }

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
    public function datatable(Request $request)
    {
        if($request->inativos == 1)
            $query = EspecificacaoTecnica::where('ativo', 0);
        else
            $query = EspecificacaoTecnica::where('ativo', 1);

        return Datatables::of($query)
        ->addColumn('action', function ($registro) {

            //prepara a função de deletar com o link certo
            $funcaodeletar = "js: deletarRegistro('".route('admin.especificacao_tecnica.delete', $registro->id)."')";

            //exibe os ícones de alterar e excluir
            $html = '<a data-toggle="tooltip" title="Alterar" href="'.route('admin.especificacao_tecnica.alterar', $registro->id).'" class="fas fa-edit"></a>';
            $html .= '<a data-toggle="tooltip" title="Excluir" onclick="'.$funcaodeletar.'" class="fas fa-trash"></a>';
            

            return $html;
        })
        ->addColumn('tipo_especificacao', function ($registro) {
            if($registro->tipo_especificacao)
                return $registro->tipo_especificacao->nome;
        })
        ->editColumn('data_criacao', function($registro){
            return Biblioteca::dateToStr($registro->data_criacao);
        })
        ->editColumn('data_revisao', function($registro){
            return Biblioteca::dateToStr($registro->data_revisao);
        })
        ->editColumn('ativo', function($registro){
            return $registro->ativo == 0? 'Inativo':'Ativo';
        })
        ->make(true);
    }

    /**
     * Força o browser a fazer download do arquivo
     * A request deve conter o nome do arquivo
     */
    public function downloadArquivo(Request $request)
    {
        return Storage::download($request->arquivo);
    }

    /**
     * Processa o arquivo importado pelo usuário e salva os dados
     */
    public function upload(Request $request)
    {
        
        //prepara o array que vai guardar as relações
        $arr_resultado = (new FastExcel)->import($request->arquivo->path(), function ($line) {

            //captura o caminho do arquivo
            $caminho = $line["Texto123"];
            
            //captura o conteudo do arquivo
            $arq = file_get_contents($caminho);

            //cria um novo usuário
            $registro = new EspecificacaoTecnica;

            //preenche os campos
            $registro->fill($line);

            //converte os campos de data
            $registro->data_criacao = Biblioteca::strToDate($line['data_criacao']);
            $registro->data_revisao = Biblioteca::strToDate($line['data_revisao']);

            //verifica se possui arquivo
            if ($arq) {

                //verifica se já existia um arquivo salvo
                if($registro->arquivo)
                {
                    //deleta o arquivo anterior
                    Storage::delete($registro->arquivo);
                }

                //troca o nome da pasta
                $nomearq = "especificacao_tecnica_arquivo_".$registro->id;

                //salva o arquivo e guarda o caminho
                $registro->arquivo = Store::put($nomearq, $arq);
            }

            //salva o registro
            return $registro->save();
        });

        dd($arr_resultado);

        //redireciona para a alteração do organograma
        return redirect(route('admin.especificacao_tecnica.index'));
    }

    /**
     * Tela inicial dos usuários
     */
    public function importacao()
    {
        // Captura o usuário logado
        $user = Auth::user();

        //retorna a view
        return View::make('admin.especificacao_tecnica.upload')->with('user', $user);
    }
}
