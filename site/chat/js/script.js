// Declara a chave da API (comentários indicam chaves anteriores utilizadas para testes)
// const API_KEY = '...'; // Chave antiga comentada
// const API_KEY = '...'; // Outra chave antiga comentada
const API_KEY = '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'; // Chave atual em uso

// Dicionário de respostas predefinidas
const respostasPredefinidas = {
    // Saudações e apresentação
    "me fale sobre você": "Olá! Sou o Vita, seu assistente de gestão hospitalar. Fui desenvolvido para apoiar a equipe de saúde na organização de dados, otimização de processos e melhoria na rotina hospitalar. Como posso ajudar hoje?",
    "olá": "Olá! Sou o Vita, pronto para auxiliar na gestão hospitalar. Em que posso ajudar?",
    "oi": "Oi! Aqui é o Vita, seu assistente de apoio à saúde. O que posso fazer por você?",
    "bom dia": "Bom dia! Vita à disposição para ajudar a tornar o seu dia no hospital mais produtivo. 🚀",
    "boa tarde": "Boa tarde! Conte comigo para agilizar os processos hospitalares. 🏥",
    "boa noite": "Boa noite! Estou aqui caso precise de suporte na gestão hospitalar. 🌙",
    "quem é você": "Sou o Vita, um assistente virtual desenvolvido para ajudar hospitais a funcionarem de forma mais eficiente, liberando tempo para que os profissionais de saúde foquem no cuidado com os pacientes. ❤️",
    "como você funciona": "Funciono com tecnologia avançada e inteligência artificial. Tenho respostas programadas e também posso buscar informações mais complexas quando necessário. Estou aqui para facilitar o dia a dia hospitalar.",

    // Perguntas voltadas ao tema
    "qual sua função": "Minha missão é apoiar a equipe hospitalar em tarefas como organização de informações, triagem de dados, e automação de processos administrativos.",
    "você pode me ajudar com a gestão de pacientes?": "Sim! Posso auxiliar na organização de prontuários, agendamentos, registros de atendimento e outras rotinas relacionadas aos pacientes.",
    "você pode otimizar processos?": "Claro! Minha função é justamente identificar gargalos e sugerir melhorias que tornem os fluxos hospitalares mais ágeis e eficientes.",
    "você ajuda médicos e enfermeiros?": "Sim, apoio todos os profissionais de saúde, liberando tempo e reduzindo tarefas administrativas repetitivas para que possam focar no atendimento aos pacientes.",

    // Informações sobre o projeto
    "como foi criado": "Fui desenvolvido com tecnologias como HTML, CSS, JavaScript e APIs inteligentes, com foco em soluções para o ambiente hospitalar.",
    "quem te criou": "Fui criado por uma equipe dedicada a transformar a rotina hospitalar com tecnologia. O objetivo é facilitar a gestão e melhorar o cuidado com os pacientes.",

    // Humor leve e temático
    "conte uma piada": "Por que o prontuário foi ao médico? Porque ele estava se sentindo incompleto! 😄",
    "me faça rir": "Sabe o que um bisturi disse para o outro? 'Corta essa!' 😂",

    // Agradecimentos
    "obrigado": "Disponha! Estou sempre por aqui para ajudar a melhorar o cuidado com seus pacientes. ❤️",
    "obrigada": "Imagina! O Vita está sempre pronto para apoiar na gestão hospitalar. 🏥",
    "valeu": "Conte comigo sempre que precisar agilizar algo no hospital. Estou por aqui! 🚑",

    // Despedidas
    "tchau": "Até logo! Que seu dia seja leve e produtivo. 🌟",
    "adeus": "Até breve! O Vita estará por aqui quando você precisar. 💼",
    "até mais": "Até a próxima! Estarei pronto para ajudar quando precisar. 🤖"
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
            addAnswerSection("Estou com dificuldades de conexão no momento. Tente novamente em breve. ✨");
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