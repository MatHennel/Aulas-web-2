<h2>Cadastrar Professores</h2>

<form action="{{ route('professores.store') }}" method="POST">
    <!-- Token de segurança salvo na sessão, verificar o formulário submetido -->
    @csrf
    <a href="{{route('professores.index')}}">
        <h4>voltar</h4>
    </a>
    <input type="radio" id="ativo" name="status" value=1>
    <label>Ativo</label>
    <input type="radio" id="inativo" name="status" value=0>
    <label>Inativo</label></br></br>

    <label>Nome do Professor: </label> <input type='text' name='nome'></br></br>
    <label>Email do Professor: </label> <input type='text' name='email'></br></br>
    <label>SIAPE do Professor: </label> <input type='number' name='siape'></br></br>
    <label>Eixo/Área</label>
    <select name="eixo_id">
        <?php foreach($dados as $itens){?>
            <option value="<?php echo $itens['id']?>"> <?php echo $itens['nome']?>  </option>
        <?php } ?> 
        
    </select> </br></br>

    <input type="submit" value="Salvar">
</form>