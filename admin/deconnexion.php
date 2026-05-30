<?php
require_once '../fonctions.php';
demarrerSession();
session_destroy();
header('Location: connexion.php');
exit;