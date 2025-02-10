<?php

include('db.php');

// Récupérer l'ID de l'utilisateur à partir du paramètre d'URL
if (isset($_GET['user'])) {
    $user_id = $_GET['user'];

    // Requête SQL pour récupérer les messages reçus par l'utilisateur
    $sql = "SELECT * FROM messages WHERE receiver_id = ?";
    /** @var mysqli $conn */
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
}

?>
<html>
    <head>
        <link rel="stylesheet" href="/bootstrap-5/css/bootstrap.min.css">
        <link rel="stylesheet" href="/style.css">
        <title>TP Messagerie</title>
    </head>
    <body>
        <div id="mainContainer">
            <div id="nav"
                 class="pageZone"
                 style="display: flex; flex-flow: row nowrap; justify-content: flex-start; align-items: flex-end; gap: 1em">
                <h1>Messagerie - Accueil</h1>
            </div>
            <div id="sideBar" class="card pageZone">
                <div class="card-header">
                    Menu
                </div>
                <div class="card-body" style="display: flex; flex-flow: column nowrap; gap: 1em; justify-content: center; align-items: center; min-width: 10em">
                    <div class="btn-group-vertical" role="group" aria-label="Vertical button group">
                        <a href="/" class="btn btn-primary">Home</a>
                        <a href="/listAllMessages.php" class="btn btn-primary">Tous les messages</a>
                        <a href="http://localhost:8085/?pma_username=root&pma_password=BestPasswordEver:)&server=db"
                           target="_blank"
                           class="btn btn-secondary">
                            PhpMyAdmin
                        </a>
                    </div>
                </div>
            </div>

            <div id="content" class="pageZone d-flex gap-3 flex-row">
                <div class="card">
                    <div class="card-header">
                        Send message
                    </div>
                    <div class="card-body">
                        <form action="/sendmessage.php" method="post" class="needs-validation" novalidate>
                            <div class="mb-3">
                                <label for="senderId" class="form-label">Sender ID</label>
                                <input type="text" class="form-control" id="senderId" name="sender_id" required>
                                <div class="invalid-feedback">
                                    Please provide a valid sender ID.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="receiverId" class="form-label">Receiver ID</label>
                                <input type="text" class="form-control" id="receiverId" name="receiver_id" required>
                                <div class="invalid-feedback">
                                    Please provide a valid receiver ID.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">Message</label>
                                <textarea class="form-control" id="message" name="message" required></textarea>
                                <div class="invalid-feedback">
                                    Please enter a message.
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Send Message</button>
                        </form>
                        <?php
                            if(isset($_GET['success']) && ($_GET['success'] == 'true')) {
                                echo '<p style="color: green">Message envoyé avec succès</p>';
                            }
                        ?>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        Query User ID
                    </div>
                    <div class="card-body">
                        <form action="" method="GET">
                            <div class="form-group">
                                <label for="user">User ID:</label>
                                <input type="text" class="form-control" id="user" name="user" placeholder="Enter User ID" required
                                value="<?php if (isset($_GET['user'])) {echo $_GET['user'];}?>">
                            </div>
                            <button type="submit" class="btn btn-primary mt-2">Rechercher</button>
                        </form>
                    </div>
                </div>


                <div class="card">
                    <div class="card-header">
                        Messages Received
                    </div>
                    <div class="card-body">
                        <?php if (isset($result) && $result->num_rows > 0): ?>
                            <ul class="list-group">
                                <?php while ($row = $result->fetch_assoc()): ?>
                                    <li class="list-group-item">
                                        <strong>From:</strong> <?php echo htmlspecialchars($row['sender_id']); ?><br>
                                        <strong>Message:</strong> <?php echo htmlspecialchars($row['message']); ?>
                                    </li>
                                <?php endwhile; ?>
                            </ul>
                        <?php else: ?>
                            <p>No messages found.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </body>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"></script>
    <script src="/bootstrap-5/js/bootstrap.min.js"></script>
</html>