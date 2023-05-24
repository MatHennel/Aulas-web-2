<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Disciplina;
use App\Models\Curso;



class DisciplinaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cursos = Curso::all();
        $disciplinas = Disciplina::all();

        return view('disciplinas.index')->with('cursos',$cursos)->with('disciplinas',$disciplinas);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cursos = Curso::all();
        return view('disciplinas.create')->with('dados',$cursos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        Disciplina::create(['nome' => $request->nome,'curso_id'=>$request->curso_id,'carga'=>$request->carga]);
        return redirect()->route('disciplinas.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $disciplina = Disciplina::find($id);
        $curso = Curso::find($disciplina->curso_id);

        return view('disciplinas.show')->with('curso',$curso)->with('disciplina',$disciplina);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $disciplina = Disciplina::find($id);
        $cursos = Curso::all();

        return view('disciplinas.edit')->with('dados',$cursos)->with('disciplina',$disciplina);

        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $disciplina = Disciplina::find($id);
        $disciplina->fill(['nome' => $request->nome,'curso_id'=>$request->curso_id,'carga'=>$request->carga]);
        $disciplina->save();

        return redirect()->route('disciplinas.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Disciplina::destroy($id);

        return redirect()->route('disciplinas.index');
    }

}
