<?php
session_start();

if (!isset($_SESSION['donnees_formulaire'])) {
    $_SESSION['donnees_formulaire'] = array();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'])) {
    $nom = htmlspecialchars($_POST['name'] ?? '');
    $email = htmlspecialchars($_POST['email'] ?? '');
    $telephone = htmlspecialchars($_POST['phone'] ?? '');

    if (!empty($nom) && !empty($email)) {
        $_SESSION['donnees_formulaire'][] = array(
            'nom' => $nom,
            'email' => $email,
            'telephone' => $telephone,
            'date' => date('d/m/Y H:i:s')
        );
    } else {
        $message = "Erreur: Le nom et l'email sont obligatoires";
        $message_class = "error";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Mon Compte - Agence Omra</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link rel="stylesheet" href="../css/compte.css">
        <link rel="stylesheet" href="../css/njareb.css">
        <link rel="stylesheet" href="../css/id.css">
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
                <li><a href="acceuil.html"><i class="fas fa-home"></i> Accueil</a></li>
                <li><a href="html.html"><i class="fas fa-globe-americas"></i> Destinations</a></li>
                <li><a href="serv.html"><i class="fas fa-suitcase-rolling"></i> Packages</a></li>
                <li><a href="service omra.html"><i class="fas fa-images"></i> Service Omra</a></li>
                <li><a href="#"><i class="fas fa-envelope-open-text"></i> Contact</a></li>
                <li><a href="#"><i class="fas fa-envelope-open-text"></i> About Us</a></li>
                <li><a href="tableau.php"><i class="fas fa-envelope-open-text"></i> Users</a></li>
                <li><a href="paiement.php"><i class="fas fa-envelope-open-text"></i> cards</a></li>
            </ul>
        </nav>
        <div class="overlay" id="overlay"></div>
        <header class="account-header">
            <h1><i class="fas fa-user-circle"></i> Mon Compte</h1>
        </header>
        <nav class="account-nav">
            <ul>
                <li class="active" data-tab="profile"><i class="fas fa-user"></i> Profil</li>
                <div id="main-content">
                    <ul>
                        <li data-tab="bookings" id="bookings-tab"><i class="fas fa-suitcase"></i> Mes Réservations</li>
                    </ul>
                    <div id="content-area"></div>
                </div>
                <li data-tab="payments"><i class="fas fa-credit-card"></i> Méthodes de Paiement</li>
                <li data-tab="settings"><i class="fas fa-cog"></i> Paramètres</li>
            </ul>
        </nav>
        <main class="account-container">
            <section class="tab-content active" id="profile">
                <?php if (!empty($message)): ?>
                    <div class="message <?php echo $message_class; ?>">
                        <?php echo $message; ?>
                        <a href="tableau.php">Voir le tableau</a>
                    </div>
                <?php endif; ?>
                <h2>Informations Personnelles</h2>
                <form id="profile-form" method="POST" action="compte.php">
                    <div class="form-group">
                        <label for="name">Nom complet</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Téléphone</label>
                        <input type="tel" id="phone" name="phone">
                    </div>
                    <button type="submit" id="profile-form">Enregistrer</button>
                    <br>
                    <br>
                    <div class="notification">
                        <div class="notification-message"></div>
                    </div>
                </form>
            </section>
            <div class="container">
        <button type="button" id="get-btn" class="ai-button">
            <div class="btn-content">
                <i class="fas fa-id-card btn-icon"></i>
                <span>Get Your ID</span>
            </div>
        </button>
        
        <div class="questionnaire" id="questionnaire">
            <div class="question">Avez-vous fait l'enregistrement ?</div>
            <div class="options">
                <label class="option">
                    <input type="radio" name="registration" value="yes">
                    <span>Oui, j'ai complété l'enregistrement</span>
                </label>
                <label class="option">
                    <input type="radio" name="registration" value="no" checked>
                    <span>Non, pas encore</span>
                </label>
            </div>
            <button type="button" id="submit-btn" class="ai-button">
                <div class="btn-content">
                    <i class="fas fa-check-circle btn-icon"></i>
                    <span>Valider</span>
                </div>
            </button>
        </div>
    </div>

    <div class="notification" id="notification">
        <div class="notification-icon">
            <i class="fas fa-check-circle" id="notif-icon"></i>
        </div>
        <div class="notification-content">
            <div class="notification-title" id="notif-title">Enregistrement réussi</div>
            <div class="notification-message" id="notif-message">
                Votre identifiant unique: 
                <div class="id-display" id="id-display"></div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <div class="page-container">
        <div class="btn-ia-wrapper">
            <div class="btn-glow-effect"></div>
            <button type="button" id="btnCodeRedirect">
                <div class="btn-content-ia">
                    <i class="fas fa-code btn-icon-ia"></i>
                    <span>Get Code</span>
                </div>
            </button>
        </div>
    </div>
            <section class="tab-content" id="data-table">
                <h2>Tableau des Données Enregistrées</h2>
                <div id="table-container">
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
                </div>
                <div class="table-actions">
                    <a href="compte.php"><button>Retour </button></a>
                    <a href="tableau.php?action=vider"><button class="danger">Vider le tableau</button></a>
                </div>
            </section>
            <h3>Ajouter une méthode de paiement</h3>
            <div class="add-payment-method">
                <button id="add-card-btn" class="payment-method-btn"><i class="far fa-credit-card"></i> Carte Bancaire</button>
                <button id="add-paypal-btn" class="payment-method-btn"><i class="fab fa-paypal"></i> PayPal</button>
            </div>
            <div id="card-form-container">
    <form id="card-form" method="POST" action="paiement.php">
        <h2><i class="fas fa-credit-card"></i> Informations de Carte</h2>
        <div class="form-group">
            <label for="card-name">Nom sur la carte</label>
            <input type="text" id="card-name" name="card_name" placeholder="John Doe" required>
        </div>
        <div class="form-group">
            <label for="card-number">Numéro de carte</label>
            <div class="input-with-icon">
                <i class="far fa-credit-card"></i>
                <input type="text" id="card-number" name="card_number" placeholder="1234 5678 9012 3456" required maxlength="19">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label for="card-expiry">Date d'expiration</label>
                <input type="text" id="card-expiry" name="card_expiry" placeholder="MM/AA" required>
            </div>
            <div class="form-group">
                <label for="card-cvv">CVV</label>
                <div class="input-with-icon">
                    <i class="fas fa-lock"></i>
                    <input type="text" id="card-cvv" name="card_cvv" placeholder="123" required maxlength="4">
                </div>
            </div>
        </div>
        <button type="submit" class="submit-btn" id="submit-payment">
            <i class="fas fa-check"></i> Terminé
        </button>
    </form>
</div>

            <div id="success-message1" class="hidden"></div>
            
        </section>
        <section class="tab-content" id="settings">
            <h2>Paramètres du Compte</h2>
            <div class="settings-options">
                <div class="option">
                    <h3>Changer le mot de passe</h3>
                    <form id="password-form">
                        <div class="form-group">
                            <label for="current-password">Mot de passe actuel</label>
                            <input type="password" id="current-password" required>
                        </div>
                        <div class="form-group">
                            <label for="new-password">Nouveau mot de passe</label>
                            <input type="password" id="new-password" required>
                        </div>
                        <div class="form-group">
                            <label for="confirm-password">Confirmer le mot de passe</label>
                            <input type="password" id="confirm-password" required>
                        </div>
                        <button type="submit">Mettre à jour</button>
                    </form>
                </div>
                <div class="option danger">
                <h3>Supprimer le compte</h3>
                <p>Cette action est irréversible. Toutes vos données seront supprimées.</p>
                <button id="delete-account-btn">Supprimer mon compte</button>
            </div>
            <div id="delete-confirm-modal" class="confirm-modal">
                <div class="confirm-modal-content">
                    <div class="confirm-modal-header">
                        <i class="fas fa-exclamation-triangle"></i>
                        <h3>Confirmer la suppression</h3>
                    </div>
                    <div class="confirm-modal-body">
                        <p>Êtes-vous sûr de vouloir supprimer définitivement votre compte ?</p>
                        <p class="warning-text"><i class="fas fa-exclamation-circle"></i> Cette action supprimera la dernière entrée du tableau et ne peut être annulée.</p>
                    </div>
                    <div class="confirm-modal-footer">
                        <button id="confirm-delete-btn" class="danger-btn">Oui, supprimer</button>
                        <button id="cancel-delete-btn">Non, annuler</button>
                    </div>
                </div>
            </div>
            </div>
        </section>
        </main>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
        <script src="../js/compte .js"></script>
        <script src="../js/njareb.js"></script>
    </body>
</html>