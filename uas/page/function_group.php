<?php
include '../db/koneksi.php';
if (!function_exists('getGroupsByClassId')) {
    function getGroupsByClassId($conn, $class_id)
    {
        $groups = [];
        $sql = "SELECT sg.study_group_id, sg.name, sg.description, u.name as leader
            FROM study_group sg
            JOIN user u ON sg.leader = u.user_id
            WHERE sg.class_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $class_id);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $group_id = $row['study_group_id'];
            $members = getGroupMembers($conn, $group_id);
            $row['members'] = $members;
            $groups[] = $row;
        }

        $stmt->close();
        return $groups;
    }
}

if (!function_exists('getGroupMembers')) {
    function getGroupMembers($conn, $group_id)
    {
        $members = [];
        $sql = "SELECT u.name
                FROM study_group_member sgm
                JOIN user u ON sgm.user_id = u.user_id
                WHERE sgm.study_group_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $group_id);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $members[] = $row['name'];
        }

        $stmt->close();
        return $members;
    }
}

if (!function_exists('addGroup')) {
    function addGroup($conn, $class_id, $name, $description, $leader, $members)
    {
        $sql = "INSERT INTO study_group (class_id, name, description, leader) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("issi", $class_id, $name, $description, $leader);

        if ($stmt->execute()) {
            $group_id = $stmt->insert_id;
            foreach ($members as $member) {
                $sql = "INSERT INTO study_group_member (study_group_id, user_id) VALUES (?, ?)";
                $stmt_member = $conn->prepare($sql);
                $stmt_member->bind_param("ii", $group_id, $member);
                $stmt_member->execute();
                $stmt_member->close();
            }
            $stmt->close();
            return true;
        } else {
            $stmt->close();
            return $conn->error;
        }
    }
}

if (!function_exists('getStudentsWithoutGroups')) {
    function getStudentsWithoutGroups($conn, $class_id)
    {
        $sql = "SELECT u.user_id, u.name, u.profile_pic 
            FROM user u
            LEFT JOIN study_group_member sgm ON u.user_id = sgm.user_id
            LEFT JOIN study_group sg ON sgm.study_group_id = sg.study_group_id
            WHERE u.role = 'student' AND (sg.class_id IS NULL OR sg.class_id != ?)
            AND u.user_id NOT IN (SELECT sgm.user_id 
                                  FROM study_group_member sgm 
                                  JOIN study_group sg ON sgm.study_group_id = sg.study_group_id 
                                  WHERE sg.class_id = ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $class_id, $class_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $students = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();

        return $students;
    }

}

include '../db/koneksi.php';

if (!function_exists('isStudentInGroup')) {
    function isStudentInGroup($conn, $user_id, $class_id)
    {
        $sql = "SELECT COUNT(*) as count
                FROM study_group_member sgm
                JOIN study_group sg ON sgm.study_group_id = sg.study_group_id
                WHERE sgm.user_id = ? AND sg.class_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $user_id, $class_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();

        return $row['count'] > 0;
    }
}


if (!function_exists('getGroupIdByUserId')) {
    function getGroupIdByUserId($conn, $user_id, $class_id)
    {
        $study_group_id = '';
        $sql = "SELECT sg.study_group_id
                FROM study_group_member sgm
                JOIN study_group sg ON sgm.study_group_id = sg.study_group_id
                WHERE sgm.user_id = ? AND sg.class_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $user_id, $class_id);
        $stmt->execute();
        $stmt->bind_result($study_group_id);
        $stmt->fetch();
        $stmt->close();

        return $study_group_id;
    }
}

if (!function_exists('getGroupGrade')) {
    function getGroupGrade($conn, $group_id, $task_id)
    {
        $grade = '';
        $sql = "SELECT grade FROM study_group_grade WHERE study_group_id = ? AND task_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $group_id, $task_id);
        $stmt->execute();
        $stmt->bind_result($grade);
        $stmt->fetch();
        $stmt->close();

        return $grade ? $grade : 0;
    }
}

if (!function_exists('getGroupIdByUserIdAndClassId')) {
    function getGroupIdByUserIdAndClassId($conn, $user_id, $class_id)
    {
        $sql = "SELECT sg.study_group_id FROM study_group_member sgm
            JOIN study_group sg ON sgm.study_group_id = sg.study_group_id
            WHERE sgm.user_id = ? AND sg.class_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $user_id, $class_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $group = $result->fetch_assoc();
        $stmt->close();
        return $group ? $group['study_group_id'] : null;
    }

}

