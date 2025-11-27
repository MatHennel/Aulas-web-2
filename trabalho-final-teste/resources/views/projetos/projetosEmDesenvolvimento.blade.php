<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Projetos em Desenvolvimento') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- MENSAGENS --}}
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-600 text-white rounded-md">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('info'))
                <div class="mb-4 p-4 bg-blue-600 text-white rounded-md">
                    {{ session('info') }}
                </div>
            @endif

            {{-- LISTA --}}
            @if($projetos->isEmpty())
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 text-center">
                    <p class="text-gray-500 dark:text-gray-300">
                        Você ainda não foi selecionado para desenvolver nenhum projeto.
                    </p>
                </div>
            @else

                <div class="space-y-6">

                    @foreach($projetos as $projeto)
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

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

                            <div class="flex space-x-3 items-center">

                                {{-- BOTÃO ENTREGAR PROJETO --}}
                                @if(!$projeto->dataFinalizacao)
                                    <form action="{{ route('projetos.entregar', $projeto->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Tem certeza que deseja entregar este projeto?')">
                                        @csrf

                                        <button
                                            class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
                                            Entregar Projeto
                                        </button>
                                    </form>
                                @else
                                    <span class="text-green-500 font-semibold">
                                        Projeto entregue em:
                                        {{ \Carbon\Carbon::parse($projeto->dataFinalizacao)->format('d/m/Y H:i') }}
                                    </span>
                                @endif

                            </div>

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
</x-app-layout>
