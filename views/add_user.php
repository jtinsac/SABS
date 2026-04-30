<?php 
if (!isset($_SESSION['username'])) { header('Location: index.php?page=login'); exit; }
if ($_SESSION['usertype'] != 'admin') { header('Location: index.php?page=dashboard'); exit; }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <header class="header">
        <span>Welcome, <?= htmlspecialchars($_SESSION['username']) ?>!</span>
        <a href="index.php?page=logout">Logout</a>
    </header>
    <div class="layout">
        <?php require_once 'includes/sidebar.php'; ?>
        <main class="main">
            <h2>Add User</h2>
            <br>
            <button class="btn-add" onclick="openAddUser()">+ Add User</button>
        </main>
    </div>

    <script>
        function openAddUser() {
            Swal.fire({
                title: 'Add User',
                width: 500,
                html: `
                    <form id="addUserForm">
                        <input class="swal2-input" type="text" name="username" placeholder="Username" required><br>
                        <input class="swal2-input" type="password" name="password" placeholder="Password" required><br>
                        <select class="swal2-input" name="usertype" required>
                            <option value="" disabled selected>Select User Type</option>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select><br>
                        <input class="swal2-input" type="text" name="name" placeholder="Name" required><br>
                        <input class="swal2-input" type="email" name="email" placeholder="Email" required><br>
                        <input class="swal2-input" type="text" name="contactno" placeholder="Contact No." required><br>
                        <input class="swal2-input" type="text" name="office" placeholder="Office" required><br>
                    </form>
                `,
                showCancelButton: true,
                confirmButtonText: 'Add User',
                preConfirm: () => {
                    const form = document.getElementById('addUserForm');
                    const formData = new FormData(form);

                    return fetch('index.php?page=add_user', {
                        method: 'POST',
                        body: formData
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (!data.success) {
                            Swal.showValidationMessage(data.message);
                        }
                        return data;
                    });
                }
            }).then(result => {
                if (result.isConfirmed && result.value.success) {
                    Swal.fire('Success', 'User added successfully!', 'success');
                }
            });
        }
    </script>
</body>
</html>
