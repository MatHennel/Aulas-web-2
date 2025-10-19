<?php

namespace App\Http\Controllers;

use App\Models\Projeto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjetoController extends Controller
{
    /**
     * Selecionar um dev para um projeto do cliente.
     */
    public function selecionarDev($projetoId, $devId)
    {
        $user = Auth::user();

        // O cliente só pode selecionar devs dos seus próprios projetos
        $projeto = Projeto::where('cliente_id', $user->id)->findOrFail($projetoId);
        $projeto->dev_selecionado_id = $devId;
        $projeto->save();

        return back()->with('success', 'Desenvolvedor selecionado com sucesso!');
    }

    /**
     * Mostrar os devs inscritos nos projetos do cliente.
     */
    public function meusDevs()
    {
        $user = Auth::user();

        // Somente o cliente pode ver seus devs
        if ($user->type_id != 2) {
            abort(403, "Acesso negado.");
        }

        // Carrega os projetos do cliente com seus devs inscritos
        $projetos = Projeto::with(['devs', 'devSelecionado'])
            ->where('cliente_id', $user->id)
            ->get();

        return view('projetos.meusDevs', compact('projetos'));
    }

    /**
     * Listar projetos do cliente logado.
     */
    public function index()
    {
        $userId = Auth::id();

        $projetos = Projeto::where("cliente_id", $userId)->get();

        return view('projetos.index', compact('projetos'));
    }

    /**
     * Exibir todos os projetos disponíveis para os desenvolvedores.
     */
    public function projetosDisponiveis()
    {
        $user = Auth::user();

        if ($user->type_id != 1) {
            abort(403, "Acesso negado.");
        }

        // Carrega os projetos com os devs inscritos
        $projetos = Projeto::with('devs')->get();

        return view('projetos.disponiveis', compact('projetos'));
    }

    /**
     * Inscrever um dev em um projeto.
     */
    public function inscrever(Request $request, Projeto $projeto)
    {
        $user = Auth::user();

        if ($user->type_id != 1) {
            abort(403, "Acesso negado.");
        }

        // Evitar inscrição duplicada
        if (!$projeto->devs->contains($user->id)) {
            $projeto->devs()->attach($user->id);
        }

        return redirect()->route('projetos.disponiveis')->with('success', 'Inscrição realizada com sucesso!');
    }

    /**
     * Formulário para o cliente criar novo projeto.
     */
    public function create()
    {
        return view('projetos.create');
    }

    /**
     * Armazenar projeto criado pelo cliente.
     */
    public function store(Request $request)
    {
        $user_id = Auth::id(); // cliente logado

        $projeto = new Projeto();
        $projeto->nome = $request->nome;
        $projeto->descricao = $request->descricao;
        $projeto->valor = $request->valor;
        $projeto->dataEntrega = $request->dataEntrega;
        $projeto->cliente_id = $user_id;
        $projeto->save();

        return redirect()->route('projetos.index')->with('success', 'Projeto criado com sucesso!');
    }

    /**
     * Formulário de edição de projeto.
     */
    public function edit(Projeto $projeto)
    {
        return view('projetos.edit', compact('projeto'));
    }

    /**
     * Atualizar projeto do cliente.
     */
    public function update(Request $request, Projeto $projeto)
    {
        $projeto->update([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'valor' => $request->valor,
            'dataEntrega' => $request->dataEntrega,
        ]);

        return redirect()->route('projetos.index')->with('success', 'Projeto atualizado com sucesso!');
    }

    /**
     * Excluir projeto.
     */
    public function destroy(Projeto $projeto)
    {
        $projeto->delete();

        return redirect()->route('projetos.index')->with('success', 'Projeto removido com sucesso!');
    }
}
