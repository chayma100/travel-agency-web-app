document.addEventListener('DOMContentLoaded', function() {
    const nextToPayment = document.getElementById('next-to-payment');
    const nextToConfirmation = document.getElementById('next-to-confirmation');
    const finish = document.getElementById('finish');
    const step1 = document.getElementById('step-1');
    const step2 = document.getElementById('step-2');
    const step3 = document.getElementById('step-3');
    const payNowBtn = document.querySelector('.pay-now-btn');
    const paymentModal = document.getElementById('payment-modal');
    const closeModal = document.querySelector('.close');
    const formArea = document.getElementById('form-area');
    const methodBtns = document.querySelectorAll('.method-btn');

    nextToPayment.addEventListener('click', function() {
        step1.style.display = 'none';
        step2.style.display = 'block'; 
    });

    payNowBtn.addEventListener('click', () => {
        paymentModal.classList.remove('hidden');
    });

    closeModal.addEventListener('click', () => {
        paymentModal.classList.add('hidden');
        formArea.innerHTML = '';
    });
    methodBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const method = btn.getAttribute('data-method');
            showForm(method);
        });
    });
    function showForm(method) {
        let formHTML = '';
        if (method === 'card') {
            formHTML = `
                <form id="card-form">
                    <input type="text" placeholder="Numéro de carte" required maxlength="19">
                    <input type="text" placeholder="Date d'expiration (MM/AA)" required maxlength="5">
                    <input type="text" placeholder="CVV" required maxlength="3">
                    <input type="text" placeholder="Nom sur la carte" required>
                    <button type="submit">Valider Paiement</button>
                </form>
            `;
        } else if (method === 'paypal') {
            formHTML = `
                <form id="paypal-form">
                    <input type="email" placeholder="Email PayPal" required>
                    <button type="submit">Se connecter à PayPal</button>
                </form>
            `;
        } else if (method === 'bank') {
            formHTML = `
                <form id="bank-form">
                    <p>Veuillez transférer le montant sur ce compte :</p>
                    <p><strong>RIB : 1234 5678 9012 3456 7890</strong></p>
                    <input type="text" placeholder="Votre nom complet" required>
                    <input type="email" placeholder="Votre email" required>
                    <button type="submit">Confirmer Virement</button>
                </form>
            `;
        }

        formArea.innerHTML = formHTML;
        const form = formArea.querySelector('form');
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            showSuccessMessage();
        });
    }

    function showSuccessMessage() {
        formArea.innerHTML = `
            <div class="success-message">
                Merci ! Votre demande est en cours de traitement. Un email de confirmation a été envoyé.
            </div>
        `;
        nextToConfirmation.style.display = 'block';
    }

    nextToConfirmation.addEventListener('click', function() {
        step2.style.display = 'none';
        step3.style.display = 'block';
    });
    finish.addEventListener('click', function() {
        window.location.href = 'service omra.html';
    });
});
document.addEventListener('DOMContentLoaded', function() {
    const finishBtn = document.getElementById('finish-btn');
    const messageContainer = document.getElementById('message-container');

    finishBtn.addEventListener('click', function() {
        showSuccessMessage();
    });

    function showSuccessMessage() {
        messageContainer.style.display = 'block';
        messageContainer.innerHTML = `
            <div class="success-message">
                <i class="fas fa-check-circle"></i>
                <p>Votre demande est terminée avec succès !</p>
            </div>
        `;
    }
});
