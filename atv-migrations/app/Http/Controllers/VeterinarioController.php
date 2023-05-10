<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

Use \App\Models\Veterinario;




class VeterinarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public $veterinarios = [[
        "crmv" => 1,
        "nome" => "Matheus Hennel",
        "especialidade" => "Cardiologista"
    ]];

    public function __construct() {
        
        $aux = session('veterinarios');

        if(!isset($aux)) {
            session(['veterinarios' => $this->veterinarios]);
        }
    }
    public function index()
    {
        $veterinarios = Veterinario::all();
        return view('veterinarios.index', compact(['veterinarios']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('veterinarios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $aux = session('veterinarios');


        $novo = [
            "crmv" => $request->crmv,
            "nome" => $request->nome,
            "especialidade" => $request->especialidade,
        ];

        array_push($aux, $novo);
        session(['veterinarios' => $aux]);



        return redirect()->route('veterinarios.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $aux = session('veterinarios');
        
        $index = array_search($id, array_column($aux, 'crmv'));

        $dados = $aux[$index];

        return view('veterinarios.show', compact('dados'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $aux = session('veterinarios');
            
        $index = array_search($id, array_column($aux, 'crmv'));

        $dados = $aux[$index];    

        return view('veterinarios.edit', compact('dados'));  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $aux = session('veterinarios');
        
        $index = array_search($id, array_column($aux, 'crmv'));

        $novo = [
            "crmv" => $request->crmv,
            "nome" => $request->nome,
            "especialidade" => $request->especialidade,
        ];

        $aux[$index] = $novo;
        session(['veterinarios' => $aux]);

        return redirect()->route('veterinarios.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $aux = session('veterinarios');
        
        $index = array_search($id, array_column($aux, 'crmv')); 

        unset($aux[$index]);

        session(['veterinarios' => $aux]);

        return redirect()->route('veterinarios.index');
    }
}
