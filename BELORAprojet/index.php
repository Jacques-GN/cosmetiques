<?php
/**
 * Page d'accueil BÉLORA — design inspiré LUNA (Dribbble) :
 * hero en deux colonnes, bénéfices, best-sellers, histoire, appel à l'action.
 */

require_once __DIR__ . '/includes/db.php';

$titre      = 'BÉLORA — Cosmétiques naturels';
$pageActive = 'accueil';
$pageCss    = 'accueil.css';

// Les 4 soins les mieux notés par les "clients" (avis les plus nombreux)
$vedettes = $pdo->query(
    'SELECT id, nom, sous_titre, badge, prix, image, note, avis
     FROM produits
     WHERE actif = 1
     ORDER BY avis DESC
     LIMIT 4'
)->fetchAll();

require __DIR__ . '/includes/header.php';
?>

<!-- ================= HERO ================= -->
<section class="hero">
    <div class="container hero-grille">

        <div class="hero-texte">
            <p class="eyebrow">Soins botaniques · BÉLORA</p>
            <h1>Des soins qui<br><em>vous ressemblent.</em></h1>
            <p class="hero-intro">
                Des formules clean et botaniques, pensées pour révéler
                l'éclat naturel de votre peau, jour après jour.
            </p>
            <a class="btn" href="catalogue.php">Découvrir la collection</a>
        </div>

        <div class="hero-image">
            <img src="img/bannieres/hero.jpg"
                 alt="Femme au teint lumineux, univers botanique BÉLORA">
        </div>

    </div>
</section>

<!-- ============ BÉNÉFICES (3 arguments) ============ -->
<section class="benefices">
    <div class="container benefices-grille">
        <div class="benefice">
            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 21C7 17 4 13.5 4 9.8 4 6.6 6.4 4 9.5 4c1.4 0 2.6.6 3.5 1.5C13.9 4.6 15.1 4 16.5 4 19.6 4 22 6.6 22 9.8c0 3.7-3 7.2-8 11.2-.6.5-1.4.5-2 0z"/></svg>
            <p>Ingrédients d'origine naturelle</p>
        </div>
        <div class="benefice">
            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M7 3c1.7 0 3 1.6 3 3.5S8.7 10 7 10 4 8.4 4 6.5 5.3 3 7 3zm10 0c1.7 0 3 1.6 3 3.5S18.7 10 17 10s-3-1.6-3-3.5S15.3 3 17 3zM5 12c2 0 3 1 4 2.5S10.5 18 10 21H5c-1.7 0-2-1.8-1.5-3.5S4 12 5 12zm14 0c1 0 1 3.8 1.5 5.5S20.7 21 19 21h-5c-.5-3 .5-5 1.5-6.5S17 12 19 12z"/></svg>
            <p>Non testé sur les animaux</p>
        </div>
        <div class="benefice">
            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M10 2h4a1 1 0 0 1 1 1v2h1.5A2.5 2.5 0 0 1 19 7.5v12A2.5 2.5 0 0 1 16.5 22h-9A2.5 2.5 0 0 1 5 19.5v-12A2.5 2.5 0 0 1 7.5 5H9V3a1 1 0 0 1 1-1zm0 5H7.5a.5.5 0 0 0-.5.5v12a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5v-12a.5.5 0 0 0-.5-.5H14v1a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1V7z"/></svg>
            <p>Testé sous contrôle dermatologique</p>
        </div>
    </div>
</section>

<!-- ============ LES ESSENTIELS (4 best-sellers) ============ -->
<section class="section">
    <div class="container">
        <header class="section-tete">
            <p class="eyebrow">La sélection</p>
            <h2>Les essentiels du rituel</h2>
            <p class="section-intro">
                Quatre soins choisis parmi nos best-sellers, pour composer
                un rituel simple et complet.
            </p>
        </header>

        <div class="grille-produits">
            <?php foreach ($vedettes as $p): ?>
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
                        <p class="carte-prix"><?= prix((float) $p['prix']) ?></p>
                    </a>
                </article>
            <?php endforeach; ?>
        </div>

        <p class="centre">
            <a class="btn btn-contour" href="catalogue.php">Voir tout le catalogue</a>
        </p>
    </div>
</section>

<!-- ============ HISTOIRE (bande image + texte) ============ -->
<section class="bande-histoire">
    <div class="container histoire-grille">
        <div class="histoire-image">
            <img src="img/ambiance/philosophie.jpg"
                 alt="Teint lumineux et feuillages, l'esprit BÉLORA">
        </div>
        <div class="histoire-texte">
            <p class="eyebrow">L'esprit BÉLORA</p>
            <h2>La beauté en<br>toute simplicité.</h2>
            <p>
                Chez BÉLORA, chaque soin est pensé comme un rituel simple :
                des actifs botaniques reconnus, des textures agréables
                et rien de superflu.
            </p>
            <a class="lien-texte" href="apropos.php">Découvrir notre histoire <span>→</span></a>
        </div>
    </div>
</section>

<!-- ============ APPEL À L'ACTION ============ -->
<section class="cta-bandeau">
    <div class="container">
        <p class="eyebrow eyebrow-clair">Un moment pour soi</p>
        <h2>Prêt·e à composer votre rituel ?</h2>
        <a class="btn btn-clair" href="catalogue.php">Explorer le catalogue</a>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
