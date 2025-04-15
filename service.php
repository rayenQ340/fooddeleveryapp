<?php
// Connexion à la base de données
include("db/connection.php");

// Récupération des services depuis la base de données
$services_query = "SELECT * FROM services";
$services_result = $conn->query($services_query);

// Vérification si l'utilisateur est connecté
session_start();
$is_logged_in = isset($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services - Foodio</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="service-style.css">
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
            <li><a href="service.php" class="active">Services</a></li>
            <li><a href="about.php">À Propos</a></li>
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

<section class="services">
    <h1>Nos Services</h1>
    <p class="subtitle">Découvrez tout ce que nous vous offrons pour une expérience culinaire exceptionnelle</p>

    <div class="service-container">
        <?php if ($services_result && $services_result->num_rows > 0): ?>
        <?php while($service = $services_result->fetch_assoc()): ?>
        <div class="service-box">
            <div class="icon"><i class="<?php echo htmlspecialchars($service['icon_class']); ?>"></i></div>
            <h2><?php echo htmlspecialchars($service['title']); ?></h2>
            <p><?php echo htmlspecialchars($service['description']); ?></p>
            <?php if ($is_logged_in && isset($service['button_text'])): ?>
            <a href="<?php echo htmlspecialchars($service['link'] ?? '#'); ?>" class="service-btn">
                <?php echo htmlspecialchars($service['button_text']); ?>
            </a>
            <?php endif; ?>
        </div>
        <?php endwhile; ?>
        <?php else: ?>
        <p class="no-services">Aucun service disponible pour le moment.</p>
        <?php endif; ?>
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