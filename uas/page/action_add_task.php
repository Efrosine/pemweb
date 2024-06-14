<?php
include '../db/koneksi.php';
include 'function_task.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $class_id = $_POST['class_id'];
    $task_title = $conn->real_escape_string($_POST['task_title']);
    $task_desc = $conn->real_escape_string($_POST['task_desc']);
    $task_type = $_POST['task_type'];
    $task_due_time = $_POST['task_due_time'];

    $result = addTask($conn, $class_id, $task_title, $task_desc, $task_type, $task_due_time);

    if ($result === true) {
        header("Location: home.php?page=class_content&class_id=$class_id&tab=tugas");
    } else {
        header("Location: home.php?page=class_content&class_id=$class_id&tab=tugas&error=" . urlencode($result));
    }
}
