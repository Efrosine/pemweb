<?php
include '../db/koneksi.php';

session_start();

$error_msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uuid = $conn->real_escape_string($_POST['uuid']);
    $password = $conn->real_escape_string($_POST['password']);

    $sql = "SELECT * FROM user WHERE uuid = '$uuid'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['role'] = $row['role'];
            header("Location: home.php");
            exit;
        } else {
            $error_msg = "Password salah. Silakan coba lagi.";
        }
    } else {
        $error_msg = "UUID tidak ditemukan. Silakan coba lagi.";
    }
    $conn->close();
}

if (!empty($error_msg)) {
    header("Location: form_login.php?error=" . urlencode($error_msg));
    exit;
}
