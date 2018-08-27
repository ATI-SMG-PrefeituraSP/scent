<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
| Explicação dos métodos:
|
| novo: get cria um novo registro e post salva o novo registro
| alterar: abre tela de alteração de um registro e post salva o registro, costuma ser a mesma função salvar do novo
| index: abre a tela inicial dos registros com a listagem e etc
| delete: exclui um registro, geralmente com uma função ajax que está descrita em public/js/script.js
| datatable: gera as informações para preencher o datatable da tela inicial do registro
*/

Auth::routes();

//página inicial
Route::get('/home', 'HomeController@index')->name('home');




//Teste Nova senha
Route::get('/nova_senha', 'UsuarioController@emailNovaSenha')->name('email.nova_senha');
Route::post('/nova_senha', 'UsuarioController@emailNovaSenha')->name('email.nova_senha');

/* Rotas do admin */

//usuário
Route::get('/usuario/novo', 'UsuarioController@novo')->name('admin.usuario.novo')->middleware('auth');
Route::post('/usuario/novo', 'UsuarioController@salvar')->name('admin.usuario.salvar')->middleware('auth');
Route::get('/usuario/datatable', 'UsuarioController@datatable')->name('admin.usuario.datatable')->middleware('auth');
Route::get('/usuario/alterar/{id}', 'UsuarioController@alterar')->name('admin.usuario.alterar')->middleware('auth');
Route::get('/usuario/index', 'UsuarioController@index')->name('admin.usuario.index')->middleware('auth');
Route::delete('/usuario/delete/{id}', 'UsuarioController@delete')->name('admin.usuario.delete')->middleware('auth');



//Minha conta
Route::get('/usuario/minhaconta', 'UsuarioController@minhaConta')->name('admin.usuario.minha_conta.alterar')->middleware('auth');
Route::post('/usuario/salvar', 'UsuarioController@salvarMinhaConta')->name('admin.usuario.minha_conta.salvar')->middleware('auth');


//Espicificações Téncincas
Route::get('/especificacao_tecnica/novo', 'EspecificacaoTecnicaController@novo')->name('admin.especificacao_tecnica.novo')->middleware('auth');
Route::post('/especificacao_tecnica/novo', 'EspecificacaoTecnicaController@salvar')->name('admin.especificacao_tecnica.salvar')->middleware('auth');
Route::get('/especificacao_tecnica/datatable', 'EspecificacaoTecnicaController@datatable')->name('admin.especificacao_tecnica.datatable')->middleware('auth');
Route::get('/especificacao_tecnica/alterar/{id}', 'EspecificacaoTecnicaController@alterar')->name('admin.especificacao_tecnica.alterar')->middleware('auth');
Route::get('/especificacao_tecnica/index', 'EspecificacaoTecnicaController@index')->name('admin.especificacao_tecnica.index')->middleware('auth');
Route::delete('/especificacao_tecnica/delete/{id}', 'EspecificacaoTecnicaController@delete')->name('admin.especificacao_tecnica.delete')->middleware('auth');
Route::get('/especificacao_tecnica/arquivo', 'EspecificacaoTecnicaController@downloadArquivo')->name('admin.especificacao_tecnica.arquivo')->middleware('auth');
//Route::post('/especificacao_tecnica/upload', 'EspecificacaoTecnicaController@upload')->name('admin.especificacao_tecnica.upload')->middleware('auth');
//Route::get('/especificacao_tecnica/importacao', 'EspecificacaoTecnicaController@importacao')->name('admin.especificacao_tecnica.importacao')->middleware('auth');


//Normas Téncincas
Route::get('/norma_tecnica/novo', 'NormaTecnicaController@novo')->name('admin.norma_tecnica.novo')->middleware('auth');
Route::post('/norma_tecnica/novo', 'NormaTecnicaController@salvar')->name('admin.norma_tecnica.salvar')->middleware('auth');
Route::get('/norma_tecnica/datatable', 'NormaTecnicaController@datatable')->name('admin.norma_tecnica.datatable')->middleware('auth');
Route::get('/norma_tecnica/alterar/{id}', 'NormaTecnicaController@alterar')->name('admin.norma_tecnica.alterar')->middleware('auth');
Route::get('/norma_tecnica/index', 'NormaTecnicaController@index')->name('admin.norma_tecnica.index')->middleware('auth');
Route::delete('/norma_tecnica/delete/{id}', 'NormaTecnicaController@delete')->name('admin.norma_tecnica.delete')->middleware('auth');



//redireciona para a home
Route::get('/', function(){
    return redirect(route('home'));
});
