<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between mx-auto items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Meus Projetos') }}
            </h2>

            <h2>
                <a class="ml-2 inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md 
                font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:border-indigo-700 focus:ring 
                ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150" 
                href="{{ route('projetos.create') }}">
                    Criar Projeto
                </a>
            </h2>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto mt-6 px-6 flex gap-3 flex-wrap">
        <a href="{{ route('projetos.index', ['filtro' => 'todos']) }}"
        class="px-4 py-2 rounded-md font-semibold 
                {{ request('filtro') == 'todos' || !request('filtro') ? 'bg-indigo-600 text-white' : 'bg-gray-300 text-gray-800' }}">
            Todos
        </a>

        <a href="{{ route('projetos.index', ['filtro' => 'sem']) }}"
        class="px-4 py-2 rounded-md font-semibold 
                {{ request('filtro') == 'sem' ? 'bg-indigo-600 text-white' : 'bg-gray-300 text-gray-800' }}">
            Sem Status
        </a>

        <a href="{{ route('projetos.index', ['filtro' => 'dev']) }}"
        class="px-4 py-2 rounded-md font-semibold 
                {{ request('filtro') == 'dev' ? 'bg-indigo-600 text-white' : 'bg-gray-300 text-gray-800' }}">
            Em Desenvolvimento
        </a>

        <a href="{{ route('projetos.index', ['filtro' => 'concluido']) }}"
        class="px-4 py-2 rounded-md font-semibold
                {{ request('filtro') == 'concluido' ? 'bg-green-600 text-white' : 'bg-gray-300 text-gray-800' }}">
            Concluídos
        </a>
    </div>


    @foreach($projetos as $projeto)
        @php
            $statusNome = $projeto->status->status ?? 'Sem status';

            switch ($statusNome) {
                case 'Desenvolvimento':
                    $cor = 'bg-blue-100 text-blue-800 border-blue-300';
                    break;
                case 'Concluído':
                    $cor = 'bg-green-100 text-green-800 border-green-300';
                    break;
                case 'Cancelado':
                    $cor = 'bg-red-100 text-red-800 border-red-300';
                    break;
                default:
                    $cor = 'bg-gray-200 text-gray-700 border-gray-300';
            }
        @endphp

        <div class="py-7">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">

                        <div class="grid gap-4">
                            <div class="col-span-2 sm:col-span-1">

                                <div class="p-4 flex justify-between items-center w-full">
                                    <h2 class="text-center text-2xl font-semibold">
                                        {{ $projeto->nome }}
                                    </h2>

                                    <div class="flex justify-between items-center w-200">

                                        <a href="{{ route('projetos.edit', $projeto) }}" class="mr-5">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="cyan"
                                                class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 
                                                0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 
                                                9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 
                                                0 .316.316l2.414-.805a.5.5 0 0 0 
                                                .196-.12l6.813-6.814z" />
                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 
                                                0 0 0 2.5 15h11a1.5 1.5 
                                                0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 
                                                0v6a.5.5 0 0 1-.5.5h-11a.5.5 
                                                0 0 1-.5-.5v-11a.5.5 0 0 
                                                1 .5-.5H9a.5.5 0 0 0 
                                                0-1H2.5A1.5 1.5 0 0 
                                                0 1 2.5v11z" />
                                            </svg>
                                        </a>

                                        <form id="delete-form" action="{{ route('projetos.destroy', $projeto) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Tem certeza que deseja excluir?')">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="red"
                                                    class="bi bi-trash3" viewBox="0 0 16 16">
                                                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 
                                                    0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 
                                                    0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 
                                                    1.5v1H2.506a.58.58 0 0 0-.01 
                                                    0H1.5a.5.5 0 0 0 0 
                                                    1h.538l.853 10.66A2 2 0 0 0 
                                                    4.885 16h6.23a2 2 0 0 0 
                                                    1.994-1.84l.853-10.66h.538a.5.5 
                                                    0 0 0 0-1h-.995a.59.59 0 0 
                                                    0-.01 0H11Z" />
                                                </svg>
                                            </button>
                                        </form>

                                    </div>
                                </div>

                                <div class="px-4">
                                    <span class="px-3 py-1 border rounded text-sm font-semibold {{ $cor }}">
                                        {{ $statusNome }}
                                    </span>
                                </div>

                                <div class="bg-gray-100 dark:bg-gray-900 p-4 w-full mt-4">
                                    {{ $projeto->descricao }}
                                </div>

                                <div class="p-4 space-y-3">

                                    <div>
                                        Valor: R$ {{ $projeto->valor }}
                                    </div>

                                    <div>
                                        Data Prevista Para Entrega: 
                                        {{ \Carbon\Carbon::createFromFormat('Y-m-d', $projeto->dataEntrega)->locale('pt')->isoFormat('DD [de] MMMM [de] YYYY') }}
                                    </div>

                                    {{-- DATA DE FINALIZAÇÃO DO PROJETO --}}
                                    @if($projeto->status_id == 2 && $projeto->dataFinalizacao)

                                        @php
                                            $dataEntrega = \Carbon\Carbon::createFromFormat('Y-m-d', $projeto->dataEntrega);
                                            $dataFinalizada = \Carbon\Carbon::parse($projeto->dataFinalizacao);

                                            // Verifica se entregou no prazo (antes ou no dia)
                                            $entregueNoPrazo = $dataFinalizada->lte($dataEntrega);
                                        @endphp

                                        <div class="{{ $entregueNoPrazo ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }} font-semibold">
                                            Finalizado em: 
                                            {{ $dataFinalizada->locale('pt')->isoFormat('DD [de] MMMM [de] YYYY') }}

                                            {{-- Texto adicional opcional --}}
                                            @if($entregueNoPrazo)
                                                <span class="font-normal">(no prazo)</span>
                                            @else
                                                <span class="font-normal">(entregue após o prazo)</span>
                                            @endif
                                        </div>

                                    @endif


                                    <div class="mt-4 space-y-3">

                                        @if($projeto->status_id != null)
                                            <a href="{{ route('chat.projeto', $projeto->id) }}"
                                               class="block text-center px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition">
                                                💬 Chat do Projeto
                                            </a>
                                        @endif

                                        @if(auth()->user()->tipo_usuario == 2 && $projeto->status_id == 2)
                                            <button
                                                onclick="document.getElementById('modalAvaliacao_{{ $projeto->id }}').showModal()"
                                                class="w-full text-center {{ $projeto->avaliacao ? 'bg-gray-500' : 'bg-indigo-600' }} text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition">
                                                ⭐ {{ $projeto->avaliacao ? 'Ver Avaliação' : 'Avaliar Desenvolvedor' }}
                                            </button>
                                        @endif

                                    </div>

                                </div>

                                {{-- MODAL DE AVALIAÇÃO --}}
                                <dialog id="modalAvaliacao_{{ $projeto->id }}" class="overflow-hidden shadow-sm bg-white dark:bg-gray-800 rounded-xl shadow-xl p-0 max-w-lg w-full">

                                    <form method="POST"
                                        action="{{ route('projetos.avaliar', $projeto->id) }}"
                                        class="p-6 space-y-4">

                                        @csrf

                                        <h2 class="text-xl font-semibold text-indigo-600 mb-4">
                                            {{ $projeto->avaliacao ? 'Avaliação Enviada' : 'Avaliar Desenvolvedor' }}
                                        </h2>

                                        @php
                                            $ja = $projeto->avaliacao !== null;
                                            $avaliacao = $projeto->avaliacao;
                                        @endphp

                                        {{-- NOTA --}}
                                        <div>
                                            <label class="font-semibold text-white">Nota (0 a 10)</label>
                                            <input type="number" name="nota" step="0.1" min="0" max="10"
                                                class="w-full mt-1 px-3 py-2 border rounded"
                                                value="{{ $ja ? $avaliacao->nota : '' }}"
                                                {{ $ja ? 'readonly' : '' }} required
                                                oninput="if(this.value > 10) this.value = 10; if(this.value < 0) this.value = 0;">
                                        </div>

                                        {{-- DESCRIÇÃO --}}
                                        <div>
                                            <label class="font-semibold text-white">Descrição</label>
                                            <textarea name="descricao" rows="3"
                                                    class="w-full mt-1 px-3 py-2 border rounded"
                                                    {{ $ja ? 'readonly' : '' }}>{{ $ja ? $avaliacao->descricao : '' }}</textarea>
                                        </div>

                                        <div class="flex justify-end gap-3 mt-4">

                                            <button type="button"
                                                    onclick="document.getElementById('modalAvaliacao_{{ $projeto->id }}').close()"
                                                    class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
                                                Fechar
                                            </button>

                                            {{-- Só mostra botão enviar se ainda não tem avaliação --}}
                                            @if(!$ja)
                                                <button type="submit"
                                                        class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                                                    Enviar Avaliação
                                                </button>
                                            @endif

                                        </div>

                                    </form>

                                </dialog>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    @endforeach

</x-app-layout>
