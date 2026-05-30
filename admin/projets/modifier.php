<?php
require_once '../auth.php';
require_once '../../config/connexion.php';

$id = (int)$_GET['id'];
$sql = "SELECT * FROM projets WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute([':id' => $id]);
$projet = $stmt->fetch();

if (!$projet) {
    header('Location: liste.php');
    exit;
}

$erreur = '';
$succes = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verifierTokenCSRF($_POST['csrf_token'] ?? '')) {
        $erreur = 'Jeton CSRF invalide.';
    } else {
        $titre = cleanInput($_POST['titre'] ?? '');
        $description = cleanInput($_POST['description'] ?? '');
        $technologies = cleanInput($_POST['technologies'] ?? '');
        $lien = cleanInput($_POST['lien'] ?? '');
        $image_actuelle = $projet['image'];
        
        // Gestion de l'image : si nouvelle image, remplacer
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $extensions_autorisees = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
            $extension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
            if (in_array($extension, $extensions_autorisees)) {
                $image_nom = uniqid() . '.' . $extension;
                $destination = '../../images/projets/' . $image_nom;
                move_uploaded_file($_FILES['image']['tmp_name'], $destination);
                // Supprimer l'ancienne image si elle existe
                if ($image_actuelle && file_exists('../../images/projets/' . $image_actuelle)) {
                    unlink('../../images/projets/' . $image_actuelle);
                }
                $image_actuelle = $image_nom;
            } else {
                $erreur = 'Format d\'image non autorisé.';
            }
        }
        
        if (empty($erreur)) {
            $sql = "UPDATE projets SET titre = :titre, description = :description, technologies = :technologies, image = :image, lien = :lien WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':titre' => $titre,
                ':description' => $description,
                ':technologies' => $technologies,
                ':image' => $image_actuelle,
                ':lien' => $lien,
                ':id' => $id
            ]);
            $succes = 'Projet modifié avec succès.';
            // Recharger les données du projet
            $projet = array_merge($projet, [
                'titre' => $titre,
                'description' => $description,
                'technologies' => $technologies,
                'image' => $image_actuelle,
                'lien' => $lien
            ]);
        }
        supprimerTokenCSRF();
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier le projet</title>
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
        img { max-width: 100px; margin-top: 10px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Modifier le projet</h1>
        <?php if ($erreur): ?><div class="error"><?php echo htmlspecialchars($erreur); ?></div><?php endif; ?>
        <?php if ($succes): ?><div class="success"><?php echo htmlspecialchars($succes); ?></div><?php endif; ?>
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="csrf_token" value="<?php echo genererTokenCSRF(); ?>">
            <label>Titre *</label>
            <input type="text" name="titre" value="<?php echo htmlspecialchars($projet['titre']); ?>" required>
            <label>Description *</label>
            <textarea name="description" rows="5" required><?php echo htmlspecialchars($projet['description']); ?></textarea>
            <label>Technologies (séparées par des virgules) *</label>
            <input type="text" name="technologies" value="<?php echo htmlspecialchars($projet['technologies']); ?>" required>
            <label>Image actuelle</label>
            <?php if ($projet['image'] && file_exists('../../images/projets/' . $projet['image'])): ?>
                <img src="../../images/projets/<?php echo $projet['image']; ?>" alt="Image actuelle">
            <?php else: ?>
                <p>Aucune image</p>
            <?php endif; ?>
            <label>Nouvelle image (laisser vide pour conserver l'actuelle)</label>
            <input type="file" name="image" accept="image/jpeg,image/png,image/webp,image/gif">
            <label>Lien externe (optionnel)</label>
            <input type="url" name="lien" value="<?php echo htmlspecialchars($projet['lien']); ?>">
            <button type="submit">Enregistrer</button>
        </form>
        <p style="margin-top: 1rem;"><a href="liste.php">← Retour à la liste</a></p>
    </div>
</body>
</html>