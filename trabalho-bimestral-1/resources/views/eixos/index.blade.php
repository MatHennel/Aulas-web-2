<!-- 
@extends('templates.main', ['titulo' => "Eixos", 'rota' => "eixos.create"])

@section('titulo') Eixos @endsection

@section('conteudo')

    <div class="row">
        <div class="col">
            
            <x-datatable
                title="Eixos" 
                crud="eixos" 
                :header="['id','nome','ações']"
                :data="$eixos"
                :hide="[true,false,false]"
            /> 
        </div>
    </div>
@endsection -->


<h2>Lista de Eixos</h2>
<a href="{{ route('eixos.create') }}">
    <h4>Novo Eixo</h4>
</a>
<table>
    <thead>
        <tr>
            <th>NOME</th>
            <th>EDITAR</th>
            <th>REMOVER</th>
        </tr>
    </thead>
    <tbody>
        
        @foreach ($eixos as $item)
        <tr> 
            
            <td>{{ $item['nome'] }}</td>
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
</table>
