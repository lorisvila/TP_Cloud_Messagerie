<?php
// Connexion à Redis
$redis = new Redis();
$redis->connect('redis', 6379); // Change to your actual Redis connection details

// Connexion à MySQL
$mysql = new mysqli('db', 'root', 'BestPasswordEver:)', 'web'); // Change to your actual MySQL connection details

// Vérifier la connexion
if ($mysql->connect_error) {
    die("Connection failed: " . $mysql->connect_error);
}

// Boucle pour consommer les messages
while (true) {
    // Récupérer le dernier message de la liste
    $message = $redis->rPop('messages');

    // Si il n'y a pas de message, attendre 1 seconde et réessayer
    if ($message === false) {
        sleep(1);
        continue;
    }

    // Décode le message JSON
    $message_data = json_decode($message, true);

    // Insérer le message dans la base de données
    $sql = "INSERT INTO messages (sender_id, receiver_id, message) VALUES (?, ?, ?)";
    $stmt = $mysql->prepare($sql);
    $stmt->bind_param("sss", $message_data['sender_id'], $message_data['receiver_id'], $message_data['message']);
    $stmt->execute();

    // Fermer la déclaration
    $stmt->close();
}

// Fermer la connexion à MySQL
$mysql->close();
?>
