<h2>Lista de Professores</h2>
<a href="{{ route('professores.create') }}">
    <h4>Novo Professor</h4>
</a>
<table>
    <thead>
        <tr>
            <th>NOME</th>
            <th>EIXO</th>
            <th>STATUS</th>
            <th>INFO</th>
            <th>EDITAR</th>
            <th>REMOVER</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($professores as $item)
        <tr>
            <td>{{ $item['nome'] }}</td>
                @foreach($eixos as $eixo)
                    @if($item['eixo_id'] == $eixo['id'])
                        <td>{{ $eixo['nome']}}</td>
                    @endif
                @endforeach
                    @if($item['ativo'] == 0)
                        <td>INATIVO</td>
                    @elseif($item['ativo'] == 1)
                        <td>ATIVO</td>
                 @endif

        
            <td><a href="{{ route('professores.show', $item['id']) }}">info</a></td>
            <td><a href="{{ route('professores.edit', $item['id']) }}">editar</a></td>
            <td>
                <form action="{{ route('professores.destroy', $item['id']) }}" method="POST">

                    @csrf
                    @method('DELETE')
                    <input type='submit' value='remover'>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>