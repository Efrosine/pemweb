<?php
session_start();
include "../connection.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
if (!isset($_SESSION['username'])) {
    die("Anda belum login");
}
$query = "SELECT * FROM jenis_minuman";
$dt_query = $koneksi->query($query);
?>
<form action="aksi_minuman.php" method="POST">
    <table>
        <tr>
            <td>Merek Minuman</td>
            <td>
                <select name="jenis">
                    <?php
                    while ($dt_jenis = $dt_query->fetch_array()) {
                        ?>
                        <option value="<?php echo $dt_jenis['id_jenis']; ?>"><?php echo $dt_jenis['merek']; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Harga Minuman</td>
            <td><input type="text" name="harga"></td>
        </tr>
        <tr>
            <td>Ukuran Minuman</td>
            <td><input type="text" name="ukuran"></td>
        </tr>
        <tr>
            <td>Jumlah Stok</td>
            <td><input type="text" name="jumlah"></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="save" value="Save"></td>
        </tr>
        <a href="../home.php">Home</a>|<a href="dt_minuman.php">Data Minuman</a> |<a href="../logout.php">Logout</a>
    </table>
</form>