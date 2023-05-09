@extends('templates.main')

@section('titulo') Novo Cliente @endsection

@section('conteudo')


<h2>Cadastrar Cliente</h2>

<form action="{{ route('clientes.store') }}" method="POST">
    <!-- Token de segurança salvo na sessão, verificar o formulário submetido -->
    @csrf
    
    <label>Nome: </label> <input type='text' name='nome'>
    <label>E-mail: </label> <input type='text' name='email'>
    <input type="submit" value="Salvar">

    <a href="{{route('clientes.index')}}">
        <h4>voltar</h4>
    </a>
</form>

@endsection