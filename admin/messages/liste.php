<?php
require_once '../auth.php';
require_once '../../config/connexion.php';

// Récupérer tous les messages triés par date décroissante
$sql = "SELECT * FROM messages_contact ORDER BY date_envoi DESC";
$stmt = $pdo->query($sql);
$messages = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Messages de contact</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; background: #0A0A0A; color: #F0F0F0; padding: 20px; }
        .container { max-width: 1200px; margin: 0 auto; }
        h1 { color: #B76EFF; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #2A2A2A; }
        th { color: #B76EFF; }
        .non-lu { font-weight: bold; background: rgba(183, 110, 255, 0.1); }
        .btn { display: inline-block; padding: 6px 12px; border-radius: 6px; text-decoration: none; }
        .btn-primary { background: #B76EFF; color: white; }
        nav a { color: #B76EFF; text-decoration: none; margin-right: 15px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Messages de contact</h1>
        <nav>
            <a href="../dashboard.php">Dashboard</a>
            <a href="../projets/liste.php">Projets</a>
            <a href="../utilisateurs/liste.php">Administrateurs</a>
            <a href="liste.php">Messages</a>
            <a href="../demandes/liste.php">Demandes</a>
            <a href="../deconnexion.php">Déconnexion</a>
        </nav>
        <table>
            <thead>
                <tr><th>ID</th><th>Nom</th><th>Email</th><th>Message (extrait)</th><th>Date</th><th>Statut</th><th>Action</th></tr>
            </thead>
            <tbody>
                <?php foreach ($messages as $msg): ?>
                <tr class="<?php echo $msg['lu'] ? '' : 'non-lu'; ?>">
                    <td><?php echo $msg['id']; ?></td>
                    <td><?php echo htmlspecialchars($msg['nom']); ?></td>
                    <td><?php echo htmlspecialchars($msg['email']); ?></td>
                    <td><?php echo htmlspecialchars(substr($msg['message'], 0, 80)); ?>...</td>
                    <td><?php echo $msg['date_envoi']; ?></td>
                    <td><?php echo $msg['lu'] ? 'Lu' : 'Non lu'; ?></td>
                    <td><a href="voir.php?id=<?php echo $msg['id']; ?>" class="btn btn-primary">Voir</a></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>