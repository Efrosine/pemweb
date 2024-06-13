<?php
include '../db/koneksi.php'; // Menghubungkan ke database

$error_msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uuid = $conn->real_escape_string($_POST['uuid']);
    $nama = $conn->real_escape_string($_POST['nama']);
    $email = $conn->real_escape_string($_POST['email']);
    $role = $conn->real_escape_string($_POST['role']);
    $password = password_hash($conn->real_escape_string($_POST['password']), PASSWORD_BCRYPT);

    $profile_pic = null;
    if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] == 0) {
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        if (in_array($_FILES['profile_pic']['type'], $allowed_types)) {
            $profile_pic = '../data/profilepic/' . basename($_FILES['profile_pic']['name']);
            move_uploaded_file($_FILES['profile_pic']['tmp_name'], '../' . $profile_pic);
        } else {
            $error_msg = "File yang diupload harus berupa gambar.";
        }
    }

    if (empty($error_msg)) {
        $check_uuid = "SELECT * FROM user WHERE uuid='$uuid'";
        $result = $conn->query($check_uuid);

        if ($result->num_rows > 0) {
            $error_msg = "UUID sudah digunakan.";
        } else {
            $sql = "INSERT INTO user (uuid, name, email, role, profile_pic, password)
                    VALUES ('$uuid', '$nama', '$email', '$role', '$profile_pic', '$password')";

            if ($conn->query($sql) === TRUE) {
                header("Location: form_login.php");
                exit();
            } else {
                $error_msg = "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }

    if (!empty($error_msg)) {
        header("Location: form_regis.php?error=" . urlencode($error_msg));
        exit();
    }
}

$conn->close();
