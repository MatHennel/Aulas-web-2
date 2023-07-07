<?php

use Illuminate\Support\Facades\Route;
use App\Models\Usuario;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $usuarios = Usuario::all();

    return view('welcome',compact(['usuarios']));
});

Route::get('/jogos/{id}', 'JogoController@index')->name('jogos.index');



Route::get('/carros',function(){
    return "<h2>Olá</h2>";
});

Route::get('/skins/{jogo_id}/{usuario_id}', 'SkinController@index')->name('skins.index');
Route::get('/skins', 'SkinController@create')->name('skins.create');
Route::get('/skins/create/{jogo_id}/{usuario_id}', 'SkinController@createForm')->name('skins.create.form');
Route::post('/skins','SkinController@store')->name('skins.store');
Route::post('/skins/edit','SkinController@edit')->name('skins.edit');
Route::resource('skins','SkinController');






