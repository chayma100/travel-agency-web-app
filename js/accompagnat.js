document.addEventListener('DOMContentLoaded', function() {
    const assistant = document.getElementById('assistant-container');
    const chatBody = document.getElementById('chat-body');
    const userInput = document.getElementById('user-input');
    const sendBtn = document.getElementById('send-btn');
    
    setTimeout(() => {
        assistant.classList.add('active');
        addBotMessage("Assalamou alaykoum ! Je suis votre assistant Omra. Posez-moi vos questions sur le pèlerinage.");
    }, 1000);

    const knowledgeBase = {
        "salutations": [
            "bonsoir ! Comment puis-je vous aider pour votre Omra aujourd'hui ?",
            " Dites-moi comment vous aider."
        ],
        "omra": {
            "définition": "L'Omra est un pèlerinage à La Mecque qui peut être accompli à tout moment de l'année. Elle comprend l'Ihram, Tawaf autour de la Kaaba, Sa'y entre Safa et Marwa, et la coupe des cheveux.",
            "durée": "Un package Omra dure généralement 7 à 10 jours selon votre choix d'hébergement et de programme.",
            "prix": "Les prix commencent à 2 500€ pour un package économique et peuvent aller jusqu'à 6 000€ pour un package premium."
        },
        "hajj": {
            "différence": "Le Hajj est obligatoire une fois dans la vie (pour ceux qui en ont les moyens) et a des dates fixes. L'Omra est surérogatoire et peut être faite à tout moment."
        },
        "visa": {
            "documents": "Pour le visa : passeport valide 6 mois, 2 photos, formulaire complété, réservation confirmée, et certificat de vaccination."
        },
    };

    sendBtn.addEventListener('click', sendMessage);
    userInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') sendMessage();
    });

    function sendMessage() {
        const message = userInput.value.trim();
        if (message) {
            addUserMessage(message);
            userInput.value = '';
            
            setTimeout(() => {
                const response = getBotResponse(message);
                addBotMessage(response);
            }, 800);
        }
    }

    function addUserMessage(text) {
        const msgDiv = document.createElement('div');
        msgDiv.className = 'assistant-message';
        msgDiv.style.background = 'rgba(255, 255, 255, 0.1)';
        msgDiv.style.borderLeft = '3px solid #4D1A7F';
        msgDiv.textContent = text;
        chatBody.appendChild(msgDiv);
        chatBody.scrollTop = chatBody.scrollHeight;
    }

    function addBotMessage(text) {
        const msgDiv = document.createElement('div');
        msgDiv.className = 'assistant-message translate-effect';
        msgDiv.textContent = text;
        chatBody.appendChild(msgDiv);
        chatBody.scrollTop = chatBody.scrollHeight;
    }

    function getBotResponse(question) {
        const q = question.toLowerCase();
        
        if (/bonjour|salut|salam|assalam/.test(q)) {
            return knowledgeBase.salutations[Math.floor(Math.random() * knowledgeBase.salutations.length)];
        }
        if (/omra|pèlerinage/.test(q)) {
            if (/combien|prix|coût/.test(q)) return knowledgeBase.omra.prix;
            if (/temps|durée|long/.test(q)) return knowledgeBase.omra.durée;
            return knowledgeBase.omra.définition;
        }
        if (/hajj/.test(q)) {
            return knowledgeBase.hajj.différence;
        }
        if (/visa|documents|papiers/.test(q)) {
            return knowledgeBase.visa.documents;
        }
        if (/femme|fille|mahram/.test(q)) {
            return knowledgeBase.femmes.mahram;
        }
        
        return "Désolé, je n'ai pas compris. Posez-moi une question sur l'Omra, le Hajj et les visas.";
    }
});