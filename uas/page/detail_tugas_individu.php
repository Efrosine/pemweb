<?php
$tugas_individu_id = isset($_GET['tugas_individu_id']) ? $_GET['tugas_individu_id'] : 0;
$class_id = isset($_GET['class_id']) ? $_GET['class_id'] : 0;
?>
<div class="d-flex">
    <ddiv class="d-flex flex-column flex-grow-1">
        <div class="flex-grow-1">
            <div class="d-flex">
                <h1 class="me-auto">NmTugasIdv <?php $tugas_individu_id ?></h1>
                <div>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#editTugasidvModal">
                        <i class="bi bi-pencil"></i> Edit Tugas
                    </button>
                </div>
            </div>
            <div class="d-flex">
                <h4 class="mt-auto mb-0">nmDosen</h4>
                <p class="ms-3 me-auto mb-0 mt-auto">Tanggal</p>
                <p class="mb-0 mt-auto">Tenggat : 12-12-12</p>
            </div>
            <hr>
            <div class="mb-5">
                <p>Petunjuk Tugas</p>
            </div>

            <div>
                <div class="d-flex flex-column align-items-center justify-content-center">
                    <form action="">
                        <div class="mb-3">
                            <label for="upload_file" class="form-label">Upload File</label>
                            <input class="form-control" type="file" id="upload_file">
                        </div>

                        <button type="button" class="btn btn-primary">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </ddiv>
    <div class="d-flex flex-column flex-shrink-1 ms-4" style="width: 250px;">
        <h2>Nilai</h2>
        <hr>
        <div class="d-flex">
            <div class="d-flex flex-column flex-grow-1 me-auto ">
                <p>Status</p>
                <p>Nilai</p>
                <p>Penilai</p>
                <p>Feedback</p>
            </div>
            <div class="d-flex flex-column flex-shrink-1 px-2 text-wrap">
                <p>none</p>
                <p>100/100</p>
                <p>Fajar Triatmojo</p>
                <p class="text-break">faskldjf;askldfj;asvmkdjrfvsaefjaseirfkjamoprmaes</p>
            </div>
        </div>
    </div>
</div>
<div class="d-flex my-5">
    <a href="home.php?page=class_content&class_id=<?php echo $class_id; ?>&tab=tugas" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Kembali ke Daftar Tugas
    </a>
</div>


<!-- Modal -->
<div class="modal fade" id="editTugasidvModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="editTugasiModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editTugasiModalLabel">Edit Tugas</h1>
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
                        <label for="tugas_due_time" class="form-label">Due Date</label>
                        <input type="date" class="form-control" id="tugas_due_time" name="tugas_due_time" required>
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