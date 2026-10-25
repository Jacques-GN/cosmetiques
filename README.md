# BÉLORA — Site vitrine cosmétique (PHP + MySQL)

Projet scolaire individuel : site vitrine pour une marque fictive de cosmétiques.
Technologies : HTML5, CSS3, JavaScript, **PHP 8 + MySQL (PDO)** — sans framework.

Design inspiré des créations LUNA sur Dribbble (esthétique crème, serif élégante,
badges, notes clients), adapté à la charte BÉLORA (ivoire, vert profond, or doux).

---

## Installation et test en local avec XAMPP

### Étape 1 — Démarrer Apache ET MySQL

1. Ouvrir le **panneau de contrôle XAMPP**.
2. Cliquer **Start** à côté de **Apache** → bouton vert.
3. Cliquer **Start** à côté de **MySQL** → bouton vert.
   *(Contrairement à une simple page HTML, ce projet a besoin de MySQL :
   les produits et les messages du contact y sont stockés.)*

### Étape 2 — Importer la base de données

1. Ouvrir `http://localhost/phpmyadmin`.
2. Onglet **Importer** → **Choisir un fichier** → `database/belora.sql`.
3. Cliquer **Exécuter**.
4. La base `belora` est créée avec 3 tables (`produits`, `messages`, `abonnes`)
   et les 9 soins de démonstration.

### Étape 3 — Copier le projet dans `htdocs`

Dézipper `BELORA_projet.zip` et copier **tout le contenu** dans :

- **Windows** : `C:\xampp\htdocs\projet\`
- **macOS** : `/Applications/XAMPP/htdocs/projet/`
- **Linux** : `/opt/lampp/htdocs/projet/`

### Étape 4 — Ouvrir le site

Taper dans le navigateur (ne **jamais** double-cliquer sur un fichier `.php` —
sinon le code s'affiche au lieu d'être exécuté) :

- `http://localhost/projet/` → accueil
- `http://localhost/projet/catalogue.php` → catalogue (9 soins, filtres + tri)
- `http://localhost/projet/produit.php?id=6` → fiche Huile hydratante
- `http://localhost/projet/apropos.php` → notre histoire
- `http://localhost/projet/contact.php` → formulaire (enregistre en base)

### En cas de problème

| Problème | Solution |
|---|---|
| Le **code PHP s'affiche** dans le navigateur | Vous avez ouvert le fichier en double-clic (`file:///...`). Taper l'URL `http://localhost/projet/` à la main. |
| « La base de données est inaccessible » | MySQL n'est pas démarré (XAMPP) ou `database/belora.sql` n'a pas été importé. |
| **« Colonne inconnue 'sous_titre' » / `SQLSTATE[42S22]`** | Votre base a été importée avec une **ancienne version** du fichier SQL. Réimporter `database/belora.sql` (le fichier détruit et recrée la base à chaque import → votre base sera à jour). |
| **« Base de données à mettre à jour »** (page stylisée) | Même chose : la structure de la base ne correspond pas au code. Réimporter `database/belora.sql`. |
| `Object not found!` (404) | Le dossier ne s'appelle pas `projet` dans `htdocs`, ou il est absent. |
| Les images ne s'affichent pas | Le sous-dossier `img/` (avec ses sous-dossiers) n'a pas été copié. |
| Port 80 occupé | Couper Skype/IIS ou changer le port Apache dans XAMPP. |

#### Réimporter la base (procédure complète, 30 secondes)

Si vous voyez une erreur `SQLSTATE[42S22]` ou « Colonne inconnue »,
c'est que la base MySQL sur votre machine est en retard par rapport au
code. Pour la remettre à jour :

1. Ouvrez `http://localhost/phpmyadmin`.
2. Cliquez sur l'onglet **Importer**.
3. Cliquez sur **Choisir un fichier** et sélectionnez
   `database/belora.sql` à la racine du projet.
4. Cliquez sur **Exécuter** (en bas à droite).
5. Rechargez la page du site.

> Le fichier `database/belora.sql` commence par `DROP DATABASE IF EXISTS belora`,
> donc réimporter recrée toujours une base propre, sans nécessité de
> supprimer manuellement l'ancienne. Vos éventuels messages de contact
> enregistrés seront effacés (données de démonstration).

---

## Fonctionnalités

| Page | Contenu |
|---|---|
| `index.php` | Hero deux colonnes, 3 bénéfices, 4 best-sellers (requête SQL), histoire, CTA |
| `catalogue.php` | 9 soins depuis MySQL, filtre par catégorie + tri (populaire, prix, nom), badges, notes |
| `produit.php?id=N` | Fiche complète : badge, étoiles + avis, prix + paiement 4×, accordéons (ingrédients / conseils / livraison), bouton panier de démonstration, suggestions « Vous aimerez aussi » |
| `apropos.php` | Histoire + philosophie (blocs alternés), 3 engagements |
| `contact.php` | Formulaire validé côté serveur → **enregistrement dans la table `messages`** |
| Newsletter (footer) | Inscription e-mail → **table `abonnes`** (doublons ignorés) |

## Base de données

Schéma complet dans `database/belora.sql` :

```
produits  (id, nom, sous_titre, categorie, badge, contenance, accroche,
           description, ingredients, conseils, prix, image, note, avis,
           actif, date_creation)
messages  (id, nom, email, sujet, message, date_envoi)
abonnes   (id, email UNIQUE, date_inscription)
```

Connexion dans `includes/db.php` (identifiants XAMPP par défaut : `root`,
sans mot de passe). Si MySQL est éteint ou la base absente, une **page d'aide
stylisée** explique les 3 étapes à suivre.

## Organisation des fichiers

```
projet/
├── index.php · catalogue.php · produit.php · apropos.php · contact.php
├── includes/
│   ├── db.php          connexion PDO + page d'aide si MySQL absent
│   ├── fonctions.php   helpers : e(), prix(), prix4x(), badge_classe(), etoiles()
│   ├── header.php      bandeau d'annonce, logo centré, navigation
│   └── footer.php      newsletter (INSERT en base), colonnes, réseaux sociaux
├── css/                1 feuille globale + 1 feuille par page (convention)
│   ├── style.css       variables, boutons, cartes, header, footer, responsive
│   ├── accueil.css · catalogue.css · produit.css · apropos.css · contact.css
├── js/menu.js          burger, accordéons, panier de démo, tri auto
├── img/
│   ├── logo/           logo-belora.png
│   ├── produits/       9 photos produits (produit-*.jpg)
│   ├── bannieres/      hero.jpg
│   └── ambiance/       philosophie.jpg · apropos.jpg · atelier.webp
├── database/
│   └── belora.sql      schéma + données (à importer dans phpMyAdmin)
├── docs/               documentation du projet
└── README.md
```

## Conventions de code

- **Échappement systématique** des sorties avec le helper `e()`
  (raccourci de `htmlspecialchars` — protection XSS).
- **Requêtes préparées** partout où une valeur utilisateur entre dans le SQL.
- **Listes blanches** pour les valeurs GET (`categorie`, `tri`) — jamais
  de valeur GET injectée directement dans une requête.
- **1 feuille CSS par page** + 1 feuille globale, comme demandé.
- HTML indenté et commenté (pas de code compressé).

## Identité visuelle

- Crème `#F6F1E8` · Vert profond `#26352B` · Or doux `#B99A65` · Charbon `#2B2926`
- Titres : Cormorant Garamond — Texte : Inter
- Signature : « Natural beauty. Lasting you. »
- Design inspiré LUNA (Dribbble) : hero bi-colonne, badges pastille,
  étoiles de notation, paiement en 4×, newsletter dans le pied de page.

## Devise

Tous les prix sont affichés en **dirham marocain (DH)**. Le fichier
`database/belora.sql` stocke les montants en DH (taux arrondi : 1 € ≈ 10 DH).
Les deux helpers `prix()` et `prix4x()` de `includes/fonctions.php`
formatent ces montants au format français `1 234,56 DH`.
