document.addEventListener('DOMContentLoaded', () => {
    // 1. Liste de tous les conteneurs à observer
    const containers = [
        ...document.querySelectorAll('.card, .img-container1'),
        ...document.querySelectorAll('.travel-form'),
        ...document.querySelectorAll('.form-container')
    ];

    // 2. Configuration optimisée de l'Observer
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animated');
                
                // Système de secours pour images manquantes
                setTimeout(() => {
                    const images = entry.target.querySelectorAll(':is(.card-img, img)');
                    images.forEach(img => {
                        if (getComputedStyle(img).opacity === '0') {
                            img.style.opacity = '1';
                            img.style.transform = 'translateY(0)';
                        }
                    });
                }, 500);
            }
        });
    }, {
        threshold: 0.05,
        rootMargin: '0px 0px -100px 0px'
    });

    // 3. Observation de tous les conteneurs
    containers.forEach(container => {
        container.classList.remove('animated'); // Reset
        observer.observe(container);
        
        // Backup ultime (3 secondes)
        setTimeout(() => {
            if (!container.classList.contains('animated')) {
                container.classList.add('animated');
            }
        }, 3000);
    });

    // Debug
    console.log('Conteneurs surveillés:', containers.length);
});