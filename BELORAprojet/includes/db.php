<?php
/**
 * Connexion à la base de données MySQL (XAMPP) via PDO.
 *
 * Prérequis côté XAMPP :
 *   1. Démarrer Apache ET MySQL dans le panneau de contrôle XAMPP.
 *   2. Importer database/belora.sql dans phpMyAdmin (http://localhost/phpmyadmin).
 *
 * Si la connexion échoue, une page d'aide claire est affichée
 * à la place d'une erreur PHP brutale.
 */

declare(strict_types=1);

// Identifiants par défaut de XAMPP (root sans mot de passe).
define('DB_HOTE', 'localhost');
define('DB_NOM',  'belora');
define('DB_USER', 'root');
define('DB_PASS', '');

try {
    $pdo = new PDO(
        'mysql:host=' . DB_HOTE . ';dbname=' . DB_NOM . ';charset=utf8mb4',
        DB_USER,
        DB_PASS,
        [
            // Erreurs SQL -> exceptions ; résultats -> tableaux associatifs
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            // Emule les vraies requêtes préparées côté MySQL
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]
    );
} catch (PDOException $e) {

    // Page d'aide (CSS inline : aucune autre dépendance n'est chargée).
    http_response_code(500);
    ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Base de données inaccessible — BÉLORA</title>
        <style>
            body { font-family: Georgia, serif; background: #F6F1E8; color: #2B2926;
                   display: flex; align-items: center; justify-content: center;
                   min-height: 100vh; margin: 0; }
            .carte { background: #FFFFFF; border: 1px solid #EDE5D8; border-radius: 12px;
                     max-width: 620px; padding: 2.5rem 3rem; }
            h1 { color: #26352B; margin-top: 0; }
            ol { line-height: 1.9; padding-left: 1.2rem; }
            code { background: #F6F1E8; padding: 0.15rem 0.4rem; border-radius: 4px;
                   font-size: 0.9em; }
        </style>
    </head>
    <body>
        <div class="carte">
            <h1>La base de données est inaccessible</h1>
            <p>Le site BÉLORA a besoin de MySQL pour afficher ses produits.
               Voici comment résoudre cela en 3 étapes :</p>
            <ol>
                <li>Ouvrez le <strong>panneau de contrôle XAMPP</strong> et démarrez
                    <strong>Apache</strong> puis <strong>MySQL</strong>.</li>
                <li>Allez sur <code>http://localhost/phpmyadmin</code>.</li>
                <li>Onglet <strong>Importer</strong> → choisissez le fichier
                    <code>database/belora.sql</code> du projet → <strong>Exécuter</strong>.</li>
            </ol>
            <p>Rechargez ensuite cette page.</p>
        </div>
    </body>
    </html>
    <?php
    exit;
}

// ----------------------------------------------------------------------
// Gestionnaire d'erreurs SQL survenues après la connexion (ex. :
// "Colonne inconnue 'sous_titre'", "Table 'belora.produits' inexistante").
// Cela arrive quand la base a été importée avec une ancienne version du
// fichier SQL. On affiche alors la même page d'aide, plutôt que l'erreur
// PHP brute, pour guider l'utilisateur.
// ----------------------------------------------------------------------
set_exception_handler(function (Throwable $ex) {
    if (!$ex instanceof PDOException) {
        // Pas une erreur SQL → on laisse PHP afficher l'erreur normale
        throw $ex;
    }

    $code = (string) $ex->getCode();
    // Codes SQLSTATE des erreurs de schéma : 42S02 (table absente),
    // 42S22 (colonne inconnue), 42S21 (colonne déjà existante), 42S??
    $erreurDeSchema = str_starts_with($code, '42S');
    // Au cas où MySQL renvoie un code plus court : on élargit
    $erreurDeSchema = $erreurDeSchema || str_starts_with($code, '42');

    if (!$erreurDeSchema) {
        throw $ex;
    }

    http_response_code(500);
    ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Base de données à mettre à jour — BÉLORA</title>
        <style>
            body { font-family: Georgia, serif; background: #F6F1E8; color: #2B2926;
                   display: flex; align-items: center; justify-content: center;
                   min-height: 100vh; margin: 0; }
            .carte { background: #FFFFFF; border: 1px solid #EDE5D8; border-radius: 12px;
                     max-width: 680px; padding: 2.5rem 3rem; }
            h1 { color: #26352B; margin-top: 0; }
            .erreur { background: #FBEDE9; border-left: 4px solid #B54A3F;
                      padding: 0.8rem 1rem; border-radius: 6px;
                      font-family: ui-monospace, Consolas, monospace; font-size: 0.85em;
                      color: #6b261d; margin: 1rem 0; word-break: break-word; }
            ol { line-height: 1.9; padding-left: 1.2rem; }
            code { background: #F6F1E8; padding: 0.15rem 0.4rem; border-radius: 4px;
                   font-size: 0.9em; }
        </style>
    </head>
    <body>
        <div class="carte">
            <h1>La base de données n'est pas à jour</h1>
            <p>La connexion MySQL fonctionne, mais la structure des tables
               ne correspond pas au code PHP. Cela arrive quand la base a été
               importée avec une ancienne version du fichier SQL.</p>

            <p class="erreur">Erreur détectée : <?= htmlspecialchars(
                $ex->getMessage(), ENT_QUOTES, 'UTF-8'
            ) ?></p>

            <p>Pour corriger en 3 étapes :</p>
            <ol>
                <li>Ouvrez <code>http://localhost/phpmyadmin</code>.</li>
                <li>Onglet <strong>Importer</strong> → choisissez le fichier
                    <code>database/belora.sql</code> du projet → <strong>Exécuter</strong>.
                    <br><em>(le fichier supprime et recrée la base à chaque import,
                    vos éventuelles anciennes données seront remplacées)</em></li>
                <li>Rechargez cette page.</li>
            </ol>
        </div>
    </body>
    </html>
    <?php
    exit;
});
