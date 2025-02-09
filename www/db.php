<?php
// Paramètres de connexion à la base de données
$servername = "db";
$username = "phpServer";
$password = "paT[zEc7WmNvhPrE";
$dbname = "web";

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    echo "<p style='color: red'>Connexion à la BDD SQL échouée: " . $conn->connect_error . "</p>";
    exit;
}

?>
