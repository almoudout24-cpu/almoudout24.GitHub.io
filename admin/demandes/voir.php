<?php
require_once '../auth.php';
require_once '../../config/connexion.php';

$id = (int)$_GET['id'];

// Marquer la demande comme lue
$sql = "UPDATE demandes_projet SET lu = 1 WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute([':id' => $id]);

// Récupérer la demande
$sql = "SELECT * FROM demandes_projet WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute([':id' => $id]);
$d = $stmt->fetch();

if (!$d) {
    header('Location: liste.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Demande de <?php echo htmlspecialchars($d['nom']); ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; background: #0A0A0A; color: #F0F0F0; padding: 20px; }
        .container { max-width: 800px; margin: 0 auto; background: #111; padding: 2rem; border-radius: 20px; }
        h1 { color: #B76EFF; }
        .info { margin: 20px 0; }
        .description { background: #0A0A0A; padding: 1rem; border-radius: 12px; white-space: pre-wrap; }
        .btn { display: inline-block; padding: 10px 20px; background: #B76EFF; color: white; text-decoration: none; border-radius: 8px; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Demande de projet de <?php echo htmlspecialchars($d['nom']); ?></h1>
        <div class="info">
            <p><strong>Email :</strong> <?php echo htmlspecialchars($d['email']); ?></p>
            <p><strong>Type de projet :</strong> <?php echo htmlspecialchars($d['type_projet']); ?></p>
            <p><strong>Budget :</strong> <?php echo htmlspecialchars($d['budget'] ?? 'Non précisé'); ?></p>
            <p><strong>Date :</strong> <?php echo $d['date_demande']; ?></p>
        </div>
        <h3>Description :</h3>
        <div class="description">
            <?php echo nl2br(htmlspecialchars($d['description'])); ?>
        </div>
        <a href="liste.php" class="btn">← Retour à la liste</a>
    </div>
</body>
</html>