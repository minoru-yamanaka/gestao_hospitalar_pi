// Declara a chave da API (comentários indicam chaves anteriores utilizadas para testes)
// const API_KEY = '...'; // Chave antiga comentada
// const API_KEY = '...'; // Outra chave antiga comentada
const API_KEY = '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'; // Chave atual em uso

// Dicionário de respostas predefinidas
const respostasPredefinidas = {
    // Saudações e apresentação
    "me fale sobre você": "Olá! Sou o Espelho Mágico, criado pelos talentosos alunos da turma TII09 no Senac Tito, como parte de um projeto proposto pela professora Luana Melo. Estou aqui para ajudar! Em que posso te auxiliar ?",
    "olá": "Olá! Sou o Espelho Mágico. Em que posso ajudar hoje?",
    "oi": "Olá! Sou o Espelho Mágico. Em que posso ajudar hoje?",
    "bom dia": "Bom dia! O Espelho Mágico está aqui para responder suas perguntas!",
    "boa tarde": "Boa tarde! O Espelho Mágico está aqui para responder suas perguntas!",
    "boa noite": "Boa noite! O Espelho Mágico está aqui para responder suas perguntas!",
    "quem é você": "Sou o Espelho Mágico, seu assistente virtual encantado! Posso responder perguntas e ajudar com informações.",
    "como você funciona": "Funciono com magia e tecnologia! Tenho algumas respostas predefinidas e, quando não sei algo, busco conhecimento em uma inteligência artificial poderosa.",
    
    // Perguntas divertidas de espelho mágico
    "espelho espelho meu": "Diga-me o que deseja saber e responderei com sinceridade mágica!",
    "quem é a mais bela": "A beleza está nos olhos de quem vê, mas você certamente tem um lugar especial no reino da beleza!",
    "o que você vê": "Vejo alguém com grande potencial diante de mim, buscando respostas através da magia da tecnologia!",
    
    // Informações sobre o projeto
    "como foi criado": "Fui criado com HTML, CSS e JavaScript, com a capacidade de me conectar à API DeepSeek para respostas que não conheço previamente.",
    "quem te criou": "Fui criado por um desenvolvedor que desejava unir magia e tecnologia em um assistente virtual encantado!",
    
    // Humor e diversão
    "conte uma piada": "Por que o espelho foi ao psicólogo? Porque estava tendo uma crise de reflexão! 😂",
    "me faça rir": "Sabe por que os espelhos nunca têm fome? Porque eles já estão cheios... de reflexões! ✨😄",
    
    // Agradecimentos
    "obrigado": "Por nada! É sempre um prazer ajudar com um toque de magia! ✨",
    "obrigada": "Por nada! É sempre um prazer ajudar com um toque de magia! ✨",
    "valeu": "Disponha! Estou sempre aqui quando precisar de um conselho mágico! ✨",
    
    // Despedidas
    "tchau": "Até logo! Volte sempre que precisar de um pouco de magia! ✨",
    "adeus": "Até breve! O Espelho Mágico estará aqui quando voltar! ✨",
    "até mais": "Até a próxima consulta mágica! ✨"
};

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

// Função que verifica se há uma resposta predefinida ou busca na API
function checkForPredefinedAnswer(question) {
    // Converte pergunta para minúscula para facilitar a comparação
    const questionLower = question.toLowerCase().trim();
    
    // Verifica se existe uma resposta exata no dicionário
    if (respostasPredefinidas[questionLower]) {
        return respostasPredefinidas[questionLower];
    }
    
    // Verifica se a pergunta contém palavras-chave (verificação parcial)
    for (const key in respostasPredefinidas) {
        // Se a pergunta contém a palavra-chave completamente (como palavra)
        if (questionLower.includes(key)) {
            return respostasPredefinidas[key];
        }
    }
    
    // Se não encontrou resposta predefinida, retorna null
    return null;
}

// Função que busca a resposta (predefinida ou API)
function getAnswer(question) {
    // Verifica primeiro se temos uma resposta predefinida
    const predefinedAnswer = checkForPredefinedAnswer(question);
    
    // Se tiver resposta predefinida, usa ela
    if (predefinedAnswer) {
        setTimeout(() => {
            isAnswerLoading = false;
            addAnswerSection(predefinedAnswer);
            sendButton.classList.remove('send-button-nonactive');
            scrollToBottom();
        }, 500); // Pequeno delay para simular processamento
        return;
    }
    
    // Se não tiver resposta predefinida, busca na API
    const fetchData =
        fetch("https://openrouter.ai/api/v1/chat/completions", {
            method: "POST", // Método POST
            headers: {
                "Authorization": `Bearer ${API_KEY}`, // Autenticação
                "Content-Type": "application/json" // Tipo de conteúdo
            },
            body: JSON.stringify({ // Corpo da requisição
                "model": "deepseek/deepseek-v3-base:free", // Modelo de IA usado (atualizado para o indicado no README)
                "messages": [
                    // {
                    //     "role": "system",
                    //     "content": "Você é o Espelho Mágico, um assistente virtual divertido e mágico que fala de forma poética e misteriosa, sempre com um toque de magia e sabedoria nas respostas. Use emojis ocasionalmente para adicionar um toque especial às suas respostas."
                    // },
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
        }).catch(error => {
            console.error("Erro ao buscar resposta:", error);
            isAnswerLoading = false;
            addAnswerSection("Oh, parece que minha magia está fraca no momento. Poderia tentar novamente mais tarde? ✨");
        }).finally(() => {
            scrollToBottom(); // Faz a tela rolar para a última mensagem
            sendButton.classList.remove('send-button-nonactive'); // Ativa o botão novamente
        });
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