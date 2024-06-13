<?php
if (!function_exists('addMaterial')) {
    function addMaterial($conn, $class_id, $title, $description, $file_path, $created_by)
    {
        try {
            $sql = "INSERT INTO material (class_id, title, description, file_path, created_by) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("issss", $class_id, $title, $description, $file_path, $created_by);

            if ($stmt->execute()) {
                return true;
            } else {
                return "Error: " . $stmt->error;
            }
        } catch (Exception $e) {
            return "Exception: " . $e->getMessage();
        }
    }
}


if (!function_exists('getMaterialsByClassId')) {
    function getMaterialsByClassId($conn, $class_id)
    {
        $materials = [];
        $sql = "SELECT material.material_id, material.title, material.description, material.file_path, material.created_at, user.name as created_by 
                FROM material 
                JOIN user ON material.created_by = user.user_id
                WHERE material.class_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $class_id);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $materials[] = $row;
        }

        $stmt->close();
        return $materials;
    }
}

if (!function_exists('getMaterialById')) {
    function getMaterialById($conn, $material_id)
    {
        $sql = "SELECT material.*, user.name as created_by 
        FROM material 
        JOIN user ON material.created_by = user.user_id 
        WHERE material.material_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $material_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $material = $result->fetch_assoc();
        $stmt->close();
        return $material;
    }
}
if (!function_exists('updateMaterial')) {
    function updateMaterial($conn, $material_id, $title, $description, $file_path)
    {
        try {
            if ($file_path) {
                $sql = "UPDATE material SET title = ?, description = ?, file_path = ? WHERE material_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sssi", $title, $description, $file_path, $material_id);
            } else {
                $sql = "UPDATE material SET title = ?, description = ? WHERE material_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssi", $title, $description, $material_id);
            }

            if ($stmt->execute()) {
                $stmt->close();
                return true;
            } else {
                $stmt->close();
                return "Error: " . $conn->error;
            }
        } catch (Exception $e) {
            return "Exception: " . $e->getMessage();
        }
    }
}


