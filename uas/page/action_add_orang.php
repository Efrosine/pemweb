<?php
session_start();
include '../db/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uuid_user = $conn->real_escape_string($_POST['uuid_user']);
    $class_id = $_POST['class_id'];

    // Get user_id by UUID
    $sql = "SELECT user_id FROM user WHERE uuid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $uuid_user);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        $user_id = $user['user_id'];

        // Check if user is already in the class
        $check_sql = "SELECT * FROM class_member WHERE user_id = ? AND class_id = ?";
        $check_stmt = $conn->prepare($check_sql);
        $check_stmt->bind_param("ii", $user_id, $class_id);
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();

        if ($check_result->num_rows == 0) {
            // Add user to class
            $insert_sql = "INSERT INTO class_member (user_id, class_id) VALUES (?, ?)";
            $insert_stmt = $conn->prepare($insert_sql);
            $insert_stmt->bind_param("ii", $user_id, $class_id);
            if ($insert_stmt->execute()) {
                header("Location: home.php?page=class_content&class_id=$class_id&tab=orang");
            } else {
                header("Location: home.php?page=class_content&class_id=$class_id&tab=orang&error=Gagal menambah user.");
            }
        } else {
            header("Location: home.php?page=class_content&class_id=$class_id&tab=orang&error=User sudah terdaftar di kelas.");
        }
    } else {
        header("Location: home.php?page=class_content&class_id=$class_id&tab=orang&error=UUID tidak ditemukan.");
    }

    $stmt->close();
    $conn->close();
}
