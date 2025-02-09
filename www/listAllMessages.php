<?php

include('db.php');

// Requête SQL pour récupérer tous les messages
$sql = "SELECT * FROM messages";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

?>
<html>
<head>
    <link rel="stylesheet" href="/bootstrap-5/css/bootstrap.min.css">
    <link rel="stylesheet" href="/style.css">
    <title>TP Messagerie</title>
</head>
<body>
    <div id="mainContainer">
        <div id="nav" class="pageZone" style="display: flex; flex-flow: row nowrap; justify-content: flex-start; align-items: flex-end; gap: 1em">
            <h1>Messagerie - Tous les messages</h1>
        </div>
        <div id="sideBar" class="card pageZone">
            <div class="card-header">
                Menu
            </div>
            <div class="card-body" style="display: flex; flex-flow: column nowrap; gap: 1em; justify-content: center; align-items: center; min-width: 10em">
                <div class="btn-group-vertical" role="group" aria-label="Vertical button group">
                    <a href="/" class="btn btn-primary">Home</a>
                    <a href="/listAllMessages.php" class="btn btn-primary">Tous les messages</a>
                    <a href="http://localhost:8085/?pma_username=root&pma_password=BestPasswordEver:)&server=db" l class="btn btn-secondary">PhpMyAdmin</a>
                </div>
            </div>
        </div>

        <div id="content" class="pageZone d-flex gap-3 flex-row">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Sender</th>
                        <th scope="col"></th>
                        <th scope="col">Receiver</th>
                        <th scope="col">Message</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['sender_id'] . "</td>";
                    echo "<td> ➡️</td>";
                    echo "<td>" . $row['receiver_id'] . "</td>";
                    echo "<td>" . $row['message'] . "</td>";
                    echo "</tr>";
                }
                ?>
                </tbody>
            </table>

        </div>
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"></script>
<script src="/bootstrap-5/js/bootstrap.min.js"></script>
</html>