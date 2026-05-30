<?php
require_once 'auth.php';
require_once '../config/connexion.php';

// Stats
$stats = [];
$sql = "SELECT COUNT(*) as total FROM projets";
$stmt = $pdo->query($sql);
$stats['projets'] = $stmt->fetchColumn();

$sql = "SELECT COUNT(*) as total FROM messages_contact WHERE lu = 0";
$stmt = $pdo->query($sql);
$stats['messages_non_lus'] = $stmt->fetchColumn();

$sql = "SELECT COUNT(*) as total FROM demandes_projet WHERE lu = 0";
$stmt = $pdo->query($sql);
$stats['demandes_non_lues'] = $stmt->fetchColumn();

// 5 dernières visites
$sql = "SELECT * FROM visites ORDER BY date_visite DESC LIMIT 5";
$stmt = $pdo->query($sql);
$visites = $stmt->fetchAll();

// 5 dernières demandes de projet
$sql = "SELECT * FROM demandes_projet ORDER BY date_demande DESC LIMIT 5";
$stmt = $pdo->query($sql);
$dernieres_demandes = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Administration</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #0A0A0A;
            color: #F0F0F0;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        h1 {
            color: #B76EFF;
        }
        .stats {
            display: flex;
            gap: 20px;
            margin: 20px 0;
            flex-wrap: wrap;
        }
        .card {
            background: #111111;
            border: 1px solid #2A2A2A;
            border-radius: 20px;
            padding: 1.5rem;
            flex: 1;
            text-align: center;
        }
        .card h3 {
            font-size: 2rem;
            color: #B76EFF;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #2A2A2A;
        }
        th {
            color: #B76EFF;
        }
        .btn {
            display: inline-block;
            padding: 0.5rem 1rem;
            background: #B76EFF;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            margin-right: 10px;
        }
        .btn-danger {
            background: #e74c3c;
        }
        nav {
            margin-bottom: 20px;
        }
        nav a {
            color: #B76EFF;
            text-decoration: none;
            margin-right: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Bonjour <?php echo htmlspecialchars($_SESSION['admin_prenom']); ?> 👋</h1>
        <nav>
            <a href="dashboard.php">Dashboard</a>
            <a href="projets/liste.php">Projets</a>
            <a href="utilisateurs/liste.php">Administrateurs</a>
            <a href="messages/liste.php">Messages</a>
            <a href="demandes/liste.php">Demandes</a>
            <a href="deconnexion.php">Déconnexion</a>
        </nav>

        <div class="stats">
            <div class="card">
                <i class="fas fa-folder-open"></i>
                <h3><?php echo $stats['projets']; ?></h3>
                <p>Projets</p>
            </div>
            <div class="card">
                <i class="fas fa-envelope"></i>
                <h3><?php echo $stats['messages_non_lus']; ?></h3>
                <p>Messages non lus</p>
            </div>
            <div class="card">
                <i class="fas fa-project-diagram"></i>
                <h3><?php echo $stats['demandes_non_lues']; ?></h3>
                <p>Demandes non lues</p>
            </div>
        </div>

        <h2>Dernières visites</h2>
        <table>
            <tr><th>IP</th><th>Page</th><th>Date</th></tr>
            <?php foreach ($visites as $v): ?>
            <tr>
                <td><?php echo htmlspecialchars($v['adresse_ip']); ?></td>
                <td><?php echo htmlspecialchars($v['page']); ?></td>
                <td><?php echo htmlspecialchars($v['date_visite']); ?></td>
            </tr>
            <?php endforeach; ?>
        </table>

        <h2>Dernières demandes de projet</h2>
        <table>
            <tr><th>Nom</th><th>Email</th><th>Type</th><th>Date</th></tr>
            <?php foreach ($dernieres_demandes as $d): ?>
            <tr>
                <td><?php echo htmlspecialchars($d['nom']); ?></td>
                <td><?php echo htmlspecialchars($d['email']); ?></td>
                <td><?php echo htmlspecialchars($d['type_projet']); ?></td>
                <td><?php echo htmlspecialchars($d['date_demande']); ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>