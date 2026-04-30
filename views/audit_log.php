<?php if (!isset($_SESSION['username'])) { header('Location: index.php?page=login'); exit; } ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Audit Log</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header class="header">
        <span>Welcome, <?= htmlspecialchars($_SESSION['username']) ?>!</span>
        <a href="index.php?page=logout">Logout</a>
    </header>
    <div class="layout">
        <?php require_once 'includes/sidebar.php'; ?>
        <main class="main">
            <h2>Audit Log</h2>
        </main>
    </div>
</body>
</html>
