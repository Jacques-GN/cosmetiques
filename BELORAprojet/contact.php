<?php
/**
 * Page Contact — formulaire validé côté serveur puis enregistré
 * dans la table `messages` de MySQL (démonstration pédagogique).
 */

require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/fonctions.php';

$titre      = 'Contact — BÉLORA';
$pageActive = 'contact';
$pageCss    = 'contact.css';

$erreurs = [];
$envoye  = false;
$nom = $email = $sujet = $message = '';

// ----- Traitement du formulaire (POST) -----
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nom     = trim($_POST['nom']     ?? '');
    $email   = trim($_POST['email']   ?? '');
    $sujet   = trim($_POST['sujet']   ?? '');
    $message = trim($_POST['message'] ?? '');

    // Validations simples avec limites alignées sur le schéma MySQL
    if ($nom === '' || mb_strlen($nom) > 100) {
        $erreurs[] = 'Veuillez entrer votre nom (100 caractères maximum).';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || mb_strlen($email) > 150) {
        $erreurs[] = 'Veuillez entrer une adresse e-mail valide.';
    }
    if ($sujet === '' || mb_strlen($sujet) > 150) {
        $erreurs[] = 'Veuillez entrer un sujet (150 caractères maximum).';
    }
    if ($message === '' || mb_strlen($message) > 3000) {
        $erreurs[] = 'Veuillez écrire votre message (3000 caractères maximum).';
    }

    // Tout est bon -> enregistrement en base (requête préparée)
    if (!$erreurs) {
        $req = $pdo->prepare(
            'INSERT INTO messages (nom, email, sujet, message)
             VALUES (:nom, :email, :sujet, :message)'
        );
        $req->execute([
            ':nom'     => $nom,
            ':email'   => $email,
            ':sujet'   => $sujet,
            ':message' => $message,
        ]);

        $envoye = true;
        $nom = $email = $sujet = $message = ''; // formulaire vidé
    }
}

require __DIR__ . '/includes/header.php';
?>

<header class="intro-page">
    <p class="eyebrow">Écrivez-nous</p>
    <h1>Contact</h1>
    <p class="intro-texte">
        Une question, une remarque, une envie de partager votre rituel ?
        Nous lisons chaque message.
    </p>
</header>

<section class="section">
    <div class="container contact-grille">

        <!-- ===== Colonne gauche : informations ===== -->
        <div class="contact-info">
            <h2>Restons en contact.</h2>
            <p>
                Envoyez-nous un message via le formulaire. Dans cette
                démonstration, il est enregistré dans la table
                <code>messages</code> de la base MySQL — vérifiable
                dans phpMyAdmin.
            </p>
            <img src="img/ambiance/apropos.jpg"
                 alt="Rituel de soin, ambiance calme BÉLORA">
            <p class="contact-direct">
                Ou écrivez-nous directement à
                <a href="mailto:bonjour@belora.fr">bonjour@belora.fr</a>.
            </p>
        </div>

        <!-- ===== Colonne droite : formulaire ===== -->
        <form class="contact-form" method="post" action="contact.php" novalidate>

            <?php if ($envoye): ?>
                <p class="notice notice-ok">
                    Merci ! Votre message a bien été enregistré.
                    Nous vous répondrons dans les meilleurs délais.
                </p>
            <?php endif; ?>

            <?php if ($erreurs): ?>
                <div class="notice notice-erreur">
                    <ul>
                        <?php foreach ($erreurs as $erreur): ?>
                            <li><?= e($erreur) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <label for="nom">Nom</label>
            <input type="text" id="nom" name="nom" maxlength="100" required
                   value="<?= e($nom) ?>">

            <label for="email">Adresse e-mail</label>
            <input type="email" id="email" name="email" maxlength="150" required
                   value="<?= e($email) ?>">

            <label for="sujet">Sujet</label>
            <input type="text" id="sujet" name="sujet" maxlength="150" required
                   value="<?= e($sujet) ?>">

            <label for="message">Message</label>
            <textarea id="message" name="message" rows="6" maxlength="3000"
                      required><?= e($message) ?></textarea>

            <button class="btn" type="submit">Envoyer le message</button>

        </form>

    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
