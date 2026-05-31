<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/omra.css">
    <link rel="stylesheet" href="../css/accompagant.css">
    <link rel="stylesheet" href="../css/njareb.css">
</head>
<body>
    <button class="menu-toggle" id="menuToggle">
        <i class="fas fa-bars"></i>
    </button>
    <nav class="side-menu" id="sideMenu">
        <div class="menu-header">
            <h2>TravelWorld</h2>
            <p>Explorez le monde</p>
        </div>
        <ul class="menu-items">
            <li><a href="../pages/acceuil.html"><i class="fas fa-home"></i> Accueil</a></li>
            <li><a href="../pages/html.html"><i class="fas fa-globe-americas"></i> Destinations</a></li>
            <li><a href="../pages/serv.html"><i class="fas fa-suitcase-rolling"></i> Packages</a></li>
            <li><a href="../php/service omra.php"><i class="fas fa-images"></i> Service Omra</a></li>
            <li><a href="#"><i class="fas fa-envelope-open-text"></i> Contact</a></li>
            <li><a href="#"><i class="fas fa-envelope-open-text"></i> About Us</a></li>
            <li><a href="../php/tableau.php"><i class="fas fa-envelope-open-text"></i> Users</a></li>
            <li><a href="../php/paiement.php"><i class="fas fa-envelope-open-text"></i> cards</a></li>
        </ul>
    </nav>
    <div class="overlay" id="overlay"></div>
    <header class="h">
        <nav class="navi">
            <div class="logo"><img src="../images/logo.png.png"></div>
            <ul class="lista">
                <li><a href="home" target="_blank">HOME</a></li>
                <li><a href="about" target="_blank">À propos de nous</a></li>
                <li><a href="" target="_blank">Nos locaux</a></li>
                <li><a href="../pages/serv.html" target="_blank">Nos offres</a></li>
                <li><a href="../pages/service omra.html" target="_blank">Services Omra</a></li>
                <li><a href="../pages/html.html" target="_blank">Tour packages</a></li>
                <li><a href="../pages/avis.html" target="_blank">Contact</a></li>
            </ul>
            <div class="input">
                <span class="material-symbols-outlined">search</span>
                <input type="text" placeholder="ville, hôtel">
            </div>
        </nav>
    </header>
    <main class="main-content">
        <div class="gallery-container">
            <button class="scroll-btn left" onclick="scrollGallery(-1)">‹</button>
            <div class="gallery" id="gallery">
                <img src="../images/mekkah.png" alt="Image 1" />
                <img src="../images/mekkah1.png" alt="Image 2" />
                <img src="../images/mekkah2.png" alt="Image 3" />
                <img src="../images/omra1.png" alt="Image 4" />
                <img src="../images/omra2.png" alt="Image 1" />
                <img src="../images/omra3.png" alt="Image 1" />
                <img src="../images/omra4.png" alt="Image 1" />
                <img src="../images/omra5.png" alt="Image 1" />
                <img src="../images/omra6.png" alt="Image 1" />
            </div>
            <button class="scroll-btn right" onclick="scrollGallery(1)">›</button>
        </div>
    </main>
    <div class="button-container" id="button-container">
        <a href="../pages/chatbot.html" class="discover-btn">Option</a>
        <br><br><br><br>
        <a href="../pages/paiement.html" class="discover-btn">Paiement</a>
        <br><br><br><br>
        <a href="../php/compte.php" class="discover-btn">Mon Compte</a>
        <br><br><br>
    </div>
    <div id="assistant-container">
        <div class="assistant-header">
            <div class="assistant-avatar">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19 14L12 21L5 14M5 10L12 3L19 10" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <div>
                <div class="assistant-title">Assistant Omra</div>
                <div class="assistant-subtitle">Je suis là pour vous aider</div>
            </div>
        </div>
        <div class="assistant-body" id="chat-body"></div>
        <div class="assistant-footer">
            <input type="text" class="assistant-input" id="user-input" placeholder="Tapez votre message...">
            <button class="assistant-send" id="send-btn">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M22 2L11 13M22 2L15 22L11 13M11 13L2 9" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
            <br><br>
        </div>
    </div>
    <script src="../js/omra.js"></script>
    <script src="../js/accompagnat.js"></script>
    <script src="../js/njareb.js"></script>
</body>
</html>