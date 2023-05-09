<?php

use Illuminate\Support\Facades\Route;
use \Illuminate\Http\Request;

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

Route::get('/home', function () {
    return view('welcome');
})->name('home-index');

// Route::view('/jogos','jogos');

// Route::get('/jogos',function(){
//     return "Curso de Laravel";
// });

// Route::view('/jogos','jogos',['name'=>'GTA']);

// Route::get('/jogos/{name?}/{id?}',function($name = null,$id = null ){
//     return view('jogos',['nomeJogo'=>$name,'idJogo'=>$id]);
// });

Route::get('/jogos', function () {
    return view('jogos');
});

// Route::fallback(function () {
//     return "erro ao localizar rota";
// });

// Route::get('/', function () {
//     return "<h1>Rota Principal </h1>";
// });

Route::get('/clientes', function () {
    $clientes = "<ul>
    <li>Carlos Eduardo</li>
    <li>Maria Cláudia</li>
    <li>João Pedro</li>
    </ul>";

    return $clientes;
})->name('clientes');

Route::get('/clientes/{total}/{nome}', function ($total, $nome) {
    $clientes = "<ul>";
    for ($cont = 0; $cont < $total; $cont++) {
        $clientes .= "<li>$nome</li>";
    }
    $clientes .= "</ul>";
    return $clientes;
});

Route::get('/racas/{total}/{raça?}/', function ($total, $raca = null) {

    $dados = array(
        "Bulldog Inglês",
        "Labrador",
        "Pastor Alemão",
        "Akita"
    );
    $pets = "<ul>";
    if ($raca == null) {
        if ($total <= count($dados)) {
            $cont = 0;
            foreach ($dados as $item) {
                $pets .= "<li>$item</li>";
                $cont++;
                if ($cont >= $total) break;
            }
        } else {
            $pets .= "<li>Tamanho Máximo = " . count($dados) . "</li>";
        }
    } else {
        for ($cont = 0; $cont < $total; $cont++) {
            $pets .= "<li>$raca</li>";
        }
    }
    $pets .= "</ul>";
    return $pets;
});

Route::prefix('/consulta')->group(function(){
    Route::get('/',function(){
        return view('consulta');
    })->name('consultas');

    Route::get('/agendar',function(){
        return view('agendar');
    })->name('consulta.agendar');

    Route::get('/cancelar',function(){
        return view('cancelar');
    })->name('consulta.cancelar');
});

Route::get('/cliente',function(){
    
    $clientes = "<ul>".
            "<li>Matheus Hennel</li>".
            "<li>Joao Carlos</li>".
            "<li>Matheus Henrique</li>".
            "<li>Matheus Carlos</li>".
            "</ul>";

    return $clientes;
})->name('cliente');

Route::redirect('/','cliente',301);

Route::get('/veterinario',function(){
    return redirect()->route('cliente');
});

Route::post('/veterinarios/add', function (Request $request) {
    return  "<h1>Adicionar Veterinário (POST)</h1>";
});
    
