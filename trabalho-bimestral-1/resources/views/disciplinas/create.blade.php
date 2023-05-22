<h2>Cadastrar Disciplinas</h2>

<form action="{{ route('disciplinas.store') }}" method="POST">
    <!-- Token de segurança salvo na sessão, verificar o formulário submetido -->
    @csrf
    <a href="{{route('disciplinas.index')}}">
        <h4>voltar</h4>
    </a>
    <label>Nome da Disciplina: </label> <input type='text' name='nome'></br></br>
    <label>Carga Horaria(n. aulas): </label> <input type='number' name='carga'></br></br>
    <label>Curso</label>
    <select name="curso_id">
        <?php foreach($dados as $itens){?>
            <option value="<?php echo $itens['id']?>"> <?php echo $itens['nome']?>  </option>
        <?php } ?> 
        
    </select> </br></br>

    <input type="submit" value="Salvar">
</form>