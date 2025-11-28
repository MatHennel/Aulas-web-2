<?php

namespace App\Http\Controllers;

use App\Models\Projeto;
use App\Models\Avaliacao;
use Illuminate\Http\Request;

class AvaliacaoController extends Controller
{
    public function store(Request $request, Projeto $projeto)
    {
        if ($projeto->status_id != 2) {
            return back()->with('error', 'Não é possível avaliar um projeto que não está concluído.');
        }

        if ($projeto->avaliacao) {
            return back()->with('error', 'Você já avaliou este projeto.');
        }

        if (!$projeto->dev_selecionado_id) {
            return back()->with('error', 'Este projeto não possui um desenvolvedor selecionado.');
        }

        $request->validate([
            'nota' => 'required|numeric|min:0|max:10',
            'descricao' => 'nullable|string|max:500',
        ]);

        Avaliacao::create([
            'projeto_id' => $projeto->id,
            'dev_id' => $projeto->dev_selecionado_id, // AQUI CORRIGIDO
            'cliente_id' => auth()->id(),
            'nota' => $request->nota,
            'descricao' => $request->descricao,
        ]);

        return back()->with('success', 'Avaliação enviada com sucesso!');
    }

}
