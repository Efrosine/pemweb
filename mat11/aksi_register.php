<?php
include "connection.php";
$username = $_POST['username'];
$psw = $_POST['password'];
$level = $_POST['level'];
$email = $_POST['email'];
$sql = "INSERT INTO register(username, password, level, email) VALUES ('" . $username . "', '" . $psw . "', '" . $level . "', '" . $email . "')";
$query = $koneksi->query($sql);
if ($query === true) {
    header('location: login.php');
} else {
    echo "Errrooooor";
}