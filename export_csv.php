<?php
include "connexion.php";

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=clients.csv');

$output = fopen('php://output', 'w');
fputcsv($output, array('ID', 'Nom', 'Prenom', 'Sexe', 'Ville', 'Loisirs'));

$rows = $conn->query("SELECT * FROM clients");
while ($row = $rows->fetch_assoc()) {
    fputcsv($output, $row);
}
fclose($output);
?>
