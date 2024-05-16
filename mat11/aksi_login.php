<?php
session_start();
include "connection.php";
$username = $_POST['username'];
$psw = $_POST['password'];
$op = $_GET['op'];

if ($op == "in") {
    $sql = "SELECT * FROM register WHERE username = '$username' AND password = '$psw'";
    $query = $koneksi->query($sql);
    if (mysqli_num_rows($query) == 1) {
        $dt_jenis = $query->fetch_array();
        $_SESSION['username'] = $dt_jenis['username'];
        $_SESSION['level'] = $dt_jenis['level'];
        $_SESSION['id_regis'] = $dt_jenis['id_regis'];
        if ($dt_jenis['level'] == "Admin") {
            header("location:home.php");
        } else if ($dt_jenis['level'] == "Kasir") {
            header("location:home.php");
        } else {
            die("Password Salah <a href=\"javascript:history.back()\">kembali</a>");
        }
    }
} else if ($op == "out") {
    unset($_SESSION['username']);
    unset($_SESSION['level']);
    header("location:login.php");
}