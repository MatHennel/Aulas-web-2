<h2>Lista de Disciplinas</h2>
<a href="{{ route('disciplinas.create') }}">
    <h4>Nova Disciplina</h4>
</a>
<a href="{{ route('docencias.index') }}">
    <h4>Vincular professor</h4>
</a>
<table>
    <thead>
        <tr>
            <th>NOME</th>
            <th>CURSO</th>
            <th>INFO</th>
            <th>EDITAR</th>
            <th>REMOVER</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($disciplinas as $item)
        <tr>
            <td>{{ $item['nome'] }}</td>
                @foreach($cursos as $curso)
                    @if($item['curso_id'] == $curso['id'])
                        <td>{{ $curso['nome']}}</td>
                    @endif
                @endforeach
                  

        
            <td><a href="{{ route('disciplinas.show', $item['id']) }}">info</a></td>
            <td><a href="{{ route('disciplinas.edit', $item['id']) }}">editar</a></td>
            <td><a href="{{ route('disciplinas.edit', $item['id']) }}">editar</a></td>

            <td>
                <form action="{{ route('disciplinas.destroy', $item['id']) }}" method="POST">

                    @csrf
                    @method('DELETE')
                    <input type='submit' value='remover'>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>