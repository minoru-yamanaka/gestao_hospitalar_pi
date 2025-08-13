// Declara a chave da API (comentários indicam chaves anteriores utilizadas para testes)
// const API_KEY = '...'; // Chave antiga comentada
// const API_KEY = '...'; // Outra chave antiga comentada
const API_KEY = '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'; // Chave atual em uso


// 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
// Captura os elementos do HTML pelo ID
const content = document.getElementById('content'); // Área onde as mensagens serão exibidas
const chatInput = document.getElementById('chatInput'); // Campo onde o usuário digita
const sendButton = document.getElementById('sendButton'); // Botão para enviar mensagem

// Controla se uma resposta está sendo carregada
let isAnswerLoading = false;
// Identificador único para seções de resposta
let answerSectionId = 0;

// Adiciona eventos de clique e enter no botão e input
sendButton.addEventListener('click', () => handleSendMessage());
chatInput.addEventListener('keypress', event => {
    if (event.key === 'Enter') { // Quando o usuário aperta "Enter"
        handleSendMessage();
    }
});

// Função que trata o envio da mensagem
function handleSendMessage() {
    const question = chatInput.value.trim(); // Remove espaços do começo/fim do input

    if (question === '' || isAnswerLoading) return; // Não envia se vazio ou carregando resposta

    sendButton.classList.add('send-button-nonactive'); // Desativa visualmente o botão

    addQuestionSection(question); // Adiciona a pergunta na tela
    chatInput.value = ''; // Limpa o campo de texto
}

// Função que busca a resposta da API
function getAnswer(question) {
    const fetchData =
        fetch("https://openrouter.ai/api/v1/chat/completions", {
            method: "POST", // Método POST
            headers: {
                "Authorization": `Bearer ${API_KEY}`, // Autenticação
                "Content-Type": "application/json" // Tipo de conteúdo
            },
            body: JSON.stringify({ // Corpo da requisição
                "model": "deepseek/deepseek-r1-distill-llama-70b:free", // Modelo de IA usado
                "messages": [
                    {
                        "role": "user",
                        "content": question // Conteúdo da pergunta enviada
                    }
                ]
            })
        });

    fetchData.then(response => response.json())
        .then(data => {
            const resultData = data.choices[0].message.content; // Extrai o texto da resposta
            isAnswerLoading = false; // Marca que a resposta terminou de carregar
            addAnswerSection(resultData); // Adiciona a resposta na tela
        }).finally(() => {
            scrollToBottom(); // Faz a tela rolar para a última mensagem
            sendButton.classList.remove('send-button-nonactive'); // Ativa o botão novamente
        })
}

// Função que adiciona a pergunta na tela
function addQuestionSection(message) {
    isAnswerLoading = true; // Agora está carregando a resposta
    const sectionElement = document.createElement('section'); // Cria uma seção
    sectionElement.className = 'question-section'; // Classe para estilização
    sectionElement.textContent = message; // Insere o texto da pergunta

    content.appendChild(sectionElement); // Adiciona no conteúdo
    addAnswerSection(message); // Cria a seção para a resposta (com loading)
    scrollToBottom(); // Rola a página para baixo
}

// Função que adiciona a resposta
function addAnswerSection(message) {
    if (isAnswerLoading) {
        answerSectionId++; // Incrementa o ID para seções de resposta
        const sectionElement = document.createElement('section'); // Cria uma nova seção
        sectionElement.className = 'answer-section'; // Classe para resposta
        sectionElement.innerHTML = getLoadingSvg(); // Coloca o SVG de carregando
        sectionElement.id = answerSectionId; // Define um ID para depois alterar

        content.appendChild(sectionElement); // Adiciona no conteúdo
        getAnswer(message); // Chama a função para buscar a resposta
    } else {
        const answerSectionElement = document.getElementById(answerSectionId); // Pega a seção criada
        answerSectionElement.textContent = message; // Atualiza o texto com a resposta recebida
    }
    // Chama a função para criar o efeito mágico após a resposta ser adicionada
    criarEfeitoMagico();
}

// Função que retorna o SVG (ícone) de carregando
function getLoadingSvg() {
    return '<svg style="height: 25px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200">' +
        '<circle fill="gold" stroke="gold" stroke-width="15" r="15" cx="40" cy="65">' +
        '<animate attributeName="cy" calcMode="spline" dur="2" values="65;135;65;" keySplines=".5 0 .5 1;.5 0 .5 1" repeatCount="indefinite" begin="-.4"></animate>' +
        '</circle>' +
        '<circle fill="gold" stroke="gold" stroke-width="15" r="15" cx="100" cy="65">' +
        '<animate attributeName="cy" calcMode="spline" dur="2" values="65;135;65;" keySplines=".5 0 .5 1;.5 0 .5 1" repeatCount="indefinite" begin="-.2"></animate>' +
        '</circle>' +
        '<circle fill="gold" stroke="gold" stroke-width="15" r="15" cx="160" cy="65">' +
        '<animate attributeName="cy" calcMode="spline" dur="2" values="65;135;65;" keySplines=".5 0 .5 1;.5 0 .5 1" repeatCount="indefinite" begin="0"></animate>' +
        '</circle>' +
    '</svg>';
    // Um SVG animado para mostrar que está carregando
}


// Função para rolar automaticamente até o fim do conteúdo
function scrollToBottom() {
    content.scrollTo({
        top: content.scrollHeight,
        behavior: 'smooth' // Anima a rolagem
    });
}

// EFEITO EXTRA: Criação de brilhos mágicos ao responder

// Função que cria partículas (faíscas) na tela
function criarEfeitoMagico() {
    for (let i = 0; i < 15; i++) { // Cria 15 faíscas
        setTimeout(() => {
            const spark = document.createElement('div'); // Cria uma faísca
            spark.className = 'spark'; // Classe para estilizar

            // Define posição aleatória
            const x = Math.random() * 360;
            const y = Math.random() * 500;

            spark.style.left = `${x}px`;
            spark.style.top = `${y}px`;

            document.querySelector('.container').appendChild(spark); // Adiciona no container

            // Anima a faísca: ela aparece e depois some
            setTimeout(() => {
                spark.style.opacity = '1'; // Aparece
                spark.style.transform = `translate(${(Math.random() - 0.5) * 50}px, ${(Math.random() - 0.5) * 50}px)`; // Movimento aleatório
                spark.style.transition = 'opacity 0.5s ease-out, transform 1.5s ease-out'; // Efeito suave
                
                setTimeout(() => {
                    spark.style.opacity = '0'; // Some
                    setTimeout(() => {
                        spark.remove(); // Remove do DOM
                    }, 500);
                }, 1000);
            }, 10);
        }, i * 100); // Pequeno atraso entre cada faísca
    }
}
