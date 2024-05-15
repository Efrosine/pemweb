<?php
include "../connection.php";
$jenis = $_POST['jenis'];
$harga = $_POST['harga'];
$ukuran = $_POST['ukuran'];
$jumlah = $_POST['jumlah'];
$sql = "INSERT INTO minuman(id_jenis, harga, ukuran, jumlah) VALUES ('" . $jenis . "', '" . $harga . "', '" . $ukuran . "', '" . $jumlah . "')";
$query = $koneksi->query($sql);
if ($query === true) {
    header('location: dt_minuman.php');
} else {
    echo "Errrooooor";
}