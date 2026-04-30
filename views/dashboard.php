<?php if (!isset($_SESSION['username'])) { header('Location: index.php?page=login'); exit; } ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .swal2-file-label { display: block; text-align: left; margin: 0.5rem 1.5rem 0.25rem; font-size: 0.9rem; }
        input[type="file"].swal2-input { padding: 0.3rem; cursor: pointer; }
    </style>
</head>
<body>
    <header class="header">
        <span>Welcome, <?= htmlspecialchars($_SESSION['username']) ?>!</span>
        <a href="index.php?page=logout">Logout</a>
    </header>
    <div class="layout">
        <?php require_once 'includes/sidebar.php'; ?>
        <main class="main">
            <h2>Dashboard</h2>
        </main>
    </div>
</body>
</html>
