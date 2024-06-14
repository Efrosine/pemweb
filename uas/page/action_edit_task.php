<?php
include '../db/koneksi.php';
include 'function_task.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $task_id = $_POST['task_id'];
    $title = $conn->real_escape_string($_POST['task_title']);
    $description = $conn->real_escape_string($_POST['task_desc']);
    $type = $conn->real_escape_string($_POST['task_type']);
    $due_time = $conn->real_escape_string($_POST['task_due_time']);

    if (updateTask($conn, $task_id, $title, $description, $type, $due_time)) {
        header("Location: home.php?page=class_content&class_id=".$_POST['class_id']."&tab=tugas");
    } else {
        echo "Error updating task.";
    }
}
