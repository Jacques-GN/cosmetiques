# Structure de la base de données

## Table `produits`
- `id` : identifiant unique du produit
- `nom` : nom affiché
- `description` : résumé court
- `details` : description détaillée
- `prix` : prix fictif en FCFA
- `image` : nom du fichier image dans `img/produits/`
- `actif` : permet de masquer un produit sans le supprimer
- `date_creation` : date d'ajout

## Table `messages`
- `id` : identifiant du message
- `nom`, `email`, `sujet`, `message` : données du formulaire
- `date_envoi` : date d'enregistrement

## Relation
Les tables sont indépendantes pour garder le projet simple. Le catalogue lit `produits`; le formulaire Contact ajoute une ligne à `messages`.
