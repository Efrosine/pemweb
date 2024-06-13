<?php
include '../db/koneksi.php';
include 'function_material.php'; // Pastikan include function_material.php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $material_id = $_POST['material_id'];
    $class_id = $_POST['class_id'];
    $title = $conn->real_escape_string($_POST['materi_title']);
    $description = $conn->real_escape_string($_POST['materi_desc']);
    $file_path = null;

    if (isset($_FILES['materi_file']) && $_FILES['materi_file']['error'] == 0) {
        $allowed_types = ['application/pdf'];
        if (in_array($_FILES['materi_file']['type'], $allowed_types)) {
            $file_path = '../data/pdfmaterial/' . basename($_FILES['materi_file']['name']);
            move_uploaded_file($_FILES['materi_file']['tmp_name'], $file_path);
        } else {
            $error_msg = "File yang diupload harus berupa PDF.";
        }
    }

    if (!isset($error_msg)) {
        $result = updateMaterial($conn, $material_id, $title, $description, $file_path);

        if ($result === true) {
            header("Location: home.php?page=class_content&class_id=$class_id&tab=materi&material_id=$material_id");
            exit();
        } else {
            $error_msg = $result;
        }
    }

    if (isset($error_msg)) {
        header("Location: home.php?page=class_content&class_id=$class_id&tab=materi&material_id=$material_id&error=$error_msg");
        exit();
    }
}
