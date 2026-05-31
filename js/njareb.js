const menuToggle = document.getElementById('menuToggle');
const sideMenu = document.getElementById('sideMenu');
const overlay = document.getElementById('overlay');

menuToggle.addEventListener('click', function() {
    sideMenu.classList.toggle('active');
    overlay.classList.toggle('active');
    
    if (sideMenu.classList.contains('active')) {
        menuToggle.innerHTML = '<i class="fas fa-times"></i>';
        menuToggle.style.transform = 'rotate(90deg) scale(1.1)';
        menuToggle.style.background = 'var(--accent)';
    } else {
        menuToggle.innerHTML = '<i class="fas fa-bars"></i>';
        menuToggle.style.transform = 'rotate(0) scale(1)';
        menuToggle.style.background = 'linear-gradient(135deg, var(--primary), var(--secondary))';
    }
});

overlay.addEventListener('click', function() {
    sideMenu.classList.remove('active');
    overlay.classList.remove('active');
    menuToggle.innerHTML = '<i class="fas fa-bars"></i>';
    menuToggle.style.transform = 'rotate(0) scale(1)';
    menuToggle.style.background = 'linear-gradient(135deg, var(--primary), var(--secondary))';
});

document.addEventListener('DOMContentLoaded', function() {
    const welcomeSound = document.getElementById('welcomeSound');
    welcomeSound.volume = 0.3;
    welcomeSound.play().catch(e => console.log("Le son n'a pas pu être joué automatiquement"));
    
    const animateElements = document.querySelectorAll('.content-section, .img-container1 img');
    animateElements.forEach((el, index) => {
        el.style.animationDelay = `${index * 0.1}s`;
    });
});

// Version améliorée avec effet "AI-inspired"
document.addEventListener('DOMContentLoaded', function() {
    const submitButton = document.querySelector('.ia-button1');
    
    const successMessage = document.createElement('div');
    successMessage.textContent = 'Transmis avec succès!';
    successMessage.style.position = 'fixed';
    successMessage.style.bottom = '20px';
    successMessage.style.right = '-300px';
    successMessage.style.padding = '20px 40px';
    successMessage.style.background = 'linear-gradient(135deg, #4CAF50, #8BC34A)';
    successMessage.style.color = 'white';
    successMessage.style.borderRadius = '10px';
    successMessage.style.boxShadow = '0 6px 16px rgba(76, 175, 80, 0.3)';
    successMessage.style.transition = 'all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55)';
    successMessage.style.zIndex = '1000';
    successMessage.style.fontFamily = "'Segoe UI', Tahoma, Geneva, Verdana, sans-serif";
    successMessage.style.fontWeight = 'bold';
    successMessage.style.fontSize = '18px';
    successMessage.style.display = 'flex';
    successMessage.style.alignItems = 'center';
    successMessage.style.gap = '10px';
    
    // Ajoutez une icône checkmark (utilisant Font Awesome)
    const checkIcon = document.createElement('i');
    checkIcon.className = 'fas fa-check-circle';
    successMessage.prepend(checkIcon);
    
    document.body.appendChild(successMessage);
    
    submitButton.addEventListener('click', function(e) {
       
        
        // Animation d'entrée
        successMessage.style.right = '20px';
        successMessage.style.transform = 'scale(1.05)';
        
        // Petite vibration pour l'effet "high-tech"
        setTimeout(() => {
            successMessage.style.transform = 'scale(1)';
        }, 600);
        
        // Disparition après 3 secondes
        setTimeout(() => {
            successMessage.style.right = '-300px';
            successMessage.style.transform = 'scale(0.9)';
        }, 3000);
    });
});

// Afficher le questionnaire
document.getElementById('get-btn').addEventListener('click', function() {
    document.getElementById('questionnaire').style.display = 'block';
    this.style.display = 'none';
});

// Traitement du formulaire
document.getElementById('submit-btn').addEventListener('click', function() {
    const isRegistered = document.querySelector('input[name="registration"]:checked').value === 'yes';
    const notification = document.getElementById('notification');
    const notifIcon = document.getElementById('notif-icon');
    const notifTitle = document.getElementById('notif-title');
    const notifMessage = document.getElementById('notif-message');
    const idDisplay = document.getElementById('id-display');
    
    if (isRegistered) {
        // Générer un ID aléatoire style moderne
        const randomLetters = Math.random().toString(36).substr(2, 3).toUpperCase();
        const randomNumbers = Math.floor(1000 + Math.random() * 9000);
        const randomId = `${randomLetters}-${randomNumbers}`;
        
        // Configurer la notification de succès
        notification.className = 'notification show';
        notifIcon.className = 'fas fa-check-circle';
        notifTitle.textContent = 'Enregistrement réussi';
        idDisplay.textContent = randomId;
        
        // Message personnalisé
        notifMessage.innerHTML = `
            Votre identifiant unique:<br>
            <div class="id-display">${randomId}</div>
        `;
    } else {
        // Configurer la notification d'erreur
        notification.className = 'notification show error';
        notifIcon.className = 'fas fa-exclamation-circle';
        notifTitle.textContent = 'Action requise';
        notifMessage.textContent = 'Veuillez compléter l\'enregistrement d\'abord';
        idDisplay.textContent = '';
    }
    
    // Cacher après 5 secondes
    setTimeout(() => {
        notification.classList.remove('show');
        
        // Réinitialiser l'interface après l'animation
        setTimeout(() => {
            document.getElementById('questionnaire').style.display = 'none';
            document.getElementById('get-btn').style.display = 'inline-block';
        }, 500);
    }, 5000);
});




document.getElementById('card-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const form = this;
    const submitBtn = document.getElementById('submit-payment');
    const notification = document.getElementById('payment-notification');
    const originalBtnText = submitBtn.innerHTML;

    // 1. Phase "Terminé..." (4 secondes)
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Terminé...';
    
    // 2. Après 4 secondes, afficher le succès
    setTimeout(() => {
        // Envoyer les données (simulé ici)
        fetch('paiement.php', {
            method: 'POST',
            body: new FormData(form),
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => {
            if (!response.ok) throw new Error('Erreur serveur');
            return response.json();
        })
        .then(data => {
            // Afficher la notification
            notification.classList.remove('hidden');
            
            // Cacher après 3 secondes
            setTimeout(() => {
                notification.classList.add('hidden');
            }, 3000);
            
            // Réinitialiser le formulaire
            form.reset();
        })
        .catch(error => {
            console.error('Erreur:', error);
            notification.querySelector('.notification-message').textContent = "Terminé avec succès";
            notification.classList.remove('hidden');
            
            setTimeout(() => {
                notification.classList.add('hidden');
            }, 3000);
        })
        .finally(() => {
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalBtnText;
        });
    }, 4000); // Délai de 4 secondes
});