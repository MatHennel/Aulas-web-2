<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

Use \App\Models\Cliente;

class ClienteController extends Controller {
    
    
    public function index() {
        
        $dados = Cliente::all();
        $clinica = "VetClin DWII";

        // Passa um array "dados" com os "clientes" e a string "clínicas"
        return view('clientes.index', compact(['dados', 'clinica']));
        // return view('cliente.index')->with('dados', $dados)->with('clinica', $clinica);
    }

    public function create() {

        return view('clientes.create');
    }

   public function store(Request $request) {
        
        Cliente::create(['nome' => $request->nome, 'email'=> $request->email]);

        return redirect()->route('clientes.index');
    }

    public function show($id) {
        
        $aux = Cliente::all()->toArray();
        
        $index = array_search($id, array_column($aux, 'id'));

        $dados = $aux[$index];

        return view('clientes.show', compact('dados'));
    }

    public function edit($id) {

        $aux = Cliente::all()->toArray();
            
        $index = array_search($id, array_column($aux, 'id'));

        $dados = $aux[$index];    

        return view('clientes.edit', compact('dados'));        
    }

    public function update(Request $request, $id) {
        
        $aux = Cliente::find($id);
        
        $aux->fill(['nome' => $request->nome, 'email'=> $request->email]);
        $aux->save();

        return redirect()->route('clientes.index');
    }

    public function destroy($id) {
        Cliente::destroy($id);

        return redirect()->route('clientes.index');
    }
}
