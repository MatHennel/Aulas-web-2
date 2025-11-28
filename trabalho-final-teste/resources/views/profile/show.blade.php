<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Perfil do Desenvolvedor
            </h2>

            {{-- MÉDIA DAS AVALIAÇÕES --}}
            @php
                $mediaNotas = $avaliacoes->avg('nota');
            @endphp

            @if($mediaNotas)
                <div class="bg-indigo-600 text-white px-4 py-2 rounded-lg shadow">
                    ⭐ Avaliação: {{ number_format($mediaNotas, 1) }}
                </div>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 space-y-4">

                    <h3 class="text-2xl font-semibold mb-4 text-indigo-500">{{ $dev->name }}</h3>

                    @if($idade)
                        <p><strong>Idade:</strong> {{ $idade }} anos</p>
                    @endif

                    <p><strong>Email:</strong> {{ $dev->email }}</p>

                    <div class="mt-4">
                        <strong>Descrição:</strong>
                        <p class="mt-2 bg-gray-100 dark:bg-gray-700 p-4 rounded-md">
                            {{ $dev->descricao ?? 'Nenhuma descrição informada.' }}
                        </p>
                    </div>

                    <div class="mt-6">
                        <a href="{{ url()->previous() }}"
                           class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700 transition">
                            Voltar
                        </a>
                    </div>

                    {{-- LISTA DE AVALIAÇÕES --}}
                    <div class="mt-10 max-w-3xl mx-auto">
                        <h3 class="text-xl font-semibold text-indigo-500 mb-4">Avaliações Recebidas</h3>

                        <div class="max-h-80 overflow-y-auto pr-2">

                            @if($avaliacoes->isEmpty())
                                <p class="text-gray-500">Nenhuma avaliação recebida ainda.</p>
                            @else
                                <div class="space-y-4">
                                    @foreach($avaliacoes as $av)
                                        <div class="p-4 bg-gray-100 dark:bg-gray-700 rounded-lg shadow">

                                            <div class="flex justify-between items-center mb-2">
                                                <span class="text-lg font-semibold">⭐ {{ $av->nota }}</span>
                                                <span class="text-sm text-gray-500">
                                                    {{ $av->created_at->format('d/m/Y') }}
                                                </span>
                                            </div>

                                            <p class="text-gray-800 dark:text-gray-200 mb-3">
                                                {{ $av->descricao ?? 'Sem descrição.' }}
                                            </p>

                                            @if($av->cliente)
                                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                                    — Avaliado por <strong>{{ $av->cliente->name }}</strong>
                                                </p>
                                            @endif

                                        </div>
                                    @endforeach
                                </div>
                            @endif

                        </div> {{-- fim scroll --}}

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
