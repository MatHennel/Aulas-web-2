<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Curso;

use App\Models\Eixo;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dados = Curso::all();

        return view('cursos.index',compact(['dados']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dados = Eixo::all();

        return view('cursos.create',compact(['dados']));
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $regras = [

            'nome' => 'required|max:50|min:10',
            'sigla' => 'required|max:8|min:2',
            'tempo' => 'required|max:2|min:1'
        ];

        $msgs = [
            "required" => "Preenchimento obrigatório!",
            "max" => "Tamanho máximo de :max caracteres!",
            "min" => "Tamanho mínimo de :min caracteres!"
        ];

        $request->validate($regras,$msgs);

        $dados = $request->only(['nome', 'sigla', 'tempo']);
    
        $curso = new Curso($dados);
        
        $eixo = Eixo::find($request->input('eixo_id'));
        
        $curso->eixo()->associate($eixo);
        
        $curso->save();
        


        return redirect()->route('cursos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $curso = Curso::find($id);

        $eixo = Eixo::find($curso->eixo_id);

        return view('cursos.show')->with('curso',$curso)->with('eixo',$eixo);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
{
    $curso = Curso::find($id);

    $eixos = Eixo::all();


    

    

    return view('cursos.edit')->with('curso', $curso)->with('eixos', $eixos);
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $aux = Curso::find($id);
        $regras = [

            'nome' => 'required|max:50|min:10',
            'sigla' => 'required|max:8|min:2',
            'tempo' => 'required|max:2|min:1'
        ];

        $msgs = [
            "required" => "Preenchimento obrigatório!",
            "max" => "Tamanho máximo de :max caracteres!",
            "min" => "Tamanho mínimo de :min caracteres!"
        ];

        $request->validate($regras,$msgs);
        
        $aux->fill(['nome' => $request->nome , 'sigla' => $request->sigla , 'tempo' => $request->tempo, 'eixo_id' => $request->eixo_id]);
        $aux->save();

        return redirect()->route('cursos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Curso::destroy($id);

        return redirect()->route('cursos.index');
    }
}
