<?php
// Connexion à Redis
$redis = new Redis();
$redis->connect('localhost', 6379);
?>