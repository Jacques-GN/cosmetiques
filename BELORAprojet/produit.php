<?php
/**
 * Fiche produit BÉLORA — style LUNA :
 * image + infos, note/avis, paiement 4x, accordéons, suggestions.
 */

require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/fonctions.php';

// ----- 1. Produit demandé (id entier, sinon 0) -----
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT) ?: 0;

$requete = $pdo->prepare(
    'SELECT id, nom, sous_titre, badge, categorie, contenance, accroche, description,
            ingredients, conseils, prix, image, note, avis
     FROM produits
     WHERE id = :id AND actif = 1'
);
$requete->execute([':id' => $id]);
$produit = $requete->fetch();

// ----- 2. Produit introuvable -> page claire -----
if (!$produit) {
    $titre      = 'Produit introuvable — BÉLORA';
    $pageActive = 'catalogue';
    $pageCss    = 'produit.css';
    require __DIR__ . '/includes/header.php';
    ?>

    <div class="container centre-page">
        <h1>Produit introuvable</h1>
        <p>Le soin demandé n'existe pas ou n'est plus affiché.</p>
        <p><a class="btn" href="catalogue.php">Retour au catalogue</a></p>
    </div>

    <?php require __DIR__ . '/includes/footer.php';
    exit;
}

// ----- 3. Suggestions : même catégorie d'abord, complétées par les best-sellers -----
$similaires = [];

$requete = $pdo->prepare(
    'SELECT id, nom, sous_titre, badge, categorie, prix, image, note, avis
     FROM produits
     WHERE actif = 1 AND id != :id AND categorie = :categorie
     ORDER BY avis DESC
     LIMIT 4'
);
$requete->execute([':id' => $produit['id'], ':categorie' => $produit['categorie']]);
$similaires = $requete->fetchAll();

if (count($similaires) < 4) {
    // On complète avec les soins les plus appréciés hors catégorie
    $idsExclus   = array_merge([$produit['id']], array_column($similaires, 'id'));
    $marqueurs   = implode(',', array_fill(0, count($idsExclus), '?'));
    $reste       = 4 - count($similaires);

    $requete = $pdo->prepare(
        "SELECT id, nom, sous_titre, badge, prix, image, note, avis
         FROM produits
         WHERE actif = 1 AND id NOT IN ($marqueurs)
         ORDER BY avis DESC
         LIMIT $reste"
    );
    $requete->execute($idsExclus);
    $similaires = array_merge($similaires, $requete->fetchAll());
}

// ----- 4. Variables d'affichage -----
$titre   = $produit['nom'] . ' — BÉLORA';
$pageActive = 'catalogue';
$pageCss = 'produit.css';

require __DIR__ . '/includes/header.php';
?>

<div class="container">

    <!-- Fil d'Ariane -->
    <nav class="fil-ariane" aria-label="Fil d'Ariane">
        <a href="index.php">Accueil</a> <span>/</span>
        <a href="catalogue.php">Nos soins</a> <span>/</span>
        <span aria-current="page"><?= e($produit['nom']) ?></span>
    </nav>

    <!-- ===== Bloc principal : image + infos ===== -->
    <article class="fiche">

        <div class="fiche-image">
            <img src="img/produits/<?= e($produit['image']) ?>"
                 alt="<?= e($produit['nom']) ?> — <?= e($produit['sous_titre']) ?>">
        </div>

        <div class="fiche-info">
            <?php if ($produit['badge']): ?>
                <p><span class="<?= badge_classe($produit['badge']) ?>"><?= e($produit['badge']) ?></span></p>
            <?php endif; ?>

            <h1><?= e($produit['nom']) ?></h1>
            <p class="fiche-sous-titre"><?= e($produit['sous_titre']) ?></p>

            <p class="fiche-note">
                <?= etoiles((float) $produit['note']) ?>
                <span><?= e(number_format((float) $produit['note'], 1, ',', ' ')) ?>
                      (<?= (int) $produit['avis'] ?> avis)</span>
            </p>

            <p class="fiche-prix"><?= prix((float) $produit['prix']) ?></p>
            <p class="fiche-4x">
                ou 4 × <?= prix4x((float) $produit['prix']) ?> sans frais
            </p>

            <p class="fiche-accroche"><?= e($produit['accroche']) ?></p>
            <p class="fiche-description"><?= e($produit['description']) ?></p>

            <p class="fiche-contenance">Contenance : <?= e($produit['contenance']) ?></p>

            <!-- Site vitrine : le bouton explique lui-même la démonstration -->
            <button class="btn btn-large" type="button" id="btn-panier">
                Ajouter au panier
            </button>
            <p class="notice" id="notice-panier" hidden>
                Site vitrine de démonstration — la commande en ligne n'est pas disponible.
            </p>
        </div>

    </article>

    <!-- ===== Accordéons : ingrédients / conseils / livraison ===== -->
    <section class="accordeons">

        <div class="accordeon ouvert">
            <button class="accordeon-titre" type="button" aria-expanded="true">
                Ingrédients clés <span aria-hidden="true">+</span>
            </button>
            <div class="accordeon-contenu">
                <p><?= e($produit['ingredients']) ?></p>
            </div>
        </div>

        <div class="accordeon">
            <button class="accordeon-titre" type="button" aria-expanded="false">
                Conseils d'utilisation <span aria-hidden="true">+</span>
            </button>
            <div class="accordeon-contenu">
                <p><?= e($produit['conseils']) ?></p>
            </div>
        </div>

        <div class="accordeon">
            <button class="accordeon-titre" type="button" aria-expanded="false">
                Livraison &amp; retours <span aria-hidden="true">+</span>
            </button>
            <div class="accordeon-contenu">
                <p>
                    Expédition sous 48 h — livraison offerte dès 600 DH d'achat.
                    Retours gratuits sous 30 jours.
                    <em>(Informations de démonstration.)</em>
                </p>
            </div>
        </div>

    </section>

    <!-- ===== Vous aimerez aussi ===== -->
    <?php if ($similaires): ?>
        <section class="suggestions">
            <h2>Vous aimerez aussi</h2>
            <div class="grille-produits">
                <?php foreach ($similaires as $p): ?>
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
                            <p class="carte-prix"><?= prix((float) $p['prix']) ?></p>
                        </a>
                    </article>
                <?php endforeach; ?>
            </div>
        </section>
    <?php endif; ?>

    <p class="centre">
        <a class="lien-texte" href="catalogue.php">← Retour au catalogue</a>
    </p>

</div>

<?php require __DIR__ . '/includes/footer.php'; ?>
