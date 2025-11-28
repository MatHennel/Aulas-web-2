<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Dashboard do Cliente') }}
        </h2>
    </x-slot>

    @php
        $user = auth()->user();
        $meusProjetos = \App\Models\Projeto::where('cliente_id', $user->id)->count();
        $projetosAbertos = \App\Models\Projeto::where('cliente_id', $user->id)
                                              ->whereNull('dev_selecionado_id')
                                              ->count();
        
        $finalizados = \App\Models\Projeto::where('cliente_id', $user->id)
                                          ->where('status_id', 2)
                                          ->count();

        $projetos = \App\Models\Projeto::where('cliente_id', $user->id)
                                       ->orderBy('created_at', 'desc')
                                       ->take(5)
                                       ->get();
    @endphp

    <div class="py-12 text-white">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- INFO DO USUÁRIO --}}
            <div class="bg-gray-900 p-6 rounded-lg shadow mb-8">
                <h3 class="text-2xl font-semibold text-indigo-400">
                    Bem-vindo, {{ $user->name }}!
                </h3>
                <p class="text-gray-300 mt-1">
                    Aqui está o resumo dos seus projetos recentes.
                </p>
            </div>

            {{-- CARDS --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

                <div class="bg-indigo-600 p-5 rounded-lg shadow">
                    <h4 class="text-xl font-semibold">Meus Projetos</h4>
                    <p class="text-3xl font-bold mt-2">{{ $meusProjetos }}</p>
                </div>

                <div class="bg-gray-700 p-5 rounded-lg shadow">
                    <h4 class="text-xl font-semibold">Projetos em Aberto</h4>
                    <p class="text-3xl font-bold mt-2">{{ $projetosAbertos }}</p>
                </div>

                <div class="bg-green-600 p-5 rounded-lg shadow">
                    <h4 class="text-xl font-semibold">Finalizados</h4>
                    <p class="text-3xl font-bold mt-2">{{ $finalizados }}</p>
                </div>

            </div>

            {{-- LISTA DE PROJETOS --}}
            <div class="bg-gray-900 p-6 rounded-lg shadow">
                <h3 class="text-xl font-semibold mb-4 text-indigo-400">Últimos Projetos Criados</h3>

                @if($projetos->isEmpty())
                    <p class="text-gray-400">Você ainda não criou nenhum projeto.</p>
                @else
                    <ul class="space-y-4">
                        @foreach($projetos as $projeto)
                            <li class="p-4 bg-gray-800 rounded-lg border border-gray-700">
                                <div class="flex justify-between">
                                    <strong class="text-white">{{ $projeto->titulo }}</strong>
                                    <span class="text-gray-400 text-sm">
                                        {{ $projeto->created_at->format('d/m/Y') }}
                                    </span>
                                </div>
                                <p class="text-gray-300 mt-1">{{ $projeto->descricao }}</p>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
