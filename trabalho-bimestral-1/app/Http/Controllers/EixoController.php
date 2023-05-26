<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\Models\Eixo;

class EixoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        
        $eixos = Eixo::all();
        // dd($eixos);
        return view('eixos.index', compact(['eixos']));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('eixos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $regras = ([
            'nome' => 'required|max:50|min:10'
        ]);

        $msgs = [
            "required" => "Preenchimento obrigatório!",
            "max" => "Tamanho máximo de :max caracteres!",
            "min" => "Tamanho mínimo de :min caracteres!"
        ];

        $request->validate($regras,$msgs);

        Eixo::create(['nome' => $request->nome]);

        return redirect()->route('eixos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $dados = Eixo::find($id)->toArray();

        return view('eixos.edit',compact('dados'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $aux = Eixo::find($id);

        $regras = ([
            'nome' => 'required|max:50|min:10'
        ]);

        $msgs = [
            "required" => "Preenchimento obrigatório!",
            "max" => "Tamanho máximo de :max caracteres!",
            "min" => "Tamanho mínimo de :min caracteres!"
        ];

        $request->validate($regras,$msgs);
        
        $aux->fill(['nome' => $request->nome]);
        $aux->save();

        return redirect()->route('eixos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Eixo::destroy($id);

        return redirect()->route('eixos.index');
    }
}
