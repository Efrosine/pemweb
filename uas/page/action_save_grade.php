<?php
include '../db/koneksi.php';
include 'function_task.php';
include 'function_grade.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tugas_id = $_POST['tugas_id'];
    $nilai_list = $_POST['nilai'];
    $feedback_list = $_POST['feedback'];
    $task_type = getTaskType($conn, $tugas_id);

    foreach ($nilai_list as $user_id => $nilai) {
        $feedback = $feedback_list[$user_id];
        if ($task_type == 'individual') {
            // Check if grade exists
            $grade = getGrade($conn, $user_id, $tugas_id);
            if ($grade) {
                // Update existing grade
                $sql = "UPDATE grade SET grade = ?, feedback = ?, status = 'done' WHERE user_id = ? AND task_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("isii", $nilai, $feedback, $user_id, $tugas_id);
            } else {
                // Insert new grade
                $sql = "INSERT INTO grade (user_id, task_id, grade, feedback, status) VALUES (?, ?, ?, ?, 'done')";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("iiis", $user_id, $tugas_id, $nilai, $feedback);
            }
        } else {
            // Get group id by user id
            $group_id = getGroupIdByUserId($conn, $user_id, $class_id);
            if ($group_id) {
                // Check if group grade exists
                $group_grade = getGroupGrade($conn, $group_id, $tugas_id);
                if ($group_grade) {
                    // Update existing group grade
                    $sql = "UPDATE study_group_grade SET grade = ?, feedback = ?, status = 'done' WHERE study_group_id = ? AND task_id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("isii", $nilai, $feedback, $group_id, $tugas_id);
                } else {
                    // Insert new group grade
                    $sql = "INSERT INTO study_group_grade (study_group_id, task_id, grade, feedback, status) VALUES (?, ?, ?, ?, 'done')";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("iiis", $group_id, $tugas_id, $nilai, $feedback);
                }
            }
        }

        if (!$stmt->execute()) {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }

    header("Location: home.php?page=class_content&tab=nilai&class_id=$class_id");
    exit();
}
