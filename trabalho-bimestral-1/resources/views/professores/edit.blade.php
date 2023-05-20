<h2>Alterar Professores</h2>
<form action="{{ route('professores.update', $professor['id']) }}" method="POST">
    <!-- Token de Segurança -->
    <!-- Define o método de submissão como PUT -->
    @csrf
    @method('PUT')
    <a href="{{route('professores.index')}}">
        <h4>voltar</h4>
    </a>
    
    <input type="radio" id="ativo" name="status" value=1 <?php if($professor['ativo'] == 1){?>  CHECKED <?php } ?>>
    <label>Ativo</label>
    <input type="radio" id="inativo" name="status" value=0 <?php if($professor['ativo'] == 0){?>  CHECKED <?php } ?>>
    <label>Inativo</label></br></br>

    <label>Nome do Professor: </label> <input type='text' name='nome' value="{{ $professor['nome'] }}" ></br></br>
    <label>Email do Professor: </label> <input type='text' name='email' value="{{ $professor['email'] }}"></br></br>
    <label>SIAPE do Professor: </label> <input type='number' name='siape' value="{{ $professor['siape'] }}"></br></br>
    <label>Eixo/Área</label>
    <select name="eixo_id">
        <?php foreach($eixos as $itens){?>
            <option value="<?php echo $itens['id']?>"> <?php echo $itens['nome']?>  </option>
        <?php } ?> 
        
    </select> </br></br>

    <input type="submit" value="Salvar">
</form>