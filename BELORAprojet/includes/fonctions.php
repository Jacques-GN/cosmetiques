<?php
/**
 * Petites fonctions utilitaires réutilisées dans toutes les pages.
 * Charger une seule fois : require_once includes/fonctions.php.
 */

declare(strict_types=1);

/**
 * Échappe une valeur pour l'affichage HTML (protection XSS).
 * Raccourci de htmlspecialchars(..., ENT_QUOTES, 'UTF-8').
 */
function e(?string $valeur): string
{
    return htmlspecialchars((string) $valeur, ENT_QUOTES, 'UTF-8');
}

/**
 * Formate un prix en dirham marocain (DH) : 349.0 -> "349,00 DH".
 */
function prix(float $montant): string
{
    return number_format($montant, 2, ',', ' ') . ' DH';
}

/**
 * Prix mensuel d'un paiement en 4 fois sans frais (affichage LUNA-like) :
 * 349.00 -> "87,25 DH".
 */
function prix4x(float $montant): string
{
    return number_format($montant / 4, 2, ',', ' ') . ' DH';
}

/**
 * Associe un libellé de badge ("Best-seller", "Nouveau")
 * à sa classe CSS pour la couleur de la pastille.
 */
function badge_classe(?string $badge): string
{
    return match ($badge) {
        'Best-seller' => 'badge badge-or',
        'Nouveau'     => 'badge badge-vert',
        default       => 'badge',
    };
}

/**
 * Renvoie le HTML des étoiles de notation (LUNA-like).
 * Principe : 5 étoiles grises en fond, 5 étoiles dorées par-dessus,
 * rognées à la largeur correspondant à la note (ex. 4.8/5 = 96 %).
 */
function etoiles(float $note): string
{
    $largeur = (int) round($note / 5 * 100);

    return '<span class="etoiles" style="--note: ' . $largeur . '%">'
         . '<span class="etoiles-fond" aria-hidden="true">★★★★★</span>'
         . '<span class="etoiles-pleines" aria-hidden="true">★★★★★</span>'
         . '</span>';
}
