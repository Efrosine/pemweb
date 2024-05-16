<?php
include '../connection.php';
$merek = $_POST['merek'];
$jenis = $_POST['jenis'];
$idregis = $_POST['idregis'];
$tanggal = $_POST['tanggal'];
$jumlah = $_POST['jumlah'];

$sql = "INSERT INTO jualbeli (id_minuman, id_regis, tanggal, jumlah, jenis) VALUES ('" . $merek . "', '" . $idregis . "', '" . $tanggal . "', '" . $jumlah . "', '" . $jenis . "')";
$query = $koneksi->query($sql);
if ($query === true) {
    header('location: ../home.php');
} else {
    echo "Errrooooor";
}