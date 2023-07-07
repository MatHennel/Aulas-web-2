<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/css/welcome.css" rel="stylesheet" type="text/css" />

    <title>Document</title>
</head>
<body>
    <h1>Inventários</h1>
    <h3>Lista</h3>
    <ul>
      @foreach($usuarios as $item)
      <li>
      <a href="{{ route('jogos.index', ['id' => $item['id']]) }}">Nick: {{$item['nick_name']}} Nome: {{$item['nome']}} Idade: {{$item['idade']}}</a>
      </li>
      @endforeach
    </ul>
    
</body>
</html>

