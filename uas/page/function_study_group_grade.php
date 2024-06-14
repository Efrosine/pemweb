<?php
if (!function_exists('getStudyGroupGrade')) {
    function getStudyGroupGrade($conn, $user_id, $study_group_submission_id)
    {
        $grade = '';
        $sql = "SELECT grade FROM study_group_grade WHERE user_id = ? AND study_group_submission_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $user_id, $study_group_submission_id);
        $stmt->execute();
        $stmt->bind_result($grade);
        $stmt->fetch();
        $stmt->close();

        return $grade ? $grade : 0;
    }
}

if (!function_exists('getStudyGroupGradeFeedback')) {
    function getStudyGroupGradeFeedback($conn, $user_id, $study_group_submission_id)
    {
        $feedback = '';
        $sql = "SELECT feedback FROM study_group_grade WHERE user_id = ? AND study_group_submission_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $user_id, $study_group_submission_id);
        $stmt->execute();
        $stmt->bind_result($feedback);
        $stmt->fetch();
        $stmt->close();

        return $feedback ? $feedback : '-';
    }
}
