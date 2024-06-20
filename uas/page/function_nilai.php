<?php
include '../db/koneksi.php';

if (!function_exists('getClassMembers')) {
    function getClassMembers($conn, $class_id)
    {
        // Query untuk mendapatkan data anggota kelas kecuali guru
        $sql = "SELECT u.name 
            FROM user  u
            JOIN class_member ON u.user_id = class_member.user_id 
            WHERE class_member.class_id = ? AND u.role != 'teacher'";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $class_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $names = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $names[] = $row['name'];
            }
        }

        $stmt->close();
        $conn->close();

        return $names;
    }
}

if (!function_exists('getTasksByClassId')) {
    function getTasksByClassId($conn, $class_id)
    {
        $tasks = [];
        $sql = "SELECT * FROM task WHERE type = 'group' OR class_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $class_id);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $tasks[] = $row;
        }

        $stmt->close();
        return $tasks;
    }
}

if (!function_exists('getIndividualTaskByClassid')) {
    function getIndividualTaskByClassid($conn, $class_id)
    {
        $tasks = [];
        $sql = "SELECT * FROM task WHERE tipe = 0 AND class_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $class_id);
        $stmt->execute();
        $result = $stmt->get_result();


        // $stmt->close();
        return $tasks;
    }
}