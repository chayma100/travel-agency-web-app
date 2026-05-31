<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "agence_voyage";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $etoile = isset($_POST["nbr"]) ? $_POST["nbr"] : "Non précisé";
    $package = isset($_POST["res"]) ? $_POST["res"] : "Non précisé";
    $nom = isset($_POST["nom"]) ? htmlspecialchars($_POST["nom"]) : "Anonyme";
    $avis = isset($_POST["avis"]) ? htmlspecialchars($_POST["avis"]) : "Aucun avis";
    $suggestions = isset($_POST["suggestions"]) ? htmlspecialchars($_POST["suggestions"]) : "Aucune suggestion";

    echo "<div class='message-thank-you'>";
    echo "<h2>Merci pour votre retour, $nom !</h2>";
    echo "<p><strong>Hôtel choisi :</strong> $etoile étoiles</p>";
    echo "<p><strong>Type de voyage :</strong> $package</p>";
    echo "<p><strong>Votre avis :</strong><br>$avis</p>";
    echo "<p><strong>Suggestions :</strong><br>$suggestions</p>";
    echo "</div>";
}

$sql = "SELECT * FROM services";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services</title>
    <link rel="stylesheet" href="../css/projet dev.css">
    <link rel="stylesheet" href="../css/projet dev 1.css">
    <link rel="stylesheet" href="../css/njareb.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
            <li><a href="../php/index.php"><i class="fas fa-home"></i> Accueil</a></li>
            <li><a href="../php/offre.php"><i class="fas fa-globe-americas"></i> Nos offres</a></li>
            <li><a href="../pages/maps.html"><i class="fas fa-concierge-bell"></i> nos locaux</a></li>
            <li><a href="../php/serv.php"><i class="fas fa-suitcase-rolling"></i> services</a></li>
            <li><a href="../php/service omra.php"><i class="fas fa-images"></i> Service Omra</a></li>
            <li><a href="../php/contact.php"><i class="fas fa-envelope-open-text"></i> Contacts</a></li>
            <li><a href="#"><i class="fas fa-envelope-open-text"></i> à propos de nous</a></li>
        </ul>
    </nav>

    <div class="overlay" id="overlay"></div>

    <div class="cards-container">
        <p style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: rgb(245, 71, 100);"><strong>Services :</strong></p>
    
        <form>
        <p style="font-family: Georgia, 'Times New Roman', Times, serif;"><strong>hotelerie : </strong></p>
        <input type="radio" name="nbr"> 5 étoiles
        <br>
        <div class="img-container1" id="cards-content">
            <div class="card ia-show">
                <img src="../images/Capture d'écran 2025-02-17 223133.png" alt="IA Visual" class="card-img" width="400" height="300">
                <img src="../images/Capture d'écran 2025-02-17 223209.png" alt="IA Visual" class="card-img" width="400" height="300">
                <img src="../images/Capture d'écran 2025-02-17 223524.png" alt="IA Visual" class="card-img" width="400" height="300">
                <img src="../images/Capture d'écran 2025-02-17 223242.png" alt="IA Visual" class="card-img" width="400" height="300">
                <img src="../images/Capture d'écran 2025-02-17 223421.png" alt="IA Visual" class="card-img" width="400" height="300">
            </div>
        </div> 
        <br>
        <input type="radio" name="nbr" checked> 4 étoiles
        <br>
        <div class="img-container1" id="cards-content">
            <div class="card ia-show delay-1">
                <img src="../images/Capture d'écran 2025-02-17 224118.png" alt="IA Visual" class="card-img" width="400" height="300">
                <img src="../images/Capture d'écran 2025-02-17 223440.png" alt="IA Visual" class="card-img" width="400" height="300">
                <img src="../images/Capture d'écran 2025-02-17 223553.png" alt="IA Visual" class="card-img" width="400" height="300">
                <img src="../images/Capture d'écran 2025-02-17 223831.png" alt="IA Visual" class="card-img" width="400" height="300">
            </div>
        </div>
        <br>
        <input type="radio" name="nbr"> 3 étoiles
        <br>
        <div class="img-container1" id="cards-content">
            <div class="card ia-show delay-2">
                <img src="../images/Capture d'écran 2025-02-17 223915.png" alt="IA Visual" class="card-img" width="400" height="300">
                <img src="../images/Capture d'écran 2025-02-17 223321.png" alt="IA Visual" class="card-img" width="400" height="300">
                <img src="../images/Capture d'écran 2025-02-17 223524.png" alt="IA Visual" class="card-img" width="400" height="300">
            </div>
        </div>
        <br>
        <h3>Autres activités:</h3>
        <div class="img-container">
    <?php
    $result->data_seek(0);
    while ($row = $result->fetch_assoc()) {
        echo "<div>";
        echo "<h4>" . $row['nom'] . "</h4>";
        echo "<p>" . $row['description'] . "</p>";
        echo "<img src='../images/" . $row['image'] . "' width='400' height='300'></div><br>";
    }
    ?>
</div>
        <br>
        <p style="font-family:Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;"><strong>Package : </strong></p>

        <form class="travel-form">
            <h3>Quel type de voyage préférez-vous ?</h3>
            <div class="radio-group">
              <label><input type="radio" name="res"> Leisure Travel</label>
              <label><input type="radio" name="res"> Adventure Travel</label>
              <label><input type="radio" name="res"> Cultural Travel</label>
              <label><input type="radio" name="res"> Eco-tourism</label>
              <label><input type="radio" name="res"> Business Travel</label>
              <label><input type="radio" name="res"> Backpacking</label>
              <label><input type="radio" name="res"> Solo Travel</label>
              <label><input type="radio" name="res"> Road Trips</label>
              <label><input type="radio" name="res"> Cruise Travel</label>
              <label><input type="radio" name="res"> Volunteer Travel (Voluntourism)</label>
              <label><input type="radio" name="res"> Family Travel</label>
              <label><input type="radio" name="res"> Luxury Travel</label>
              <label><input type="radio" name="res"> Health and Wellness Travel</label>
              <label><input type="radio" name="res"> Digital Nomad Travel</label>
            </div>
            <div class="content">
                <button type="submit" class="ia-button1">Soumettre</button>
            </div>
        </form>
        <br>

        <p style="font-family:Verdana, Geneva, Tahoma, sans-serif"><strong> Activities : </strong></p>
        <p style="font-family: Georgia, 'Times New Roman', Times, serif;"><strong> SKI : <p>Profiter des stations de montagne en hiver.</p></strong><br> 
        <div class="img-container1" id="cards-content">
            <div class="card ia-show">
                <img src="../images/Capture d'écran 2025-02-17 223706.png" alt="IA Visual" class="card-img" width="400" height="300">
                <img src="../images/Capture d'écran 2025-02-17 223831.png" alt="IA Visual" class="card-img" width="400" height="300">
                <img src="../images/Capture d'écran 2025-02-17 223758.png" alt="IA Visual" class="card-img" width="400" height="300">
            </div>
        </div> 
        <br>
        <p style="font-family: Georgia, 'Times New Roman', Times, serif;"><strong> Visiter des monuments célèbres : <p>Découvrir l'histoire, l'art et la culture locale.</p></strong><br> 
        <div class="img-container1" id="cards-content">
            <div class="card ia-show">
                <img src="../images/Capture d'écran 2025-02-17 224530.png" alt="IA Visual" class="card-img" width="400" height="300">
                <img src="../images/Capture d'écran 2025-02-17 224555.png" alt="IA Visual" class="card-img" width="400" height="300">
                <img src="../images/Capture d'écran 2025-02-17 224636.png" alt="IA Visual" class="card-img" width="400" height="300">
                <img src="../images/Capture d'écran 2025-02-17 224728.png" alt="IA Visual" class="card-img" width="400" height="300">
            </div>
        </div> 
        <br>
        <p style="font-family: Georgia, 'Times New Roman', Times, serif;"><strong> Surf et Kayak : <p>Activités nautiques selon la destination.</p></strong><br> 
        <div class="img-container1" id="cards-content">
            <div class="card ia-show">
                <img src="../images/Capture d'écran 2025-02-24 191959.png" alt="IA Visual" class="card-img" width="400" height="300">
                <img src="../images/Capture d'écran 2025-02-24 192330.png" alt="IA Visual" class="card-img" width="400" height="300">
                <img src="../images/Capture d'écran 2025-02-24 192400.png" alt="IA Visual" class="card-img" width="400" height="300">
                <img src="../images/Capture d'écran 2025-02-24 192517.png" alt="IA Visual" class="card-img" width="400" height="300">
            </div>
        </div> 
        <br>
        <p style="font-family: Georgia, 'Times New Roman', Times, serif;"><strong>Explorer des quartiers pittoresques : <p>Se promener dans des rues historiques ou colorées.</p></strong><br> 
        <div class="img-container1" id="cards-content">
            <div class="card ia-show">
                <img src="../images/Capture d'écran 2025-02-24 192633.png" alt="IA Visual" class="card-img" width="400" height="300">
                <img src="../images/Capture d'écran 2025-02-24 192700.png" alt="IA Visual" class="card-img" width="400" height="300">
                <img src="../images/Capture d'écran 2025-02-24 192731.png" alt="IA Visual" class="card-img" width="400" height="300">
                <img src="../images/Capture d'écran 2025-02-24 192812.png" alt="IA Visual" class="card-img" width="400" height="300">
                <img src="../images/Capture d'écran 2025-02-24 192852.png" alt="IA Visual" class="card-img" width="400" height="300">
                <img src="../images/Capture d'écran 2025-02-24 192925.png" alt="IA Visual" class="card-img" width="400" height="300">
                <img src="../images/Capture d'écran 2025-02-24 193028.png" alt="IA Visual" class="card-img" width="400" height="300">
                <img src="../images/Capture d'écran 2025-02-24 193004.png" alt="IA Visual" class="card-img" width="400" height="300">
            </div>
        </div> 
        <br><br>
        <p style="font-family: Georgia, 'Times New Roman', Times, serif;"><strong>Faire des activités ludiques : <p>mini-golf, escape games ...</p></strong><br> 
        <div class="img-container1" id="cards-content">
            <div class="card ia-show">
                <img src="../images/Capture d'écran 2025-02-24 200728.png" alt="IA Visual" class="card-img" width="400" height="300">
                <img src="../images/Capture d'écran 2025-02-24 200926.png" alt="IA Visual" class="card-img" width="400" height="300">
                <img src="../images/Capture d'écran 2025-02-24 201105.png" alt="IA Visual" class="card-img" width="400" height="300">
                <img src="../images/Capture d'écran 2025-02-24 201234.png" alt="IA Visual" class="card-img" width="400" height="300">
                <img src="../images/Capture d'écran 2025-02-24 201415.png" alt="IA Visual" class="card-img" width="400" height="300">
            </div>
        </div> 
        <br>
        <p style="font-family: Georgia, 'Times New Roman', Times, serif;"><strong>Parachutisme ou parapente : <p>Sensation forte avec des vues panoramiques.</p></strong><br> 
        <div class="img-container1" id="cards-content">
            <div class="card ia-show">
                <img src="../images/Capture d'écran 2025-02-24 202314.png" alt="IA Visual" class="card-img" width="400" height="300">
                <img src="../images/Capture d'écran 2025-02-24 202421.png" alt="IA Visual" class="card-img" width="400" height="300">
                <img src="../images/Capture d'écran 2025-02-24 202447.png" alt="IA Visual" class="card-img" width="400" height="300">
                <img src="../images/Capture d'écran 2025-02-24 203506.png" alt="IA Visual" class="card-img" width="400" height="300">
                <img src="../images/Capture d'écran 2025-02-24 203531.png" alt="IA Visual" class="card-img" width="400" height="300">
                <img src="../images/Capture d'écran 2025-02-24 203643.png" alt="IA Visual" class="card-img" width="400" height="300">
                <img src="../images/Capture d'écran 2025-02-24 203818.png" alt="IA Visual" class="card-img" width="400" height="300">
                <img src="../images/Capture d'écran 2025-02-24 203732.png" alt="IA Visual" class="card-img" width="400" height="300">
                <img src="../images/Capture d'écran 2025-02-24 200728.png" alt="IA Visual" class="card-img" width="400" height="300">
                <img src="../images/Capture d'écran 2025-02-24 200926.png" alt="IA Visual" class="card-img" width="400" height="300">
                <img src="../images/Capture d'écran 2025-02-24 201105.png" alt="IA Visual" class="card-img" width="400" height="300">
                <img src="../images/Capture d'écran 2025-02-24 201234.png" alt="IA Visual" class="card-img" width="400" height="300">
                <img src="../images/Capture d'écran 2025-02-24 201415.png" alt="IA Visual" class="card-img" width="400" height="300">
            </div>
        </div> 
        <br>
        <p style="font-family: Georgia, 'Times New Roman', Times, serif;"><strong>Aller dans des zoos ou aquariums: <p>Découvrir des animaux exotiques.</p></strong></p><br> 
        <div class="img-container1" id="cards-content">
            <div class="card ia-show">
                <img src="../images/Capture d'écran 2025-02-24 201557.png" alt="IA Visual" class="card-img" width="400" height="300">
                <img src="../images/Capture d'écran 2025-02-24 201639.png" alt="IA Visual" class="card-img" width="400" height="300">
                <img src="../images/Capture d'écran 2025-02-24 201824.png" alt="IA Visual" class="card-img" width="400" height="300">
                <img src="../images/Capture d'écran 2025-02-24 202031.png" alt="IA Visual" class="card-img" width="400" height="300">
                <img src="../images/Capture d'écran 2025-02-24 202229.png" alt="IA Visual" class="card-img" width="400" height="300">
            </div>
        </div> 
        <br>
        <div class="form-container">
            <h2>Contactez-nous</h2>
            <form>
              <label for="name">Nom</label>
              <input type="text" id="name" placeholder="Votre nom" />
              <label for="email">Email</label>
              <input type="email" id="email" placeholder="Votre email" />
              <label for="message">Message</label>
              <textarea id="message" placeholder="Votre message..."></textarea>
              <button type="submit">Envoyer</button>
            </form>
        </div>
    </div>
    <script src="../js/scroll-transitions.js"></script>
    <script src="../js/njareb.js"></script>
</body>
</html>

<?php
$conn->close();
?>