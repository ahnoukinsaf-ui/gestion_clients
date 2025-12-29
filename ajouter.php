<?php 
session_start();

/* Protection par authentification */
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include "connexion.php"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $sexe = $_POST["sexe"];
    $ville = $_POST["ville"];
    $loisirs = isset($_POST["loisirs"]) ? implode(",", $_POST["loisirs"]) : "";
    $sql = "INSERT INTO clients (nom, prenom, sexe, ville, loisirs)
            VALUES ('$nom', '$prenom', '$sexe', '$ville', '$loisirs')";
    $conn->query($sql);
    header("Location: index.php"); 
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un client</title>
    <link rel="stylesheet" href="ressources/ajstyle.css">
    <script src="ressources/validation.js"></script>
</head>
<body>
<h2>Ajouter un client</h2>
<form method="POST" onsubmit="return verifierFormulaire();">
    <label>Nom :</label>
    <input type="text" id="nom" name="nom" placeholder="Nom">
    <label>Prénom :</label>
    <input type="text" id="prenom" name="prenom" placeholder="Prénom">
    <label>Sexe :</label>
    <select id="sexe" name="sexe">
    <option value="">-- Choisir --</option>
    <option value="Homme">Homme</option>
    <option value="Femme">Femme</option>
    </select>
    <label>Ville :</label>
    <input type="text" id="ville" name="ville" placeholder="Ville">
    <div class="checkbox-group">
    <label>Sport <input type="checkbox" name="loisirs[]" value="Sport"></label>
    <label>Musique <input type="checkbox" name="loisirs[]" value="Musique"></label>
    <label>Lecture <input type="checkbox" name="loisirs[]" value="Lecture"></label>
   </div>
    <button class="btn btn-save">Enregistrer</button>
    <a href="index.php" class="btn btn-return">Retour</a>
</form>
</body>
</html>
