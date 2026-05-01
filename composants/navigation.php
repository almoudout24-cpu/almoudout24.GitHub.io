<?php
$page_courante = basename($_SERVER['PHP_SELF']);
?>
<nav>
    <div class="nav-container">
        <a href="index.php" class="logo">AT</a>
        <ul class="nav-links">
            <li><a href="index.php" <?= $page_courante == 'index.php' ? 'class="active"' : '' ?>>Accueil</a></li>
            <li><a href="about.php" <?= $page_courante == 'about.php' ? 'class="active"' : '' ?>>À propos</a></li>
            <li><a href="projets.php" <?= $page_courante == 'projets.php' ? 'class="active"' : '' ?>>Projets</a></li>
            <li><a href="contact.php" <?= $page_courante == 'contact.php' ? 'class="active"' : '' ?>>Contact</a></li>
        </ul>
        <button class="theme-toggle" id="themeToggle" aria-label="Changer de thème">
            <i class="fas fa-sun"></i>
        </button>
    </div>
</nav>