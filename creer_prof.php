<?php
require_once 'config/connexion.php';

$email = 'prof@example.com';
$password = 'Projet2025!';
$hash = password_hash($password, PASSWORD_BCRYPT);

$sql = "INSERT INTO administrateurs (prenom, nom, email, mot_de_passe) VALUES ('Cherif', 'Diouf', :email, :hash)";
$stmt = $pdo->prepare($sql);
$stmt->execute([':email' => $email, ':hash' => $hash]);

echo "Compte professeur créé avec succès !<br>";
echo "Email : " . $email . "<br>";
echo "Mot de passe : " . $password . "<br>";
echo "Page de connexion : <a href='admin/connexion.php'>admin/connexion.php</a>";
?>