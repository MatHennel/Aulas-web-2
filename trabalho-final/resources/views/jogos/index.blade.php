<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/css/welcome.css" rel="stylesheet" type="text/css" />

    <title>Document</title>
</head>
<body>
    <h1>Jogos</h1>
    <h3>Lista</h3>
    <ul>
    @foreach ($jogos as $jogo)
    <li>
        <a href="{{ route('skins.index', ['jogo_id' => $jogo['id'], 'usuario_id' => $usuario['id']]) }}">Jogo: {{ $jogo['nome'] }}</a>
    </li>
    @endforeach
    </ul>

    
    
</body>
</html>

