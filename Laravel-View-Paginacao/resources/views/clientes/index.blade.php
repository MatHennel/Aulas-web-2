@extends('templates.main', ['titulo' => "Clientes", 'rota' => "clientes.create"])
<!-- Preenche o conteúdo da seção "titulo" -->
@section('titulo') Clientes @endsection
<!-- Preenche o conteúdo da seção "conteudo" -->
@section('conteudo')




<div class="row">
<div class="col">
<!-- Utiliza o componente "datalist" criado -->
<x-datalist
crud="alunos"
:header="['ID', 'NOME', 'E-MAIL', 'AÇÕES']"
:data="$alunos"
:hide="[true, false, true, false]"
/>
</div>
</div>
@endsection
