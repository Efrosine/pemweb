<?php
include "koneksi.php";
$nama = $_POST['nama'];
$gender = $_POST['gender'];
$email = $_POST['email'];
$role = $_POST['role'];


$sql = "INSERT INTO bukutamu (nama, id_gender, email, id_role) VALUES ('$nama', '$gender', '$email', '$role')";
$a = $koneksi->query($sql);
if ($a === true) {
    header("location:hasilbukutamu.php");
} else {
    echo "Data gagal disimpan";
}