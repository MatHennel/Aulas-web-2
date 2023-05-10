<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EspecialidadeController extends Controller
{
    
    public $especialidades = [[
        "id" => 1,
        "nome" => "Cardiologista",
        "descricao" => "Profissinal especialista em questões do coração"
    ]];

    public function __construct() {
        
        $aux = session('especialidades');

        if(!isset($aux)) {
            session(['especialidades' => $this->especialidades]);
        }
    }

    public function index() {
        
        $dados = session('especialidades');
        return view('especialidades.index', compact(['dados']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('especialidades.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $aux = session('especialidades');
        $ids = array_column($aux, 'id');

        if(count($ids) > 0) {
            $new_id = max($ids) + 1;
        }
        else {
            $new_id = 1;   
        }

        $novo = [
            "id" => $new_id,
            "nome" => $request->nome,
            "descricao" => $request->descricao
        ];

        array_push($aux, $novo);
        session(['especialidades' => $aux]);

        return redirect()->route('especialidades.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $aux = session('especialidades');
        
        $index = array_search($id, array_column($aux, 'id'));

        $dados = $aux[$index];

        return view('especialidades.show', compact('dados'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $aux = session('especialidades');
            
        $index = array_search($id, array_column($aux, 'id'));

        $dados = $aux[$index];    

        return view('especialidades.edit', compact('dados'));    
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
        $aux = session('especialidades');
        
        $index = array_search($id, array_column($aux, 'id'));

        $novo = [
            "id" => $id,
            "nome" => $request->nome,
            "descricao" => $request->descricao
        ];

        $aux[$index] = $novo;
        session(['especialidades' => $aux]);

        return redirect()->route('especialidades.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $aux = session('especialidades');
        
        $index = array_search($id, array_column($aux, 'id')); 

        unset($aux[$index]);

        session(['especialidades' => $aux]);

        return redirect()->route('especialidades.index');
    }
}
