<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Aluno;
use App\Models\Disciplina;
use App\Models\Matricula;

class MatriculaController extends Controller
{
    /**
     * Display a listing of the resource.
     *@param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $aluno = Aluno::find($id);
    
        $disciplinas = Disciplina::all();
    
        $matriculas = Matricula::where('aluno_id',$id)->with(['aluno', 'disciplina'])->get()->toArray();
    
        return view('matriculas.index', compact('aluno', 'disciplinas', 'matriculas'));
    }

    public function store(Request $request){
        $disciplinas_id = $request->input('disciplinas_id');
        
        
        print_r($disciplinas_id);
    
        if($disciplinas_id == null) return redirect()->route('alunos.index');
    
        foreach ($disciplinas_id as $disciplinaIdAlunoId) {
            $ids = explode('_', $disciplinaIdAlunoId);
            $disciplinaId = $ids[0];
            $alunoId = $ids[1];
            
            
            $disciplina = Disciplina::find($disciplinaId);

            $auxMatriculas = Matricula::all()->toArray();

            

            

            

    
    
            if(isset($disciplina)){

                
                $aluno = Aluno::find($alunoId);
                
    
                if (isset($aluno)) {
                    $matricula = new Matricula();
                    $aluno->disciplina()->detach($disciplinaId);
                    $matricula->aluno()->associate($aluno);
                    $matricula->disciplina()->associate($disciplina);
                    $matricula->save();
                }
            
            }
    
            
        }

    return redirect()->route('alunos.index');
        
    }
    

   
}
