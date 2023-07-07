<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/css/welcome.css" rel="stylesheet" type="text/css" />

    <title>Document</title>
</head>
<body>
    <nav>

    </nav>

    <a href="{{ $route = route('skins.create.form', ['jogo_id' => $jogo_id, 'usuario_id' => $usuario_id]) }}">

    <h4>Nova Skin</h4>
</a>

    <div class="oi">
        <h1>
            Inventário de Skins
        </h1>

        <table>
<caption>Lista de Skins</caption>
<thead>
  <tr>
  <th>Arma</th>
    <th>Nome da Skin</th>
    <th>Imagem</th>
    <th>Preço</th>
    <th>Editar</th>
    <th>Excluir</th>
  </tr>
</thead>


    @foreach ($skins as $item)
        <tr>
            <td name="Arma">{{ $item['arma'] }}</td>
            <td name="Nome da Skin">{{ $item['nome'] }}</td>
            <td name="Imagem"><img src="caminho/para/imagem1.jpg" alt="Skin 1"></td>
            <td name="Preço">{{ $item['preço'] }}</td>
            <td><a href="{{ route('skins.edit', $item['id']) }}">Editar</a></td>
            <td>
            <form action="{{ route('skins.destroy', $item['id']) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Remover</button>
            </form>
            </td>
        </tr>
    @endforeach



</tbody>
</table>
        
    </div>
</body>
</html>

