<?php
include("redis.php");

if (!(isset($_POST['sender_id']) && isset($_POST['receiver_id']) && isset($_POST['message']))) {
    echo "There are values missing in you form...";
    exit(500);
}

// Récupérer les données du formulaire
$sender_id = $_POST['sender_id'];
$receiver_id = $_POST['receiver_id'];
$message = $_POST['message'];

// Créer un tableau avec les données du message
$message_data = [
    'sender_id' => $sender_id,
    'receiver_id' => $receiver_id,
    'message' => $message,
];

// Sérialiser les données du message en JSON
$message_json = json_encode($message_data);

// Utiliser l'instruction LPUSH pour ajouter le message à la liste "messages"
/** @var Redis $redis */
$redis->lPush('messages', $message_json);

// Redirection vers la page principale
header('Location: /?success=true');
exit;
?>