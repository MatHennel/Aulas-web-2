<h2>Lista de Cursos</h2>
<a href="{{ route('cursos.create') }}">
    <h4>Novo Curso</h4>
</a>
<table>
    <thead>
        <tr>
            <th>NOME</th>
            <th>SIGLA</th>
            <th>INFO</th>
            <th>EDITAR</th>
            <th>REMOVER</th>
        </tr>
    </thead>
    <tbody>
        
        @foreach ($dados as $item)
        <tr> 
            
            <td>{{ $item['nome'] }}</td>
            <td>{{ $item['sigla'] }}</td>
            <td><a href="{{ route('cursos.show', $item['id']) }}">info</a></td>
            <td><a href="{{ route('cursos.edit', $item['id']) }}">editar</a></td>
            <td>
                <form action="{{ route('cursos.destroy', $item['id']) }}" method="POST">
                   
                    @csrf
                    @method('DELETE')
                    <input type='submit' value='remover'>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
