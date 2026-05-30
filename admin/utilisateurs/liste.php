<?php
require_once '../auth.php';
require_once '../../config/connexion.php';

$sql = "SELECT * FROM administrateurs ORDER BY date_creation DESC";
$stmt = $pdo->query($sql);
$admins = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des administrateurs</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; background: #0A0A0A; color: #F0F0F0; padding: 20px; }
        .container { max-width: 1200px; margin: 0 auto; }
        h1 { color: #B76EFF; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #2A2A2A; }
        th { color: #B76EFF; }
        .btn { display: inline-block; padding: 6px 12px; border-radius: 6px; text-decoration: none; margin-right: 5px; }
        .btn-primary { background: #B76EFF; color: white; }
        .btn-danger { background: #e74c3c; color: white; }
        .btn-warning { background: #f39c12; color: white; }
        .ajouter { margin-bottom: 20px; display: inline-block; }
        nav a { color: #B76EFF; text-decoration: none; margin-right: 15px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Gestion des administrateurs</h1>
        <nav>
            <a href="../dashboard.php">Dashboard</a>
            <a href="../projets/liste.php">Projets</a>
            <a href="liste.php">Administrateurs</a>
            <a href="../messages/liste.php">Messages</a>
            <a href="../demandes/liste.php">Demandes</a>
            <a href="../deconnexion.php">Déconnexion</a>
        </nav>
        <a href="ajouter.php" class="btn btn-primary ajouter">+ Ajouter un administrateur</a>
        <table>
            <thead>
                <tr><th>ID</th><th>Prénom</th><th>Nom</th><th>Email</th><th>Date de création</th><th>Actions</th></tr>
            </thead>
            <tbody>
                <?php foreach ($admins as $admin): ?>
                <tr>
                    <td><?php echo $admin['id']; ?></td>
                    <td><?php echo htmlspecialchars($admin['prenom']); ?></td>
                    <td><?php echo htmlspecialchars($admin['nom']); ?></td>
                    <td><?php echo htmlspecialchars($admin['email']); ?></td>
                    <td><?php echo $admin['date_creation']; ?></td>
                    <td>
                        <a href="modifier.php?id=<?php echo $admin['id']; ?>" class="btn btn-warning"><i class="fas fa-edit"></i> Modifier</a>
                        <?php if ($admin['id'] != $_SESSION['admin_id']): ?>
                            <a href="supprimer.php?id=<?php echo $admin['id']; ?>" class="btn btn-danger" onclick="return confirm('Supprimer cet administrateur ?');"><i class="fas fa-trash"></i> Supprimer</a>
                        <?php else: ?>
                            <span class="btn btn-danger" style="background: grey; cursor: not-allowed;">Auto-suppression impossible</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>