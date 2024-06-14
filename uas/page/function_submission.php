<?php
if (!function_exists('addSubmission')) {
    function addSubmission($conn, $user_id, $task_id, $file_path)
    {
        $sql = "INSERT INTO submission (user_id, task_id, file_path) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iis", $user_id, $task_id, $file_path);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }

        // $stmt->close();
    }
}

if (!function_exists('getTaskType')) {
    function getTaskType($conn, $task_id)
    {
        $task_type = '';
        $sql = "SELECT type FROM task WHERE task_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $task_id);
        $stmt->execute();
        $stmt->bind_result($task_type);
        $stmt->fetch();
        $stmt->close();

        return $task_type;
    }
}

if (!function_exists('getSubmission')) {
    function getSubmission($conn, $user_id, $task_id)
    {
        $sql = "SELECT * FROM submission WHERE user_id = ? AND task_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $user_id, $task_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $submission = $result->fetch_assoc();
        $stmt->close();

        return $submission;
    }
}

if (!function_exists('getGrade')) {
    function getGrade($conn, $submission_id)
    {
        $sql = "SELECT g.*, u.name as evaluator_name 
                FROM grade g 
                JOIN user u ON g.user_id = u.user_id 
                WHERE g.submission_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $submission_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $grade = $result->fetch_assoc();
        $stmt->close();

        return $grade;
    }
}

if (!function_exists('addGroupSubmission')) {
    function addGroupSubmission($conn, $group_id, $task_id, $file_path)
    {
        $sql = "INSERT INTO study_group_submission (study_group_id, task_id, file_path) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iis", $group_id, $task_id, $file_path);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }

        // $stmt->close();
    }
}


if (!function_exists('getGroupSubmission')) {
    function getGroupSubmission($conn, $group_id, $task_id)
    {
        $sql = "SELECT * FROM study_group_submission WHERE study_group_id = ? AND task_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $group_id, $task_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $submission = $result->fetch_assoc();
        $stmt->close();

        return $submission;
    }
}

if (!function_exists('getGroupGrade')) {
    function getGroupGrade($conn, $group_submission_id)
    {
        $sql = "SELECT sg.*, u.name as evaluator_name 
                FROM study_group_grade sg 
                JOIN user u ON sg.user_id = u.user_id 
                WHERE sg.study_group_submission_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $group_submission_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $grade = $result->fetch_assoc();
        $stmt->close();

        return $grade;
    }
}

if (!function_exists('getSubmissionDetails')) {
    function getSubmissionDetails($conn, $task_id, $user_id)
    {
        $sql = "SELECT * FROM submission WHERE task_id = ? AND user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $task_id, $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $submission = $result->fetch_assoc();
        $stmt->close();
        return $submission;
    }
}


