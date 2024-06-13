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

