<?php
// register.php

// 1. Connexion à la base de données
require_once 'db/connection.php'; // Ce fichier doit définir $conn (voir en bas)

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 2. Récupération et vérification des données du formulaire
    $nom = $_POST['nom'] ?? '';
    $prenom = $_POST['prenom'] ?? '';
    $email = $_POST['email'] ?? '';
    $mdp = $_POST['password'] ?? '';
    $confirm_mdp = $_POST['confirm_password'] ?? '';
    $adresse = $_POST['adresse'] ?? '';
    $telephone = $_POST['telephone'] ?? '';
    $role = $_POST['role'] ?? '';

    // 3. Validation de base
    if (empty($nom) || empty($prenom) || empty($email) || empty($mdp) || empty($confirm_mdp) || empty($adresse) || empty($telephone) || empty($role)) {
        die("Veuillez remplir tous les champs requis.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Adresse email invalide.");
    }

    if ($mdp !== $confirm_mdp) {
        die("Les mots de passe ne correspondent pas.");
    }

    // 4. Hash du mot de passe
    $mdp_hash = password_hash($mdp, PASSWORD_DEFAULT);

    // 5. Champs spécifiques selon le rôle
    $vehicule = null;
    $image_path = null;

    if ($role === "livreur") {
        $vehicule = $_POST['vehicule'] ?? null;
    }

    if ($role === "restaurant" && isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $image_name = basename($_FILES['image']['name']);
        $upload_dir = "uploads/";

        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $image_path = $upload_dir . time() . "_" . $image_name;

        if (!move_uploaded_file($_FILES['image']['tmp_name'], $image_path)) {
            die("Erreur lors de l'upload de l'image.");
        }
    }

    // 6. Insertion dans la base de données
    $sql = "INSERT INTO users (nom, prenom, email, password, adresse, telephone, role, vehicule, image)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssss", $nom, $prenom, $email, $mdp_hash, $adresse, $telephone, $role, $vehicule, $image_path);

    if ($stmt->execute()) {
        header("Location: index.html?success=1");
        exit();
    } else {
        if ($conn->errno == 1062) {
            die("Cette adresse email est déjà utilisée.");
        } else {
            die("Erreur lors de l'inscription : " . $stmt->error);
        }
    }

    $stmt->close();
    $conn->close();
} else {
    die("Méthode non autorisée.");
}
?>
