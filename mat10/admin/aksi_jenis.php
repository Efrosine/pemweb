<?php
include "../connection.php";
$jenis = $_POST['jenis'];
$merek = $_POST['merek'];
$sql = "INSERT INTO jenis_minuman (nm_jenis, merek) VALUES ('" . $jenis . "', '" . $merek . "')";
$query = $koneksi->query($sql);
if ($query === true) {
    header('location: dt_jenis.php');
} else {
    echo "Errrooooor";
}