
const sliderTrack = document.getElementById('sliderTrack');
  const slides = sliderTrack.children;
  const totalSlides = slides.length;
  const visibleSlides = 4; 
  let currentIndex = 0;

  
  for(let i = 0; i < visibleSlides; i++) {
    const clone = slides[i].cloneNode(true);
    sliderTrack.appendChild(clone);
  }

 
  const slideWidthPercent = 100 / visibleSlides;


  function moveSlider() {
    currentIndex++;
    sliderTrack.style.transition = 'transform 0.5s ease';
    sliderTrack.style.transform = `translateX(-${currentIndex * slideWidthPercent}%)`;

    
    if(currentIndex >= totalSlides) {
      setTimeout(() => {
        sliderTrack.style.transition = 'none';
        currentIndex = 0;
        sliderTrack.style.transform = `translateX(0)`;
      }, 300); // 
    }
  }

  
  setInterval(moveSlider, 1500);
  const scroll = document.querySelector(".navi");
  window.addEventListener("scroll", () => {
      if (window.scrollY > 150) {
          scroll.classList.add("scrolled");
      } else {
          scroll.classList.remove("scrolled");
      }
  });
  document.getElementById("btnConnecter").addEventListener("click", function() {
  this.classList.add('clicked');
  setTimeout(() => {
      this.classList.remove('clicked');
      document.querySelector('form').submit();
  }, 200);
});

document.getElementById("btnInscrire").addEventListener("click", function() {
  this.classList.add('clicked');
  setTimeout(() => {
      this.classList.remove('clicked');
      window.location.href = 'register.php';
  }, 200);
});

document.querySelectorAll('.lista a').forEach(link => {
  link.classList.add('boutonNav');
});
document.getElementById("loginForm").addEventListener("submit", function(e) {
  e.preventDefault(); 

  var formData = new FormData(this); 

  var xhr = new XMLHttpRequest();
  xhr.open("POST", "index.php", true);  
  xhr.onreadystatechange = function() {
      if (xhr.readyState == 4 && xhr.status == 200) {
         
          document.getElementById("errorMessage").textContent = xhr.responseText;
      }
  };
  xhr.send(formData);  
});
