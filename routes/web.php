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


Route::get('/', function () {
    return view('welcome');
});
Route::get('/', function () {
    return view('welcome');
});

Route::get('hello/{name}', function($name){
    return view('hello', ['name' => $name]);

});

Route::get('teste/{t}', function($t){
    return view('teste', ['t' => $t]);

});

Route::get('/players', 'PlayersController@lista');
//Route::get('/api/boardcomposition/{player1}/{player2}', 'BoardCompositionController@composition');
//Route::get('/boardcomposition/{player1}/{player2}', 'BoardCompositionController@composition');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
