<?php
// admin/auth.php
require_once '../fonctions.php';
demarrerSession();
if (empty($_SESSION['admin_id'])) {
    header('Location: connexion.php');
    exit;
}
?>