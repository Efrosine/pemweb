<?php
$class_id = isset($_GET['class_id']) ? $_GET['class_id'] : 0; // Ambil ID kelas dari parameter GET
?>
<div class="d-flex flex-column">
    <div class="d-flex justify-content-center">
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                Semua Tugas
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Semua Tugas</a></li>
                <li><a class="dropdown-item" href="#">Tugas Individu</a></li>
                <li><a class="dropdown-item" href="#">Tugas Kelompok</a></li>
            </ul>
        </div>
        <button type="button" class="btn btn-primary ms-5" data-bs-toggle="modal" data-bs-target="#tambahTugasiModal">
            <i class="bi bi-plus"></i>Tambah Tugas
        </button>
    </div>
    <h2>Tugas Individu</h2>
    <div class="m-3 p-3" style="border: 2px solid gray;border-radius: 24px;">
        <div class="d-flex flex-column justify-content-start">
            <a href="home.php?page=class_content&tab=tugas&class_id=<?php echo $class_id; ?>&tugas_individu_id=1"
                class="text-decoration-none text-dark">
                <h3>Nm Tuagas</h3>
                <h4>tgl</h4>
                <hr>
                <div class="p-3">
                    <h5>Petunjuk</h5>
                </div>
            </a>
        </div>
    </div>
    <h2>Tugas Kelompok</h2>
    <div class="m-3 p-3" style="border: 2px solid gray;border-radius: 24px;">
        <div class="d-flex flex-column justify-content-start">
            <a href="home.php?page=class_content&tab=tugas&class_id=<?php echo $class_id; ?>&tugas_kelompok_id=1"
                class="text-decoration-none text-dark">
                <div class="d-flex flex-row align-items-end">
                    <h3>Nm Tuagas</h3>
                    <div class="ms-3">
                        <h4>Nm Kelompok</h4>
                    </div>
                </div>
                <h4>tgl</h4>
                <hr>
                <div class="p-3">
                    <h5>Petunjuk</h5>
                </div>
            </a>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="tambahTugasiModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="tambahTugasiModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="tambahTugasiModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="mb-3">
                        <label for="tugas_tittle" class="form-label">Judul Tugas</label>
                        <input type="text" class="form-control" id="tugas_tittle" name="tugas_tittle" required>
                    </div>
                    <div class="mb-3">
                        <label for="tugas_dec" class="form-label">Petujuk Tugas</label>
                        <input type="text" class="form-control" id="tugas_dec" name="tugas_dec" required>
                    </div>
                    <div class="mb-3">
                        <label for="tugas_file" class="form-label">Pilih File Pendukung</label>
                        <input class="form-control" type="file" id="tugas_file">
                    </div>
                    <div class="mb-3">
                        <label for="tugas_type" class="form-label">Tipe Tugas</label>
                        <select class="form-select" id="tugas_type" name="tugas_type"
                            aria-label="Example select with button addon">
                            <option value="idv">Individu</option>
                            <option value="group">Group</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tugas_due_time" class="form-label">Due Date</label>
                        <input type="date" class="form-control" id="tugas_due_time" name="tugas_due_time" required>
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