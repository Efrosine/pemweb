<?php
// Ambil ID materi dari parameter GET
$material_id = isset($_GET['material_id']) ? $_GET['material_id'] : 0;
$class_id = isset($_GET['class_id']) ? $_GET['class_id'] : 0; // Ambil ID kelas dari parameter GET
?>
<div class="d-flex">
    <h1 class="me-auto">nmMateri <?php echo $material_id; ?></h1>
    <div>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahMateriModal">
            <i class="bi bi-pencil"></i> Edit Materi
        </button>
    </div>
</div>
<div class="d-flex align-items-end">
    <h4>nmDosen</h4>
    <h5 class="ms-4">Tanggal</h5>
</div>
<hr>
<h5>Deskripsi Materi</h5>
<div class="d-flex flex-column align-items-center">
    <div class="flex-grow-1 d-flex align-items-center justify-content-center" style="height: 200px;">
        <a href="#" class="btn btn-link">Download File</a>
    </div>
    <div class="d-flex align-self-start">
        <a href="home.php?page=class_content&class_id=<?php echo $class_id; ?>&tab=materi" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali ke Daftar Materi
        </a>
    </div>
</div>

<div class="modal fade" id="tambahMateriModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="tambahMateriModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="tambahMateriModalLabel">Edit Materi</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="mb-3">
                        <label for="materi_tittle" class="form-label">Judul Materi</label>
                        <input type="text" class="form-control" id="materi_tittle" name="materi_tittle" required>
                    </div>
                    <div class="mb-3">
                        <label for="materi_dec" class="form-label">Deskripsi Materi</label>
                        <input type="text" class="form-control" id="materi_dec" name="materi_dec" required>
                    </div>
                    <div class="mb-3">
                        <label for="materi_file" class="form-label">Pilih File Pendukung</label>
                        <input class="form-control" type="file" id="materi_file">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>