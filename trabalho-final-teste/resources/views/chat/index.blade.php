<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Chat - {{ $projeto->nome }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 rounded shadow p-6">

        @if(auth()->user()->tipo_usuario == 1)
            {{-- BOTÃO VOLTAR --}}
            <a href="{{ route('projetos.em.desenvolvimento') }}"
               class="inline-block mb-4 bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700 transition">
                ← Voltar para Projetos em Desenvolvimento
            </a>
        @else
            <a href="{{ route('projetos.index') }}"
            class="inline-block mb-4 bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700 transition">
                ← Voltar para Projetos
            </a>
        @endif

            {{-- ÁREA DAS MENSAGENS --}}
            <div id="mensagens"
                 class="h-80 overflow-y-auto border border-gray-300 dark:border-gray-700 p-4 rounded mb-4 
                        bg-gray-100 dark:bg-gray-900">
            </div>

            {{-- FORM DE ENVIO --}}
            <form id="formEnvio">
                @csrf
                <div class="flex space-x-2">
                    <input type="text" name="mensagem" id="mensagem"
                           class="flex-1 border rounded p-2 dark:bg-gray-700 dark:text-white"
                           placeholder="Digite sua mensagem...">

                    <button class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                        Enviar
                    </button>
                </div>
            </form>

        </div>
    </div>

    <script>
        const mensagensDiv = document.getElementById('mensagens');
        const authId = {{ auth()->id() }};

        function carregarMensagens() {
            fetch("{{ route('chat.mensagens', $projeto->id) }}")
                .then(res => res.json())
                .then(data => {
                    mensagensDiv.innerHTML = "";

                    data.forEach(msg => {

                        const el = document.createElement('div');
                        el.classList.add("mb-3", "flex");

                        // Verifica se a mensagem é do usuário logado (DEV)
                        const isMine = msg.user_id === authId;

                        // Estilos dos balões
                        const bubbleClasses = isMine
                            ? "bg-indigo-600 text-white ml-auto"
                            : "bg-gray-700 text-white mr-auto";

                        const alignment = isMine ? "justify-end" : "justify-start";

                        el.innerHTML = `
                            <div class="max-w-xs px-4 py-2 rounded-xl shadow ${bubbleClasses}">
                                <div class="font-semibold text-sm">
                                    ${msg.user.name}
                                </div>
                                <div class="text-sm">
                                    ${msg.mensagem}
                                </div>
                                <div class="text-[10px] text-gray-200 mt-1 text-right">
                                    ${new Date(msg.created_at).toLocaleString('pt-BR')}
                                </div>
                            </div>
                        `;

                        el.classList.add(alignment);

                        mensagensDiv.appendChild(el);
                    });

                    mensagensDiv.scrollTop = mensagensDiv.scrollHeight;
                });
        }

        // Atualiza mensagens automaticamente
        setInterval(carregarMensagens, 1500);
        carregarMensagens();

        // Enviar mensagem via AJAX
        document.getElementById('formEnvio').addEventListener('submit', function(e) {
            e.preventDefault();

            fetch("{{ route('chat.enviar', $projeto->id) }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('input[name=\"_token\"]').value,
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({
                    mensagem: document.getElementById('mensagem').value
                })
            }).then(() => {
                document.getElementById('mensagem').value = '';
                carregarMensagens();
            });
        });
    </script>

</x-app-layout>
