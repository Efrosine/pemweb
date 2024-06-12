<?php
// Ambil ID materi dari parameter GET
$id = isset($_GET['id']) ? $_GET['id'] : 0;
?>
<div class="container bg-primary" style="border-radius: 24px;">
    <div class="d-flex flex-column justify-content-start p-3">
        <div class="d-flex align-items-end flex-row">
            <div class="me-3">
                <h1>Detail Materi <?php echo $id; ?></h1>
            </div>
            <h3>Nama dosen</h3>
        </div>
        <h4>keterangan</h4>
    </div>
</div>

<div class="d-flex justify-content-center my-5">
    <a href="home.php?page=class_content" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Kembali ke Daftar Materi
    </a>
</div>

<div class="container" style="border: 2px solid gray; border-radius: 24px;">
    <div class="d-flex flex-column justify-content-start p-3">
        <div class="me-3">
            <h5>Detail materi untuk ID: <?php echo $id; ?></h5>
        </div>
        <h6>tgl</h6>
        <!-- Konten detail materi -->
    </div>
</div>