document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('reservationForm');
    const guideYes = document.getElementById('guideYes');
    const guideList = document.getElementById('guideList');
    const guideSelect = document.getElementById('guideSelect');
    const submitBtn = document.querySelector('.btn');
    const messageContainer = document.getElementById('messageContainer');

    guideYes.addEventListener('change', function() {
        guideList.style.display = this.checked ? 'block' : 'none';
    });

    form.addEventListener('submit', function(event) {
        event.preventDefault(); 

        const isGuideRequired = guideYes.checked;
        const isGuideSelected = guideSelect.value !== '';

        if (isGuideRequired && !isGuideSelected) {
            submitBtn.style.backgroundColor = '#ff4444';
            submitBtn.inner = '<i class="fas fa-exclamation-circle"></i> Veuillez choisir un guide';
            
            setTimeout(() => {
                submitBtn.style.backgroundColor = '';
                submitBtn.innerHTML = '<i class="fas fa-paper-plane"></i> Confirmer ma demande sacrée';
            }, 3000);
            return; 
        }

        form.style.display = 'none';
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
