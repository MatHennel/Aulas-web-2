<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Aluno;

use App\Models\Curso;


class AlunoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alunos = Aluno::all();

        
        return view('alunos.index',compact(['alunos']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $dados = Curso::all();

        return view('alunos.create',compact(['dados']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $regras = [

            'nome' => 'required|max:100|min:10',
            
        ];

        $msgs = [
            "required" => "Preenchimento obrigatório!",
            "max" => "Tamanho máximo de :max caracteres!",
            "min" => "Tamanho mínimo de :min caracteres!"
        ];

        $request->validate($regras,$msgs);

        $aluno = new Aluno();
        $aluno->nome = $request->nome;
        $curso = Curso::find($request->curso_id);
        $aluno->curso()->associate($curso);
        $aluno->save();

        return redirect()->route('alunos.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
