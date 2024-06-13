<?php
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
function logout()
{
    session_start();
    session_unset();
    session_destroy();
    header("Location: form_login.php");
    exit();
}
