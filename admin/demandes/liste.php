<?php
require_once '../auth.php';
require_once '../../config/connexion.php';

$sql = "SELECT * FROM demandes_projet ORDER BY date_demande DESC";
$stmt = $pdo->query($sql);
$demandes = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Demandes de projet</title>
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
        <h1>Demandes de projet</h1>
        <nav>
            <a href="../dashboard.php">Dashboard</a>
            <a href="../projets/liste.php">Projets</a>
            <a href="../utilisateurs/liste.php">Administrateurs</a>
            <a href="../messages/liste.php">Messages</a>
            <a href="liste.php">Demandes</a>
            <a href="../deconnexion.php">Déconnexion</a>
        </nav>
        <table>
            <thead>
                <tr><th>ID</th><th>Nom</th><th>Email</th><th>Type</th><th>Budget</th><th>Date</th><th>Statut</th><th>Action</th></tr>
            </thead>
            <tbody>
                <?php foreach ($demandes as $d): ?>
                <tr class="<?php echo $d['lu'] ? '' : 'non-lu'; ?>">
                    <td><?php echo $d['id']; ?></td>
                    <td><?php echo htmlspecialchars($d['nom']); ?></td>
                    <td><?php echo htmlspecialchars($d['email']); ?></td>
                    <td><?php echo htmlspecialchars($d['type_projet']); ?></td>
                    <td><?php echo htmlspecialchars($d['budget'] ?? 'Non précisé'); ?></td>
                    <td><?php echo $d['date_demande']; ?></td>
                    <td><?php echo $d['lu'] ? 'Lu' : 'Non lu'; ?></td>
                    <td><a href="voir.php?id=<?php echo $d['id']; ?>" class="btn btn-primary">Voir</a></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>