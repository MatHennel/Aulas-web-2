<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Dashboard do Desenvolvedor') }}
        </h2>
    </x-slot>

    @php
        $user = auth()->user();
        $projetosAndamento = \App\Models\Projeto::where('dev_selecionado_id', $user->id)
                                                ->where('status_id', 1)
                                                ->count();

        $projetosFinalizados = \App\Models\Projeto::where('dev_selecionado_id', $user->id)
                                                  ->where('status_id', 2)
                                                  ->count();

        $avaliacoes = \App\Models\Avaliacao::where('dev_id', $user->id)->get();
        $media = $avaliacoes->count() ? number_format($avaliacoes->avg('nota'), 1) : '—';
    @endphp

    <div class="py-12 text-white">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- INFO DO USUÁRIO --}}
            <div class="bg-gray-900 p-6 rounded-lg shadow mb-8">
                <h3 class="text-2xl font-semibold text-indigo-400">
                    Bem-vindo, {{ $user->name }}!
                </h3>
                <p class="text-gray-300 mt-1">
                    Aqui está o resumo dos seus projetos e avaliações.
                </p>
            </div>

            {{-- CARDS --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

                <div class="bg-indigo-600 p-5 rounded-lg shadow">
                    <h4 class="text-xl font-semibold">Projetos em Andamento</h4>
                    <p class="text-3xl font-bold mt-2">{{ $projetosAndamento }}</p>
                </div>

                <div class="bg-green-600 p-5 rounded-lg shadow">
                    <h4 class="text-xl font-semibold">Projetos Finalizados</h4>
                    <p class="text-3xl font-bold mt-2">{{ $projetosFinalizados }}</p>
                </div>

                <div class="bg-yellow-600 p-5 rounded-lg shadow">
                    <h4 class="text-xl font-semibold">Avaliação Média</h4>
                    <p class="text-3xl font-bold mt-2">⭐ {{ $media }}</p>
                </div>

            </div>

            {{-- ÚLTIMAS AVALIAÇÕES --}}
            <div class="bg-gray-900 p-6 rounded-lg shadow">
                <h3 class="text-xl font-semibold mb-4 text-indigo-400">Últimas Avaliações</h3>

                @if($avaliacoes->isEmpty())
                    <p class="text-gray-400">Você ainda não recebeu avaliações.</p>
                @else
                    <div class="space-y-4">
                        @foreach($avaliacoes->take(5) as $avaliacao)
                            <div class="p-4 bg-gray-800 rounded-lg border border-gray-700">
                                <div class="flex justify-between">
                                    <strong class="text-white">⭐ {{ $avaliacao->nota }}</strong>
                                    <span class="text-gray-400 text-sm">
                                        {{ $avaliacao->created_at->format('d/m/Y') }}
                                    </span>
                                </div>
                                <p class="mt-1 text-gray-300">
                                    {{ $avaliacao->descricao ?? 'Sem comentário.' }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
