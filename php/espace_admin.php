<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "agence_voyage";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['service-name']) && isset($_FILES['service-image'])) {
    $serviceName = $_POST['service-name'];
    $serviceDescription = $_POST['service-description'];
    $imageName = $_FILES['service-image']['name'];
    $imageTmpName = $_FILES['service-image']['tmp_name'];
    $imagePath = '../uploads/' . basename($imageName);
    $imageExtension = pathinfo($imageName, PATHINFO_EXTENSION);
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

    if (!in_array(strtolower($imageExtension), $allowedExtensions)) {
        echo "Format d'image non supporté.";
        exit;
    }

    move_uploaded_file($imageTmpName, $imagePath);

    $stmt = $conn->prepare("INSERT INTO services (nom, description, image) VALUES (?, ?, ?)");
    $stmt->execute([$serviceName, $serviceDescription, $imagePath]);
    header("Location: espace_admin.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['offre-title']) && isset($_FILES['offre-image']) && isset($_POST['offre-price'])) {
    $offreTitle = $_POST['offre-title'];
    $offreDescription = $_POST['offre-description'];
    $offrePrice = $_POST['offre-price'];
    $imageName = $_FILES['offre-image']['name'];
    $imageTmpName = $_FILES['offre-image']['tmp_name'];
    $imagePath = '../uploads/' . basename($imageName);
    $imageExtension = pathinfo($imageName, PATHINFO_EXTENSION);
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

    if (!in_array(strtolower($imageExtension), $allowedExtensions)) {
        echo "Format d'image non supporté.";
        exit;
    }

    move_uploaded_file($imageTmpName, $imagePath);

    $stmt = $conn->prepare("INSERT INTO offres (titre, description, prix, image) VALUES (?, ?, ?, ?)");
    $stmt->execute([$offreTitle, $offreDescription, $offrePrice, $imagePath]);
    header("Location: espace_admin.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete-service'])) {
    $serviceId = intval($_POST['service-id']);
    $stmt = $conn->prepare("DELETE FROM services WHERE id = ?");
    $stmt->execute([$serviceId]);
    echo "<script>alert('Service supprimé avec succès.'); window.location.href='espace_admin.php';</script>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete-offre'])) {
    $offreId = intval($_POST['offre-id']);
    $stmt = $conn->prepare("DELETE FROM offres WHERE id = ?");
    $stmt->execute([$offreId]);
    echo "<script>alert('Offre supprimée avec succès.'); window.location.href='espace_admin.php';</script>";
    exit;
}

$servicesStmt = $conn->query("SELECT * FROM services");
$offresStmt = $conn->query("SELECT * FROM offres");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Espace Admin</title>
    <link rel="stylesheet" href="../css/espace_admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="mainbox">
        <input type="checkbox" id="check">
        <label for="check" class="btn_1"><i class="fas fa-bars"></i></label>

        <div class="sidebarmenu">
            <div class="logo"><a href="#">Admin Panel</a></div>
            <label for="check" class="btn_2"><i class="fas fa-times"></i></label>
            <ul class="lista">
                <li><a href="index.php"><i class="fas fa-home"></i>Accueil</a></li>
                <li><a href="serv.php"><i class="fas fa-concierge-bell"></i>Services</a></li>
                <li><a href="../pages/maps.html"><i class="fas fa-concierge-bell"></i>nos locaux</a></li>
                <li><a href="offre.php"><i class="fas fa-tags"></i>Offres</a></li>
                <li><a href="liste_services.php"><i class="fas fa-concierge-bell"></i>Liste des Services</a></li>
                <li><a href="liste_offres.php"><i class="fas fa-tags"></i>Liste des Offres</a></li>
                <li><a href="liste_utilisateurs.php"><i class="fas fa-users"></i>Utilisateurs</a></li>
                <li><a href="messages.php"><i class="fas fa-envelope"></i>Messages</a></li>
                <li><a href="contact.php"><i class="fas fa-phone-volume"></i>Contact</a></li>
            </ul>
        </div>
    </div>

    <div class="content">
        <h1>Bienvenue dans l'espace admin</h1>

        <section>
            <h2>Ajouter un Service</h2>
            <form method="POST" enctype="multipart/form-data">
                <input type="text" name="service-name" placeholder="Nom du service" required>
                <textarea name="service-description" placeholder="Description" required></textarea>
                <input type="file" name="service-image" accept="image/*" required>
                <button type="submit">Ajouter</button>
            </form>
        </section>

        <section>
            <h2>Ajouter une Offre</h2>
            <form method="POST" enctype="multipart/form-data">
                <input type="text" name="offre-title" placeholder="Titre de l'offre" required>
                <textarea name="offre-description" placeholder="Description" required></textarea>
                <input type="number" name="offre-price" placeholder="Prix de l'offre" required>
                <input type="file" name="offre-image" accept="image/*" required>
                <button type="submit">Ajouter</button>
            </form>
        </section>

        <section id="supprimer-service">
            <h2>Supprimer un Service</h2>
            <form method="POST">
                <input type="number" name="service-id" placeholder="ID du service" required>
                <button type="submit" name="delete-service" onclick="return confirm('Voulez-vous vraiment supprimer ce service ?')">Supprimer</button>
            </form>
        </section>

        <section id="supprimer-offre">
            <h2>Supprimer une Offre</h2>
            <form method="POST">
                <input type="number" name="offre-id" placeholder="ID de l'offre" required>
                <button type="submit" name="delete-offre" onclick="return confirm('Voulez-vous vraiment supprimer cette offre ?')">Supprimer</button>
            </form>
        </section>
    </div>
</body>
</html>

<?php $conn = null; ?>