<?php
require_once 'config/database.php';

function findByUsername($username) {
    global $conn;
    $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
    return mysqli_fetch_assoc($result);
}

function registerUser($username, $password, $usertype, $name, $email, $contactno, $office) {
    global $conn;
    $hashed = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (username, password, usertype, name, email, contactno, office) 
            VALUES ('$username', '$hashed', '$usertype', '$name', '$email', '$contactno', '$office')";
    return mysqli_query($conn, $sql);
}
