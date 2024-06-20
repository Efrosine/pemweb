<?php
include '../db/koneksi.php';
include 'function_task.php';
include 'function_grade.php';
include 'function_class.php';
include 'function_submision.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $task_id = $_POST['tugas_id'];
    $class_id = $_POST['class_id'];
    $nilai = $_POST['nilai'];
    $techer_id = $_POST['teacher_id'];
    $student = getClassMembers($conn, $class_id);

    foreach ($nilai as $user_id => $grade) {
        // Validasi dan sanitasi data sebelum disimpan ke database
        $user_id = (int) $user_id;
        $grade = (int) $grade;

        $submision_id = getSubmision($conn, $user_id, $task_id);
        $grades = getGradeBySubmissionId($conn, $submision_id) ? getGradeBySubmissionId($conn, $submision_id) : null;
        if ($grades) {
            updateGrade($conn, $teacher_id, $submision_id, $grade, '');
        } else {
            insertGrade($conn, $teacher_id, $submision_id, $grade, '');
        }

        // Query untuk menyimpan atau memperbarui nilai ke database


        header("Location: home.php?page=class_content&tab=nilai&class_id=$class_id");
        exit();
    }
}

// $sql = "SELECT sg.name
// FROM study_group sg
// JOIN class c ON sg.class_id = c.class_id
// WHERE sg.class_id = 6";
// $stmt = $conn->prepare($sql);
// // $stmt->bind_param("i", $class_id);
// $stmt->execute();
// $result = $stmt->get_result();
// $group = $result->fetch_assoc();
// $stmt->close();
// return $group;