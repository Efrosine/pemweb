<?php
include '../db/koneksi.php';
include 'function_discussion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $group_id = $_POST['group_id'];
    $user_id = $_POST['user_id'];
    $content = $_POST['content'];

    if (addGroupDiscussion($conn, $group_id, $user_id, $content)) {
        header("Location: " . $_SERVER['HTTP_REFERER']);
    } else {
        echo "Error: Unable to add discussion.";
    }
}
