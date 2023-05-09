@extends('templates.main')

@section('titulo') Mostrar Cliente @endsection

@section('conteudo')

<h2>Informações do Cliente</h2>



<h4>ID: {{ $dados['id'] }}</h4>

<h4>Nome: {{ $dados['nome'] }}</h4>

<h4>E-mail: {{ $dados['email'] }}</h4>

<a href="{{route('clientes.index')}}"><h4>voltar</h4></a>

@endsection