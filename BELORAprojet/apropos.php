<?php
/**
 * Page « Notre histoire » — présentation de la marque et de ses engagements.
 * Page statique : aucune requête SQL nécessaire.
 */

$titre      = 'Notre histoire — BÉLORA';
$pageActive = 'apropos';
$pageCss    = 'apropos.css';

require __DIR__ . '/includes/header.php';
?>

<header class="intro-page">
    <p class="eyebrow">L'univers BÉLORA</p>
    <h1>Natural beauty.<br>Lasting you.</h1>
    <p class="intro-texte">
        Une marque née d'une conviction simple : la beauté durable repose
        sur des gestes justes et des formules sincères, pas sur l'accumulation.
    </p>
</header>

<section class="section">
    <div class="container">

        <!-- ===== Bloc 1 : l'histoire ===== -->
        <div class="bloc-histoire">
            <div class="bloc-image">
                <img src="img/ambiance/apropos.jpg"
                     alt="Moment de soin au bord d'un plan de travail en marbre">
            </div>
            <div class="bloc-texte">
                <p class="eyebrow">Notre histoire</p>
                <h2>Une marque née du plaisir du geste simple</h2>
                <p>
                    Tout commence autour d'une table de marbre, entre deux sérums
                    et une tasse de thé : l'envie de créer des soins que l'on prend
                    plaisir à utiliser chaque jour, sans discours compliqué.
                    BÉLORA est née de ce moment, calme et lumineux.
                </p>
                <p>
                    Nous imaginons chaque produit comme une étape de rituel :
                    nettoyer, équilibrer, nourrir, protéger. Des étapes courtes
                    et claires, que chacun peut s'approprier selon sa peau
                    et son temps.
                </p>
            </div>
        </div>

        <!-- ===== Bloc 2 : la philosophie (inversé) ===== -->
        <div class="bloc-histoire bloc-inverse">
            <div class="bloc-image">
                <img src="img/ambiance/atelier.webp"
                     alt="Préparation botanique : mortier, feuilles et fleurs séchées">
            </div>
            <div class="bloc-texte">
                <p class="eyebrow">Notre philosophie</p>
                <h2>La nature, choisie avec soin</h2>
                <p>
                    Nos formules privilégient des ingrédients botaniques reconnus :
                    huiles végétales, extraits de plantes, eaux florales.
                    Les listes d'ingrédients restent courtes et lisibles,
                    parce que la confiance commence par la transparence.
                </p>
                <p>
                    Du choix des actifs à celui des contenants en verre,
                    chaque décision cherche l'équilibre entre efficacité,
                    plaisir d'utilisation et sobriété.
                </p>
            </div>
        </div>

        <!-- ===== Nos engagements ===== -->
        <div class="engagements">
            <h2>Nos engagements</h2>
            <div class="engagements-grille">
                <div class="engagement">
                    <h3>Formules courtes</h3>
                    <p>
                        Des listes d'ingrédients limitées à l'essentiel,
                        sans promesse inutile ni complexité artificielle.
                    </p>
                </div>
                <div class="engagement">
                    <h3>Ingrédients botaniques</h3>
                    <p>
                        Des actifs d'origine naturelle, choisis pour leur
                        tolérance et leur efficacité reconnue sur la peau.
                    </p>
                </div>
                <div class="engagement">
                    <h3>Transparence</h3>
                    <p>
                        Des informations claires sur chaque soin : usage,
                        texture, actifs — sans allégation excessive.
                    </p>
                </div>
            </div>
        </div>

        <p class="centre">
            <a class="btn" href="catalogue.php">Découvrir nos produits</a>
        </p>

    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
