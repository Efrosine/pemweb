<a href="../home.php">Home</a> |<a href="../logout.php">Logout</a></br>
<a href="form_jenis.php">Tambah</a>
<?php
session_start();
include "../connection.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
if (!isset($_SESSION['username'])) {
    die("Anda belum login");
}
$no = 1;
$query = "SELECT * FROM jenis_minuman";
$dt_query = $koneksi->query($query);
?>
<table border="1">
    <thead>
        <tr>
            <th>#</th>
            <th>Jenis Minuman</th>
            <th>Merek</th>
            <th>aksi</th>
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
                <td>
                    <a href='delete.php?id=<?php echo $dt_jenis['id_jenis']; ?>'>edit</a> |
                    <a href='delete.php?id=<?php echo $dt_jenis['id_jenis']; ?>'>delete</a>
                </td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>