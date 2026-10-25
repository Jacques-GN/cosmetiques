<?php
/**
 * Catalogue des soins BÉLORA.
 * Filtre par catégorie + tri, les deux via l'URL (GET) :
 *   catalogue.php?categorie=visage&tri=prix-asc
 */

require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/fonctions.php';

$titre      = 'Nos soins — BÉLORA';
$pageActive = 'catalogue';
$pageCss    = 'catalogue.css';

// ----- 1. Filtre de catégorie (liste blanche pour éviter l'injection) -----
$categorie = $_GET['categorie'] ?? 'tous';
if (!in_array($categorie, ['tous', 'visage', 'corps'], true)) {
    $categorie = 'tous';
}

// ----- 2. Tri (liste blanche des colonnes autorisées) -----
$tris = [
    'populaire' => 'Les plus appréciés (avis DESC)',
    'prix-asc'  => 'Prix croissant',
    'prix-desc' => 'Prix décroissant',
    'nom'       => 'Ordre alphabétique',
];
$tri = $_GET['tri'] ?? 'populaire';
if (!array_key_exists($tri, $tris)) {
    $tri = 'populaire';
}

// ----- 3. Requête construite uniquement à partir des listes blanches -----
$sql    = 'SELECT id, nom, sous_titre, badge, prix, image, note, avis
           FROM produits
           WHERE actif = 1';
$params = [];

if ($categorie !== 'tous') {
    $sql .= ' AND categorie = :categorie';
    $params[':categorie'] = $categorie;
}

$sql .= ' ORDER BY ' . match ($tri) {
    'prix-asc'  => 'prix ASC',
    'prix-desc' => 'prix DESC',
    'nom'       => 'nom ASC',
    default     => 'avis DESC',
};

$requete = $pdo->prepare($sql);
$requete->execute($params);
$produits = $requete->fetchAll();

require __DIR__ . '/includes/header.php';
?>

<header class="intro-page">
    <p class="eyebrow">La collection</p>
    <h1>Nos soins</h1>
    <p class="intro-texte">
        Des formules clean et efficaces qui soutiennent l'éclat naturel
        de la peau — pour le visage et pour le corps.
    </p>
</header>

<section class="section">
    <div class="container">

        <!-- ===== Barre de filtres et de tri ===== -->
        <div class="barre-filtres">

            <nav class="filtres" aria-label="Filtrer par catégorie">
                <a href="catalogue.php?tri=<?= e($tri) ?>"
                   class="filtre <?= $categorie === 'tous' ? 'actif' : '' ?>">Tous</a>
                <a href="catalogue.php?categorie=visage&amp;tri=<?= e($tri) ?>"
                   class="filtre <?= $categorie === 'visage' ? 'actif' : '' ?>">Soin du visage</a>
                <a href="catalogue.php?categorie=corps&amp;tri=<?= e($tri) ?>"
                   class="filtre <?= $categorie === 'corps' ? 'actif' : '' ?>">Soin du corps</a>
            </nav>

            <form method="get" class="form-tri">
                <input type="hidden" name="categorie" value="<?= e($categorie) ?>">
                <label for="tri">Trier&nbsp;:</label>
                <select id="tri" name="tri">
                    <?php foreach ($tris as $cle => $libelle): ?>
                        <option value="<?= e($cle) ?>" <?= $tri === $cle ? 'selected' : '' ?>>
                            <?= e($libelle) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <noscript><button type="submit">OK</button></noscript>
            </form>

        </div>

        <p class="compte-produits">
            <?= count($produits) ?> soin<?= count($produits) > 1 ? 's' : '' ?>
            <?= $categorie !== 'tous' ? 'dans cette catégorie' : 'au total' ?>
        </p>

        <!-- ===== Grille des produits ===== -->
        <?php if ($produits): ?>
            <div class="grille-produits">
                <?php foreach ($produits as $p): ?>
                    <article class="carte-produit">
                        <a href="produit.php?id=<?= (int) $p['id'] ?>">
                            <div class="carte-photo">
                                <?php if ($p['badge']): ?>
                                    <span class="<?= badge_classe($p['badge']) ?>"><?= e($p['badge']) ?></span>
                                <?php endif; ?>
                                <img src="img/produits/<?= e($p['image']) ?>"
                                     alt="<?= e($p['nom']) ?> — <?= e($p['sous_titre']) ?>">
                            </div>
                            <h3><?= e($p['nom']) ?></h3>
                            <p class="carte-sous-titre"><?= e($p['sous_titre']) ?></p>
                            <p class="carte-note">
                                <?= etoiles((float) $p['note']) ?>
                                <span>(<?= (int) $p['avis'] ?> avis)</span>
                            </p>
                            <p class="carte-prix"><?= prix((float) $p['prix']) ?></p>
                        </a>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="vide">
                Aucun produit dans cette catégorie pour le moment.
                <a href="catalogue.php">Voir tous les soins</a>
            </p>
        <?php endif; ?>

    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
