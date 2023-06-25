<!-- Herda o layout padrão definido no template "main" -->
@extends('templates.main', ['titulo' => "Acesso negado"])
<!-- Preenche o conteúdo da seção "titulo" -->
@section('titulo') Eixos @endsection
<!-- Preenche o conteúdo da seção "conteudo" -->
@section('conteudo')

<body class="aw-layout-simple-page">
    Desculpe, você não está autorizado a acessar a página que solicitou.
        Se você acha que isso é um engano, entre em contato conosco.
  
      <div class="d-flex justify-content-center">
      

        <img src="https://media.istockphoto.com/id/1221686500/pt/vetorial/stop-sign-red-forbidding-sign-with-human-hand-in-octagon-shape-stop-hand-gesture-do-not.jpg?s=612x612&w=0&k=20&c=tNNp-o1P95W5CwIfC2YyKlsAPIEDODZbkpnT87qZh5s=" 
            alt="Imagem de stop"
            width="300"
            height="300"
        >
        <br/><br/>
        
      </div>
     <a href="javascript:history.back()" class="btn btn-primary">Voltar para onde estava</a>
        
    

  
</body>
</html>


@endsection