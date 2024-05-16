<a href="../home.php">Home</a> |<a href="../logout.php">Logout</a></br>
<a href="form_minuman.php">Tambah</a>
<?php
session_start();
include "../connection.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
if (!isset($_SESSION['username'])) {
    die("Anda belum login");
}
$no = 1;
$sql = "SELECT * FROM minuman,jenis_minuman WHERE minuman.id_jenis = jenis_minuman.id_jenis";
$dt_query = $koneksi->query($sql);
?>
<table border="1">
    <thead>
        <tr>
            <th>#</th>
            <th>Jenis Minuman</th>
            <th>Merek</th>
            <th>Harga</th>
            <th>Ukuran</th>
            <th>Jumlah Stok</th>
        </tr>
    </thead>
    <tbody>
        <?php
        while ($dt_jenis = $dt_query->fetch_array()) {
            ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $dt_jenis['nm_jenis']; ?></td>
                <td><?php echo $dt_jenis['merek']; ?></td>
                <td><?php echo $dt_jenis['harga']; ?></td>
                <td><?php echo $dt_jenis['ukuran']; ?></td>
                <td><?php echo $dt_jenis['jumlah']; ?></td>
                <td><a href=''>update</a></td>
            </tr>
            <?php
        }
        ?>
    </tbody>