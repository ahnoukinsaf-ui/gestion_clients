<?php
session_start();
/* Protection par authentification */
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
include "connexion.php";
$username = "admin";   
$password = "123456";
$hash = password_hash($password, PASSWORD_DEFAULT);
$sql = "INSERT INTO users (username, password)
        VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username, $hash);
if ($stmt->execute()) {
    echo "Utilisateur créé correctement";
} else {
    echo "Erreur lors de la création";
}
?>
