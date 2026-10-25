<?php
/**
 * En-tête commun à toutes les pages.
 * Variables attendues (facultatives) avant l'inclusion :
 *   $titre      — titre de l'onglet
 *   $pageActive — accueil | catalogue | apropos | contact
 *   $pageCss    — nom du fichier CSS spécifique (ex. 'accueil.css')
 */

require_once __DIR__ . '/fonctions.php';

$titre      = $titre ?? 'BÉLORA — Cosmétiques naturels';
$pageActive = $pageActive ?? '';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($titre) ?></title>
    <meta name="description" content="BÉLORA — soins botaniques d'origine naturelle. Site vitrine pédagogique.">

    <!-- Polices : Cormorant Garamond (titres) + Inter (texte) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- Feuille globale + feuille propre à la page -->
    <link rel="stylesheet" href="css/style.css">
    <?php if (!empty($pageCss)): ?>
        <link rel="stylesheet" href="css/<?= e($pageCss) ?>">
    <?php endif; ?>
</head>
<body>

<!-- Bandeau d'annonce (style e-commerce LUNA) -->
<div class="annonce">
    Livraison offerte dès 600&nbsp;DH d'achat · Retours gratuits sous 30&nbsp;jours
</div>

<!-- En-tête : logo centré sur ordinateur, burger sur mobile -->
<header class="site-header">
    <div class="container header-grille">

        <a class="logo" href="index.php" aria-label="BÉLORA — retour à l'accueil">
            <img src="img/logo/logo-belora.png" alt="Logo BÉLORA">
        </a>

        <nav class="nav" id="nav-principale" aria-label="Navigation principale">
            <a href="index.php"      class="<?= $pageActive === 'accueil'   ? 'actif' : '' ?>">Accueil</a>
            <a href="catalogue.php"  class="<?= $pageActive === 'catalogue' ? 'actif' : '' ?>">Nos soins</a>
            <a href="apropos.php"    class="<?= $pageActive === 'apropos'   ? 'actif' : '' ?>">Notre histoire</a>
            <a href="contact.php"    class="<?= $pageActive === 'contact'   ? 'actif' : '' ?>">Contact</a>
        </nav>

        <button class="burger" type="button"
                aria-label="Ouvrir le menu" aria-expanded="false"
                aria-controls="nav-principale">&#9776;</button>

    </div>
</header>

<main>
