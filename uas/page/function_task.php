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

if (!function_exists('getTaskDetails')) {
    function getTaskDetails($conn, $task_id)
    {
        $sql = "SELECT t.*, u.name as created_by_name 
                FROM task t 
                JOIN user u ON t.created_by = u.user_id 
                WHERE t.task_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $task_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $task = $result->fetch_assoc();
        $stmt->close();
        return $task;
    }
}

if (!function_exists('updateTask')) {
    function updateTask($conn, $task_id, $title, $description, $type, $due_time)
    {
        $sql = "UPDATE task SET title = ?, description = ?, type = ?, due_time = ? WHERE task_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $title, $description, $type, $due_time, $task_id);

        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            $stmt->close();
            return false;
        }
    }
}

