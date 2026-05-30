<?php
require_once 'config/connexion.php';

$email = 'traorealmoudouphp@gmail.com';
$password = 'Passer1234';
$hash = password_hash($password, PASSWORD_BCRYPT);

$sql = "INSERT INTO administrateurs (prenom, nom, email, mot_de_passe) VALUES (:prenom, :nom, :email, :hash)";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    ':prenom' => 'Cherif',
    ':nom' => 'Diouf',
    ':email' => $email,
    ':hash' => $hash
]);

echo "Compte professeur créé avec succès !<br>";
echo "Email : " . $email . "<br>";
echo "Mot de passe : " . $password . "<br>";
?>