const prices = {
    paris: 1800,
    berlin: 1500,
    bangkok: 1200,
    maldives: 3000,
    venice: 2000,
    canada: 2500,
    cappadoce: 1400
  };

  document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("price-paris").textContent = "Price: $" + prices.paris;
    document.getElementById("price-berlin").textContent = "Price: $" + prices.berlin;
    document.getElementById("price-bangkok").textContent = "Price: $" + prices.bangkok;
    document.getElementById("price-maldives").textContent = "Price: $" + prices.maldives;
    document.getElementById("price-venice").textContent = "Price: $" + prices.venice;
    document.getElementById("price-canada").textContent = "Price: $" + prices.canada;
    document.getElementById("price-cappadoce").textContent = "Price: $" + prices.cappadoce;
  });
// Récupérer l'élément du bouton
const button = document.getElementById('redirectButton');

// Ajouter un événement au clic
button.addEventListener('click', function(event) {
  // Empêcher le comportement par défaut (c'est-à-dire la navigation)
  event.preventDefault();

  // Rediriger vers une autre page
  window.location.href = 'https://fr.wikipedia.org/wiki/Paris';  // Remplace l'URL par celle que tu souhaites
});
// Ajouter un événement au clic du bouton
button.addEventListener('click', function() {
  // Jouer le son de bienvenue
  welcomeSound.play();
});