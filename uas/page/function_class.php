<?php
include '../db/koneksi.php';

if (!function_exists('createClass')) {
    function createClass($conn, $name, $description, $created_by)
    {
        try {
            $sql = "INSERT INTO class (name, description, created_by) VALUES ('$name', '$description', '$created_by')";

            if ($conn->query($sql) === TRUE) {
                return true;
            } else {
                return "Error: " . $sql . "<br>" . $conn->error;
            }
        } catch (Exception $e) {
            return "Exception: " . $e->getMessage();
        }
    }
}

if (!function_exists('joinClass')) {
    function joinClass($conn, $user_id, $class_code)
    {
        $sql = "SELECT class_id FROM class WHERE code='$class_code'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $class_id = $row['class_id'];

            $check_sql = "SELECT * FROM class_member WHERE user_id='$user_id' AND class_id='$class_id'";
            $check_result = $conn->query($check_sql);

            if ($check_result->num_rows == 0) {
                $insert_sql = "INSERT INTO class_member (user_id, class_id) VALUES ('$user_id', '$class_id')";

                if ($conn->query($insert_sql) === TRUE) {
                    return true;
                } else {
                    return "Error: " . $insert_sql . "<br>" . $conn->error;
                }
            } else {
                return "User already joined this class.";
            }
        } else {
            return "Invalid class code.";
        }
    }
}

if (!function_exists('getClassesByUserId')) {
    function getClassesByUserId($conn, $user_id)
    {
        $classes = [];
        $sql = "SELECT class.class_id, class.name, class.description, user.profile_pic, user.name as created_by 
                FROM class 
                JOIN class_member ON class.class_id = class_member.class_id 
                JOIN user ON class.created_by = user.user_id
                WHERE class_member.user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $classes[] = $row;
        }

        $stmt->close();
        return $classes;
    }
}
