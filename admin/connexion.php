<?php
require_once '../fonctions.php';
require_once '../config/connexion.php';
demarrerSession();

// Si déjà connecté, rediriger vers dashboard
if (!empty($_SESSION['admin_id'])) {
    header('Location: dashboard.php');
    exit;
}

$erreur = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérification CSRF
    if (!verifierTokenCSRF($_POST['csrf_token'] ?? '')) {
        $erreur = 'Jeton de sécurité invalide.';
    } else {
        $email = cleanInput($_POST['email'] ?? '');
        $password = $_POST['mot_de_passe'] ?? '';
        
        if (empty($email) || empty($password)) {
            $erreur = 'Email et mot de passe requis.';
        } else {
            $sql = "SELECT * FROM administrateurs WHERE email = :email";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':email' => $email]);
            $admin = $stmt->fetch();
            
            if ($admin && password_verify($password, $admin['mot_de_passe'])) {
                // Connexion réussie
                session_regenerate_id(true);
                $_SESSION['admin_id'] = $admin['id'];
                $_SESSION['admin_prenom'] = $admin['prenom'];
                $_SESSION['admin_nom'] = $admin['nom'];
                header('Location: dashboard.php');
                exit;
            } else {
                $erreur = 'Email ou mot de passe incorrect.';
            }
        }
        // Supprimer le token CSRF utilisé
        supprimerTokenCSRF();
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion Administration</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            background: #0A0A0A;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .login-container {
            background: #111111;
            padding: 2rem;
            border-radius: 24px;
            border: 1px solid #2A2A2A;
            width: 100%;
            max-width: 400px;
        }
        h1 {
            color: #B76EFF;
            margin-bottom: 1.5rem;
            text-align: center;
            font-size: 1.8rem;
        }
        .form-group {
            margin-bottom: 1rem;
        }
        label {
            display: block;
            margin-bottom: 0.5rem;
            color: #F0F0F0;
        }
        input {
            width: 100%;
            padding: 0.8rem;
            background: #0A0A0A;
            border: 1px solid #2A2A2A;
            border-radius: 12px;
            color: #F0F0F0;
        }
        button {
            width: 100%;
            padding: 0.8rem;
            background: #B76EFF;
            color: white;
            border: none;
            border-radius: 12px;
            font-weight: bold;
            cursor: pointer;
        }
        button:hover { background: #9B4DCC; }
        .error {
            background: rgba(231,76,60,0.2);
            border: 1px solid #e74c3c;
            color: #e74c3c;
            padding: 0.8rem;
            border-radius: 12px;
            margin-bottom: 1rem;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Administration</h1>
        <?php if ($erreur): ?>
            <div class="error"><?php echo htmlspecialchars($erreur); ?></div>
        <?php endif; ?>
        <form method="POST" action="">
            <input type="hidden" name="csrf_token" value="<?php echo genererTokenCSRF(); ?>">
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
            </div>
            <div class="form-group">
                <label>Mot de passe</label>
                <input type="password" name="mot_de_passe" required>
            </div>
            <button type="submit">Se connecter</button>
        </form>
    </div>
</body>
</html>