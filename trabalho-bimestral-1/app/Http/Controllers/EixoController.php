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
        Eixo::create(['nome' => $request->nome]);

        return redirect()->route('eixos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
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
