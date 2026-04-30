<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="auth">
    <div class="container">
        <h2>Register</h2>
        <?php if (!empty($error)): ?>
            <p class="error"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>
        <form method="POST">
            <label>Username</label>
            <input type="text" name="username" value="<?= isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '' ?>">

            <label>Password</label>
            <input type="password" name="password">

            <label>User Type</label>
            <select name="usertype">
                <option value="" disabled selected>Select User Type</option>
                <option value="admin" <?= (isset($_POST['usertype']) && $_POST['usertype'] == 'admin') ? 'selected' : '' ?>>Admin</option>
                <option value="user" <?= (isset($_POST['usertype']) && $_POST['usertype'] == 'user') ? 'selected' : '' ?>>User</option>
            </select>

            <label>Name</label>
            <input type="text" name="name" value="<?= isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '' ?>">

            <label>Email</label>
            <input type="email" name="email" value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>">

            <label>Contact No.</label>
            <input type="text" name="contactno" value="<?= isset($_POST['contactno']) ? htmlspecialchars($_POST['contactno']) : '' ?>">

            <label>Office</label>
            <input type="text" name="office" value="<?= isset($_POST['office']) ? htmlspecialchars($_POST['office']) : '' ?>">

            <button type="submit">Register</button>
        </form>
        <p>Already have an account? <a href="index.php?page=login">Login</a></p>
    </div>
</body>
</html>
