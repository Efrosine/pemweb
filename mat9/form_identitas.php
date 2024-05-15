<form method="POST" class="form-horizontal" action="insert.php?status=identitas">
    <div class="form-group">
        <label class="col-sm-2 control-label">NIM</label>
        <div class="col-sm-10">
            <input type="number" class="form-control" name="nim">
        </div>

    </div>
    <div class="hr-line-dashed"></div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Nama</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="nama">
        </div>
    </div>
    <div class="hr-line-dashed"></div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Alamat</label>
        <div class="col-sm-10">
            <textarea class="form-control" name="alamat"></textarea>
        </div>
    </div>
    <div class="hr-line-dashed"></div>
    <div class="form-group">
        <label class="col-sm-2 control-label">NO. HP</label>
        <div class="col-sm-10">
            <input type="number" class="form-control" name="nomor">
        </div>
    </div>
    <div class="hr-line-dashed">
        <div class="form-group">
            <label class="col-sm-2 control-label">Jurusan</label>
            <div class="col-sm-10"></div>
            <select class="form-control m-b" name="jurusan">
                <?php
                include "koneksi.php";
                $a = "SELECT * FROM jurusan";
                $aq = $koneksi->query($a);
                while ($aa = $aq->fetch_array()) {
                    ?>
                    <option value="<?php echo $aa['idjurusan']; ?>"><?php echo $aa['nmjurusan']; ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
    </div>
    <div class="hr-line-dashed"></div>
    <div class="form-group">
        <div class="col-sm-4 col-sm-offset-2">
            <button class="btn btn-white" type="reset">Cancel</button>
            <button class="btn btn-primary" type="submit">Save</button>
        </div>
    </div>
</form>