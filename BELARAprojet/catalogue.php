<?php 
// Variables pour le header
$titre = 'Catalogue - Naya';
$css_page = 'catalogue.css'; 

// Un tableau PHP simple qui contient nos produits
$produits = [
    ["id" => 1, "nom" => "Sérum Éclat", "prix" => "29,90 €", "cat" => "visage"],
    ["id" => 2, "nom" => "Crème Velours", "prix" => "24,50 €", "cat" => "visage"],
    ["id" => 3, "nom" => "Huile Douceur", "prix" => "19,90 €", "cat" => "corps"],
    ["id" => 4, "nom" => "Baume Lèvres", "prix" => "12,00 €", "cat" => "visage"],
    ["id" => 5, "nom" => "Lait Corps", "prix" => "18,50 €", "cat" => "corps"],
    ["id" => 6, "nom" => "Rouge Doux", "prix" => "22,00 €", "cat" => "maquillage"]
];

// On inclut le header
include 'includes/header.php'; 
?>

<section class="page-catalogue">
    <h1>Notre Catalogue</h1>

    <!-- Les boutons de filtre -->
    <div class="filtres">
        <button class="filtre actif" data-cat="tous">Tous</button>
        <button class="filtre" data-cat="visage">Visage</button>
        <button class="filtre" data-cat="corps">Corps</button>
        <button class="filtre" data-cat="maquillage">Maquillage</button>
    </div>

    <!-- La grille de produits -->
    <div class="grille-produits" id="grille">
        
        <?php 
        // On fait une boucle pour afficher chaque produit du tableau
        foreach ($produits as $produit) { 
        ?>
            <div class="carte" data-cat="<?php echo $produit['cat']; ?>">
                <a href="produit.php?id=<?php echo $produit['id']; ?>">
                    <!-- Image temporaire (placeholder) en attendant tes vraies images -->
                    <img src="https://via.placeholder.com/250x250?text=Photo" alt="<?php echo $produit['nom']; ?>">
                    <h2><?php echo $produit['nom']; ?></h2>
                    <p class="prix"><?php echo $produit['prix']; ?></p>
                </a>
            </div>
        <?php 
        } 
        ?>

    </div>
</section>

<?php 
// On inclut le footer
include 'includes/footer.php'; 
?>