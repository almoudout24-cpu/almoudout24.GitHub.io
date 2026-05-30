<?php
require_once __DIR__ . '/../fonctions.php';
demarrerSession();
if (empty($_SESSION['admin_id'])) {
    header('Location: connexion.php');
    exit;
}
?>