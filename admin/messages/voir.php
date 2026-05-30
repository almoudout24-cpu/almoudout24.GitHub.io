<?php
require_once '../auth.php';
require_once '../../config/connexion.php';

$id = (int)$_GET['id'];

// Marquer le message comme lu
$sql = "UPDATE messages_contact SET lu = 1 WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute([':id' => $id]);

// Récupérer le message
$sql = "SELECT * FROM messages_contact WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute([':id' => $id]);
$msg = $stmt->fetch();

if (!$msg) {
    header('Location: liste.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Message de <?php echo htmlspecialchars($msg['nom']); ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; background: #0A0A0A; color: #F0F0F0; padding: 20px; }
        .container { max-width: 800px; margin: 0 auto; background: #111; padding: 2rem; border-radius: 20px; }
        h1 { color: #B76EFF; }
        .info { margin: 20px 0; }
        .message { background: #0A0A0A; padding: 1rem; border-radius: 12px; white-space: pre-wrap; }
        .btn { display: inline-block; padding: 10px 20px; background: #B76EFF; color: white; text-decoration: none; border-radius: 8px; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Message de <?php echo htmlspecialchars($msg['nom']); ?></h1>
        <div class="info">
            <p><strong>Email :</strong> <?php echo htmlspecialchars($msg['email']); ?></p>
            <p><strong>Date :</strong> <?php echo $msg['date_envoi']; ?></p>
        </div>
        <div class="message">
            <?php echo nl2br(htmlspecialchars($msg['message'])); ?>
        </div>
        <a href="liste.php" class="btn">← Retour à la liste</a>
    </div>
</body>
</html>