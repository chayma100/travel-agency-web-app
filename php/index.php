<?php

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $conn = new PDO("mysql:host=localhost;dbname=agence_voyage", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $nom = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM utilisateurs WHERE email = :email AND mot_de_passe = :mot_de_passe";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':mot_de_passe', $password);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            header("Location: espace_utilisateur.php");
            exit();
        } else {
            $message = "Nom d'utilisateur ou mot de passe incorrect.";
        }
    } catch (PDOException $e) {
        die("Erreur de connexion à la base de données : " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>agence de voyage</title>
    <link rel="stylesheet" href="../css/index.css">
    <link rel="icon" href="../images/logo.png.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=bolt" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@400" />
</head>
<body>
    <header class="h">
        <nav class="navi">
            <div class="logo"><img src="../images/logo.png.png"></div>
            <ol class="lista">
                <li><a href="#">HOME</a></li>
                <li><a href="../pages/proj.html">À propos de nous</a></li>
                <li><a href="../pages/maps.html">Nos locaux</a></li>
                <li><a href="offre.php">Nos offres</a></li>
                <li><a href="serv.php">Services</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="service omra.php">service omra</a></li>
            </ol>
            <div class="input">
                <span class="material-symbols-outlined">search</span>
                <input type="text" placeholder="ville, hôtel">
            </div>
        </nav>
    </header>

    <section class="hero">
        <div class="slider-container-01">
            <div class="slider-track" id="sliderTrack">
              <div class="slider-item"><img src="https://img.freepik.com/photos-gratuite/statue-christophe-colomb_1398-691.jpg?ga=GA1.1.1545874887.1746305393&semt=ais_hybrid&w=740" alt="Image 1" /></div>
              <div class="slider-item"><img src="https://img.freepik.com/photos-premium/minar-e-pakistan-jour_3544-60.jpg?ga=GA1.1.1545874887.1746305393&semt=ais_hybrid&w=740" alt="Image 2" /></div>
              <div class="slider-item"><img src="https://img.freepik.com/photos-gratuite/monument-democratie-dans-nuit-bangkok-thailande_1150-17917.jpg?ga=GA1.1.1545874887.1746305393&semt=ais_hybrid&w=740" alt="Image 3" /></div>
              <div class="slider-item"><img src="https://img.freepik.com/photos-gratuite/tir-vertical-riviere-entouree-montagnes-prairies-ecosse_181624-27881.jpg?ga=GA1.1.1545874887.1746305393&semt=ais_hybrid&w=740" alt="Image 4" /></div>
              <div class="slider-item"><img src="https://img.freepik.com/photos-gratuite/prise-vue-verticale-faible-angle-sculptures-colorees-carnaval_181624-33168.jpg?ga=GA1.1.1545874887.1746305393&semt=ais_hybrid&w=740" alt="Image 5" /></div>
              <div class="slider-item"><img src="https://img.freepik.com/photos-premium/monument-tour-minarepakistan-pakistan-lahore-pakistan_759575-4793.jpg?ga=GA1.1.1545874887.1746305393&semt=ais_hybrid&w=740" alt="Image 6" /></div>
              <div class="slider-item"><img src="https://img.freepik.com/photos-premium/structure-construite-au-coucher-du-soleil_1048944-24816571.jpg?ga=GA1.1.1545874887.1746305393&semt=ais_hybrid&w=740" alt="Image 7" /></div>
              <div class="slider-item"><img src="https://img.freepik.com/photos-gratuite/groupe-personnes-marchant-trek-bali_72229-1531.jpg?ga=GA1.1.1545874887.1746305393&semt=ais_hybrid&w=740" alt="Image 8" /></div>
            </div>
        </div>
    </section>

    <section class="container">
        <article class="mySlides"><img src="../images/omra.png" alt="Offre 1"></article>
        <article class="mySlides"><img src="../images/istanbul.png" alt="Offre 2"></article>
        <article class="mySlides"><img src="../images/circuit_nord.png" alt="Offre 3"></article>
        <article class="mySlides"><img src="../images/sud_tunisien.png" alt="Offre 4"></article>
    </section>

    <section class="s1">
        <h1>découvrons le monde ensemble &#128522;</h1>
        <div class="confiance"><img src="../images/Capture d'écran 2025-02-13 004944.png"></div>
    </section>

    <section class="newsletter">
        <h1>Newsletter</h1>
        <pre>                Inscrivez-vous à la newsletter de Go Mondo afin de recevoir les dernières actualités, les offres
                privées et inspirations pour votre prochaine croisière</pre>
        <h3><span class="material-symbols-outlined">bolt</span>Suivez notre actualité</h3>
        <h3><span class="material-symbols-outlined">bolt</span>Bénéficiez de nos offres commerciale</h3>
        <h3><span class="material-symbols-outlined">bolt</span>Recevez nos inspirations</h3>
    </section>

    <section class="LR">
        <div class="left">
            <fieldset>
                <legend>Connexion</legend>
                <form action="index.php" method="POST">
                    <table>
                        <tr>
                            <td><label for="name"></label></td>
                            <td><input type="text" id="name" name="name" placeholder="Entrez votre nom" required></td>
                        </tr>
                        <tr>
                            <td><label for="email"></label></td>
                            <td><input type="email" id="email" name="email" placeholder="Entrez votre email" required></td>
                        </tr>
                        <tr>
                            <td><label for="password"></label></td>
                            <td><input type="password" id="password" name="password" placeholder="Entrez votre mot de passe" required></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <button id="btnConnecter" class="bttn1" type="submit">Se connecter</button>
                                <button id="btnInscrire" type="button" onclick="window.location.href='register.php'">S'inscrire</button>
                            </td>
                        </tr>
                    </table>
                </form>
                <?php if (!empty($message)) echo "<p style='color: red; font-weight: bold;'>$message</p>"; ?>
            </fieldset>
            <br>
        </div>
    </section>

    <section id="durabilite"><img src="../images/durabilité.png"></section>

    <section class="tests">
        <h2>Over 1000 satisfied customers</h2>
        <div class="test-container">
            <div class="test">
                <img src="https://img.a.transfermarkt.technology/portrait/big/69110-1725823974.png?lm=1" alt="User">
                <h3>youssef msekni</h3>
                <p>2 years ago</p>
                <p>"Amazing service"</p>
            </div>
            <div class="test">
                <img src="https://realites.com.tn/fr/wp-content/uploads/2023/11/400133234_751022813707884_5948976763040358012_n.jpg" alt="User">
                <h3>zied jaziri</h3>
                <p>11 months ago</p>
                <p>"Very professional team!"</p>
            </div>
            <div class="test">
                <img src="https://pictures.artify.tn/media/nydwlxje77msmb8aonhf.jpg" alt="User">
                <h3>baya zardi</h3>
                <p>5 months ago</p>
                <p>"Would definitely recommend!"</p>
            </div>
        </div>
    </section>

<script src="../js/index.js"></script>
</body>
</html>