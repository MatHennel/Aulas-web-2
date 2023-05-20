<h2>Alterar Eixos</h2>
<form action="{{ route('eixos.update', $dados['id']) }}" method="POST">
<!-- Token de Segurança -->
<!-- Define o método de submissão como PUT -->
@csrf
@method('PUT')
<a href="{{route('eixos.index')}}"><h4>voltar</h4></a>
<label>Nome: </label> <input type='text' name='nome' value="{{$dados['nome']}}">
<input type="submit" value="Salvar">
</form>