<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Nivel1;


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
    return view('templates.main')->with('titulo', "");
})->name('index');

Route::resource('eixos','EixoController');

Route::resource('cursos','CursoController');

Route::resource('professores','ProfessorController');;

Route::resource('disciplinas','DisciplinaController');;

Route::resource('docencias','DocenciaController');;

Route::resource('alunos','AlunoController');;

Route::get('/matriculas/{id}', 'MatriculaController@index')->name('matriculas.index');;

Route::post('/matriculas/store', 'MatriculaController@store')->name('matriculas.store');;




