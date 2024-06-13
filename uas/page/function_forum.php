<?php
include '../db/koneksi.php';

function getForumMessages($conn, $class_id)
{
    $sql = "SELECT discussion.*, user.name, user.profile_pic FROM discussion 
            JOIN user ON discussion.user_id = user.user_id 
            WHERE discussion.class_id = ? ORDER BY discussion.created_at ASC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $class_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $messages = [];
    while ($row = $result->fetch_assoc()) {
        $messages[] = $row;
    }
    return $messages;
}

function addForumMessage($conn, $class_id, $user_id, $message)
{
    $sql = "INSERT INTO discussion (class_id, user_id, message, created_at) VALUES (?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iis", $class_id, $user_id, $message);
    if ($stmt->execute()) {
        return true;
    } else {
        return "Error: " . $stmt->error;
    }
}
