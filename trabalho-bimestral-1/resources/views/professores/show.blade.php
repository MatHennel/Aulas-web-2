<h2>Informações do Professor</h2>

<a href="{{route('professores.index')}}"><h4>voltar</h4></a>

<h4>ID: {{ $professor['id'] }}</h4>

<h4>Nome: {{ $professor['nome'] }}</h4>

<h4>E-mail: {{ $professor['email'] }}</h4>

@if($professor['ativo'] == 0)
    <h4>status: INATIVO</h4>
@elseif($professor['ativo'] == 1)
    <h4>status: ATIVO</h4>
@endif


<h4>SIAPE: {{ $professor['siape'] }}</h4>

<h4>Eixo: {{ $eixo['nome'] }}</h4>


