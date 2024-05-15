<?php
include "koneksi.php";
$stts = $_GET['status'];
if ($stts == "single") {
    $nama = $_POST['nama'];
    $sql = "INSERT INTO  jurusan (nmjurusan) VALUES ('" . $nama . "')";
    $a = $koneksi->query($sql);
    if ($a === true) {
        header("location:form_jurusan.php");
    }
} elseif ($stts == "identitas") {
    $nama = $_POST['nama'];
    $NIM = $_POST['nim'];
    $alamat = $_POST['alamat'];
    $nomor = $_POST['nomor'];
    $jurusan = $_POST['jurusan'];

    $sql = "INSERT INTO identitas (NIM,idjurusan,nama,alamat,noHP) VALUES ('" . $NIM . "', '" . $jurusan . "', '" . $nama . "',  '" . $alamat . "', '" . $nomor . "')";
    $a = $koneksi->query($sql);
    if ($a === true) {
        header("location:data_jurusan.php");
    }
} else if ($stts == "multi") {
    $r = $_POST['jumlah'];
    for ($i = 1; $i <= $r; $i++) {
        $NIM = $_POST['NIM' . $i];
        $nama = $_POST['nama' . $i];
        $keterangan = $_POST['keterangan' . $i];


        $sql = "INSERT INTO absensi (NIM, keterangan) VALUES ('" . $NIM . "', '" . $keterangan . "')";
        $a = $koneksi->query($sql);
    } ?>
        <script language="javascript">
            alert("Data berhasil disimpan");
            history.back(-1);
        </script>
        <?php
        header("location:data_jurusan.php");

}
?>