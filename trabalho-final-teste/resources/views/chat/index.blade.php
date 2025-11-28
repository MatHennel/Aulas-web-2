<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Chat - {{ $projeto->nome }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 rounded shadow p-6">

            {{-- BOTÃO VOLTAR --}}
            @if(auth()->user()->tipo_usuario == 1)
                @php
                    $rotaDev = $somenteLeitura
                        ? route('projetos.dev.entregues')
                        : route('projetos.em.desenvolvimento');
                @endphp

                <a href="{{ $rotaDev }}"
                   class="inline-block mb-4 bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700 transition">
                    ← Voltar
                </a>
            @else
                <a href="{{ route('projetos.index') }}"
                   class="inline-block mb-4 bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700 transition">
                    ← Voltar
                </a>
            @endif

            {{-- ÁREA DAS MENSAGENS --}}
            <div id="mensagens"
                 class="h-80 overflow-y-auto border border-gray-300 dark:border-gray-700 p-4 rounded mb-4 
                        bg-gray-100 dark:bg-gray-900">
            </div>

            {{-- FORM DE ENVIO (se não for somente leitura) --}}
            @if(!$somenteLeitura)
            <form id="formMensagem" class="mt-4">
                @csrf
                <div class="flex gap-2">
                    <input type="text" id="mensagem"
                        class="flex-1 p-2 rounded bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-white"
                        placeholder="Digite sua mensagem...">

                    <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                        Enviar
                    </button>
                </div>
            </form>
            @else
                <div class="mt-4 p-3 bg-yellow-200 text-yellow-800 rounded">
                    Este chat está em modo somente leitura.  
                    O projeto foi finalizado.
                </div>
            @endif

        </div>
    </div>

    <script>
        const mensagensDiv = document.getElementById('mensagens');
        const authId = {{ auth()->id() }};

        // CARREGA AS MENSAGENS
        function carregarMensagens() {
            fetch("{{ route('chat.mensagens', $projeto->id) }}")
                .then(res => res.json())
                .then(data => {
                    mensagensDiv.innerHTML = "";

                    data.forEach(msg => {
                        const el = document.createElement('div');
                        el.classList.add("mb-3", "flex");

                        const isMine = msg.user_id === authId;

                        const bubbleClasses = isMine
                            ? "bg-indigo-600 text-white ml-auto"
                            : "bg-gray-700 text-white mr-auto";

                        const alignment = isMine ? "justify-end" : "justify-start";

                        el.innerHTML = `
                            <div class="max-w-xs px-4 py-2 rounded-xl shadow ${bubbleClasses}">
                                <div class="font-semibold text-sm">${msg.user.name}</div>
                                <div class="text-sm">${msg.mensagem}</div>
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

        carregarMensagens();
        setInterval(carregarMensagens, 1500);

        // ENVIO DE MENSAGEM
        @if(!$somenteLeitura)
        document.getElementById('formMensagem').addEventListener('submit', function(e) {
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
            })
            .then(res => res.json())
            .then(() => {
                document.getElementById('mensagem').value = '';
                carregarMensagens();
            });
        });
        @endif
    </script>

</x-app-layout>
