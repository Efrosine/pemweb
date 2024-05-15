<table id="a" class="table table-striped table-bordered table-hover dataTables-example">
    <thead>
        <tr>
            <th>#</th>
            <th>Nama Jurusan</th>
            <th>Jumlah Mahasiswa</th>
            <th>Absensi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        include "koneksi.php";
        $no = 1;
        $a = "SELECT * FROM jurusan";
        $aq = $koneksi->query($a);
        while ($aa = $aq->fetch_array()) {
            $idjurusan = $aa['idjurusan'];
            ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $aa['nmjurusan']; ?></td>
                <td><?php
                $g = "SELECT * FROM identitas where idjurusan = '$idjurusan'";
                $gq = $koneksi->query($g);
                $ga = mysqli_num_rows($gq);
                echo $ga;
                ?></td>
                <td>
                    <a href="form_absensi.php?idjurusan=<?php echo $idjurusan; ?>">Link</a>
                </td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>