<?php
include '../db/koneksi.php';

if (!function_exists('getTasksByClassIdAndType')) {
    function getTasksByClassIdAndType($conn, $class_id, $type = null)
    {
        $tasks = [];
        $sql = "SELECT * FROM task WHERE class_id = ?";
        if ($type) {
            $sql .= " AND type = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("is", $class_id, $type);
        } else {
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $class_id);
        }
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $tasks[] = $row;
        }

        $stmt->close();
        return $tasks;
    }
}

if (!function_exists('addTask')) {
    function addTask($conn, $class_id, $title, $description, $type, $due_time)
    {
        $sql = "INSERT INTO task (class_id, title, description, type, due_time) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("issss", $class_id, $title, $description, $type, $due_time);

        if ($stmt->execute()) {
            return true;
        } else {
            return $conn->error;
        }
    }
}
