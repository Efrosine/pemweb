<?php
if (!function_exists('isAuthorized')) {
    function isAuthorized($conn)
    {
        if (!isset($_SESSION['user_id'])) {
            return false;
        }

        $user_id = $_SESSION['user_id'];
        $sql = "SELECT * FROM user WHERE user_id = $user_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }
}

if (!function_exists('logout')) {
    function logout()
    {
        session_start();
        session_unset();
        session_destroy();
        header("Location: form_login.php");
        exit();
    }
}

if (!function_exists('getUsersByRoleAndClass')) {
    function getUsersByRoleAndClass($conn, $role, $class_id)
    {
        $users = [];
        $sql = "SELECT user.user_id, user.name, user.profile_pic 
                FROM user 
                JOIN class_member ON user.user_id = class_member.user_id 
                WHERE user.role = ? AND class_member.class_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $role, $class_id);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }

        $stmt->close();
        return $users;
    }
}

if (!function_exists('getGroupIdByUserId')) {
    function getGroupIdByUserId($conn, $user_id)
    {
        $group_id = '';
        $sql = "SELECT sgm.study_group_id 
                FROM study_group_member sgm
                JOIN study_group sg ON sgm.study_group_id = sg.study_group_id
                WHERE sgm.user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->bind_result($group_id);
        $stmt->fetch();
        $stmt->close();

        return $group_id;
    }
}


