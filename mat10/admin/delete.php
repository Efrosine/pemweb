<?php
session_start();
include "../connection.php";
$id = $_GET['id'];
$sql = "DELETE FROM jenis_minuman WHERE id_jenis = '$id'";
$query = $koneksi->query($sql);
if ($query) {
    header('location: dt_minuman.php');
}