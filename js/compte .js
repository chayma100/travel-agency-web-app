document.getElementById('profile-form').addEventListener('submit', function(e) {
    const btn = document.getElementById('save-btn');
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Enregistrement...';

    setTimeout(() => {
        setTimeout(() => {
            notification.className = 'notification-hidden';
            btn.disabled = false;
            btn.innerHTML = 'Enregistrer';
            document.getElementById('profile-form').reset();
        }, 3000);
    }, 1500);
});

document.addEventListener("DOMContentLoaded", function () {
    const tabs = document.querySelectorAll(".account-nav li");
    const contents = document.querySelectorAll(".tab-content");

    tabs.forEach(tab => {
        tab.addEventListener("click", function () {
            tabs.forEach(t => t.classList.remove("active"));
            contents.forEach(c => c.classList.remove("active"));
            this.classList.add("active");
            const tabId = this.getAttribute("data-tab");
            const activeSection = document.getElementById(tabId);
            if (activeSection) {
                activeSection.classList.add("active");
            }
        });
    });
});

document.getElementById('profile-form').addEventListener('submit', function(e) {
    const notification = document.querySelector('.notification');
    const notificationMessage = document.querySelector('.notification-message');

    const randomLetters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    const letterPart = 
        randomLetters.charAt(Math.floor(Math.random() * randomLetters.length)) + 
        randomLetters.charAt(Math.floor(Math.random() * randomLetters.length)) + 
        randomLetters.charAt(Math.floor(Math.random() * randomLetters.length));
    const numberPart = Math.floor(1000 + Math.random() * 9000);
    const randomId = `${letterPart}-${numberPart}`;

    notification.className = 'notification notification-visible';
    notificationMessage.innerHTML = `
        <i class="fas fa-check-circle"></i>
        <div>
            <strong>✅ Enregistrement réussi !</strong><br>
            Votre ID de confirmation : <strong>${randomId}</strong>
        </div>
    `;

    setTimeout(() => {
        notification.className = 'notification notification-hidden';
        setTimeout(() => {
            this.submit();
        }, 500);
    }, 5000);
});

document.addEventListener('DOMContentLoaded', function() {
    const cardBtn = document.getElementById('add-card-btn');
    const paypalBtn = document.getElementById('add-paypal-btn');
    const cardForm = document.getElementById('card-form-container');

    cardBtn.addEventListener('click', function(e) {
        e.preventDefault();
        cardForm.classList.toggle('hidden');
    });

    paypalBtn.addEventListener('click', function(e) {
        e.preventDefault();
        window.location.href = 'https://www.paypal.com/signin';
    });

    const cardNumberInput = document.querySelector('#card-form input[placeholder="1234 5678 9012 3456"]');
    if (cardNumberInput) {
        cardNumberInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\s+/g, '');
            if (value.length > 0) {
                value = value.match(new RegExp('.{1,4}', 'g')).join(' ');
            }
            e.target.value = value;
        });
    }

    const cardFormElement = document.getElementById('card-form');
    if (cardFormElement) {
        cardFormElement.addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('.submit-btn');
            const originalText = submitBtn.textContent;
            submitBtn.disabled = true;
            submitBtn.textContent = 'Traitement...';

            setTimeout(() => {
                const notification = document.getElementById('payment-notification');
                const notificationText = notification.querySelector('.payment-notification-text');
                notificationText.textContent = 'Carte enregistrée avec succès !';
                notification.classList.add('show', 'success');
                cardForm.classList.add('hidden');
                submitBtn.disabled = false;
                submitBtn.textContent = originalText;
                setTimeout(() => {
                    notification.classList.remove('show');
                    setTimeout(() => {
                        this.reset();
                        notification.classList.remove('success');
                    }, 400);
                }, 3000);
            }, 2000);
        });
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const deleteBtn = document.getElementById('delete-account-btn');
    const confirmModal = document.getElementById('delete-confirm-modal');
    const confirmDeleteBtn = document.getElementById('confirm-delete-btn');
    const cancelDeleteBtn = document.getElementById('cancel-delete-btn');

    deleteBtn.addEventListener('click', function() {
        confirmModal.classList.add('active');
    });

    cancelDeleteBtn.addEventListener('click', function() {
        confirmModal.classList.remove('active');
    });

    confirmDeleteBtn.addEventListener('click', function() {
        confirmDeleteBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Suppression...';
        confirmDeleteBtn.disabled = true;

        setTimeout(() => {
            confirmModal.classList.remove('active');
            showNotification('La dernière entrée a été supprimée avec succès', 'success');

            fetch('tableau.php?action=delete_last', {
                method: 'POST'
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    showNotification('La dernière entrée a été supprimée avec succès', 'success');
                } else {
                    showNotification('Erreur lors de la suppression', 'error');
                }
            })
            .catch(error => {
                showNotification('Erreur de connexion', 'error');
            })
            .finally(() => {
                confirmDeleteBtn.innerHTML = 'Oui, supprimer';
                confirmDeleteBtn.disabled = false;
            });
        }, 1500);
    });

    function showNotification(message, type) {
        console.log(`${type}: ${message}`);
    }
});

document.getElementById('card-form').addEventListener('submit', function(e) {
    const form = this;
    const submitBtn = form.querySelector('.submit-btn');
    const originalBtnText = submitBtn.innerHTML;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Traitement...';
    submitBtn.disabled = true;

    fetch(form.action, {
        method: 'POST',
        body: new FormData(form)
    })
    .then(response => response.json())
    .then(data => {
        const notification = document.getElementById('payment-notification');
        const notificationText = notification.querySelector('.payment-notification-text');
        notificationText.textContent = data.message || 'Votre paiement a été traité avec succès';
        notification.classList.remove('hidden');
        notification.classList.add('show');
        document.getElementById('card-form-container').classList.add('hidden');
        setTimeout(() => {
            form.reset();
            notification.classList.remove('show');
            setTimeout(() => notification.classList.add('hidden'), 400);
        }, 3000);
    })
    .catch(error => {
        console.error('Erreur:', error);
    })
    .finally(() => {
        submitBtn.innerHTML = originalBtnText;
        submitBtn.disabled = false;
    });
});

document.getElementById('card-number').addEventListener('input', function(e) {
    let value = e.target.value.replace(/\s+/g, '');
    if (value.length > 0) {
        value = value.match(new RegExp('.{1,4}', 'g')).join(' ');
    }
    e.target.value = value;
});

document.getElementById('btnCodeRedirect').addEventListener('click', function() {
    window.location.href = 'code.html';
});

