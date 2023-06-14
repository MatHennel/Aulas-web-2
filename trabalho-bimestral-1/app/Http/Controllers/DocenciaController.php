<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Disciplina;
use App\Models\Professor;
use App\Models\ProfessorDisciplina;



class DocenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $disciplinas = Disciplina::all();
        $professores = Professor::where('ativo','1')->get();
        $vinculos = ProfessorDisciplina::with(['professores','disciplinas']);
       

        return view('docencias.index')->with('disciplinas',$disciplinas)->with('professores',$professores)->with('vinculos',$vinculos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $professores = $request->input('professores_id');
    ProfessorDisciplina::truncate();

    

    foreach ($professores as $professorIdDisciplinaId) {
        $ids = explode('_', $professorIdDisciplinaId);
        $disciplinaId = $ids[0];
        $professorId = $ids[1];
        
        
        $professor = Professor::find($professorId);


        if(isset($professor)){
            
            
            $disciplina = Disciplina::find($disciplinaId);
            

            if (isset($disciplina)) {
                $obj_professor_disciplina = new ProfessorDisciplina();
                $obj_professor_disciplina->professor()->associate($professor);
                $obj_professor_disciplina->disciplina()->associate($disciplina);
                $obj_professor_disciplina->save();
            }
        
        }

        
    }

    return redirect()->route('disciplinas.index');
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
    public function destroy(string $id)
    {
        //
    }
}
