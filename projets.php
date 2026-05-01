<?php require_once 'fonctions.php'; ?>

<?php
$projets = get_projets();
$search = isset($_GET['q']) ? nettoyer($_GET['q']) : '';
$category = isset($_GET['cat']) ? nettoyer($_GET['cat']) : '';

$filtered = [];
foreach ($projets as $projet) {
    $match = true;
    if ($search !== '') {
        $in_title = stripos($projet['titre'], $search) !== false;
        $in_desc = stripos($projet['description'], $search) !== false;
        $in_tech = false;
        foreach ($projet['technologies'] as $tech) {
            if (stripos($tech, $search) !== false) $in_tech = true;
        }
        if (!$in_title && !$in_tech && !$in_desc) $match = false;
    }
    if ($category !== '' && $category !== 'all') {
        if ($projet['categorie'] !== $category) $match = false;
    }
    if ($match) $filtered[] = $projet;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projets | Almoudou Traoré</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php require 'composants/navigation.php'; ?>

    <main>
        <h2 class="fade-in">Mes réalisations</h2>
        <p class="section-subtitle fade-in">Découvrez mes projets en IoT, développement logiciel et applications web</p>

        <div class="filters-container fade-in">
            <form method="GET" action="" class="search-form">
                <div class="search-wrapper">
                    <i class="fas fa-search"></i>
                    <input type="text" name="q" placeholder="Rechercher un projet..." value="<?= htmlspecialchars($search) ?>">
                </div>
                <div class="filter-tags">
                    <a href="?<?= $search ? 'q='.urlencode($search).'&' : '' ?>cat=all" class="filter-tag <?= $category === 'all' || $category === '' ? 'active' : '' ?>">Tous</a>
                    <a href="?<?= $search ? 'q='.urlencode($search).'&' : '' ?>cat=iot" class="filter-tag <?= $category === 'iot' ? 'active' : '' ?>">📡 IoT</a>
                    <a href="?<?= $search ? 'q='.urlencode($search).'&' : '' ?>cat=web" class="filter-tag <?= $category === 'web' ? 'active' : '' ?>">🌐 Web</a>
                    <a href="?<?= $search ? 'q='.urlencode($search).'&' : '' ?>cat=c" class="filter-tag <?= $category === 'c' ? 'active' : '' ?>">⚙️ C / C++</a>
                </div>
            </form>
        </div>

        <div class="stats-projects fade-in">
            <div class="result-count">
                <i class="fas fa-layer-group"></i> <?= count($filtered) ?> projet(s) trouvé(s)
            </div>
        </div>

        <div class="projects-grid">
            <?php if (empty($filtered)): ?>
                <p>Aucun projet ne correspond à votre recherche.</p>
            <?php else: ?>
                <?php foreach ($filtered as $projet): ?>
                <div class="card project-card fade-in">
                    <div class="card-img" data-fullimg="<?= $projet['image_full'] ?>">
                        <img src="<?= $projet['image'] ?>" alt="<?= $projet['titre'] ?>">
                        <div class="card-img-overlay"><div class="zoom-icon"><i class="fas fa-search-plus"></i></div></div>
                    </div>
                    <div class="card-content">
                        <h3><?= htmlspecialchars($projet['titre']) ?></h3>
                        <div class="badges">
                            <?php foreach ($projet['technologies'] as $tech): ?>
                                <span class="badge"><?= htmlspecialchars($tech) ?></span>
                            <?php endforeach; ?>
                        </div>
                        <p><?= htmlspecialchars($projet['description']) ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </main>

    <?php require 'composants/pied-de-page.php'; ?>

    <div id="lightbox" class="lightbox" onclick="closeLightbox()">
        <span class="lightbox-close" onclick="closeLightbox()">&times;</span>
        <img id="lightbox-img" src="" alt="Agrandissement">
    </div>

    <script>
        const lightbox = document.getElementById('lightbox');
        const lightboxImg = document.getElementById('lightbox-img');
        
        document.querySelectorAll('.card-img').forEach(imgContainer => {
            imgContainer.addEventListener('click', (e) => {
                const fullImg = imgContainer.getAttribute('data-fullimg');
                if (fullImg) {
                    lightboxImg.src = fullImg;
                    lightbox.classList.add('active');
                    document.body.style.overflow = 'hidden';
                }
            });
        });
        
        function closeLightbox() {
            lightbox.classList.remove('active');
            document.body.style.overflow = '';
        }
        
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && lightbox.classList.contains('active')) {
                closeLightbox();
            }
        });
    </script>
</body>
</html>