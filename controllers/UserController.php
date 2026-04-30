<?php
require_once 'models/User.php';

function register() {
    $error = '';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username  = $_POST['username'];
        $password  = $_POST['password'];
        $usertype  = $_POST['usertype'];
        $name      = $_POST['name'];
        $email     = $_POST['email'];
        $contactno = $_POST['contactno'];
        $office    = $_POST['office'];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = 'Invalid email format.';
        } elseif (!in_array($usertype, ['admin', 'user'])) {
            $error = 'Invalid user type.';
        } elseif (strlen($password) < 8) {
            $error = 'Password must be at least 8 characters.';
        } elseif (!preg_match('/[A-Z]/', $password)) {
            $error = 'Password must contain at least one uppercase letter.';
        } elseif (!preg_match('/[a-z]/', $password)) {
            $error = 'Password must contain at least one lowercase letter.';
        } elseif (!preg_match('/[0-9]/', $password)) {
            $error = 'Password must contain at least one number.';
        } elseif (!preg_match('/[\W]/', $password)) {
            $error = 'Password must contain at least one special character.';
        } elseif (findByUsername($username)) {
            $error = 'Username already exists.';
        } else {
            registerUser($username, $password, $usertype, $name, $email, $contactno, $office);
            echo json_encode(['success' => true, 'message' => 'User added successfully.']);
            return;
        }
        echo json_encode(['success' => false, 'message' => $error]);
        return;
    }

    require_once 'views/add_user.php';
}

function login() {
    $error = '';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $user = findByUsername($username);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id']  = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['usertype'] = $user['usertype'];
            if ($user['usertype'] == 'admin') {
                header('Location: index.php?page=add_user');
            } else {
                header('Location: index.php?page=dashboard');
            }
            exit;
        } else {
            $error = 'Invalid username or password.';
        }
    }

    require_once 'views/login.php';
}
