<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Meus Projetos e Desenvolvedores') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 space-y-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">

            @forelse($projetos as $projeto)
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-2xl font-bold text-indigo-700 mb-4">{{ $projeto->nome }}</h3>

                    @if($projeto->devs->isEmpty())
                        <p class="text-gray-500">Nenhum desenvolvedor inscrito neste projeto.</p>
                    @else
                        <table class="min-w-full text-left border border-gray-300 dark:border-gray-700">
                            <thead class="bg-gray-100 dark:bg-gray-900">
                                <tr>
                                    <th class="py-2 px-4 border-b">Nome</th>
                                    <th class="py-2 px-4 border-b">Email</th>
                                    <th class="py-2 px-4 border-b text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($projeto->devs as $dev)
                                    <tr class="border-b dark:border-gray-700">
                                        <td class="py-2 px-4">{{ $dev->name }}</td>
                                        <td class="py-2 px-4">{{ $dev->email }}</td>
                                        <td class="py-2 px-4 text-center space-x-2">
                                            <a href="{{ route('profile.show', $dev->id) }}"
                                               class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 transition">
                                                Ver Perfil
                                            </a>

                                            <form method="POST" action="{{ route('projetos.selecionarDev', [$projeto->id, $dev->id]) }}" class="inline">
                                                @csrf
                                                <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700 transition">
                                                    Selecionar
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            @empty
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <p class="text-gray-500">Você ainda não criou nenhum projeto.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
