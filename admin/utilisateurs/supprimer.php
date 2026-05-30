<?php
require_once '../auth.php';
require_once '../../config/connexion.php';

$id = (int)$_GET['id'];

// Interdire l'auto-suppression
if ($id === $_SESSION['admin_id']) {
    die('Vous ne pouvez pas supprimer votre propre compte.');
}

$sql = "SELECT id FROM administrateurs WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute([':id' => $id]);
if (!$stmt->fetch()) {
    header('Location: liste.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verifierTokenCSRF($_POST['csrf_token'] ?? '')) {
        die('Jeton CSRF invalide.');
    }
    $sql = "DELETE FROM administrateurs WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);
    header('Location: liste.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Confirmation de suppression</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background: #0A0A0A; color: #F0F0F0; display: flex; justify-content: center; align-items: center; height: 100vh; }
        .confirm { background: #111; padding: 2rem; border-radius: 20px; text-align: center; max-width: 400px; }
        button { background: #e74c3c; color: white; border: none; padding: 10px 20px; border-radius: 8px; cursor: pointer; }
        a { color: #B76EFF; margin-left: 10px; text-decoration: none; }
    </style>
</head>
<body>
    <div class="confirm">
        <h2>Supprimer cet administrateur ?</h2>
        <p>Cette action est irréversible.</p>
        <form method="POST">
            <input type="hidden" name="csrf_token" value="<?php echo genererTokenCSRF(); ?>">
            <button type="submit">Oui, supprimer</button>
            <a href="liste.php">Annuler</a>
        </form>
    </div>
</body>
</html>