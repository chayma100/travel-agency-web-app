document.addEventListener('DOMContentLoaded', function() {
  // Sélectionne toutes les images à animer
  const images = document.querySelectorAll('.sliding-image');
  
  // Fonction pour animer les images une par une
  function animateImages() {
      images.forEach((image, index) => {
          // Délai progressif pour chaque image
          setTimeout(() => {
              image.classList.add('animate');
          }, index * 200); // 200ms entre chaque animation
      });
  }
  
  // Délai pour s'assurer que la page est complètement chargée
  setTimeout(animateImages, 300);
});