<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Skin;
use App\Models\Usuario;
use App\Models\Jogo;


class SkinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($jogo_id,$usuario_id)
    {
        
        $skins = Skin::where('jogo_id', $jogo_id)->where('usuario_id', $usuario_id)->get()->toArray();


        

        return view('skins.index',compact(['skins']))->with('jogo_id',$jogo_id)->with('usuario_id',$usuario_id);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    public function createForm($jogo_id,$usuario_id){
        return view('skins.create',compact(['jogo_id','usuario_id']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $skin = new Skin();
        $skin->nome = $request->nome;
        $skin->preço = $request->preço;
        $skin->arma = $request->arma;
        $jogo = Jogo::find($request->jogo_id);
        $usuario = Usuario::find($request->usuario_id);
        $skin->jogo()->associate($jogo);
        $skin->usuario()->associate($usuario);

        $skin->save();

        return redirect()->route('skins.index', ['jogo_id' => $jogo['id'], 'usuario_id' => $usuario['id']]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $skin = Skin::find($id);

        $jogo_id = $skin->jogo_id;
        $usuario_id = $skin->usuario_id;

        Skin::destroy($id);


        

        return view('skins.index',compact(['skins']))->with('jogo_id',$jogo_id)->with('usuario_id',$usuario_id);


    }
}
