
    <a href="{{route('disciplinas.index')}}">
        <h4>voltar</h4>
    </a>
    <a href="{{route('disciplinas.create')}}">
        <h4>vincular</h4>
    </a>
    <table>
    <thead>
        <tr>
            <th>DISCIPLINA</th>
            <th>PROFESSOR</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($vinculo as $item)
        <tr>
            @foreach($disciplinas as $disciplina)
                @if($item['disciplina_id'] == $disciplina['id'])
                    <td>{{ $disciplina['nome'] }}</td>
                @endif
            @endforeach
            @foreach($professores as $professor)
                @if($item['professor_id'] == $professor['id'])
                    <td>{{ $professor['nome'] }}</td>
                @endif
            @endforeach


            
           
            
            
        </tr>
        @endforeach
    </tbody>
</table>
        
    
