<?php
session_start();
include '../db/koneksi.php';
include 'function_class.php';
include 'function_user.php';
include 'function_material.php';

$user = isAuthorized($conn);
if (!$user) {
    header("Location: form_login.php");
    exit();
}

$class_id = isset($_POST['class_id']) ? $_POST['class_id'] : 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_material'])) {
    $title = $_POST['materi_tittle'];
    $description = $_POST['materi_dec'];
    $created_by = $user['user_id'];
    $file_path = '';

    if (isset($_FILES['materi_file']) && $_FILES['materi_file']['error'] == 0) {
        $allowed_types = ['application/pdf'];
        if (in_array($_FILES['materi_file']['type'], $allowed_types)) {
            $file_path = '../data/pdfmaterial/' . basename($_FILES['materi_file']['name']);
            move_uploaded_file($_FILES['materi_file']['tmp_name'], $file_path);
            $result = addMaterial($conn, $class_id, $title, $description, $file_path, $created_by);
        } else {
            $error_msg = "File yang diupload harus berupa PDF.";
        }
    }

    if (!empty($error_msg)) {
        header("Location: home.php?page=class_content&class_id=$class_id&tab=materi&error=" . $error_msg);
    } else {
        header("Location: home.php?page=class_content&class_id=$class_id&tab=materi");
    }
    exit();
}

