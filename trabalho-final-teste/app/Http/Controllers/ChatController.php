<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Projeto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index(Projeto $projeto)
    {
        return view('chat.index', compact('projeto'));
    }

    public function enviar(Request $request, Projeto $projeto)
    {
        $request->validate([
            'mensagem' => 'required|string'
        ]);

        Chat::create([
            'projeto_id' => $projeto->id,
            'user_id' => Auth::id(),
            'mensagem' => $request->mensagem
        ]);

        return response()->json(['success' => true]);
    }

    public function mensagens(Projeto $projeto)
    {
        $mensagens = Chat::with('user')
            ->where('projeto_id', $projeto->id)
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json($mensagens);
    }

    public function projetosEmDesenvolvimento()
    {
        $devId = auth()->id();

        $projetos = Projeto::where('dev_selecionado_id', $devId)->get();

        return view('projetos.projetosEmDesenvolvimento', compact('projetos'));
    }
}
