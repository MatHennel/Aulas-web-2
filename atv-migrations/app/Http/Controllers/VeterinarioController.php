<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

Use \App\Models\Veterinario;

Use \App\Models\Especialidade;




class VeterinarioController extends Controller
{

     
    public function index()
    {
        $veterinarios = Veterinario::all();
        

        return view('veterinarios.index', compact(['veterinarios']));
    }

  
    public function create()
    {

        $dados = Especialidade::all();


        return view('veterinarios.create',compact(['dados']));
    }

   
    public function store(Request $request)
    {
        // echo $request->es;

        Veterinario::create(['nome' => $request->nome, 'crmv'=> $request->crmv,'especialidade_id'=> $request->es]);



        return redirect()->route('veterinarios.index');
    }

   
    public function show($id)
    {
        $aux = Veterinario::all()->toArray();


        
        $index = array_search($id, array_column($aux, 'id'));

        $dados = $aux[$index];

        $auxEsp = Especialidade::find($dados['especialidade_id']);
        


        return view('veterinarios.show')->with('dados', $dados)->with('especialidade', $auxEsp);
    }

    
    public function edit($id)
    {
        $dados = Veterinario::find($id);

        $esp = Especialidade::find($dados->especialidade_id);

        return view('veterinarios.edit')->with('dados', $dados)->with('esp', $esp);;
    }

 
    public function update(Request $request, $id)
    {
        $aux = Veterinario::find($id);

        
    

        $aux->fill(['nome' => $request->nome, 'crmv'=> $request->crmv,'especialidade_id'=> $request->es]);
        
        $aux->save();

        return redirect()->route('veterinarios.index');
    }

   
    public function destroy($id)
    {
        Veterinario::destroy($id);
        return redirect()->route('veterinarios.index');
    }
}
