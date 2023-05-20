<h2>Cadastrar Cursos</h2>

<form action="{{ route('cursos.store') }}" method="POST">
    <!-- Token de segurança salvo na sessão, verificar o formulário submetido -->
    @csrf
    <a href="{{route('cursos.index')}}">
        <h4>voltar</h4>
    </a>
    <label>Nome do Curso: </label> <input type='text' name='nome'></br></br>
    <label>Sigla do Curso: </label> <input type='text' name='sigla'></br></br>
    <label>Tempo do Curso(anos): </label> <input type='number' name='tempo'></br></br>
    <label>Eixo/Área</label>
    <select name="eixo_id">
        <?php foreach($dados as $itens){?>
            <option value="<?php echo $itens['id']?>"> <?php echo $itens['nome']?>  </option>
        <?php } ?> 
        
    </select> </br></br>

    <input type="submit" value="Salvar">
</form>