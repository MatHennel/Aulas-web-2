<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Projetos Disponíveis') }}
            </h2>
        </div>
    </x-slot>

    @if(session('success'))
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                {{ session('success') }}
            </div>
        </div>
    @endif

    <div class="py-12 space-y-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @forelse($projetos as $projeto)
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="grid gap-4">
                            <div class="col-span-2 sm:col-span-1">
                                <div class="p-4 flex justify-between items-center w-full">
                                    <h2 class="text-2xl font-semibold">
                                        {{ $projeto->nome }}
                                    </h2>

                                    @php
                                        $jaInscrito = $projeto->devs->contains(Auth::id());
                                    @endphp

                                    @if(!$jaInscrito)
                                        <form method="POST" action="{{ route('projetos.inscrever', $projeto) }}">
                                            @csrf
                                            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">
                                                Inscrever-se
                                            </button>
                                        </form>
                                    @else
                                        <span class="px-4 py-2 bg-gray-400 text-white rounded">Já inscrito</span>
                                    @endif
                                </div>

                                <div class="bg-gray-100 dark:bg-gray-900 p-4 w-full">
                                    {{ $projeto->descricao }}
                                </div>

                                <div class="p-4 flex justify-between w-full">
                                    <div>Valor: R$ {{ $projeto->valor }}</div>
                                    <div>Data Prevista: {{ \Carbon\Carbon::parse($projeto->dataEntrega)->locale('pt')->isoFormat('DD [de] MMMM [de] YYYY') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900 dark:text-gray-100">
                    Não há projetos disponíveis no momento.
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
