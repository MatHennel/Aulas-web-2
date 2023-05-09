<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClienteController extends Controller
{
    

    public $clientes = [[
        'id' => 1,
        'nome' => 'Matheus Hennel',
        'email' => 'math@gmail.com'
    ]];

    public function __construct(){
        $aux = session('clientes');

        if(!isset($aux)){
            session(['clientes' => $this->clientes]);
        }

    }
    


    public function index()
    {
       $clientes = session('clientes'); 
       
       

        return view('clientes.index',compact('clientes'));

       
        

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $aux = session('clientes');

        $ids = array_column($aux,'id');

        if(count($ids) > 0){
            $new_id = max($ids) + 1;
        }else{
            $new_id = 1;
        }

        $novo = [
            'id' => $new_id,
            'nome' => $request->nome,
            'email' => $request->email
        ];

        array_push($aux,$novo);

        session(['clientes' => $aux]);

        return redirect()->route('clientes.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $aux = session('clientes');
        

        $indice = array_search($id,array_column($aux,'id'));

        

        $dados = $aux[$indice];

        return view('clientes.show',compact('dados'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $aux = session('clientes');

        $indice = array_search($id,array_column($aux,'id'));

        $dados = $aux[$indice];

        return view('clientes.edit',compact('dados'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $alterado = [
            'id' => $id,
            'nome' => $request->nome,
            'email' => $request->email
        ];

        $aux = session('clientes');

        $indice = array_search($id,array_column($aux,'id'));

        $aux[$indice] = $alterado;

        session(['clientes' => $aux]);

        return redirect()->route('clientes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $aux = session('clientes');

        $indice = array_search($id,array_column($aux,'id'));

        unset($aux[$indice]);

        session(['clientes' => $aux]);

        return redirect()->route('clientes.index');
    }
}
