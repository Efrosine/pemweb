<?php
session_start();
include "connection.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
if (!isset($_SESSION['username'])) {
    die("Anda belum login");
}

$idregis = $_SESSION['id_regis'];
$username = $_SESSION['username'];
$sql = "SELECT * FROM register WHERE id_regis = '$idregis'";
$query = $koneksi->query($sql);
$dt_jenis = $query->fetch_array();
?>
Selamat Datang <?php echo $username; ?></br>
<?php
if ($dt_jenis['level'] == "Admin") {
    ?>
    <a href="admin/dt_minuman.php">Data Minuman</a> |<a href="admin/dt_jenis.php">Data Jenis Minuman</a> |<a
        href="logout.php">Logout</a>
    <?php
} else if ($dt_jenis['level'] == "Kasir") {
    ?>
        <a href='kasir/form_jualbeli.php?jenis=Jual'>Jual Barang</a> | <a href='kasir/form_jualbeli.php?jenis=Beli'>Beli
            Barang</a> | <a href='kasir/form_cari.php'>Cari
            Barang</a> |<a href='logout.php'>Logout</a>
    <?php

}
?>
<table border="1">
    <tr>
        <td>Username</td>
        <td><?php echo $dt_jenis['username']; ?></td>
    </tr>
    <tr>
        <td>Password</td>
        <td><?php echo $dt_jenis['password']; ?></td>
    </tr>
    <tr>
        <td>Level</td>
        <td><?php echo $dt_jenis['level']; ?></td>
    </tr>
    <tr>
        <td>Email</td>
        <td><?php echo $dt_jenis['email']; ?></td>
    </tr>
</table>