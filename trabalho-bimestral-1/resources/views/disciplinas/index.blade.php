<!-- Herda o layout padrão definido no template "main" -->
@extends('templates.main', ['titulo' => "Disciplinas", 'rota' => "disciplinas.create"])
<!-- Preenche o conteúdo da seção "titulo" -->
@section('titulo') Disciplinas @endsection
<!-- Preenche o conteúdo da seção "conteudo" -->
@section('conteudo')

    <div class="row">
        <div class="col">
            <x-datatable 
                title="Disciplinas" 
                crud="disciplinas" 
                :header="['id', 'nome' , 'curso']" 
                :data="$disciplinas"
                :hide="[true, false, false]" 
            /> 
        </div>
    </div>
@endsection