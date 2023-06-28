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
        
        /*$professores = Professor::all();
        $eixos = Eixo::all();
        foreach ($professores as $professor) {
            $eixo = $eixos->firstWhere('id', $professor->eixo_id);
            $professor->eixo = $eixo->nome;
        }*/
        $professores = Professor::with(['eixo'])->get();
        $p = 0;
        foreach ($professores as $professor) { //usando orm para colocar o nome do eixo
            $professor["eixo"] = $professor->eixo->nome;   
            $professores[$p] = $professor;
            $p++;
        }

        return view('professores.index', compact('professores'));
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

        $regras = [
            'nome' => 'required|max:100|min:10',
            'email' => 'required|max:250|min:15|unique:professores',
            'siape' => 'required|max:10|min:8|unique:professores',
            'status' => 'required'
        ];

        $msgs = [
            "required" => "Preenchimento obrigatório!",
            "max" => "Tamanho máximo de :max caracteres!",
            "min" => "Tamanho mínimo de :min caracteres!",
            "unique" => "Já existe esse :attribute cadastrado!"
        ];

        
        $request->validate($regras,$msgs);

        
        
       $professor = new Professor();

        $eixo = Eixo::find($request->eixo_id);

        if(isset($eixo)){
            $professor->nome = $request->nome;
            $professor->email = $request->email;
            $professor->siape = $request->siape;
            $professor->ativo = $request->status;
            $professor->eixo()->associate($eixo);
            $professor->save();

        }

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

        $regras = [
            'nome' => 'required|max:100|min:10',
            'email' => 'required|max:250|min:15|',
            'siape' => 'required|max:10|min:8|',
            'status' => 'required'
        ];

        $msgs = [
            "required" => "Preenchimento obrigatório!",
            "max" => "Tamanho máximo de :max caracteres!",
            "min" => "Tamanho mínimo de :min caracteres!",
            "unique" => "Já existe esse :attribute cadastrado!"
        ];

        $request->validate($regras,$msgs);


        $eixo = Eixo::find($request->eixo_id);

        if(isset($eixo)){
            $aux->nome = $request->nome;
            $aux->email = $request->email;
            $aux->siape = $request->siape;
            $aux->ativo = $request->status;
            $aux->eixo()->associate($eixo);
            $aux->save();

        }

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
