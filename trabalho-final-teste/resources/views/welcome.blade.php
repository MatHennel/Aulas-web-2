<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DevEConnection</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">

</head>

<body class="bg-gray-900 text-white min-h-screen flex flex-col">

    <!-- NAVBAR -->
    <header class="w-full py-4 px-6 flex justify-between items-center">

        <!-- LOGO À ESQUERDA -->
        <img src="{{ asset('img/logo.png') }}" 
            alt="DevConnection Logo" 
            class="w-48 h-auto">

        <!-- MENU À DIREITA -->
        <nav class="flex gap-4">
            @auth
                <a href="{{ url('/dashboard') }}" class="text-gray-300 hover:text-white font-semibold">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="text-gray-300 hover:text-white font-semibold">Entrar</a>
                <a href="{{ route('redirecionamento') }}" class="text-gray-300 hover:text-white font-semibold">Registrar</a>
            @endauth
        </nav>

    </header>

    <!-- TÍTULO -->
    <section class="mt-20 text-center px-6">
        <h1 class="text-3xl font-bold max-w-3xl mx-auto">
            Bem vindo à DevEConnection, onde sonhos são construídos e desenvolvidos.
        </h1>
    </section>

    <!-- CARDS -->
    <section class="mt-14 grid grid-cols-1 md:grid-cols-2 gap-8 max-w-5xl mx-auto px-6">

        <!-- CARD CLIENTES -->
        <div class="bg-white/10 border border-gray-700 rounded-2xl p-8 shadow-xl backdrop-blur">
            <h2 class="text-2xl font-bold mb-4">Para Clientes</h2>
            <p class="text-gray-300 leading-relaxed">
                Encontre desenvolvedores qualificados prontos para transformar suas ideias 
                em soluções reais. Publique projetos, acompanhe o progresso e receba suporte direto.
            </p>
        </div>

        <!-- CARD DEVS -->
        <div class="bg-white/10 border border-gray-700 rounded-2xl p-8 shadow-xl backdrop-blur">
            <h2 class="text-2xl font-bold mb-4">Para Desenvolvedores</h2>
            <p class="text-gray-300 leading-relaxed">
                Desenvolva projetos reais, conecte-se com empreendedores, monte seu portfólio 
                e cresça profissionalmente através do marketplace da DevEConnection.
            </p>
        </div>

    </section>

</body>
</html>
