<?php
$tugas_kelompok_id = isset($_GET['tugas_kelompok_id']) ? $_GET['tugas_kelompok_id'] : 0;
$class_id = isset($_GET['class_id']) ? $_GET['class_id'] : 0;
?>
<div class="container bg-primary" style="border-radius: 24px;">
    <div class="d-flex flex-column justify-content-start p-3">
        <div class="d-flex align-items-end flex-row">
            <div class="me-3">
                <h1>Detail Tugas Kelompok <?php echo $tugas_kelompok_id; ?></h1>
            </div>
            <h3>Nama dosen (Kelas <?php echo $class_id; ?>)</h3>
        </div>
        <h4>keterangan</h4>
    </div>
</div>

<div class="d-flex justify-content-center my-5">
    <a href="home.php?page=class_content&class_id=<?php echo $class_id; ?>&tab=tugas" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Kembali ke Daftar Tugas
    </a>
</div>

<div class="container" style="border: 2px solid gray; border-radius: 24px;">
    <div class="d-flex flex-column justify-content-start p-3">
        <div class="me-3">
            <h5>Detail tugas kelompok untuk ID: <?php echo $tugas_kelompok_id; ?></h5>
        </div>
        <h6>tgl</h6>
        <!-- Konten detail tugas kelompok -->
    </div>
</div>