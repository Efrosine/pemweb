<?php
include "../db/koneksi.php";

if (!function_exists('getSubmision')) {
    function getSubmision($student, $task_id, $conn)
    {
        $sql = "SELECT * FROM submission WHERE user_id = ? AND task_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $student['user_id'], $task_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $submission = $result->fetch_assoc();
        $stmt->close();
        return $submission;
    }
}