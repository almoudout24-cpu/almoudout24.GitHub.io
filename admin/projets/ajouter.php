<?php
require_once '../auth.php';
require_once '../../config/connexion.php';

$erreur = '';
$succes = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // CSRF
    if (!verifierTokenCSRF($_POST['csrf_token'] ?? '')) {
        $erreur = 'Jeton CSRF invalide.';
    } else {
        $titre = cleanInput($_POST['titre'] ?? '');
        $description = cleanInput($_POST['description'] ?? '');
        $technologies = cleanInput($_POST['technologies'] ?? '');
        $lien = cleanInput($_POST['lien'] ?? '');
        
        // Gestion de l'image
        $image_name = null;
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $extensions_autorisees = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
            $extension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
            if (in_array($extension, $extensions_autorisees)) {
                $image_name = uniqid() . '.' . $extension;
                $destination = '../../images/projets/' . $image_name;
                move_uploaded_file($_FILES['image']['tmp_name'], $destination);
            } else {
                $erreur = 'Format d\'image non autorisé. (jpg, jpeg, png, webp, gif)';
            }
        }
        
        if (empty($erreur)) {
            $sql = "INSERT INTO projets (titre, description, technologies, image, lien) VALUES (:titre, :description, :technologies, :image, :lien)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':titre' => $titre,
                ':description' => $description,
                ':technologies' => $technologies,
                ':image' => $image_name,
                ':lien' => $lien
            ]);
            $succes = 'Projet ajouté avec succès.';
        }
        supprimerTokenCSRF();
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un projet</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; background: #0A0A0A; color: #F0F0F0; padding: 20px; }
        .container { max-width: 800px; margin: 0 auto; background: #111; padding: 2rem; border-radius: 20px; }
        label { display: block; margin: 1rem 0 0.5rem; }
        input, textarea { width: 100%; padding: 0.8rem; background: #0A0A0A; border: 1px solid #2A2A2A; border-radius: 8px; color: #F0F0F0; }
        button { background: #B76EFF; color: white; padding: 0.8rem 2rem; border: none; border-radius: 8px; cursor: pointer; margin-top: 1rem; }
        .error { color: #e74c3c; margin-bottom: 1rem; }
        .success { color: #2ecc71; margin-bottom: 1rem; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Ajouter un projet</h1>
        <?php if ($erreur): ?><div class="error"><?php echo htmlspecialchars($erreur); ?></div><?php endif; ?>
        <?php if ($succes): ?><div class="success"><?php echo htmlspecialchars($succes); ?></div><?php endif; ?>
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="csrf_token" value="<?php echo genererTokenCSRF(); ?>">
            <label>Titre *</label>
            <input type="text" name="titre" required>
            <label>Description *</label>
            <textarea name="description" rows="5" required></textarea>
            <label>Technologies (séparées par des virgules) *</label>
            <input type="text" name="technologies" placeholder="PHP,MySQL,JavaScript" required>
            <label>Image (optionnel)</label>
            <input type="file" name="image" accept="image/jpeg,image/png,image/webp,image/gif">
            <label>Lien externe (optionnel)</label>
            <input type="url" name="lien" placeholder="https://...">
            <button type="submit">Ajouter</button>
        </form>
        <p style="margin-top: 1rem;"><a href="liste.php">← Retour à la liste</a></p>
    </div>
</body>
</html>