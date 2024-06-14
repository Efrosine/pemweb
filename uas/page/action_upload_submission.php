<?php
include '../db/koneksi.php';
include 'function_submission.php';
include 'function_user.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $task_id = $_POST['task_id'];
    $user_id = $_POST['user_id'];
    $class_id = $_POST['class_id'];

    // Check if file was uploaded
    if (isset($_FILES['upload_file']) && $_FILES['upload_file']['error'] == UPLOAD_ERR_OK) {
        $file_tmp = $_FILES['upload_file']['tmp_name'];
        $file_name = basename($_FILES['upload_file']['name']);
        $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);

        // Allow only PDF files
        if ($file_ext !== 'pdf') {
            echo "Only PDF files are allowed.";
            exit();
        }

        // Determine the upload directory based on task type
        $task_type = getTaskType($conn, $task_id);
        if ($task_type == 'individual') {
            $upload_dir = '../data/pdfsubmissions/individual/';
        } else {
            $upload_dir = '../data/pdfsubmissions/groups/';
        }

        $file_path = $upload_dir . $file_name;

        // Create the directory if it doesn't exist
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        // Move uploaded file to the desired directory
        if (move_uploaded_file($file_tmp, $file_path)) {
            if ($task_type == 'individual') {
                // Insert file information into the database using a function
                $result = addSubmission($conn, $user_id, $task_id, $file_path);
            } else {
                $group_id = getGroupIdByUserId($conn, $user_id); // Assuming a function to get group ID by user ID
                $result = addGroupSubmission($conn, $group_id, $task_id, $file_path);
            }

            if ($result) {
                header("Location: home.php?page=class_content&tab=tugas&class_id=$class_id&task_id=$task_id");
                exit();
            } else {
                echo "Error: Unable to save submission.";
            }
        } else {
            echo "Failed to move uploaded file.";
        }
    } else {
        echo "No file uploaded or upload error.";
    }

    $conn->close();
}
