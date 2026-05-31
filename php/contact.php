<?php

$host = 'localhost';
$dbname = 'agence_voyage';
$username = 'root';
$password = '';

$successMessage = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $message = htmlspecialchars($_POST['message']);
        $stmt = $pdo->prepare("INSERT INTO contact_messages (name, email, message) VALUES (:name, :email, :message)");
        $stmt->execute([':name' => $name, ':email' => $email, ':message' => $message]);
        $successMessage = 'Votre message a été envoyé avec succès !';
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - GOMondo</title>
    <link rel="stylesheet" href="../css/contact.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>

<header class="contact-header">
    <h1>Contactez-nous</h1>
</header>

<main class="contact-container">
    <section class="contact-info">
        <h2>Nos coordonnées</h2>
        <p><strong>📍 Adresse :</strong> Tunis - Centre Urbain</p>
        <p><strong>📞 Téléphone :</strong> 77 98 65 98</p>
        <p><strong>📧 Email :</strong> GOMondo-agence@gmail.com</p>
    </section>

    <section class="contact-form">
        <h2>Envoyez-nous un message</h2>
        <form action="contact.php" method="post">
            <label for="name">Nom :</label>
            <input type="text" id="name" name="name" required>
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" required>
            <label for="message">Message :</label>
            <textarea id="message" name="message" required></textarea>
            <button type="submit">Envoyer</button>
        </form>
    </section>

    <input type="checkbox" id="check">
    <label for="check" class="btn_1"><i class="fas fa-bars"></i></label>

    <div class="sidebarmenu">
        <div class="logo"><a href="#">Panel</a></div>
        <label for="check" class="btn_2"><i class="fas fa-times"></i></label>
        <ul class="lista">
            <li><a href="index.php">HOME</a></li>
            <li><a href="../pages/proj.html">À propos de nous</a></li>
            <li><a href="../pages/locaux.html">Nos locaux</a></li>
            <li><a href="offre.php">Nos offres</a></li>
            <li><a href="serv.php">Services</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
    </div>

    <?php if (!empty($successMessage)): ?>
        <div id="notification" class="notification"><?php echo $successMessage; ?></div>
    <?php endif; ?>
    <a href="../pages/feedback.html" class="btn-feedback">Donner un avis</a>
</main>

<footer>
    <p>Suivez-nous sur:</p>
    <div class="social-icons">
        <a href="#"><img src="../images/insta.jpg" alt="Instagram"></a>
        <a href="#"><img src="../images/fb.jpg" alt="Facebook"></a>
        <a href="#"><img src="../images/tiktok.png" alt="TikTok"></a>
    </div>
    <p>&copy; 2025 GOMondo. Tous droits réservés.</p>
</footer>

<script>
    window.onload = function() {
        const successMessage = "<?php echo $successMessage; ?>";
        if (successMessage) {
            const notification = document.getElementById("notification");
            notification.style.display = "block";
            setTimeout(function() {
                notification.style.display = "none";
            }, 5000);
        }
    }
</script>

</body>
</html>