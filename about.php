<?php require_once 'fonctions.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>À propos | Almoudou Traoré</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php require 'composants/navigation.php'; ?>

    <main>
        <div class="fade-in" style="text-align: center;">
            <h2>À propos de moi</h2>
            <div class="tagline"><i class="fas fa-map-marker-alt"></i> Un Malien à la conquête du savoir ultime</div>
        </div>

        <div class="presentation-card fade-in">
            <div class="presentation-inner">
                <img src="tete2.jpeg" alt="Almoudou Traoré" class="profile-photo" onerror="this.src='https://placehold.co/400x400/7C3AED/white?text=AT'">
                <div class="presentation-text">
                    <h2>Almoudou Traoré</h2>
                    <p><strong>Licence 2 — Génie Logiciel & Administration Réseau</strong></p>
                    <p>Étudiant passionné par le développement logiciel, les systèmes embarqués et l'administration réseau.</p>
                    <p>Originaire du Mali, je poursuis aujourd'hui ma formation au Sénégal.</p>
                </div>
            </div>
        </div>

        <div class="about-grid">
            <div class="about-card fade-in">
                <div class="card-header"><i class="fas fa-graduation-cap"></i><h3>Parcours académique</h3></div>
                <ul class="timeline-list">
                    <li><strong>2024 - présent</strong> — Licence 2 Génie Logiciel & Administration Réseau</li>
                    <li><strong>2022-2023</strong> — Baccalauréat scientifique</li>
                    <li><strong>Juillet 2020</strong> — Diplôme d'études fondamentales · Mention Très Bien</li>
                </ul>
            </div>

            <div class="about-card fade-in">
                <div class="card-header"><i class="fas fa-code"></i><h3>Compétences techniques</h3></div>
                <div class="badges">
                    <?php
                    $techs = ['HTML/CSS', 'JavaScript', 'C / C++', 'Java', 'Python', 'PHP', 'MySQL', 'ESP32', 'Cisco'];
                    foreach ($techs as $tech) echo '<span class="badge">' . $tech . '</span>';
                    ?>
                </div>
            </div>

            <div class="about-card fade-in">
                <div class="card-header"><i class="fas fa-users"></i><h3>Savoir-être</h3></div>
                <ul class="timeline-list">
                    <li><strong>Travail d'équipe</strong> — Projets collaboratifs</li>
                    <li><strong>Résolution de problèmes</strong> — Projet voiture miniature électrique</li>
                    <li><strong>Adaptabilité</strong> — Polyvalent, apprentissage rapide</li>
                </ul>
            </div>

            <div class="about-card fade-in">
                <div class="card-header"><i class="fas fa-microscope"></i><h3>Centres d'intérêt</h3></div>
                <div class="interest-item"><i class="fas fa-car-side"></i><span><strong>Programmation embarquée</strong></span></div>
                <div class="interest-item"><i class="fas fa-shield-alt"></i><span><strong>Cybersécurité</strong></span></div>
                <div class="interest-item"><i class="fas fa-robot"></i><span><strong>Intelligence artificielle</strong></span></div>
            </div>

            <div class="about-card fade-in">
                <div class="card-header"><i class="fas fa-calendar-alt"></i><h3>Vie associative</h3></div>
                <ul class="timeline-list">
                    <li><strong>ESTM Graduation</strong> — Représentant officiel du Mali</li>
                </ul>
            </div>
        </div>
    </main>

    <?php require 'composants/pied-de-page.php'; ?>
</body>
</html>