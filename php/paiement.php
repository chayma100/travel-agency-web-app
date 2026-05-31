<?php
session_start();

if (!isset($_SESSION['paiements'])) {
    $_SESSION['paiements'] = array();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nomCarte = htmlspecialchars($_POST['card_name']);
    $numeroCarte = htmlspecialchars($_POST['card_number']);
    $expiration = htmlspecialchars($_POST['expiry']);
    $cvv = htmlspecialchars($_POST['cvv']);

    $nouveauPaiement = array(
        'nom' => $nomCarte,
        'numero' => $numeroCarte,
        'expiration' => $expiration,
        'cvv' => $cvv,
        'date' => date('d/m/Y H:i:s')
    );

    $_SESSION['paiements'][] = $nouveauPaiement;

    header('Location: ../php/paiement.php?success=1');
    exit;
}

if (isset($_GET['action']) && $_GET['action'] === 'supprimer_dernier') {
    array_pop($_SESSION['paiements']);
    header('Location: ../php/paiement.php');
    exit;
}

if (isset($_GET['action']) && $_GET['action'] === 'vider') {
    $_SESSION['paiements'] = [];
    header('Location: ../php/paiement.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tableau des Paiements</title>
    <link rel="stylesheet" href="../css/paiement.css">
</head>
<style>
body { font-family: Arial; padding: 20px; max-width: 800px; margin: auto; }
table { width: 100%; border-collapse: collapse; margin-top: 20px; }
th, td { padding: 10px; border: 1px solid #ccc; }
th { background-color: #f0f0f0; }
.success { color: green; margin-top: 10px; }
.actions a {
    margin-right: 10px;
    text-decoration: none;
    color: white;
    background-color: #007bff;
    padding: 6px 12px;
    border-radius: 5px;
}
.actions a.danger { background-color: #dc3545; }
.actions-modern {
    display: flex;
    gap: 16px;
    margin-top: 30px;
    flex-wrap: wrap;
    justify-content: center;
}
.btn-modern {
    padding: 12px 24px;
    background: linear-gradient(135deg, #a8f0c6, #e3e3e3);
    color: #1a1a1a;
    font-weight: 600;
    text-decoration: none;
    border: none;
    border-radius: 16px;
    box-shadow: 0 6px 12px rgba(168, 240, 198, 0.3);
    transition: all 0.35s ease;
    backdrop-filter: blur(3px);
    font-size: 15px;
    letter-spacing: 0.5px;
}
.btn-modern:hover {
    background: linear-gradient(135deg, #baf7d4, #ffffff);
    transform: scale(1.05);
    box-shadow: 0 8px 16px rgba(168, 240, 198, 0.5);
}
.btn-modern.danger {
    background: linear-gradient(135deg, #f7c2c2, #eeeeee);
    box-shadow: 0 6px 12px rgba(255, 145, 145, 0.3);
    color: #5a0000;
}
.btn-modern.danger:hover {
    background: linear-gradient(135deg, #fcdcdc, #ffffff);
    box-shadow: 0 8px 16px rgba(255, 145, 145, 0.5);
}
</style>
<body>
    <h1>Enregistrement des Paiements</h1>

    <?php if (isset($_GET['success'])): ?>
        <p class="success">✅ Paiement enregistré avec succès.</p>
    <?php endif; ?>

    <?php if (!empty($_SESSION['paiements'])): ?>
        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Numéro de carte</th>
                    <th>Expiration</th>
                    <th>CVV</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION['paiements'] as $p): ?>
                    <tr>
                        <td><?= htmlspecialchars($p['nom']) ?></td>
                        <td><?= htmlspecialchars($p['numero']) ?></td>
                        <td><?= htmlspecialchars($p['expiration']) ?></td>
                        <td><?= htmlspecialchars($p['cvv']) ?></td>
                        <td><?= htmlspecialchars($p['date']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Aucun paiement enregistré.</p>
    <?php endif; ?>

    <div class="actions-modern">
        <a href="../php/compte.php" class="btn-modern">⬅ Retour</a>
        <a href="../php/paiement.php?action=supprimer_dernier" class="btn-modern danger">🗑 Supprimer le dernier</a>
        <a href="../php/paiement.php?action=vider" class="btn-modern danger">🗑 Vider tous les paiements</a>
    </div>
</body>
</html>