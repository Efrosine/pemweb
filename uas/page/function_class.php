<?php
include '../db/koneksi.php';

function createClass($conn, $name, $description, $created_by)
{
    try {
        $sql = "INSERT INTO class (name, description, created_by) VALUES ('$name', '$description', '$created_by')";

        if ($conn->query($sql) === TRUE) {
            return true;
        } else {
            return "Error: " . $sql . "<br>" . $conn->error;
        }//code...
    } catch (Exception $e) {
        return "Exception: " . $e->getMessage();
    }
}

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