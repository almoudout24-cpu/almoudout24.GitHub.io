<?php require_once 'fonctions.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Portfolio d'Almoudou Traoré - Étudiant en Génie Logiciel et Administration Réseau.">
    <title>Almoudou Traoré | Portfolio</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php require 'composants/navigation.php'; ?>

    <main>
        <!-- ========== SECTION HERO ========== -->
        <section class="hero fade-in">
            <div class="hero-badge">
                <i class="fas fa-code"></i> Étudiant en Génie Logiciel & Réseaux
            </div>
            <h1>Almoudou Traoré<br><span>Créateur de solutions innovantes</span></h1>
            <p>Passionné par l'embarqué, la cybersécurité et l'IA — Malien au Sénégal, je transforme ma curiosité technique en compétences solides au service de l'Afrique.</p>
            <div class="btn-group">
                <a href="projets.php" class="btn"><i class="fas fa-arrow-right"></i> Voir mes projets</a>
                <a href="contact.php" class="btn btn-outline"><i class="fas fa-envelope"></i> Me contacter</a>
            </div>
        </section>

        <!-- ========== SECTION BIENVENUE (style de l'image) ========== -->
        <section class="welcome-card fade-in">
            <div class="welcome-inner">
                <!-- Avatar violet "AT" à gauche -->
                <div class="welcome-avatar">
                    <span>AT</span>
                </div>
                <!-- Texte à droite -->
                <div class="welcome-text">
                    <h2>Bienvenue sur mon portfolio</h2>
                    <p>Je m'appelle <strong>Almoudou Traoré</strong>, étudiant passionné par le développement logiciel, les systèmes embarqués et l'administration réseau.</p>
                    <p>Originaire du Mali, je poursuis aujourd'hui ma formation au Sénégal pour acquérir une expertise technique solide et contribuer au développement technologique de l'Afrique de l'Ouest.</p>
                    <p>Mon objectif : concevoir des solutions innovantes, sécurisées et accessibles, qui répondent aux défis réels de notre époque.</p>
                </div>
            </div>
        </section>

        <!-- ========== STATS ========== -->
        <section class="stats-section fade-in">
            <div class="stats-grid">
                <div class="stat-card"><div class="stat-icon"><i class="fas fa-folder-open"></i></div><div class="stat-number">4</div><div class="stat-label">Projets réalisés</div><div class="stat-desc">Web, embarqué, réseaux</div></div>
                <div class="stat-card"><div class="stat-icon"><i class="fas fa-laptop-code"></i></div><div class="stat-number">7</div><div class="stat-label">Langages maîtrisés</div><div class="stat-desc">C, C++, Python, Java, PHP, SQL, JS</div></div>
                <div class="stat-card"><div class="stat-icon"><i class="fas fa-clock"></i></div><div class="stat-number">2</div><div class="stat-label">Années d'apprentissage</div><div class="stat-desc">Dévouement et progression</div></div>
                <div class="stat-card"><div class="stat-icon"><i class="fas fa-microchip"></i></div><div class="stat-number">4</div><div class="stat-label">Projets IoT</div><div class="stat-desc">ESP32, capteurs, automatisation</div></div>
            </div>
        </section>

        <!-- ========== COMPÉTENCES ========== -->
        <section class="skills-section fade-in">
            <h2>Compétences techniques</h2>
            <div class="skills-container">
                <?php
                $skills = [
                    ['name' => 'HTML / CSS', 'percent' => 85, 'icon' => 'fab fa-html5'],
                    ['name' => 'C / C++', 'percent' => 75, 'icon' => 'fas fa-c'],
                    ['name' => 'JavaScript', 'percent' => 65, 'icon' => 'fab fa-js'],
                    ['name' => 'Python / Java', 'percent' => 70, 'icon' => 'fab fa-python'],
                    ['name' => 'MySQL / PHP', 'percent' => 60, 'icon' => 'fas fa-database'],
                    ['name' => 'ESP32 / Embarqué', 'percent' => 70, 'icon' => 'fas fa-microchip'],
                    ['name' => 'Cybersécurité (Cisco)', 'percent' => 65, 'icon' => 'fas fa-shield-alt']
                ];
                foreach ($skills as $skill): ?>
                <div class="skill-bar-item">
                    <div class="skill-info">
                        <span class="skill-name"><i class="<?= $skill['icon'] ?>"></i> <?= $skill['name'] ?></span>
                        <span class="skill-percent"><?= $skill['percent'] ?>%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress" data-width="<?= $skill['percent'] ?>"></div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>
    </main>

    <?php require 'composants/pied-de-page.php'; ?>
</body>
</html>