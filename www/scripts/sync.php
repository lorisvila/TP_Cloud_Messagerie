<?php
include("../redis.php"); // Connexion au cache Redis
include("../db.php"); // Connexion à la BDD MySQL

// Boucle pour consommer les messages
while (true) {
    // Récupérer le dernier message de la liste
    /** @var Redis $redis */
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
    /** @var mysqli $conn */
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $message_data['sender_id'], $message_data['receiver_id'], $message_data['message']);
    $stmt->execute();

    // Fermer la déclaration
    $stmt->close();
}

// Fermer la connexion à MySQL
$mysql->close();
?>
