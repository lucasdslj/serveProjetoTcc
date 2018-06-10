<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//retorna os dados para realizar a batalha
Route::get('/boardcomposition/{player1}/{player2}',  'BoardCompositionController@composition');
//retorna a lista de aversários disponíveis para o jogador
Route::get('/opponentPlayers/{player}',  'PlayersController@opponentsList');
//retorna os adversários que venceram o jogador 
Route::get('/playersRematch/{player}',  'PlayersController@rematchList');
//efetua login do jogador
Route::post('login','PlayersController@authenticate');
//Retorna dados do jogador
Route::post('getPlayer','PlayersController@getPlayer');
//verifica se o user_name está disponível
Route::post('verifyUserName','PlayersController@verifyUserName');
//cria um novo jogador
Route::post('createNewPlayer','PlayersController@createNewPlayer');
//verifica email repetido
Route::post('verifyEmail','PlayersController@verifyEmail');
//Incrementa o valor de vitórias
Route::post('plusVictory','PlayersController@plusVictory');
//Incrementa o valor de derrotas
Route::post('plusDefeat','PlayersController@plusDefeat');
//adciona um valor de xp repassado
Route::post('plusXp','PlayersController@plusXp');
//Incrementa o valor de level
Route::post('plusLevel','PlayersController@plusLevel');
//adiciona uma relação entre jogadores na tabela rematches
Route::post('addRematch','PlayersController@addRematch');
//retorna revanches
Route::post('getRematch','PlayersController@getRematch');
//deleta um registro da tabela Rematches
Route::post('delRematch','PlayersController@delRematch');
//atribui a  locatização
Route::post('setLocation','PlayersController@setLocation');



//não utilizado
Route::post('test','PlayersController@test');

Route::post('test2','PlayersController@test2');

