<?php

$host = "localhost";
$dbname = "agence_voyage";
$user = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

$reservation_message = '';
$annulation_message = '';

if ($_SERVER["REQUEST_METHOD"] === "POST" && $_POST['action'] === 'reserver') {
    $destination = $_POST['destination'];
    $date = $_POST['date'];
    $nb_personnes = (int) $_POST['nb_personnes'];
    $user_id = 1;

    $stmt = $pdo->prepare("INSERT INTO reservations (user_id, destination, date_depart, nb_personnes) VALUES (?, ?, ?, ?)");
    if ($stmt->execute([$user_id, $destination, $date, $nb_personnes])) {
        $reservation_message = "Réservation effectuée avec succès.";
    } else {
        $reservation_message = "Une erreur est survenue lors de la réservation.";
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && $_POST['action'] === 'annuler') {
    $id_reservation = (int) $_POST['id_reservation'];

    $stmt = $pdo->prepare("DELETE FROM reservations WHERE id = ?");
    if ($stmt->execute([$id_reservation])) {
        $annulation_message = "Réservation annulée avec succès.";
    } else {
        $annulation_message = "Erreur lors de l'annulation.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Espace Utilisateur</title>
    <link rel="stylesheet" href="../css/espace_utilisateur.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .message { text-align: center; font-weight: bold; font-size: 1.1em; margin: 10px 0; }
        .success { color: green; }
        .error { color: red; }
    </style>
</head>
<body>
    <div class="mainbox">
        <input type="checkbox" id="check">
        <label for="check" class="btn_1"><i class="fas fa-bars"></i></label>

        <div class="sidebarmenu">
            <div class="logo"><a href="#">Espace Client</a></div>
            <label for="check" class="btn_2"><i class="fas fa-times"></i></label>
            <ul class="lista">
                <li><a href="index.php"><i class="fas fa-home"></i>Accueil</a></li>
                <li><a href="offre.php"><i class="fas fa-tags"></i>Offres</a></li>
                <li><a href="serv.php"><i class="fas fa-sliders-h"></i>Services</a></li>
                <li><a href="liste_reservation.php"><i class="fas fa-calendar-plus"></i>Mes Réservations</a></li>
                <li><a href="../pages/contact.html"><i class="fas fa-phone"></i>Contact</a></li>
            </ul>
            <div class="socialmedia">
                <ul>
                    <li><i class="fab fa-facebook"></i></li>
                    <li><i class="fab fa-twitter"></i></li>
                    <li><i class="fab fa-instagram"></i></li>
                    <li><i class="fab fa-youtube"></i></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="content">
        <h1>Bienvenue sur votre espace</h1>
        <p>Réservez ou annulez vos voyages ici.</p>

        <?php if (!empty($reservation_message)): ?>
            <p class="message success"><?= htmlspecialchars($reservation_message) ?></p>
        <?php endif; ?>

        <?php if (!empty($annulation_message)): ?>
            <p class="message error"><?= htmlspecialchars($annulation_message) ?></p>
        <?php endif; ?>

        <section>
            <h2>Faire une réservation</h2>
            <form action="espace_utilisateur.php" method="POST">
                <input type="hidden" name="action" value="reserver">
                <label for="destination">Destination</label>
                <input type="text" id="destination" name="destination" required>
                <label for="date">Date de départ</label>
                <input type="date" id="date" name="date" required>
                <label for="nb_personnes">Nombre de personnes</label>
                <input type="number" id="nb_personnes" name="nb_personnes" min="1" required>
                <button type="submit">Réserver</button>
            </form>
        </section>

        <section>
            <h2>Annuler une réservation</h2>
            <form id="annulationForm" action="espace_utilisateur.php" method="POST">
                <input type="hidden" name="action" value="annuler">
                <label for="id_reservation">ID de la réservation</label>
                <input type="number" id="id_reservation" name="id_reservation" required>
                <button type="button" id="btn-annuler">Annuler</button>
            </form>
        </section>
    </div>

    <div class="toggle-switch" id="modeSwitch">
        <span class="toggle-text">OFF</span>
        <div class="toggle-circle"></div>
    </div>

    <script>
        document.getElementById('btn-annuler').addEventListener('click', function () {
            Swal.fire({
                title: 'Voulez-vous vraiment annuler ?',
                text: "Cette action est irréversible.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Oui, annuler',
                cancelButtonText: 'Non'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('annulationForm').submit();
                }
            });
        });

        const modeSwitch = document.getElementById('modeSwitch');
        modeSwitch.addEventListener('click', function() {
            document.body.classList.toggle('dark-mode');
            modeSwitch.classList.toggle('on');
            const text = modeSwitch.querySelector('.toggle-text');
            text.textContent = modeSwitch.classList.contains('on') ? 'sombre' : 'clair';
        });
    </script>
</body>
</html>