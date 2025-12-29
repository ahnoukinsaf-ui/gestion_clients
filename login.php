<?php
session_start();
include "connexion.php";
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $username;
            header("Location: index.php");
        } else {
            $erreur = "Mot de passe incorrect";
        }
    } else {
        $erreur = "Utilisateur non trouvé";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title> 
    <link rel="stylesheet" href="ressources/login_style.css">

</head>
<body>
<div class="login-container">
    <h2>Connexion</h2>
    <form method="post">
        <label>Nom d'utilisateur :</label>
        <input type="text" name="username" required>

        <label>Mot de passe :</label>
        <input type="password" name="password" required>

        <input type="submit" name="login" value="Se connecter">
    </form>

    <?php
    if (isset($erreur)) {
        echo "<div class='error-message'>$erreur</div>";
    }
    ?>
</div>
</body>
</html>
