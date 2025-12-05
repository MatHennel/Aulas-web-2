<?php

namespace App\Http\Controllers;

use App\Models\Projeto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjetoController extends Controller
{
    public function selecionarOrientador($projetoId, $orientadorId)
    {
        $projeto = Projeto::findOrFail($projetoId);

        $projeto->dev_orientador_selecionado_id = $orientadorId;
        $projeto->save();

        return back()->with('success', 'Orientador selecionado com sucesso!');
    }

    public function orientar(Projeto $projeto)
    {
        $userId = Auth::id();

        // Evitar que dev selecionado possa orientar
        if ($projeto->dev_selecionado_id == $userId) {
            return back()->with('error', 'Você já está desenvolvendo este projeto.');
        }

        // Evitar dupla inscrição como orientador
        if ($projeto->orientadores->contains($userId)) {
            return back()->with('error', 'Você já está inscrito como orientador.');
        }

        $projeto->orientadores()->attach($userId);

        return back()->with('success', 'Você se inscreveu como orientador!');
    }

    public function projetosEntregues()
    {
        $devId = auth()->id();

        $projetos = Projeto::where('dev_selecionado_id', $devId)
                            ->whereNotNull('dataFinalizacao')
                            ->where('status_id',2)
                            ->get();

        return view('projetos.projetosEntregues', compact('projetos'));
    }

    public function entregar($id)
    {
        $projeto = Projeto::findOrFail($id);

        // Verificar se o usuário logado é o dev selecionado
        if ($projeto->dev_selecionado_id !== Auth::id()) {
            abort(403, "Você não tem permissão para entregar este projeto.");
        }

        // Se já estiver finalizado, não deixa finalizar de novo
        if (!is_null($projeto->dataFinalizacao)) {
            return back()->with('info', 'Este projeto já foi finalizado.');
        }

        // Atualizar status e data
        $projeto->status_id = 2; // ID do status "Finalizado" (ajuste conforme sua tabela)
        $projeto->dataFinalizacao = now();
        $projeto->save();

        return back()->with('success', 'Projeto entregue com sucesso!');
    }


    public function projetosEmDesenvolvimento()
    {
        $devId = auth()->id();

        $projetosDev = Projeto::where('status_id', 1)
            ->where('dev_selecionado_id', $devId)
            ->with(['cliente', 'orientadores'])
            ->get();

        $projetosOrientador = Projeto::where('status_id', 1)
            ->where('dev_orientador_selecionado_id', $devId)
            ->with(['cliente', 'orientadores'])
            ->get();

        return view('projetos.projetosEmDesenvolvimento', compact('projetosDev','projetosOrientador'));

    }


    /**
     * Selecionar um dev para um projeto do cliente.
     */
    public function selecionarDev($projetoId, $devId)
    {
        $user = Auth::user();

        // O cliente só pode selecionar devs dos seus próprios projetos
        $projeto = Projeto::where('cliente_id', $user->id)->findOrFail($projetoId);
        $projeto->dev_selecionado_id = $devId;
        $projeto->status_id = 1; // 1 = Desenvolvimento (ajuste se usar outra tabela)
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
        if ($user->tipo_usuario != 2) {
            abort(403, "Acesso negado.");
        }

        // Carrega os projetos do cliente com seus devs inscritos
        $projetos = Projeto::with(['devs', 'devSelecionado'])
            ->where('cliente_id', $user->id)
            ->whereNull('status_id')
            ->get();

        return view('projetos.meusDevs', compact('projetos'));
    }

    /**
     * Listar projetos do cliente logado.
     */
    public function index()
    {
        $userId = Auth::id();
        $filtro = request('filtro');

        $query = Projeto::where("cliente_id", $userId);

        switch ($filtro) {
            case 'sem':
                $query->whereNull('status_id');
                break;

            case 'dev':
                $query->where('status_id', 1);
                break;

            case 'concluido':
                $query->where('status_id', 2);
                break;

            // todos -> não aplica filtro
            default:
                // mostra tudo
                break;
        }

        $projetos = $query->get();

        return view('projetos.index', compact('projetos'));
    }


    /**
     * Exibir todos os projetos disponíveis para os desenvolvedores.
     */
    public function projetosDisponiveis()
    {
        $user = Auth::user();

        if ($user->tipo_usuario != 1) {
            abort(403, "Acesso negado.");
        }

        $userId = Auth::id();

        $projetos = Projeto::with('devs')
            ->whereNull('status_id') // Projetos sem status, disponíveis
            ->orWhere(function($query) use ($userId) {
                $query->where('status_id', 1) // Projetos em desenvolvimento
                    ->where('dev_selecionado_id', '!=', $userId)
                    ->where(function($q) use ($userId) {
                        $q->whereNull('dev_orientador_selecionado_id')
                            ->orWhere('dev_orientador_selecionado_id', '!=', $userId);
                    });
            })
            ->get();


        return view('projetos.disponiveis', compact('projetos'));
    }


    /**
     * Inscrever um dev em um projeto.
     */
    public function inscrever(Request $request, Projeto $projeto)
    {
        $user = Auth::user();

        if ($user->tipo_usuario != 1) {
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
