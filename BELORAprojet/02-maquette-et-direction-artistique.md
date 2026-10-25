# BÉLORA — Consignes de passation pour tout assistant ou intervenant

## 1. Mission

Aider à construire et améliorer le site vitrine BÉLORA en respectant les choix de projet, la direction artistique et le niveau de programmation de l'étudiant. Travailler étape par étape et vérifier l'existant avant de proposer des changements.

## 2. Priorités non négociables

1. **Respecter la maquette et l'identité visuelle BÉLORA.** La référence LUNA sert à guider la structure générale, pas à remplacer la palette ni les images de BÉLORA.
2. Le rendu ne doit pas être trop minimaliste : viser un résultat premium, naturel, visuellement riche et professionnel.
3. Le code doit rester classique, simple, court quand c'est possible et compréhensible par un débutant.
4. Ajouter quelques commentaires utiles aux parties importantes, sans surcommenter.
5. Ne pas réécrire les éléments qui fonctionnent sans raison. Examiner les fichiers actuels avant de modifier.
6. Ne pas inventer des fonctionnalités, des données, des certifications ou des résultats.
7. Expliquer brièvement les changements importants et comment les tester.

## 3. Contexte du projet

- Marque fictive : BÉLORA.
- Type de site : site vitrine de cosmétiques, pas une boutique en ligne.
- Environnement : VS Code et XAMPP en local.
- Niveau : étudiant débutant, bases de HTML/CSS/JavaScript/PHP.
- Technologies souhaitées : HTML, CSS, JavaScript de base, PHP simple.
- Pas de framework ni de structure complexe sans nécessité pédagogique claire.
- MySQL n'est pas confirmé comme exigence. Ne pas l'ajouter avant vérification des consignes du professeur.

## 4. Direction artistique à suivre

Palette officielle :

- Ivoire : `#F3EBDD`
- Vert profond : `#26352B`
- Or doux : `#B99A65`
- Charbon : `#24221F`
- Beige grisé : `#DED5C6`
- Texte secondaire : `#625E55`

Typographie :

- Titres en serif élégante, par exemple Cormorant Garamond.
- Textes en sans-serif lisible, par exemple Inter.

Images :

- Photographie éditoriale de soins cosmétiques.
- Produits sur fonds ivoire, pierre claire ou matières naturelles.
- Lumière douce et ambiance cohérente.
- Visuels propres, suffisamment grands et correctement recadrés.
- Pas de logo LUNA, pas de photos avec une marque concurrente présentée comme BÉLORA.

La page doit avoir une vraie hiérarchie visuelle, des sections suffisamment riches, des photos de qualité, des boutons cohérents et une finition soignée. Éviter un résultat vide, plat ou trop minimaliste.

## 5. Référence de structure

La référence LUNA partagée par l'utilisateur inspire notamment :

- barre d'annonce facultative ;
- en-tête et navigation ;
- grande bannière avec image et appel à l'action ;
- produits mis en avant ;
- section histoire de la marque ;
- pied de page complet.

BÉLORA peut ajouter ou réorganiser les sections nécessaires : présentation des ingrédients, valeurs, appel à l'action, catalogue, fiches produit et contact. Les fonctionnalités doivent correspondre au cahier des charges.

## 6. Pages et fonctions prévues

- `index.php` : accueil avec bannière, produits mis en avant, présentation de la marque et pied de page.
- `catalogue.php` : catalogue et éventuellement des filtres simples.
- `produit.php` : détails d'un produit selon un identifiant, avec traitement d'un identifiant invalide.
- `apropos.php` : histoire et philosophie de BÉLORA.
- `contact.php` : formulaire de contact avec validation PHP élémentaire.
- `includes/header.php` et `includes/footer.php` : parties communes.
- `css/style.css` : styles partagés.
- `css/accueil.css`, `css/catalogue.css`, `css/produit.css`, `css/apropos.css`, `css/contact.css` : styles propres aux pages si cela correspond à l'organisation actuelle.
- `js/script.js` : interactions simples réellement utiles.
- `img/` : images locales.

Avant de créer un fichier, vérifier si un fichier équivalent existe déjà. La structure exacte peut évoluer si les fichiers du dépôt sont déjà organisés autrement ; ne pas casser les liens existants sans nécessité.

## 7. Limites fonctionnelles

Ne pas ajouter sans demande explicite :

- panier ou paiement ;
- compte client ;
- gestion de commandes ;
- espace administrateur ;
- base de données MySQL ;
- système d'envoi d'e-mails externe ;
- bibliothèques, frameworks ou animations complexes.

Le formulaire de contact doit afficher un message honnête. Ne pas dire qu'un message a été envoyé par e-mail si aucun système d'envoi réel n'est configuré.

## 8. Règles de code

- Écrire du HTML, CSS, JavaScript et PHP de niveau débutant.
- Privilégier les conditions, boucles et fonctions simples seulement quand elles sont utiles.
- Employer des noms explicites.
- Indenter le code.
- Ajouter des commentaires courts aux blocs importants.
- Éviter le code dupliqué lorsqu'une inclusion simple suffit.
- Ne pas réduire le nombre de lignes à tout prix : la priorité est la clarté.
- Vérifier les valeurs reçues dans l'URL et le formulaire.
- Utiliser `htmlspecialchars` pour afficher du texte utilisateur dans une page HTML.
- Tester les pages dans le navigateur via XAMPP après chaque étape.

## 9. Méthode de travail attendue

Pour chaque étape :

1. Demander ou examiner le contenu actuel des fichiers nécessaires.
2. Dire en quelques mots ce qui doit changer et pourquoi.
3. Proposer le code complet du fichier modifié quand c'est plus simple pour le débutant que des changements fragmentés.
4. Ne pas modifier les fichiers non concernés.
5. Donner des instructions de test courtes et précises.
6. Corriger les erreurs à partir des messages réels, sans supposer le résultat.
7. Mettre à jour cette documentation si une décision importante change.

## 10. État et prochaine action

La direction visuelle a été clarifiée : conserver la palette et les images de BÉLORA, s'inspirer de la structure LUNA et viser un rendu plus professionnel, pas trop minimaliste.

La prochaine étape technique est d'inspecter le code existant de `index.php` et `includes/header.php`, puis d'ajuster la page d'accueil sans repartir de zéro. Ne pas prétendre avoir modifié le dépôt GitHub si aucun changement n'y a réellement été poussé.
