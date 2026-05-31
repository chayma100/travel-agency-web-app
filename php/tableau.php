<?php
session_start();

if (!isset($_SESSION['donnees_formulaire'])) {
    $_SESSION['donnees_formulaire'] = array();
}

if (isset($_GET['action']) && $_GET['action'] === 'vider') {
    $_SESSION['donnees_formulaire'] = array();
    header('Location: tableau.php');
    exit;
}
if (isset($_GET['action']) && $_GET['action'] == 'delete_last') {
    if (!empty($_SESSION['donnees_formulaire'])) {
        array_pop($_SESSION['donnees_formulaire']);
        header('Content-Type: application/json');
        echo json_encode(['success' => true]);
        exit;
    } else {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'Aucune donnée à supprimer']);
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau des données</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/compte.css">
    <link rel="stylesheet" href="../css/tableau.css">
</head>
<body>
    <header class="account-header">
        <h1><i class="fas fa-user-circle"></i> Tableau des données</h1>
    </header>
    
    <?php if (empty($_SESSION['donnees_formulaire'])): ?>
        <p>Aucune donnée enregistrée pour le moment.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION['donnees_formulaire'] as $donnee): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($donnee['nom']); ?></td>
                        <td><?php echo htmlspecialchars($donnee['email']); ?></td>
                        <td><?php echo htmlspecialchars($donnee['telephone']); ?></td>
                        <td><?php echo htmlspecialchars($donnee['date']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
    
    <div class="actions-container">
    <div class="buttons-group">
        <a href="compte.php" class="btn btn-primary">
            <i class="fas fa-arrow-left"></i> Retour 
        </a>
        <a href="tableau.php?action=vider" class="btn btn-danger">
            <i class="fas fa-trash-alt"></i> Vider le tableau
        </a>
    </div>
</div>
</body>
</html>