<?php
$pdo = new PDO('mysql:host=localhost;dbname=food_delivery', 'root', '');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nom'])) {
    $nom = $_POST['nom'];
    $image = $_POST['image'];
    $lien = $_POST['lien'];

    $stmt = $pdo->prepare("INSERT INTO restaurants (nom, image, lien) VALUES (?, ?, ?)");
    $stmt->execute([$nom, $image, $lien]);
}

$stmt = $pdo->query("SELECT * FROM restaurants");
$restaurants = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="menu-style.css">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
    <title>Food Delivery App</title>
</head>

<body>
<section class="menu">
    <div class="nav">
        <div class="logo">
            <h1>Food<b>io</b></h1>
        </div>
        <ul>
            <li><a href="Accueil.php">Accueil</a></li>
            <li><a href="menu.php">Restaurent</a></li>
            <li><a href="service.php">Services</a></li>
            <li><a href="about.php">À Propos</a></li>
        </ul>
        <div class="auth-buttons">
            <label for="signin-modal" class="signin-btn">Se Connecter</label>
            <label for="signup-modal" class="signup-btn">S'inscrire</label>
        </div>
    </div>
</section>
<input type="checkbox" id="signin-modal" class="modal-toggle">
<div class="modal">
    <div class="modal-content">
        <label for="signin-modal" class="close-btn">&times;</label>
        <h3>Formulaire de Connexion</h3>
        <input type="email" placeholder="Email" />
        <input type="password" placeholder="Mot de passe" />
        <button>Se connecter</button>
    </div>
</div>
<input type="checkbox" id="signup-modal" class="modal-toggle">
<div class="modal">
    <div class="modal-content">
        <label for="signup-modal" class="close-btn">&times;</label>
        <h3>Formulaire d'Inscription</h3>
        <input type="text" placeholder="Nom" />
        <input type="email" placeholder="Email" />
        <input type="password" placeholder="Mot de passe" />
        <button>S'inscrire</button>
    </div>
</div>

<section class="category">
    <div class="list-items">
        <br><br>
        <div class="card-list">
            <?php foreach ($restaurants as $resto): ?>
                <a href="<?= htmlspecialchars($resto['lien']) ?>" class="card-link">
                    <div class="card">
                        <img src="<?= htmlspecialchars($resto['image']) ?>" alt="<?= htmlspecialchars($resto['nom']) ?>">
                        <div class="food-title">
                            <h1><?= htmlspecialchars($resto['nom']) ?></h1>
                        </div>
                        <div class="desc-title">
                            <p></p>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
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