<?php
$class_id = isset($_GET['class_id']) ? $_GET['class_id'] : 0;
?>
<div class="d-flex flex-column">
    <div class="container bg-primary" style="border-radius: 24px;">
        <div class="d-flex flex-column justify-content-start p-3">
            <div class="d-flex align-items-end flex-row">
                <div class="me-3">
                    <h1>Nama kelas <?php echo $class_id; ?></h1>
                </div>
                <h3>Nama dosen</h3>
            </div>
            <h4>keterangan</h4>
        </div>
    </div>

    <div class="d-flex justify-content-center my-5">
        <button type="button" class="btn btn-primary">
            <i class="bi bi-plus"></i> Tambah Materi
        </button>
    </div>

    <div class="container" style="border: 2px solid gray; border-radius: 24px;">
        <div class="d-flex flex-column justify-content-start p-3">
            <a href="home.php?page=class_content&class_id=1&material_id=1" class="text-decoration-none text-dark">
                <div class="me-3">
                    <h5>nmDosen Mempostin materi baru : nmMateri</h5>
                </div>
                <h6>tgl</h6>
            </a>
        </div>
        <!-- Tambahkan item materi lainnya di sini -->
    </div>
</div>