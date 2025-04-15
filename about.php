<?php
// Connexion à la base de données
include("db/connection.php");

// Vérification si l'utilisateur est connecté
session_start();
$is_logged_in = isset($_SESSION['user_id']);

// Récupération des chefs depuis la base de données
$chefs_query = "SELECT * FROM chefs ORDER BY RAND() LIMIT 4";
$chefs_result = $conn->query($chefs_query);

// Récupération de l'histoire du restaurant
$story_query = "SELECT * FROM restaurant_info WHERE key_name = 'our_story'";
$story_result = $conn->query($story_query);
$our_story = $story_result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>À Propos - Foodio</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="about-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
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
            <li><a href="about.php" class="active">À Propos</a></li>
            <li><a href="livreur.php">Livreur</a></li>
        </ul>
        <div class="auth-buttons">
            <?php if ($is_logged_in): ?>
            <span>Bienvenue, <?php echo htmlspecialchars($_SESSION['user_name'] ?? 'Utilisateur'); ?></span>
            <a href="logout.php" class="signout-btn">Déconnexion</a>
            <?php else: ?>
            <label for="signin-modal" class="signin-btn">Se Connecter</label>
            <label for="signup-modal" class="signup-btn">S'inscrire</label>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Modals de connexion/inscription -->
<input type="checkbox" id="signin-modal" class="modal-toggle">
<div class="modal">
    <div class="modal-content">
        <label for="signin-modal" class="close-btn">&times;</label>
        <h3>Formulaire de Connexion</h3>
        <form action="login.php" method="POST">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <button type="submit">Se connecter</button>
        </form>
    </div>
</div>

<input type="checkbox" id="signup-modal" class="modal-toggle">
<div class="modal">
    <div class="modal-content">
        <label for="signup-modal" class="close-btn">&times;</label>
        <h3>Formulaire d'Inscription</h3>
        <form action="register.php" method="POST">
            <input type="text" name="name" placeholder="Nom complet" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <button type="submit">S'inscrire</button>
        </form>
    </div>
</div>

<section class="about-us">
    <div class="about-text">
        <h1>À Propos de Nous</h1>
        <p>Nous nous engageons à offrir des expériences culinaires exceptionnelles, combinant des ingrédients frais, des recettes innovantes et une passion pour un service hors pair.</p>
    </div>
    <div class="about-image">
        <img src="img/logo.png" alt="Logo Foodio">
    </div>
</section>

<section class="our-chefs">
    <h2>Nos Chefs Étoilés</h2>
    <div class="chefs-grid">
        <?php if ($chefs_result && $chefs_result->num_rows > 0): ?>
        <?php while($chef = $chefs_result->fetch_assoc()): ?>
        <div class="chef-card">
            <img src="img/<?php echo htmlspecialchars($chef['photo']); ?>" alt="<?php echo htmlspecialchars($chef['name']); ?>">
            <h3><?php echo htmlspecialchars($chef['name']); ?></h3>
            <p><?php echo htmlspecialchars($chef['specialty']); ?></p>
            <p class="chef-bio"><?php echo htmlspecialchars($chef['bio']); ?></p>
        </div>
        <?php endwhile; ?>
        <?php else: ?>
        <p class="no-chefs">Aucun chef à afficher pour le moment.</p>
        <?php endif; ?>
    </div>
</section>

<section class="our-story">
    <h2>Notre Histoire</h2>
    <p><?php echo htmlspecialchars($our_story['value'] ?? 'Notre histoire est en cours d\'écriture...'); ?></p>

    <div class="milestones">
        <div class="milestone">
            <h3>2015</h3>
            <p>Ouverture de notre premier restaurant</p>
        </div>
        <div class="milestone">
            <h3>2018</h3>
            <p>Première étoile au guide Michelin</p>
        </div>
        <div class="milestone">
            <h3>2020</h3>
            <p>Lancement de notre service de livraison</p>
        </div>
        <div class="milestone">
            <h3>2024</h3>
            <p>Ouverture de notre 5ème établissement</p>
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
            <a href="#"><i class='bx bxl-facebook'></i></a>
            <a href="#"><i class='bx bxl-twitter'></i></a>
            <a href="#"><i class='bx bxl-instagram'></i></a>
            <a href="#"><i class='bx bxl-linkedin'></i></a>
        </div>
        <p>&copy; <?php echo date('Y'); ?> Foodio. Tous droits réservés.</p>
    </div>
</footer>
</body>
</html>