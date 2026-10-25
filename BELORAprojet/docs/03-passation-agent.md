
# BÉLORA — Guide de passation du projet

## 1. Mission

Continuer le développement du site vitrine BÉLORA sans mélanger les décisions prises ni remplacer inutilement le code existant.

Le projet doit rester adapté à un étudiant débutant en informatique.

## 2. Contexte

- Marque : BÉLORA.
- Type : site vitrine de cosmétiques.
- Travail : individuel.
- Niveau : débutant.
- Délai estimé : 2 à 4 semaines.
- Environnement local : XAMPP et VS Code.
- Dépôt GitHub prévu : Jacques-GN/projet.
- Technologies : HTML, CSS, JavaScript et un peu de PHP.

Le site fonctionne déjà en local selon l'étudiant.

## 3. Architecture annoncée

projet/
├── index.php
├── catalogue.php
├── produit.php
├── apropos.php
├── contact.php
├── includes/
│   ├── header.php
│   └── footer.php
├── config/
│   └── db.php
├── css/
│   └── style.css
├── js/
│   └── script.js
├── img/
└── sql/
    └── produits.sql

Cette structure est celle annoncée par l'étudiant. Inspecter les fichiers réels avant toute modification.

## 4. CSS

L'étudiant souhaite une feuille de style par page pour garder le code lisible.

Conserver style.css pour les styles communs et ajouter si nécessaire :

- accueil.css
- catalogue.css
- produit.css
- apropos.css
- contact.css

Vérifier les feuilles existantes avant de créer des doublons.

## 5. Identité visuelle à préserver

- Ivoire : #F3EBDD
- Vert profond : #26352B
- Or doux : #B99A65
- Charbon : #24221F

Titres élégants à empattements, texte courant lisible, photographies de qualité, espaces généreux et animations limitées.

Signature de référence :
"Natural beauty. Lasting you."

Ne pas transformer le site en boutique en ligne.

## 6. Utilisation de PHP

PHP doit rester limité aux besoins pédagogiques :

- include pour réutiliser header.php et footer.php.
- Traitement réel du formulaire de contact.
- Validation côté serveur.
- Protection des données réaffichées avec htmlspecialchars.

Ne pas développer une architecture complexe.

MySQL reste facultatif jusqu'à confirmation du professeur.

## 7. Sécurité

Ne jamais demander, afficher ou enregistrer de jeton GitHub, mot de passe ou secret dans le code ou le dépôt.

Si un formulaire est traité, valider les champs et vérifier les données côté serveur.

Ne pas prétendre qu'un e-mail est envoyé sans mécanisme d'envoi configuré.

## 8. Ordre de travail

1. Examiner le code existant.
2. Vérifier que le site fonctionne toujours.
3. Harmoniser les couleurs et la typographie.
4. Améliorer l'en-tête et le pied de page.
5. Construire la page d'accueil.
6. Développer le catalogue et les détails des produits.
7. Développer À propos et Contact.
8. Ajouter les interactions JavaScript utiles.
9. Tester le formulaire PHP.
10. Tester le responsive et les liens.
11. Compléter le README avec les instructions XAMPP.

## 9. Règles de collaboration

- Ne pas réécrire tout le projet sans nécessité.
- Faire des modifications progressives.
- Expliquer les changements simplement.
- Tester après chaque étape importante.
- Conserver les noms et la structure des fichiers autant que possible.
- Signaler clairement les fonctionnalités non terminées.
- Ne pas supposer que les fichiers locaux sont déjà synchronisés avec GitHub.

## 10. Objectif final

Livrer un site vitrine élégant, fonctionnel et responsive, accompagné d'une documentation permettant à un autre agent de poursuivre le travail et à l'étudiant d'expliquer son code au professeur.
