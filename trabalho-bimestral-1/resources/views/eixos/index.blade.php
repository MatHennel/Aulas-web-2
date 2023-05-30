<!-- Herda o layout padrão definido no template "main" -->
@extends('templates.main', ['titulo' => "Eixos", 'rota' => "eixos.create"])
<!-- Preenche o conteúdo da seção "titulo" -->
@section('titulo') Eixos @endsection
<!-- Preenche o conteúdo da seção "conteudo" -->
@section('conteudo')

    <div class="row">
        <div class="col">
            <x-datatable 
                title="Eixos" 
                crud="eixos" 
                :header="['id', 'nome']" 
                :data="$eixos"
                :hide="[true, false, false]" 
            /> 
        </div>
    </div>
@endsection