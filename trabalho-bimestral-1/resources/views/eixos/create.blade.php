<h2>Cadastrar Eixos</h2>

<form action="{{ route('eixos.store') }}" method="POST">
    <!-- Token de segurança salvo na sessão, verificar o formulário submetido -->
    @csrf
    <a href="{{route('eixos.index')}}">
        <h4>voltar</h4>
    </a>
    <label>Nome: </label> <input type='text' name='nome'>
    <input type="submit" value="Salvar">
</form>