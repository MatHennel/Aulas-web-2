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
                :header="['id','nome','ações']"
                :data="$dados"
                :hide="[true,false,false]"
            /> 
        </div>
    </div>
@endsection

<!-- 
<h2>Lista de Clientes</h2>
<a href="{{ route('eixos.create') }}">
    <h4>Novo Cliente</h4>
</a>
<table>
    <thead>
        <tr>
            <th>NOME</th>
            <th>INFO</th>
            <th>EDITAR</th>
            <th>REMOVER</th>
        </tr>
    </thead>
    <tbody>
        
        @foreach ($eixos as $item)
        <tr> 
            
            <td>{{ $item['nome'] }}</td>
            <td>{{ $item['especialidade'] }}</td>
            <td><a href="{{ route('eixos.show', $item['id']) }}">info</a></td>
            <td><a href="{{ route('eixos.edit', $item['id']) }}">editar</a></td>
            <td>
                <form action="{{ route('eixos.destroy', $item['id']) }}" method="POST">
                   
                    @csrf
                    @method('DELETE')
                    <input type='submit' value='remover'>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table> -->