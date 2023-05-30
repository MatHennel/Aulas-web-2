<!-- Herda o layout padrão definido no template "main" -->
@extends('templates.main', ['titulo' => "Professores", 'rota' => "professores.create"])
<!-- Preenche o conteúdo da seção "titulo" -->
@section('titulo') Professores @endsection
<!-- Preenche o conteúdo da seção "conteudo" -->
@section('conteudo')

    <div class="row">
        <div class="col">
            <x-datatable 
                title="Professores" 
                crud="professores" 
                :header="['id', 'nome' , 'eixo', 'status']" 
                :data="$professores"
                :hide="[true, false, false, false]" 
            /> 
        </div>
    </div>
@endsection