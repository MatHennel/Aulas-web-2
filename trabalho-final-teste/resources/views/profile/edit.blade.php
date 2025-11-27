<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Perfil
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Formulário de atualização de informações -->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PUT')

                        <!-- Nome -->
                        <div class="mt-4">
                            <label for="name" class="block font-medium text-sm text-gray-700 dark:text-gray-200">Nome</label>
                            <input id="name" type="text" name="name" value="{{ old('name', auth()->user()->name) }}" required
                                class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-md shadow-sm">
                        </div>

                        <!-- Email -->
                        <div class="mt-4">
                            <label for="email" class="block font-medium text-sm text-gray-700 dark:text-gray-200">Email</label>
                            <input id="email" type="email" name="email" value="{{ old('email', auth()->user()->email) }}" required
                                class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-md shadow-sm">
                        </div>

                        @if(auth()->user()->tipo_usuario == 1)
                            <!-- Desenvolvedor -->

                            <!-- CPF -->
                            <div class="mt-4">
                                <label for="cpfOuCep" class="block font-medium text-sm text-gray-700 dark:text-gray-200">CPF</label>
                                <input id="cpfOuCep" type="text" name="cpfOuCep"
                                    value="{{ old('cpfOuCep', auth()->user()->cpfOuCep) }}"
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-md shadow-sm">
                            </div>

                            <!-- Data de Nascimento -->
                            <div class="mt-4">
                                <label for="dataNascimento" class="block font-medium text-sm text-gray-700 dark:text-gray-200">Data de Nascimento</label>
                                <input id="dataNascimento" type="date" name="dataNascimento"
                                    value="{{ old('dataNascimento', auth()->user()->dataNascimento ? auth()->user()->dataNascimento->format('Y-m-d') : '') }}"
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-md shadow-sm">
                            </div>

                            <!-- Descrição -->
                            <div class="mt-4">
                                <label for="descricao" class="block font-medium text-sm text-gray-700 dark:text-gray-200">Descrição</label>
                                <textarea id="descricao" name="descricao" rows="4"
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-md shadow-sm">{{ old('descricao', auth()->user()->descricao) }}</textarea>
                            </div>

                        @elseif(auth()->user()->tipo_usuario == 2)
                            <!-- Cliente -->

                            <!-- CPF ou CNPJ -->
                            <div class="mt-4">
                                <label for="cpfOuCep" class="block font-medium text-sm text-gray-700 dark:text-gray-200">CPF ou CNPJ</label>
                                <input id="cpfOuCep" type="text" name="cpfOuCep"
                                    value="{{ old('cpfOuCep', auth()->user()->cpfOuCep) }}"
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-md shadow-sm">
                            </div>

                            <!-- Nome da Empresa -->
                            <div class="mt-4">
                                <label for="empresa" class="block font-medium text-sm text-gray-700 dark:text-gray-200">Empresa</label>
                                <input id="empresa" type="text" name="empresa"
                                    value="{{ old('empresa', auth()->user()->empresa ?? '') }}"
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-md shadow-sm">
                            </div>
                        @endif

                        <!-- Telefone -->
                        <div class="mt-4">
                            <label for="telefone" class="block font-medium text-sm text-gray-700 dark:text-gray-200">Telefone</label>
                            <input id="telefone" type="text" name="telefone"
                                value="{{ old('telefone', auth()->user()->telefone) }}"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-md shadow-sm">
                        </div>

                        <!-- Endereço -->
                        <div class="mt-4">
                            <label for="endereco" class="block font-medium text-sm text-gray-700 dark:text-gray-200">Endereço</label>
                            <input id="endereco" type="text" name="endereco"
                                value="{{ old('endereco', auth()->user()->endereco) }}"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-md shadow-sm">
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                Atualizar Perfil
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Formulário de atualização de senha -->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Formulário de exclusão de usuário -->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
