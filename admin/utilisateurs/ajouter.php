<?php
require_once '../auth.php';
require_once '../../config/connexion.php';

$erreur = '';
$succes = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verifierTokenCSRF($_POST['csrf_token'] ?? '')) {
        $erreur = 'Jeton CSRF invalide.';
    } else {
        $prenom = cleanInput($_POST['prenom'] ?? '');
        $nom = cleanInput($_POST['nom'] ?? '');
        $email = cleanInput($_POST['email'] ?? '');
        $mot_de_passe = $_POST['mot_de_passe'] ?? '';

        if (empty($prenom) || empty($nom) || empty($email) || empty($mot_de_passe)) {
            $erreur = 'Tous les champs sont obligatoires.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $erreur = 'Email invalide.';
        } else {
            // Vérifier si l'email existe déjà
            $sql = "SELECT id FROM administrateurs WHERE email = :email";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':email' => $email]);
            if ($stmt->fetch()) {
                $erreur = 'Cet email est déjà utilisé.';
            } else {
                $hash = password_hash($mot_de_passe, PASSWORD_BCRYPT);
                $sql = "INSERT INTO administrateurs (prenom, nom, email, mot_de_passe) VALUES (:prenom, :nom, :email, :hash)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    ':prenom' => $prenom,
                    ':nom' => $nom,
                    ':email' => $email,
                    ':hash' => $hash
                ]);
                $succes = 'Administrateur ajouté avec succès.';
            }
        }
        supprimerTokenCSRF();
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un administrateur</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; background: #0A0A0A; color: #F0F0F0; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background: #111; padding: 2rem; border-radius: 20px; }
        label { display: block; margin: 1rem 0 0.5rem; }
        input { width: 100%; padding: 0.8rem; background: #0A0A0A; border: 1px solid #2A2A2A; border-radius: 8px; color: #F0F0F0; }
        button { background: #B76EFF; color: white; padding: 0.8rem 2rem; border: none; border-radius: 8px; cursor: pointer; margin-top: 1rem; }
        .error { color: #e74c3c; }
        .success { color: #2ecc71; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Ajouter un administrateur</h1>
        <?php if ($erreur): ?><div class="error"><?php echo htmlspecialchars($erreur); ?></div><?php endif; ?>
        <?php if ($succes): ?><div class="success"><?php echo htmlspecialchars($succes); ?></div><?php endif; ?>
        <form method="POST">
            <input type="hidden" name="csrf_token" value="<?php echo genererTokenCSRF(); ?>">
            <label>Prénom *</label>
            <input type="text" name="prenom" required>
            <label>Nom *</label>
            <input type="text" name="nom" required>
            <label>Email *</label>
            <input type="email" name="email" required>
            <label>Mot de passe *</label>
            <input type="password" name="mot_de_passe" required>
            <button type="submit">Ajouter</button>
        </form>
        <p style="margin-top: 1rem;"><a href="liste.php">← Retour à la liste</a></p>
    </div>
</body>
</html>