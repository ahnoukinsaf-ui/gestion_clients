<?php 
session_start();

/* Protection par authentification */
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}


include "connexion.php";

$id = $_GET["id"];
$conn->query("DELETE FROM clients WHERE id=$id");

header("Location: index.php");
exit();
?>
