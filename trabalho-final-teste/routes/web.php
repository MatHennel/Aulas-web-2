<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjetoController;
use Illuminate\Support\Facades\Route;



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
    return view('welcome');
});

Route::get('templates.main', function () {
    return view('templates.main');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified','redirecionaUsuario'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

Route::resource('projetos','ProjetoController')
    ->except(['show'])    
    ->middleware(['auth', 'verified','cadastroVerificaLogin']);

Route::get('redirecionamento', function(){
    return view('redirecionamento');
})->name('redirecionamento');

Route::resource('clientes','ClienteController')->middleware(['auth', 'verified']);
Route::resource('desenvolvedores','DesenvolvedorController')->middleware(['auth', 'verified']);

Route::middleware(['auth', 'verified','cadastroVerificaLogin'])->group(function () {
    Route::get('projetos/disponiveis', [ProjetoController::class, 'projetosDisponiveis'])->name('projetos.disponiveis');
    Route::post('projetos/{projeto}/inscrever', [ProjetoController::class, 'inscrever'])->name('projetos.inscrever');
});

Route::get('/meus-projetos/devs', [ProjetoController::class, 'meusDevs'])
    ->name('projetos.meusDevs')
    ->middleware(['auth', 'verified', 'cadastroVerificaLogin']);


Route::post('/projetos/{projeto}/selecionar-dev/{dev}', [ProjetoController::class, 'selecionarDev'])
    ->name('projetos.selecionarDev')
    ->middleware(['auth', 'verified', 'cadastroVerificaLogin']);


Route::get('/profile/{id}', [ProfileController::class, 'show'])->name('profile.show');



require __DIR__.'/auth.php';
