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