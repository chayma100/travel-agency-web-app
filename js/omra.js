function scrollGallery(direction) {
    const gallery = document.getElementById('gallery');
    const scrollAmount = 300;
    gallery.scrollBy({
      left: direction * scrollAmount,
      behavior: 'smooth'
    });
  }

  const text = "Bienvenue à notre service OMRA";
  const element = document.getElementById("typewriter");
  let index = 0;

  function typeWriter() {
    if (index < text.length) {
      element.innerHTML += text.charAt(index);
      index++;
      setTimeout(typeWriter, 80); 
    }
  }

  window.onload = typeWriter;

  document.querySelectorAll('.discover-btn').forEach(btn => {
    btn.addEventListener('mouseenter', () => {
        btn.style.transform = 'scale(1.05)';
    });
    btn.addEventListener('mouseleave', () => {
        btn.style.transform = 'scale(1)';
    });
});
