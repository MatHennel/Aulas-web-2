<h2>Cadastrar Skin</h2>

<form action="{{ route('skins.store') }}" method="POST">
    <!-- Token de segurança salvo na sessão, verificar o formulário submetido -->
    @csrf
    <a href="javascript:history.back()" class="btn btn-primary">
        <h4>Voltar para onde estava</h4>
    </a>

    <input type="hidden" name='jogo_id' value="{{$jogo_id}}">
    <input type="hidden" name='usuario_id' value="{{$usuario_id}}">
    <label>Arma: </label> <input type='text' name='arma'>

    <label>Nome: </label> <input type='text' name='nome'>
    <label>Preço: </label> <input type='number' name='preço'>
    <input type="submit" value="Salvar">
</form>