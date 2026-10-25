'use strict';

/**
 * Interactions légères du site BÉLORA :
 *   1. menu mobile (burger)
 *   2. accordéons de la fiche produit
 *   3. bouton « Ajouter au panier » (site vitrine : notice explicative)
 *   4. tri du catalogue (soumission automatique du select)
 */

// ------------------------------------------------------------------
// 1. Menu mobile
// ------------------------------------------------------------------
const burger = document.querySelector('.burger');
const nav = document.querySelector('.nav');

if (burger && nav) {
    burger.addEventListener('click', () => {
        const ouvert = nav.classList.toggle('ouvert');
        burger.setAttribute('aria-expanded', String(ouvert));
        burger.innerHTML = ouvert ? '&#10005;' : '&#9776;';
    });
}

// ------------------------------------------------------------------
// 2. Accordéons (fiche produit)
// ------------------------------------------------------------------
document.querySelectorAll('.accordeon-titre').forEach((bouton) => {
    bouton.addEventListener('click', () => {
        const accordeon = bouton.closest('.accordeon');
        const contenu = accordeon.querySelector('.accordeon-contenu');
        const ouvert = accordeon.classList.toggle('ouvert');

        bouton.setAttribute('aria-expanded', String(ouvert));

        // max-height animé : hauteur réelle du contenu quand ouvert
        contenu.style.maxHeight = ouvert
            ? contenu.scrollHeight + 'px'
            : '0px';
    });
});

// ------------------------------------------------------------------
// 3. Bouton panier de démonstration
// ------------------------------------------------------------------
const btnPanier = document.getElementById('btn-panier');
const noticePanier = document.getElementById('notice-panier');

if (btnPanier && noticePanier) {
    btnPanier.addEventListener('click', () => {
        noticePanier.hidden = false;
    });
}

// ------------------------------------------------------------------
// 4. Tri automatique du catalogue (sans bouton OK)
// ------------------------------------------------------------------
const selectTri = document.getElementById('tri');

if (selectTri) {
    selectTri.addEventListener('change', () => {
        selectTri.form.submit();
    });
}
