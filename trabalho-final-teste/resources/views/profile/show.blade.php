<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Perfil do Desenvolvedor
        </h2>
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
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
