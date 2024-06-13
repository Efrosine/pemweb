<?php
$class_id = isset($_GET['class_id']) ? $_GET['class_id'] : 0; // Ambil ID kelas dari parameter GET
?>
<div class="d-flex flex-column">
    <div class="container bg-primary" style="border-radius: 24px;">
        <div class="d-flex flex-column justify-content-start p-3">
            <div class="d-flex align-items-end flex-row">
                <div class="me-3">
                    <h1>Nama kelas</h1>
                </div>
                <div class="me-auto">
                    <h3>Nama dosen</h3>
                </div>
                <h3>Kode Kelas</h3>
            </div>
            <h4>keterangan</h4>
        </div>
    </div>

    <div class="d-flex justify-content-center my-5">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahMateriModal">
            <i class="bi bi-plus"></i> Tambah Materi
        </button>
    </div>

    <div class="container" style="border: 2px solid gray; border-radius: 24px;">
        <div class="d-flex flex-column justify-content-start p-3">
            <!-- Ganti URL untuk mengirim parameter class_id dan material_id dengan benar -->
            <a href="home.php?page=class_content&tab=materi&class_id=<?php echo $class_id; ?>&material_id=1"
                class="text-decoration-none text-dark">
                <div class="me-3">
                    <h5>nmDosen Mempostin materi baru : nmMateri</h5>
                </div>
                <h6>tgl</h6>
            </a>
        </div>
        <!-- Tambahkan item materi lainnya di sini -->
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="tambahMateriModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="tambahMateriModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="tambahMateriModalLabel">Tambah Materi</h1>
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
                <button type="button" class="btn btn-primary">Tambah</button>
            </div>
        </div>
    </div>
</div>