<?php
// Ambil ID materi dari parameter GET
$material_id = isset($_GET['material_id']) ? $_GET['material_id'] : 0;
$class_id = isset($_GET['class_id']) ? $_GET['class_id'] : 0; // Ambil ID kelas dari parameter GET
?>
<div class="container bg-primary" style="border-radius: 24px;">
    <div class="d-flex flex-column justify-content-start p-3">
        <div class="d-flex align-items-end flex-row">
            <div class="me-3">
                <h1>Detail Materi <?php echo $material_id; ?></h1>
            </div>
            <h3>Nama dosen <?php echo $class_id; ?></h3>
        </div>
        <h4>keterangan</h4>
    </div>
</div>

<div class="d-flex justify-content-center my-5">
    <a href="home.php?page=class_content&class_id=<?php echo $class_id; ?>" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Kembali ke Daftar Materi
    </a>
</div>

<div class="container" style="border: 2px solid gray; border-radius: 24px;">
    <div class="d-flex flex-column justify-content-start p-3">
        <div class="me-3">
            <h5>Detail materi untuk ID: <?php echo $material_id; ?></h5>
        </div>
        <h6>tgl</h6>
        <!-- Konten detail materi -->
    </div>
</div>