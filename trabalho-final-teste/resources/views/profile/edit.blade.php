<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Perfil
        </h2>
        {{-- MÉDIA DE NOTAS NO CANTO SUPERIOR DIREITO --}}
        @if($user->tipo_usuario == 1 && isset($avaliacoes) && $avaliacoes->count() > 0)
            @php
                $mediaNotas = $avaliacoes->avg('nota');
            @endphp

            <div class="w-full flex justify-end mt-4 px-6">
                <div class="bg-indigo-600 text-white px-4 py-2 rounded-lg shadow text-right">
                    ⭐ Avaliação: {{ number_format($mediaNotas, 1) }}
                </div>
            </div>
        @endif
    </x-slot>

    


    <div x-data="{ tab: 'perfil' }" class="py-12 text-white">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            {{-- NAV DAS ABAS --}}
            <div class="flex space-x-4 mb-6">

                <button 
                    class="px-4 py-2 rounded-lg"
                    :class="tab === 'perfil' ? 'bg-indigo-600' : 'bg-gray-700'"
                    @click="tab = 'perfil'">
                    Perfil
                </button>

                @if($user->tipo_usuario == 1)
                    <button 
                        class="px-4 py-2 rounded-lg"
                        :class="tab === 'avaliacoes' ? 'bg-indigo-600' : 'bg-gray-700'"
                        @click="tab = 'avaliacoes'">
                        Avaliações
                    </button>
                @endif

            </div>

            {{-- ABA PERFIL --}}
            <div x-show="tab === 'perfil'" x-cloak>
                <div class="bg-gray-900 shadow sm:rounded-lg p-6">

                    <h3 class="text-2xl font-semibold mb-4 text-indigo-400">Editar Perfil</h3>

                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PUT')

                        {{-- NOME --}}
                        <div class="mt-4">
                            <label class="block font-medium text-white">Nome</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                   class="mt-1 w-full rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600">
                        </div>

                        {{-- EMAIL --}}
                        <div class="mt-4">
                            <label class="block font-medium text-white">Email</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                   class="mt-1 w-full rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600">
                        </div>

                        {{-- CAMPOS EXTRA SE FOR DESENVOLVEDOR --}}
                        @if($user->tipo_usuario == 1)

                            <div class="mt-4">
                                <label class="block font-medium text-white">CPF</label>
                                <input type="text" name="cpfOuCep" value="{{ old('cpfOuCep', $user->cpfOuCep) }}"
                                       class="mt-1 w-full rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600">
                            </div>

                            <div class="mt-4">
                                <label class="block font-medium text-white">Data de Nascimento</label>
                                <input type="date" name="dataNascimento"
                                       value="{{ $user->dataNascimento ? $user->dataNascimento->format('Y-m-d') : '' }}"
                                       class="mt-1 w-full rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600">
                            </div>

                            <div class="mt-4">
                                <label class="block font-medium text-white">Descrição</label>
                                <textarea name="descricao" rows="4"
                                          class="mt-1 w-full rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600">{{ old('descricao', $user->descricao) }}</textarea>
                            </div>

                        @endif

                        {{-- TELEFONE --}}
                        <div class="mt-4">
                            <label class="block font-medium text-white">Telefone</label>
                            <input type="text" name="telefone" value="{{ old('telefone', $user->telefone) }}"
                                   class="mt-1 w-full rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600">
                        </div>

                        {{-- ENDEREÇO --}}
                        <div class="mt-4">
                            <label class="block font-medium text-white">Endereço</label>
                            <input type="text" name="endereco" value="{{ old('endereco', $user->endereco) }}"
                                   class="mt-1 w-full rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600">
                        </div>

                        <div class="flex justify-end mt-6">
                            <button type="submit"
                                class="px-6 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-500 transition">
                                Salvar
                            </button>
                        </div>

                    </form>
                </div>

                {{-- Alterar Senha --}}
                <div class="mt-8 bg-gray-900 p-6 rounded-lg shadow text-white">
                    @include('profile.partials.update-password-form')
                </div>

                {{-- Excluir Conta --}}
                <div class="mt-8 bg-gray-900 p-6 rounded-lg shadow text-white">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>


            {{-- ABA AVALIAÇÕES — SOMENTE PARA DESENVOLVEDOR --}}
            @if($user->tipo_usuario == 1)
                <div x-show="tab === 'avaliacoes'" x-cloak>

                    <div class="bg-gray-900 shadow sm:rounded-lg p-6">

                        <h3 class="text-2xl font-semibold text-indigo-400 mb-4">
                            Avaliações Recebidas
                        </h3>

                        @if($avaliacoes->isEmpty())
                            <p class="text-gray-300">Você ainda não recebeu avaliações.</p>
                        @else
                            <div class="space-y-4">

                                @foreach($avaliacoes as $avaliacao)
                                    <div class="p-4 bg-gray-800 rounded-lg border border-gray-700">

                                        <div class="flex justify-between">
                                            <strong class="text-lg text-white">
                                                Nota: {{ $avaliacao->nota }}
                                            </strong>

                                            <span class="text-gray-400 text-sm">
                                                {{ $avaliacao->created_at->format('d/m/Y') }}
                                            </span>
                                        </div>

                                        @if($avaliacao->descricao)
                                            <p class="mt-2 text-gray-300">
                                                {{ $avaliacao->descricao }}
                                            </p>
                                        @endif

                                    </div>
                                @endforeach

                            </div>
                        @endif

                    </div>

                </div>
            @endif

        </div>
    </div>
</x-app-layout>
