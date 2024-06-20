<?php
if (!function_exists('getGrade')) {
    function getGrade($conn, $user_id, $submission_id)
    {
        $grade = '';
        $sql = "SELECT grade FROM grade WHERE user_id = ? AND submission_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $user_id, $submission_id);
        $stmt->execute();
        $stmt->bind_result($grade);
        $stmt->fetch();
        $stmt->close();

        return $grade ? $grade : 0;
    }
}
if (!function_exists('getGradeBySubmissionId')) {
    function getGradeBySubmissionId($conn, $submission_id)
    {
        $grade = '';
        $sql = "SELECT grade FROM grade WHERE  submission_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $submission_id);
        $stmt->execute();
        $stmt->bind_result($grade);
        $stmt->fetch();
        $stmt->close();

        return $grade ? $grade : 0;
    }
}

if (!function_exists('getGradeFeedback')) {
    function getGradeFeedback($conn, $user_id, $submission_id)
    {
        $feedback = '';
        $sql = "SELECT feedback FROM grade WHERE user_id = ? AND submission_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $user_id, $submission_id);
        $stmt->execute();
        $stmt->bind_result($feedback);
        $stmt->fetch();
        $stmt->close();

        return $feedback ? $feedback : '-';
    }
}
if (!function_exists('updateGrade')) {
    function updateGrade($conn, $user_id, $submission_id, $grade, $feedback)
    {
        $sql = "UPDATE grade SET grade = ?, feedback = ? WHERE user_id = ? AND submission_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isii", $grade, $feedback, $user_id, $submission_id);
        return $stmt->execute();
    }
}

if (!function_exists('insertGrade')) {
    function insertGrade($conn, $user_id, $submission_id, $grade, $feedback)
    {
        $sql = "INSERT INTO grade (user_id, submission_id, grade, feedback) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iiis", $user_id, $submission_id, $grade, $feedback);
        return $stmt->execute();
    }
}

if (!function_exists('getGradeDetails')) {
    function getGradeDetails($conn, $submission_id)
    {
        $sql = "SELECT * FROM grade WHERE submission_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $submission_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $grade = $result->fetch_assoc();
        $stmt->close();
        return $grade;
    }
}

