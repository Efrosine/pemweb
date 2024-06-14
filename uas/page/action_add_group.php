<?php
include '../db/koneksi.php';
include 'function_group.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $class_id = $_POST['class_id'];
    $group_name = $conn->real_escape_string($_POST['group_name']);
    $group_desc = $conn->real_escape_string($_POST['group_desc']);
    $leader = $_POST['leader'];
    $members = $_POST['members'];

    $result = addGroup($conn, $class_id, $group_name, $group_desc, $leader, $members);

    if ($result === true) {
        header("Location: home.php?page=class_content&class_id=$class_id&tab=kelompok");
    } else {
        header("Location: home.php?page=class_content&class_id=$class_id&tab=kelompok&error=msgerror");
    }
}
