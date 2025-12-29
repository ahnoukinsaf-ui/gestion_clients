<?php 
session_start();
/* Protection par authentification */
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}


  include "connexion.php";
  $result = $conn->query("SELECT * FROM clients");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Liste des clients</title>
    <link rel="stylesheet" href="ressources/style.css"> 
    <a href="logout.php" class="bouton" style="background-color:gray;">Logout</a>

</head>
<body class="container ">

<h2>Liste des clients</h2>

<a href="ajouter.php" class="bouton">Ajouter un client</a>

<table class="tableau">
    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Sexe</th>
        <th>Ville</th>
        <th>Loisirs</th>
        <th>Actions</th>
    </tr>
<?php while ($row = $result->fetch_assoc()) { ?>
    <tr>
        <td><?php echo $row['id'] ?></td>
        <td><?php echo $row['nom'] ?></td>
        <td><?php echo $row['prenom'] ?></td>
        <td><?php echo $row['sexe'] ?></td>
        <td><?php echo $row['ville'] ?></td>
        <td><?php echo $row['loisirs'] ?></td>
        <td>
            <!-- Bouton Modifier -->
            <a href="modifier.php?id=<?php echo $row['id']; ?>" class="bouton" style="background-color:orange;">Modifier</a>
            <!-- Bouton Supprimer -->
            <a href="supprimer.php?id=<?php echo $row['id']; ?>" class="bouton" style="background-color:red;" onclick="return confirm('Supprimer ?');">Supprimer</a>
        </td>
    </tr>
<?php } ?>
</table>
</body>
</html>
