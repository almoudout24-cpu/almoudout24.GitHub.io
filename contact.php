<?php require_once 'fonctions.php'; ?>

<?php
$contact_success = false;
$contact_errors = [];
$contact_nom = $contact_email = $contact_objet = $contact_message = '';

$project_success = false;
$project_errors = [];
$project_nom = $project_email = $project_type = $project_description = '';
$project_recap = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'contact') {
    $contact_nom = nettoyer($_POST['nom'] ?? '');
    $contact_email = nettoyer($_POST['email'] ?? '');
    $contact_objet = nettoyer($_POST['objet'] ?? '');
    $contact_message = nettoyer($_POST['message'] ?? '');
    
    if (!champ_requis($contact_nom)) $contact_errors['nom'] = 'Le nom est obligatoire.';
    if (!email_valide($contact_email)) $contact_errors['email'] = 'L\'adresse email est invalide.';
    if (!champ_requis($contact_objet)) $contact_errors['objet'] = 'L\'objet est obligatoire.';
    if (!champ_requis($contact_message)) $contact_errors['message'] = 'Le message ne peut pas être vide.';
    
    if (empty($contact_errors)) {
        $contact_success = true;
        $contact_nom = $contact_email = $contact_objet = $contact_message = '';
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'project') {
    $project_nom = nettoyer($_POST['projet_nom'] ?? '');
    $project_email = nettoyer($_POST['projet_email'] ?? '');
    $project_type = nettoyer($_POST['projet_type'] ?? '');
    $project_description = nettoyer($_POST['projet_description'] ?? '');
    
    if (!champ_requis($project_nom)) $project_errors['projet_nom'] = 'Le nom est obligatoire.';
    if (!email_valide($project_email)) $project_errors['projet_email'] = 'L\'adresse email est invalide.';
    if (!champ_requis($project_description)) $project_errors['projet_description'] = 'La description du projet est obligatoire.';
    
    if (empty($project_errors)) {
        $project_success = true;
        $project_recap = [
            'nom' => $project_nom,
            'email' => $project_email,
            'type' => $project_type,
            'description' => $project_description
        ];
        $project_nom = $project_email = $project_type = $project_description = '';
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact | Almoudou Traoré</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php require 'composants/navigation.php'; ?>

    <main>
        <h2 class="fade-in">Parlons de vos projets</h2>
        <p class="section-subtitle fade-in">Une idée, un projet, une collaboration ? Je suis à votre écoute.</p>

        <div class="form-card fade-in">
            <div class="card-header"><h3><i class="fas fa-paper-plane"></i> Envoyez-moi un message</h3></div>
            <div class="card-body">
                <?php if ($contact_success): ?>
                    <div class="alert-success"><i class="fas fa-check-circle"></i> ✅ Message envoyé avec succès !</div>
                <?php endif; ?>

                <form method="POST" action="">
                    <input type="hidden" name="action" value="contact">
                    <div class="form-group">
                        <label>Nom complet</label>
                        <input type="text" name="nom" value="<?= htmlspecialchars($contact_nom) ?>">
                        <?php if (isset($contact_errors['nom'])): ?>
                            <div class="field-error"><?= $contact_errors['nom'] ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" value="<?= htmlspecialchars($contact_email) ?>">
                        <?php if (isset($contact_errors['email'])): ?>
                            <div class="field-error"><?= $contact_errors['email'] ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label>Objet</label>
                        <input type="text" name="objet" value="<?= htmlspecialchars($contact_objet) ?>">
                        <?php if (isset($contact_errors['objet'])): ?>
                            <div class="field-error"><?= $contact_errors['objet'] ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label>Message</label>
                        <textarea name="message" rows="4"><?= htmlspecialchars($contact_message) ?></textarea>
                        <?php if (isset($contact_errors['message'])): ?>
                            <div class="field-error"><?= $contact_errors['message'] ?></div>
                        <?php endif; ?>
                    </div>
                    <button type="submit" class="btn-submit">Envoyer</button>
                </form>
            </div>
        </div>

        <div class="form-card fade-in">
            <div class="card-header"><h3><i class="fas fa-project-diagram"></i> Demande de projet</h3></div>
            <div class="card-body">
                <?php if ($project_success && $project_recap): ?>
                    <div class="alert-success">
                        <i class="fas fa-check-circle"></i> ✅ Demande envoyée !<br>
                        <strong>Récapitulatif :</strong><br>
                        Nom : <?= htmlspecialchars($project_recap['nom']) ?><br>
                        Email : <?= htmlspecialchars($project_recap['email']) ?><br>
                        Type : <?= htmlspecialchars($project_recap['type']) ?><br>
                        Description : <?= htmlspecialchars($project_recap['description']) ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="">
                    <input type="hidden" name="action" value="project">
                    <div class="form-group">
                        <label>Nom / Société</label>
                        <input type="text" name="projet_nom" value="<?= htmlspecialchars($project_nom) ?>">
                        <?php if (isset($project_errors['projet_nom'])): ?>
                            <div class="field-error"><?= $project_errors['projet_nom'] ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="projet_email" value="<?= htmlspecialchars($project_email) ?>">
                        <?php if (isset($project_errors['projet_email'])): ?>
                            <div class="field-error"><?= $project_errors['projet_email'] ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label>Type de projet</label>
                        <select name="projet_type">
                            <option value="Site web" <?= $project_type === 'Site web' ? 'selected' : '' ?>>Site web</option>
                            <option value="Application web" <?= $project_type === 'Application web' ? 'selected' : '' ?>>Application web</option>
                            <option value="IoT" <?= $project_type === 'IoT' ? 'selected' : '' ?>>IoT / Embarqué</option>
                            <option value="Réseau" <?= $project_type === 'Réseau' ? 'selected' : '' ?>>Réseau / Cybersécurité</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="projet_description" rows="3"><?= htmlspecialchars($project_description) ?></textarea>
                        <?php if (isset($project_errors['projet_description'])): ?>
                            <div class="field-error"><?= $project_errors['projet_description'] ?></div>
                        <?php endif; ?>
                    </div>
                    <button type="submit" class="btn-submit">Envoyer la demande</button>
                </form>
            </div>
        </div>

        <div class="info-card fade-in">
            <div class="card-header"><h3><i class="fas fa-address-card"></i> Me contacter</h3></div>
            <div class="card-body">
                <ul class="contact-details">
                    <li><i class="fas fa-envelope"></i> <a href="mailto:almoudout24@gmail.com">almoudout24@gmail.com</a></li>
                    <li><i class="fas fa-phone-alt"></i> <a href="tel:+221789190981">+221 78-919-09-81</a></li>
                    <li><i class="fab fa-linkedin"></i> <a href="https://www.linkedin.com/in/almoudou-traor%C3%A9-b81931337" target="_blank">Almoudou Traoré</a></li>
                </ul>
            </div>
        </div>
    </main>

    <?php require 'composants/pied-de-page.php'; ?>
</body>
</html>