<?php
// Inclure la connexion à la base de données
include('db/connection.php');

// Récupérer les données du formulaire
$email = $_POST['email'];
$password = $_POST['password'];
$role = $_POST['role'];

// Rechercher l'utilisateur avec le bon email et rôle
$sql = "SELECT * FROM users WHERE email = ? AND role = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ss', $email, $role);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
if ($user && password_verify($password, $user['password'])) {
    // Connexion réussie

    // Démarrer la session et stocker les infos utilisateur
    session_start();
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_email'] = $user['email'];
    $_SESSION['user_role'] = $user['role'];

    // Rediriger selon le rôle
    switch ($role) {
        case 'client':
            header('Location: Accueil.php');
            break;
        case 'restaurant':
            header('Location: menu.php');
            break;
        case 'livreur':
            header('Location: livreur.html');
            break;
    }
    exit;
} else {
    // Identifiants invalides
    echo "<p style='color:red; text-align:center;'>Email ou mot de passe incorrect.</p>";
}
?>
