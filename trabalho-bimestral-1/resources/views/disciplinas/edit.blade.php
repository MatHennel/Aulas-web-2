<h2>Alterar Disciplinas</h2>
<form action="{{ route('disciplinas.update', $disciplina['id']) }}" method="POST">
    <!-- Token de Segurança -->
    <!-- Define o método de submissão como PUT -->
    @csrf
    @method('PUT')
    <a href="{{route('disciplinas.index')}}">
        <h4>voltar</h4>
    </a>
    <label>Nome da Disciplina: </label> <input type='text' name='nome' value="{{ $disciplina['nome'] }}"></br></br>
    <label>Carga Horaria(n. aulas): </label> <input type='number' name='carga' value="{{ $disciplina['carga'] }}"></br></br>
    <label>Curso</label>
    <select name="curso_id">
        <?php foreach($cursos as $itens){?>
            <option value="<?php echo $itens['id']?>"> <?php echo $itens['nome']?>  </option>
        <?php } ?> 
        
    </select> </br></br>
    <input type="submit" value="Salvar">
</form>