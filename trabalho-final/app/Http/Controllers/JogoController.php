<?php

namespace App\Http\Controllers;

use App\Models\Jogo;
use Illuminate\Http\Request;
use App\Models\Jogo_Usuario;
use App\Models\Usuario;


class JogoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $usuario = Usuario::find($id);
    
    
    
        $jogos_usuario = Jogo_Usuario::where('usuario_id',$id)->with(['jogo','usuario'])->get()->toArray();

        foreach($jogos_usuario as $item => $jogo){
            $jogos[] = $jogo['jogo'];
        }


        print_r($jogos);
        return view('jogos.index',compact(['jogos','usuario']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Jogo $jogo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jogo $jogo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jogo $jogo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jogo $jogo)
    {
        //
    }
}
