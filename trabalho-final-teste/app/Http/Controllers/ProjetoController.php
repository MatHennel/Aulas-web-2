<?php

namespace App\Http\Controllers;

use App\Models\Projeto;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class ProjetoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       

       
        $userId = Auth::id();
       

        $projetos = Projeto::where("user_id",$userId)->get();

      

        return view('projetos.index',compact(['projetos']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('projetos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $user_id = $request->user_id;

        $projeto = new Projeto;
        $projeto->nome = $request->nome;
        $projeto->descricao= $request->descricao;
        $projeto->valor = $request->valor;
        $projeto->dataEntrega = $request->dataEntrega;
        
        $user = User::find($user_id);
    
        $projeto->user()->associate($user);
        $projeto->save();

        return redirect()->route('projetos.index');


    }

    /**
     * Display the specified resource.
     */
    public function show(Projeto $projeto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Projeto $projeto)
    {
        return view('projetos.edit',compact('projeto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Projeto $projeto)
    {
       
        $projetoBanco = Projeto::find($projeto->id);
        $projetoBanco->nome = $request->nome;
        $projetoBanco->descricao= $request->descricao;
        $projetoBanco->valor = $request->valor;
        $projetoBanco->dataEntrega = $request->dataEntrega;
        $projetoBanco->save();

        return redirect()->route('projetos.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Projeto $projeto)
    {
        Projeto::destroy($projeto->id);

        return redirect()->route('projetos.index');
    }
}
