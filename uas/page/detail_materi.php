<?php
// Ambil ID materi dari parameter GET
$material_id = isset($_GET['material_id']) ? $_GET['material_id'] : 0;
$class_id = isset($_GET['class_id']) ? $_GET['class_id'] : 0; // Ambil ID kelas dari parameter GET

$material = getMaterialById($conn, $material_id);

$title = $material['title'];
$description = $material['description'];
$file_path = $material['file_path'];
$created_by = $material['created_by'];
$created_at = $material['created_at'];
$error_msg = $_GET['error'] ?? '';
?>
<!-- Error Message Alert -->
<?php if (!empty($error_msg)): ?>
    <div class='toast-container position-fixed bottom-0 end-0 p-3' style='z-index: 11'>
        <div class='toast align-items-center text-bg-danger border-0 show' role='alert' aria-live='assertive'
            aria-atomic='true'>
            <div class='d-flex'>
                <div class='toast-body'>
                    <?php echo $error_msg; ?>
                </div>
                <button type='button' class='btn-close btn-close-white me-2 m-auto' data-bs-dismiss='toast'
                    aria-label='Close'></button>
            </div>
        </div>
    </div>
<?php endif; ?>
<div class="d-flex">
    <h1 class="me-auto"><?php echo htmlspecialchars($title); ?></h1>
    <?php if ($user['role'] === 'teacher'): ?>
        <div>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editMateriModal">
                <i class="bi bi-pencil"></i> Edit Materi
            </button>
        </div>
    <?php endif; ?>
</div>
<div class="d-flex align-items-end">
    <h4><?php echo htmlspecialchars($created_by); ?></h4>
    <h5 class="ms-4"><?php echo htmlspecialchars($created_at); ?></h5>
</div>
<hr>
<h5><?php echo htmlspecialchars($description); ?></h5>
<div class="d-flex flex-column align-items-center">
    <div class="flex-grow-1 d-flex align-items-center justify-content-center" style="height: 200px;">
        <a href="<?php echo htmlspecialchars($file_path); ?>" class="btn btn-link">Download File</a>
    </div>
    <div class="d-flex align-self-start">
        <a href="home.php?page=class_content&class_id=<?php echo $class_id; ?>&tab=materi" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali ke Daftar Materi
        </a>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editMateriModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="editMateriModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editMateriModalLabel">Edit Materi</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="action_edit_material.php" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="materi_title" class="form-label">Judul Materi</label>
                        <input type="text" class="form-control" id="materi_title" name="materi_title"
                            value="<?php echo htmlspecialchars($title); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="materi_desc" class="form-label">Deskripsi Materi</label>
                        <input type="text" class="form-control" id="materi_desc" name="materi_desc"
                            value="<?php echo htmlspecialchars($description); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="materi_file" class="form-label">Pilih File Pendukung</label>
                        <input class="form-control" type="file" id="materi_file" name="materi_file">
                    </div>
                    <input type="hidden" name="material_id" value="<?php echo $material_id; ?>">
                    <input type="hidden" name="class_id" value="<?php echo $class_id; ?>">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>