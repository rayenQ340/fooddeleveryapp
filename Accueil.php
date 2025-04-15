<?php
// Connexion à la base de données
include("db/connection.php");

// Récupération des éléments du menu
$query = "SELECT * FROM menu_items";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>Accueil - Foodio</title>
</head>
<body>
<section class="menu">
    <div class="nav">
        <div class="logo">
            <h1>Food<b>io</b></h1>
        </div>
        <ul>
            <li><a href="Accueil.php">Accueil</a></li>
            <li><a href="menu.php">Restaurant</a></li>
            <li><a href="service.php">Services</a></li>
            <li><a href="about.php">À Propos</a></li>
            <li><a href="livreur.php">Livreur</a></li>
        </ul>
        <div class="auth-buttons">
            <a href="index.html" class="signin-btn">Déconnexion</a>
        </div>


    </div>
</section>




<section class="hero">
    <div class="grid">
        <div class="content-left">
            <h2>Commander vos plats préférés</h2>
            <p>Découvrez une sélection des plats les plus savoureux directement chez vous.</p>
        </div>
        <div class="content-right">
            <img src="img/img2.png" alt="Image de plats savoureux">
        </div>
    </div>
</section>

<section class="category">
    <h3>Plats Populaires</h3>
    <div class="card-list">
        <?php while ($row = $result->fetch_assoc()) { ?>
        <div class="card">
            <img src="img/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>">
            <div class="food-title">
                <h1><?php echo $row['name']; ?></h1>
            </div>
            <div class="desc-title">
                <p><?php echo $row['description']; ?></p>
            </div>
        </div>
        <?php } ?>
    </div>
</section>

<footer>
    <div class="footer-container">
        <div class="logo">
            <h1>Food<b>io</b></h1>
        </div>
        <div class="links">
            <a href="Accueil.php">Accueil</a>
            <a href="menu.php">Menu</a>
            <a href="service.php">Services</a>
            <a href="about.php">À Propos</a>
            <a href="order.php">Galerie</a>
        </div>
        <div class="social-icons">
            <a href="#"><i class="bx bxl-facebook"></i></a>
            <a href="#"><i class="bx bxl-twitter"></i></a>
            <a href="#"><i class="bx bxl-instagram"></i></a>
            <a href="#"><i class="bx bxl-linkedin"></i></a>
        </div>
        <p>&copy; 2024 Foodio. Tous droits réservés.</p>
    </div>
</footer>
</body>
</html>
