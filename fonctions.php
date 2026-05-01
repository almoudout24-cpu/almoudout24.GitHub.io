<?php
/**
 * Fichier de fonctions utilitaires pour le portfolio dynamique
 * 
 * Ce fichier contient toutes les fonctions réutilisables dans les différentes pages
 * du portfolio : nettoyage de données, validation, et gestion des projets.
 *
 * @author Almoudou Traoré
 * @version 1.0
 */

/**
 * Nettoie une chaîne de caractères pour un affichage HTML sécurisé
 *
 * Cette fonction supprime les espaces inutiles au début et à la fin,
 * et convertit les caractères spéciaux en entités HTML pour prévenir les
 * attaques XSS (Cross-Site Scripting).
 *
 * @param string $valeur La chaîne brute à nettoyer
 * @return string La chaîne nettoyée et sécurisée pour l'affichage HTML
 */
function nettoyer(string $valeur): string {
    return htmlspecialchars(trim($valeur), ENT_QUOTES, 'UTF-8');
}

/**
 * Vérifie qu'un champ n'est pas vide après suppression des espaces
 *
 * Utilisée pour valider les champs obligatoires des formulaires.
 * Un champ contenant uniquement des espaces est considéré comme vide.
 *
 * @param string $valeur La valeur à vérifier
 * @return bool true si le champ contient du texte non vide, false sinon
 */
function champ_requis(string $valeur): bool {
    return !empty(trim($valeur));
}

/**
 * Valide le format d'une adresse email
 *
 * Utilise la fonction native filter_var de PHP avec le filtre VALIDATE_EMAIL.
 * Vérifie que l'email respecte le format standard (ex: nom@domaine.extension).
 *
 * @param string $email L'adresse email à valider
 * @return bool true si l'email est valide, false sinon
 */
function email_valide(string $email): bool {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

/**
 * Retourne la liste complète des projets du portfolio
 *
 * Les projets sont stockés dans un tableau associatif pour permettre
 * un affichage dynamique sur la page projets.php.
 * Chaque projet contient son titre, sa description, ses technologies,
 * ses images, sa catégorie et un éventuel lien externe.
 *
 * @return array Tableau des projets avec leurs propriétés
 */
function get_projets(): array {
    return [
        /**
         * Projet 1 : Poubelle intelligente connectée
         * Projet IoT utilisant un ESP32 et des capteurs DHT11
         */
        [
            'titre' => 'Poubelle intelligente connectée',
            'description' => 'Poubelle connectée mesurant température et humidité. Détection de présence et ouverture automatique du couvercle. Affichage en temps réel sur écran LCD et transmission des données par WiFi.',
            'technologies' => ['ESP32', 'C++', 'DHT11', 'IoT'],
            'image' => 'iot.jpeg',
            'image_full' => 'iot.jpeg',
            'categorie' => 'iot',
            'site_web' => null
        ],
        
        /**
         * Projet 2 : Application de gestion de contacts
         * Application console en C avec base de données MySQL
         */
        [
            'titre' => 'Application de gestion de contacts',
            'description' => 'Application en C permettant d\'ajouter, modifier, supprimer et rechercher des numéros de téléphone dans une base de données MySQL. Interface console intuitive et gestion des erreurs.',
            'technologies' => ['Langage C', 'MySQL', 'CRUD'],
            'image' => 'c.PNG',
            'image_full' => 'c.PNG',
            'categorie' => 'c',
            'site_web' => null
        ],
        
        /**
         * Projet 3 : AfrikDev
         * Plateforme web collaborative pour développeurs africains
         */
        [
            'titre' => 'AfrikDev',
            'description' => 'Plateforme collaborative pour développeurs africains. Conception des pages principales, structure HTML/CSS moderne, accessibilité et responsive design pour une expérience optimale sur tous les appareils.',
            'technologies' => ['HTML5', 'CSS3', 'Responsive', 'Collaboratif'],
            'image' => 'capture1.png',
            'image_full' => 'capture1.png',
            'categorie' => 'web',
            'site_web' => null
        ],
        
        /**
         * Projet 4 : AgroConnect
         * Application agricole connectée pour les agriculteurs
         */
        [
            'titre' => 'AgroConnect',
            'description' => 'Application agricole connectée : alertes météo, détection d\'insectes et de feux, vente directe aux communautés. Abonnement à 9000 FCFA/mois pour un accès premium.',
            'technologies' => ['Application mobile', 'IoT', 'Alertes en temps réel', 'Paiement mobile'],
            'image' => 'a.jpeg',
            'image_full' => 'a.jpeg',
            'categorie' => 'iot',
            'site_web' => null
        ]
    ];
}
?>