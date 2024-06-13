<?php
session_start();
include '../db/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_members'])) {
    $class_id = $_POST['class_id'];
    $members_to_delete = $_POST['delete_members'];

    foreach ($members_to_delete as $member_id) {
        $sql = "DELETE FROM class_member WHERE user_id = ? AND class_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $member_id, $class_id);
        $stmt->execute();
        $stmt->close();
    }

    $conn->close();
    header("Location: home.php?page=class_content&class_id=$class_id&tab=orang");
    exit();
} else {
    $conn->close();
    header("Location: home.php?page=class_content&class_id=$class_id&tab=orang&error=No members selected for deletion.");
    exit();
}
