<?php
include '../db/koneksi.php';
include 'function_grade.php';
include 'function_submission.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tugas_id = $_POST['tugas_id'];
    $nilai = $_POST['nilai'];
    $feedback = $_POST['feedback'];
    $class_id = $_POST['class_id'];

    foreach ($nilai as $user_id => $grade_value) {
        $submission = getSubmissionDetails($conn, $tugas_id, $user_id);
        $submission_id = $submission ? $submission['submission_id'] : null;

        if ($submission_id) {
            $existing_grade = getGradeDetails($conn, $submission_id);

            if ($existing_grade) {
                updateGrade($conn, $user_id, $submission_id, $grade_value, $feedback[$user_id]);
            } else {
                insertGrade($conn, $user_id, $submission_id, $grade_value, $feedback[$user_id]);
            }
        }
    }
    header("Location: home.php?page=class_content&tab=nilai&class_id=$class_id");
    exit();
}
