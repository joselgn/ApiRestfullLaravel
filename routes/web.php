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
*/

//ROTAS PARA O SISTEMA
Route::get('/','IndexController@index');

//Rotas previstas na documentaçao
//Lista de Veiculos - Todos
Route::get('/veiculos','IndexController@index');///veiculos

//Novo Veiculo - Tela
Route::get('/novo', 'IndexController@novo');///veiculo - Novo Registro

//Veiculo especifico por ID
Route::get('/veiculos/{id}', 'IndexController@detalhe')->where(['id' => '[0-9]+']);///veiculos detalhes
Route::get('/veiculos/{id}/{tpMsg?}/{msg?}', 'IndexController@detalhe')->where(['id' => '[0-9]+','tpMsg'=>'[0-2]','msg'=>'[0-9A-Za-z]+']);///veiculos detalhes

//Adicionar novo veiculo
Route::post('/veiculos','IndexController@cadastrar');

//Alterando registro
Route::put('/veiculos/{id}','IndexController@editar')->where(['id' => '[0-9]+']);

//Excluindo registro
Route::delete('/veiculos/{id}','IndexController@excluir')->where(['id' => '[0-9]+']);


//ROTAS PARA A API
Route::prefix('api')->group(function () {
    //lista todos os registros0
    Route::get('/','IndexController@apiindex');
    //Detalhe veiculo especifico
    Route::get('/veiculos/{id}','IndexController@apidetalhes')->where(['id' => '[0-9]+']);
    
    //Adicionar novo veiculo
    Route::post('/veiculos','IndexController@apicadastrar');
    
    //Alterando registro
    Route::put('/veiculos/{id}','IndexController@apieditar')->where(['id' => '[0-9]+']);

    //Excluindo registro
    Route::delete('/veiculos/{id}','IndexController@apiexcluir')->where(['id' => '[0-9]+']);
});//Group API