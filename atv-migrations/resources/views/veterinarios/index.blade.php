<!-- <h2>Lista de Clientes</h2>
<a href="{{ route('veterinarios.create') }}">
    <h4>Novo Cliente</h4>
</a>
<table>
    <thead>
        <tr>
            <th>CRMV</th>
            <th>NOME</th>
            <th>ESPECIALIDADE</th>
            <th>INFO</th>
            <th>EDITAR</th>
            <th>REMOVER</th>
        </tr>
    </thead>
    <tbody>
        
        @foreach ($veterinarios as $item)
        <tr> 
            
            <td>{{ $item['crmv'] }}</td>
            <td>{{ $item['nome'] }}</td>
            <td>{{ $item['especialidade'] }}</td>
            <td><a href="{{ route('veterinarios.show', $item['crmv']) }}">info</a></td>
            <td><a href="{{ route('veterinarios.edit', $item['crmv']) }}">editar</a></td>
            <td>
                <form action="{{ route('veterinarios.destroy', $item['crmv']) }}" method="POST">
                   
                    @csrf
                    @method('DELETE')
                    <input type='submit' value='remover'>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table> -->


<!-- Herda o layout padrão definido no template "main" -->
@extends('templates.main', ['titulo' => "Veterinarios", 'rota' => "veterinarios.create"])
<!-- Preenche o conteúdo da seção "titulo" -->
@section('titulo') Veterinarios @endsection
<!-- Preenche o conteúdo da seção "conteudo" -->
@section('conteudo')

    <div class="row">
        <div class="col">
            <x-datatable 
                title="Veterinario" 
                crud="veterinarios" 
                :header="['crmv', 'nome', 'especialidade', 'ações']" 
                :data="$veterinarios"
                :hide="[true, false, true, false]" 
            /> 
        </div>
    </div>
@endsection