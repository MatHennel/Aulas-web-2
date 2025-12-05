<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Projetos em Desenvolvimento') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- ABAS --}}
            <div class="flex mb-6 space-x-2">
                <button 
                    onclick="showTab('dev')" 
                    id="tab-dev"
                    class="px-4 py-2 font-semibold rounded-t-lg transition focus:outline-none">
                    Desenvolvendo
                </button>

                <button 
                    onclick="showTab('orientador')" 
                    id="tab-orientador"
                    class="px-4 py-2 font-semibold rounded-t-lg transition focus:outline-none">
                    Orientando
                </button>
            </div>

            {{-- ============================
                ABA DESENVOLVEDOR
            ============================= --}}
            <div id="content-dev">
                @if($projetosDev->isEmpty())
                    <div class="bg-white dark:bg-gray-800 p-6 rounded shadow text-center">
                        <p class="text-gray-500 dark:text-gray-300">
                            Você ainda não está desenvolvendo nenhum projeto.
                        </p>
                    </div>
                @else
                    <div class="space-y-6 max-h-[600px] overflow-y-auto pr-2">
                        @foreach($projetosDev as $projeto)
                            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                                <h3 class="text-2xl font-bold text-indigo-700 dark:text-indigo-400 mb-3">
                                    {{ $projeto->nome }}
                                </h3>
                                <p class="text-gray-700 dark:text-gray-300 mb-2">
                                    <strong>Descrição:</strong> {{ $projeto->descricao }}
                                </p>
                                <p class="text-gray-700 dark:text-gray-300 mb-2">
                                    <strong>Valor:</strong> R$ {{ number_format($projeto->valor, 2, ',', '.') }}
                                </p>
                                <p class="text-gray-700 dark:text-gray-300 mb-4">
                                    <strong>Cliente:</strong>
                                    {{ $projeto->cliente ? $projeto->cliente->name : 'Não informado' }}
                                    @if($projeto->cliente)
                                        <span class="text-sm text-gray-500">
                                            ({{ $projeto->cliente->email }})
                                        </span>
                                    @endif
                                </p>

                                {{-- ORIENTADOR --}}
                                <p class="text-gray-700 dark:text-gray-300 mb-4">
                                    <strong>Orientador:</strong>
                                    @php
                                        $orientadorSel = $projeto->orientadores->where('id', $projeto->dev_orientador_selecionado_id)->first();
                                    @endphp
                                    @if($orientadorSel)
                                        {{ $orientadorSel->name }}
                                        <span class="text-sm text-gray-500">
                                            ({{ $orientadorSel->email }})
                                        </span>
                                    @else
                                        <span class="text-gray-500">Nenhum selecionado</span>
                                    @endif
                                </p>

                                {{-- BOTÕES EM FLEX --}}
                                <div class="flex flex-wrap gap-2 mt-4">
                                    {{-- BOTÃO SELECIONAR ORIENTADOR --}}
                                    @if($projeto->orientadores->count() > 0 && !$projeto->dev_orientador_selecionado_id)
                                        <button 
                                            onclick="openOrientadoresModal({{ $projeto->id }})"
                                            class="flex-1 bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition text-center">
                                            Selecionar Orientador
                                        </button>
                                    @elseif($projeto->dev_orientador_selecionado_id)
                                        <span class="flex-1 bg-green-600 text-white px-4 py-2 rounded-lg text-center">
                                            Orientador Selecionado ✔
                                        </span>
                                    @endif


                                    {{-- CHAT --}}
                                    <a href="{{ route('chat.projeto', $projeto->id) }}"
                                       class="flex-1 bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition text-center">
                                        Chat do Projeto
                                    </a>

                                    {{-- ENTREGAR PROJETO --}}
                                    @if(!$projeto->dataFinalizacao)
                                        <form action="{{ route('projetos.entregar', $projeto->id) }}"
                                            method="POST"
                                            class="flex-1"
                                            onsubmit="return confirm('Tem certeza que deseja entregar este projeto?')">
                                            @csrf
                                            <button
                                                class="w-full bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
                                                Entregar Projeto
                                            </button>
                                        </form>
                                    @else
                                        <span class="flex-1 text-center text-green-500 font-semibold">
                                            Projeto entregue em:
                                            {{ \Carbon\Carbon::parse($projeto->dataFinalizacao)->format('d/m/Y H:i') }}
                                        </span>
                                    @endif
                                </div>

                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- ============================
                ABA ORIENTADOR
            ============================= --}}
            <div id="content-orientador" class="hidden">
                @if($projetosOrientador->isEmpty())
                    <div class="bg-white dark:bg-gray-800 p-6 rounded shadow text-center">
                        <p class="text-gray-500 dark:text-gray-300">
                            Você não está orientando nenhum projeto.
                        </p>
                    </div>
                @else
                    <div class="space-y-6 max-h-[600px] overflow-y-auto pr-2">
                        @foreach($projetosOrientador as $projeto)
                            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                                <h3 class="text-2xl font-bold text-indigo-700 dark:text-indigo-400 mb-3">
                                    {{ $projeto->nome }}
                                </h3>
                                <p class="text-gray-700 dark:text-gray-300 mb-2">
                                    <strong>Descrição:</strong> {{ $projeto->descricao }}
                                </p>
                                <p class="text-gray-700 dark:text-gray-300 mb-2">
                                    <strong>Valor:</strong> R$ {{ number_format($projeto->valor, 2, ',', '.') }}
                                </p>
                                <p class="text-gray-700 dark:text-gray-300 mb-4">
                                    <strong>Cliente:</strong>
                                    {{ $projeto->cliente ? $projeto->cliente->name : 'Não informado' }}
                                    @if($projeto->cliente)
                                        <span class="text-sm text-gray-500">
                                            ({{ $projeto->cliente->email }})
                                        </span>
                                    @endif
                                </p>

                                {{-- CHAT --}}
                                <div class="mt-3">
                                    <a href="{{ route('chat.projeto', $projeto->id) }}"
                                       class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">
                                        Chat do Projeto
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>

{{-- MODAL ORIENTADORES --}}
<div id="modalOrientadores"
     class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg w-full max-w-lg">
        <h2 class="text-xl font-bold mb-4 text-gray-800 dark:text-white">
            Selecionar Orientador
        </h2>
        <div id="listaOrientadores"></div>
        <button onclick="closeOrientadoresModal()"
                class="mt-4 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
            Fechar
        </button>
    </div>
</div>

<script>
    const projetos = @json($projetosDev);
    let selectedTab = 'dev';

    function showTab(tab) {
        selectedTab = tab;

        document.getElementById('content-dev').classList.toggle('hidden', tab !== 'dev');
        document.getElementById('content-orientador').classList.toggle('hidden', tab !== 'orientador');

        const devBtn = document.getElementById('tab-dev');
        const orientBtn = document.getElementById('tab-orientador');

        if(tab === 'dev') {
            devBtn.classList.add('bg-indigo-600', 'text-white');
            devBtn.classList.remove('bg-gray-100', 'dark:bg-gray-800', 'text-gray-700', 'dark:text-gray-300');

            orientBtn.classList.remove('bg-indigo-600', 'text-white');
            orientBtn.classList.add('bg-gray-100', 'dark:bg-gray-800', 'text-gray-700', 'dark:text-gray-300');
        } else {
            orientBtn.classList.add('bg-indigo-600', 'text-white');
            orientBtn.classList.remove('bg-gray-100', 'dark:bg-gray-800', 'text-gray-700', 'dark:text-gray-300');

            devBtn.classList.remove('bg-indigo-600', 'text-white');
            devBtn.classList.add('bg-gray-100', 'dark:bg-gray-800', 'text-gray-700', 'dark:text-gray-300');
        }
    }

    function openOrientadoresModal(projetoId) {
        const projeto = projetos.find(p => p.id === projetoId);
        if (!projeto) return;

        const lista = projeto.orientadores || [];
        let html = '';

        lista.forEach(o => {
            let botao = '';
            if (projeto.dev_orientador_selecionado_id === o.id) {
                botao = `<span class="bg-green-600 text-white px-3 py-1 rounded">Selecionado ✔</span>`;
            } else {
                botao = `
                    <form method="POST" action="/projetos/${projetoId}/selecionar-orientador/${o.id}">
                        @csrf
                        <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">
                            Selecionar
                        </button>
                    </form>
                `;
            }

            html += `
                <div class="border border-gray-300 dark:border-gray-700 rounded p-3 mb-3">
                    <p class="text-gray-900 dark:text-white font-semibold">${o.name}</p>
                    <p class="text-gray-600 dark:text-gray-300 text-sm">${o.email}</p>
                    <div class="mt-3 flex space-x-2">
                        <a href="/profile/${o.id}" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">Ver Perfil</a>
                        ${botao}
                    </div>
                </div>
            `;
        });

        document.getElementById('listaOrientadores').innerHTML = html;
        document.getElementById('modalOrientadores').classList.remove('hidden');
        document.getElementById('modalOrientadores').classList.add('flex');
    }

    function closeOrientadoresModal() {
        document.getElementById('modalOrientadores').classList.remove('flex');
        document.getElementById('modalOrientadores').classList.add('hidden');
    }

    showTab(selectedTab);
</script>
