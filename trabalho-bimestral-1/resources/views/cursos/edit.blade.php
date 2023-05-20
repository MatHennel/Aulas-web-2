<h2>Alterar Eixos</h2>
<form action="{{ route('cursos.update', $curso['id']) }}" method="POST">
    <!-- Token de Segurança -->
    <!-- Define o método de submissão como PUT -->
    @csrf
    @method('PUT')
    <a href="{{route('cursos.index')}}">
        <h4>voltar</h4>
    </a>
    <label>Nome: </label> <input type='text' name='nome' value="{{ $curso['nome'] }}"></br></br>
    <label>Sigla do Curso: </label> <input type='text' name='sigla' value="{{ $curso['sigla'] }}"></br></br>
    <label>Tempo do Curso(anos): </label> <input type='number' name='tempo' value="{{ $curso['tempo'] }}"></br></br>
    <label>Eixo/Área</label>
    <select name="eixo_id">
        <?php foreach ($eixos as $itens) { ?>
            <option value="<?php echo $itens['id'] ?>"> <?php echo $itens['nome'] ?> </option>
        <?php } ?>


    </select> </br></br>
    <input type="submit" value="Salvar">
</form>