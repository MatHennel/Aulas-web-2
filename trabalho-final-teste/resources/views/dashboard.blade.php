<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @php
        $tipo = auth()->user()->tipo_usuario;
        $user = auth()->user();
    @endphp

    <div class="py-12 text-white">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-gray-900 p-6 rounded-lg shadow mb-8">
                <h3 class="text-2xl font-semibold text-indigo-400">
                    Bem-vindo, {{ $user->name }}!
                </h3>
                <p class="text-gray-300 mt-1">
                    Aqui está um resumo da sua conta no sistema.
                </p>
            </div>

            {{-- CARDS DE INFORMAÇÕES --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                {{-- SE FOR CLIENTE --}}
                @if($tipo == 2)

                    {{-- TOTAL DE PROJETOS --}}
                    <div class="bg-indigo-600 p-5 rounded-lg shadow">
                        <h4 class="text-xl font-semibold">Meus Projetos</h4>
                        <p class="text-3xl font-bold mt-2">
                            {{ \App\Models\Projeto::where('cliente_id', $user->id)->count() }}
                        </p>
                    </div>

                    {{-- PROJETOS EM ABERTO --}}
                    <div class="bg-gray-700 p-5 rounded-lg shadow">
                        <h4 class="text-xl font-semibold">Projetos em Aberto</h4>
                        <p class="text-3xl font-bold mt-2">
                            {{ \App\Models\Projeto::where('cliente_id', $user->id)->whereNull('dev_selecionado_id')->count() }}
                        </p>
                    </div>

                    {{-- PROJETOS FINALIZADOS --}}
                    <div class="bg-green-600 p-5 rounded-lg shadow">
                        <h4 class="text-xl font-semibold">Finalizados</h4>
                        <p class="text-3xl font-bold mt-2">
                            {{ \App\Models\Projeto::where('cliente_id', $user->id)->where('status_id', 2)->count() }}
                        </p>
                    </div>

                @endif


                {{-- SE FOR DESENVOLVEDOR --}}
                @if($tipo == 1)

                    {{-- PROJETOS PARTICIPANDO --}}
                    <div class="bg-indigo-600 p-5 rounded-lg shadow">
                        <h4 class="text-xl font-semibold">Projetos em Andamento</h4>
                        <p class="text-3xl font-bold mt-2">
                            {{ \App\Models\Projeto::where('dev_selecionado_id', $user->id)->where('status_id', 1)->count() }}
                        </p>
                    </div>

                    {{-- PROJETOS FINALIZADOS --}}
                    <div class="bg-green-600 p-5 rounded-lg shadow">
                        <h4 class="text-xl font-semibold">Projetos Finalizados</h4>
                        <p class="text-3xl font-bold mt-2">
                            {{ \App\Models\Projeto::where('dev_selecionado_id', $user->id)->where('status_id', 2)->count() }}
                        </p>
                    </div>

                    {{-- MÉDIA DE AVALIAÇÕES --}}
                    <div class="bg-yellow-600 p-5 rounded-lg shadow">
                        <h4 class="text-xl font-semibold">Avaliação Média</h4>
                        @php
                            $avaliacoes = \App\Models\Avaliacao::where('dev_id', $user->id)->get();
                            $media = $avaliacoes->count() > 0 ? number_format($avaliacoes->avg('nota'), 1) : '—';
                        @endphp
                        <p class="text-3xl font-bold mt-2">
                            ⭐ {{ $media }}
                        </p>
                    </div>

                @endif

            </div>


            {{-- SE FOR DESENVOLVEDOR: LISTA RÁPIDA DE ÚLTIMAS AVALIAÇÕES --}}
            @if($tipo == 1)
                <div class="mt-10 bg-gray-900 p-6 rounded-lg shadow">
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
            @endif


            {{-- SE FOR CLIENTE: LISTA RÁPIDA DOS ÚLTIMOS PROJETOS --}}
            @if($tipo == 2)
                <div class="mt-10 bg-gray-900 p-6 rounded-lg shadow">
                    <h3 class="text-xl font-semibold mb-4 text-indigo-400">Últimos Projetos Criados</h3>

                    @php
                        $projetos = \App\Models\Projeto::where('cliente_id', $user->id)
                                                        ->orderBy('created_at', 'desc')
                                                        ->take(5)
                                                        ->get();
                    @endphp

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
            @endif

        </div>
    </div>
</x-app-layout>
