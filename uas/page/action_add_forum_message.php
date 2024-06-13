<?php
include '../db/koneksi.php';
include 'function_forum.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $class_id = $_POST['class_id'];
    $user_id = $_POST['user_id'];
    $message = $_POST['message'];

    $result = addForumMessage($conn, $class_id, $user_id, $message);

    if ($result === true) {
        header("Location: home.php?page=class_content&class_id=$class_id&tab=forum");
    } else {
        $error_msg = "msgerror";
        header("Location: home.php?page=class_content&class_id=$class_id&tab=forum&error=$error_msg");
    }
}