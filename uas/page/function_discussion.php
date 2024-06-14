<?php
if (!function_exists('addGroupDiscussion')) {
    function addGroupDiscussion($conn, $group_id, $user_id, $content)
    {
        $sql = "INSERT INTO study_group_discussion (study_group_id, user_id, content) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iis", $group_id, $user_id, $content);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }

        // $stmt->close();
    }
}

if (!function_exists('getGroupDiscussions')) {
    function getGroupDiscussions($conn, $group_id)
    {
        $sql = "SELECT d.content, d.created_at, u.name
                FROM study_group_discussion d
                JOIN user u ON d.user_id = u.user_id
                WHERE d.study_group_id = ?
                ORDER BY d.created_at ASC";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $group_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $discussions = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $discussions;
    }
}

if (!function_exists('getGroupIdByUserIdAndClassId')) {
    function getGroupIdByUserIdAndClassId($conn, $user_id, $class_id)
    {
        $group_id = '';
        $sql = "SELECT sgm.study_group_id
                FROM study_group_member sgm
                JOIN study_group sg ON sgm.study_group_id = sg.study_group_id
                WHERE sgm.user_id = ? AND sg.class_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $user_id, $class_id);
        $stmt->execute();
        $stmt->bind_result($group_id);
        $stmt->fetch();
        $stmt->close();
        return $group_id;
    }
}

