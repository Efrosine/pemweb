<?php
session_start();
include "../connection.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
if (!isset($_SESSION['username'])) {
    die("Anda belum login");
}
$id_regis = $_SESSION['id_regis'];
$jenis = $_GET['jenis'];
$query = "SELECT * FROM minuman,jenis_minuman WHERE minuman.id_jenis = jenis_minuman.id_jenis";
$dt_query = $koneksi->query($query);
if ($jenis == 'Beli') {
    ?>
    Form Beli Barang
    <?php
} else if ($jenis == 'Jual') {
    ?>
        Form Jual Barang
    <?php
}
?>
<form action="aksi_jualbeli.php" method="POST">
    <table>
        <tr>
            <td>Merek Minuman</td>
            <td>
                <select name="merek">
                    <?php
                    while ($dt_jenis = $dt_query->fetch_array()) {
                        ?>
                        <option value="<?php echo $dt_jenis['id_minuman']; ?>"><?php echo $dt_jenis['merek']; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Jumlah Barang</td>
            <td><input type="text" name="jumlah"></td>
            <input type="hidden" name="idregis" value="<?php echo $id_regis; ?>">
            <input type="hidden" name="tanggal" value="<?php echo date('d-m-y'); ?>">
            <input type="hidden" name="jenis" value="<?php echo $jenis; ?>">
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="save" value="Save"></td>
        </tr>
        <a href="../home.php">Home</a> | <a href="../logout.php">Logout</a>
    </table>
</form>