<form action="<?php $_PHP_SELF ?>" method="GET">
    <table>
        <tr>
            <td>Cari</td>
            <td><input type="text" name="cari"></td>
            <td><input type="submit" name="search" value="Cari"></td>
        </tr>
        <a href="../home.php">Home</a> | <a href="../logout.php">Logout</a>
    </table>
</form>
<?php
session_start();
include "../connection.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
if (!isset($_SESSION['username'])) {
    die("Anda belum login");
}
$key = $_GET['cari'];
$no = 1;
$sql = "SELECT * FROM minuman,jenis_minuman WHERE minuman.id_jenis = jenis_minuman.id_jenis AND jenis_minuman.merek LIKE '%$key%'";
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
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>