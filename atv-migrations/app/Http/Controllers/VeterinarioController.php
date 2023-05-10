<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

Use \App\Models\Veterinario;

Use \App\Models\Especialidade;




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

        $dados = Especialidade::all();


        return view('veterinarios.create',compact(['dados']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // echo $request->es;

        Veterinario::create(['nome' => $request->nome, 'crmv'=> $request->crmv,'especialidade_id'=> $request->es]);



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
        $aux = Veterinario::all()->toArray();


        
        $index = array_search($id, array_column($aux, 'id'));

        $dados = $aux[$index];

        $auxEsp = Especialidade::find($dados['especialidade_id']);
        


        return view('veterinarios.show')->with('dados', $dados)->with('especialidade', $auxEsp);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $aux = Veterinario::all()->toArray();
            
        $index = array_search($id, array_column($aux, 'id'));

        $dados = $aux[$index];    

        return view('veterinarios.edit',compact(['dados']));
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
        $aux = Veterinario::find($id);

        
    

        $aux->fill(['nome' => $request->nome, 'crmv'=> $request->crmv,'especialidade_id'=> $request->es]);
        
        $aux->save();

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
        Veterinario::destroy($id);
        return redirect()->route('veterinarios.index');
    }
}
