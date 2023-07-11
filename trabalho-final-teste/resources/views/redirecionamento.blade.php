<x-guest-layout>
<div class="flex flex-row">
    <a href="{{ route('register.create' ,  ['type' => 1]) }}" class="flex-grow ml-2 inline-flex items-center justify-center w-full px-4 py-2 bg-indigo-600 border border-transparent rounded-md 
        font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:border-indigo-700 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
        <span class="text-center">Sou Desenvolvedor</span>
    </a>
    <a href="{{ route('register.create',  ['type' => 2]) }}" class="flex-grow ml-2 inline-flex items-center justify-center w-full px-4 py-2 bg-indigo-600 border border-transparent rounded-md 
        font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:border-indigo-700 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150" >
        <span class="text-center">Sou cliente</span>
    </a>
</div>

</x-guest-layout>
