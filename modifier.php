<?php 
session_start();

/* Protection par authentification */
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include "connexion.php";
$id = $_GET["id"];
$res = $conn->query("SELECT * FROM clients WHERE id=$id");
$client = $res->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $sexe = $_POST["sexe"];
    $ville = $_POST["ville"];
    $loisirs = isset($_POST["loisirs"]) ? implode(",", $_POST["loisirs"]) : "";

    $conn->query("UPDATE clients SET 
        nom='$nom',
        prenom='$prenom',
        sexe='$sexe',
        ville='$ville',
        loisirs='$loisirs'
        WHERE id=$id");

    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier client</title>
    <link rel="stylesheet" href="ressources/modifier.css">
</head>

<body>

<h2>Modifier le client</h2>

<form method="POST">

    <label>Nom :</label>
    <input type="text" name="nom" value="<?= $client['nom'] ?>">

    <label>Prenom :</label>
    <input type="text" name="prenom" value="<?= $client['prenom'] ?>">

    <label>Sexe :</label>
    <select name="sexe">
        <option >Homme</option>
        <option <?= $client['sexe']=="Femme" ? "selected" : "" ?>>Femme</option>
    </select>

    <label>Ville :</label>
    <input type="text" name="ville" value="<?= $client['ville'] ?>">

    <?php $L = explode(",", $client['loisirs']); ?>

    <label>Loisirs :</label>
    <div class="checkbox-group">
        <label><input type="checkbox" name="loisirs[]" value="Sport"   <?= in_array("Sport",$L)?"checked":"" ?>> Sport</label>
        <label><input type="checkbox" name="loisirs[]" value="Musique" <?= in_array("Musique",$L)?"checked":"" ?>> Musique</label>
        <label><input type="checkbox" name="loisirs[]" value="Lecture" <?= in_array("Lecture",$L)?"checked":"" ?>> Lecture</label>
    </div>

    <button class="btn-save">Modifier</button>
    <a href="index.php" class="btn-return">Annuler</a>

</form>
</body>
</html>
 