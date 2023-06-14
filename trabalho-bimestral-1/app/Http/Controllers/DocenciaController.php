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
        $vinculos = ProfessorDisciplina::with(['professor_id', 'disciplina_id'])->get();


        return view('docencias.index')->with('disciplinas',$disciplinas)->with('professores',$professores)->with('vinculo',$vinculos);
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

    foreach ($professores as $professorId => $disciplinaId) {
        

        $professor = Professor::find($professorId);

        if(isset($professor)){
            
            if (isset($disciplinaId)) {
            $obj_disciplina = Disciplina::find($disciplinaId);

            if (isset($obj_disciplina)) {
                $obj_professor_disciplina = new ProfessorDisciplina();
                $obj_professor_disciplina->professor()->associate($obj_disciplina);
                $obj_professor_disciplina->disciplina()->associate($professor);
                $obj_professor_disciplina->save();
            }
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
