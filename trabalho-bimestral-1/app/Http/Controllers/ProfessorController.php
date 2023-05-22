<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Professor;

use App\Models\Eixo;

class ProfessorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $professores = Professor::all();
        $eixos = Eixo::all();
        return view('professores.index',compact(['professores']),compact('eixos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dados = Eixo::all();
        return view('professores.create',compact(['dados']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Professor::create(['nome' => $request->nome, 'email' => $request->email, 'siape' => $request->siape, 'eixo_id' => $request->eixo_id, 'ativo' => $request->status]);

        return redirect()->route('professores.index');
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        $professor = Professor::find($id);

        $eixo = Eixo::find($professor->eixo_id);

        return view('professores.show')->with('professor',$professor)->with('eixo',$eixo);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $professor = Professor::find($id);

        $eixos = Eixo::all();

        return view('professores.edit')->with('professor',$professor)->with('eixos',$eixos);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $aux = Professor::find($id);
        
        $aux->fill(['nome' => $request->nome, 'email' => $request->email, 'siape' => $request->siape, 'eixo_id' => $request->eixo_id, 'ativo' => $request->status]);
        $aux->save();

        return redirect()->route('professores.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Professor::destroy($id);

        return redirect()->route('professores.index');
    }
}