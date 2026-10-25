<?php
/**
 * Pied de page commun : bandeau newsletter (table abonnes)
 * + colonnes de liens + mention légale du projet.
 */

// ------------------------------------------------------------------
// Traitement du formulaire newsletter (POST depuis n'importe quelle page)
// ------------------------------------------------------------------
$newsletterMessage = '';

if (($_SERVER['REQUEST_METHOD'] ?? '') === 'POST' && isset($_POST['email_newsletter'])) {
    $emailNewsletter = trim($_POST['email_newsletter'] ?? '');

    if (filter_var($emailNewsletter, FILTER_VALIDATE_EMAIL) && mb_strlen($emailNewsletter) <= 150) {
        // Ignore silencieusement les doublons (index UNIQUE sur la colonne email)
        $req = $pdo->prepare(
            'INSERT IGNORE INTO abonnes (email) VALUES (:email)'
        );
        $req->execute([':email' => $emailNewsletter]);
        $newsletterMessage = 'Merci ! Votre inscription est confirmée.';
    } else {
        $newsletterMessage = 'Veuillez saisir une adresse e-mail valide.';
    }
}
?>
</main>

<footer class="site-footer">

    <div class="container">

        <!-- Bandeau newsletter -->
        <div class="footer-newsletter">
            <div>
                <h2>Restons dans l'éclat.</h2>
                <p>Rituels, conseils et nouveautés — une fois par mois, jamais plus.</p>
            </div>
            <form method="post" class="newsletter-form" novalidate>
                <label class="sr-only" for="email_newsletter">Votre adresse e-mail</label>
                <input type="email" id="email_newsletter" name="email_newsletter"
                       placeholder="Votre adresse e-mail" required>
                <button type="submit" aria-label="S'inscrire à la newsletter">→</button>
            </form>
            <?php if ($newsletterMessage !== ''): ?>
                <p class="newsletter-msg <?= str_starts_with($newsletterMessage, 'Merci') ? 'ok' : 'ko' ?>">
                    <?= e($newsletterMessage) ?>
                </p>
            <?php endif; ?>
        </div>

        <!-- Colonnes de liens -->
        <div class="footer-colonnes">

            <div class="footer-marque">
                <img class="footer-logo" src="img/logo/logo-belora.png" alt="BÉLORA">
                <p>Natural beauty. Lasting you.<br>
                   Des soins botaniques aux formules courtes et sincères.</p>
                <div class="footer-social">
                    <a href="#" aria-label="Instagram">
                        <svg viewBox="0 0 24 24" width="20" height="20" fill="none"
                             stroke="currentColor" stroke-width="1.6">
                            <rect x="3" y="3" width="18" height="18" rx="5"/>
                            <circle cx="12" cy="12" r="4"/>
                            <circle cx="17.2" cy="6.8" r="1" fill="currentColor" stroke="none"/>
                        </svg>
                    </a>
                    <a href="#" aria-label="Facebook">
                        <svg viewBox="0 0 24 24" width="20" height="20" fill="none"
                             stroke="currentColor" stroke-width="1.6">
                            <path d="M14 8h2.5V4.5H14A4.5 4.5 0 0 0 9.5 9v2.5H7V15h2.5v6H13v-6h2.5l.5-3.5H13V9a1 1 0 0 1 1-1z"/>
                        </svg>
                    </a>
                    <a href="#" aria-label="Pinterest">
                        <svg viewBox="0 0 24 24" width="20" height="20" fill="none"
                             stroke="currentColor" stroke-width="1.6">
                            <circle cx="12" cy="12" r="9"/>
                            <path d="M9.5 20l2-8m-2.2 4.5c-1.6-.8-2.3-2.4-2.1-4.2C7.5 9.4 9.8 7.6 12.3 8c2.5.4 4 2.6 3.6 5-.4 2.4-2.3 4-4.4 3.7-1-.2-1.7-.7-2-1.4"/>
                        </svg>
                    </a>
                </div>
            </div>

            <div>
                <h3>Navigation</h3>
                <a href="index.php">Accueil</a>
                <a href="catalogue.php">Nos soins</a>
                <a href="apropos.php">Notre histoire</a>
                <a href="contact.php">Contact</a>
            </div>

            <div>
                <h3>Informations</h3>
                <a href="catalogue.php?categorie=visage">Soin du visage</a>
                <a href="catalogue.php?categorie=corps">Soin du corps</a>
                <a href="contact.php">Nous écrire</a>
                <a href="apropos.php">Nos engagements</a>
            </div>

        </div>

        <p class="footer-copyright">
            © <?= date('Y') ?> BÉLORA — Projet pédagogique.
            Produits, prix et avis fictifs, stockés dans une base MySQL.
        </p>

    </div>
</footer>

<script src="js/menu.js"></script>
</body>
</html>
