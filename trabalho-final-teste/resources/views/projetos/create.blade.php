<x-app-layout>

    <form method="POST" action="{{ route('projetos.store') }}">
    @csrf
    
    <x-slot name="header">
    
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Novo Projeto') }} 
        </h2>
    

    </x-slot>

    

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-60">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8 text-gray-900 dark:text-gray-100 ">
                    <div class="p-1">
                        <x-input-label for="Nome" :value="__('Nome')" />
                        <x-text-input id="nome" class="block mt-1 w-full" type="text" name="nome" :value="old('nome')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('nome')" class="mt-2" />
                    </div>

                    <div class="p-1">
                        <x-input-label for="Descricao" :value="__('Descricao')" />
                        <textarea id="descricao" class="block mt-1 w-full rounded-md h-40 bg-gray-100 dark:bg-gray-900 text-white " name="descricao" required autofocus autocomplete="username">{{ old('descricao') }}</textarea>

                        <x-input-error :messages="$errors->get('descricao')" class="mt-2" />
                    </div>

                    <div class="p-1">
                        <x-input-label for="Valor" :value="__('Valor')" />
                        <x-text-input id="valor" class="block mt-1 w-full" type="number" inputmode="decimal" required name="valor" :value="old('valor')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('valor')" class="mt-2" />
                    </div>

                    <div class="p-1">
                        <x-input-label for="DataEntrega" :value="__('DataEntrega')" />
                        <x-text-input id="dataEntrega" class="block mt-1 w-full" type="date" name="dataEntrega" :value="old('dataEntrega')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('dataEntrega')" class="mt-2" />
                    </div>

                    <div class="pt-4 ">
                        <x-primary-button class="ml-2">
                            {{ __('Criar') }}
                        </x-primary-button>

                        <a href="{{ route('projetos.index') }}" class=" ml-3 inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            {{ __('Voltar') }}
                        </a>
                    </div>

                   
                    
                </div>
            </div>
        </div>
    </div>

    </form>

    
</x-app-layout>
