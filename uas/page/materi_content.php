<?php
$class_id = isset($_GET['class_id']) ? $_GET['class_id'] : 0; // Ambil ID kelas dari parameter GET
$materials = getMaterialsByClassId($conn, $class_id);
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
<div class="d-flex flex-column">
    <div class="container-fluid pt-5 pb-3" style="border-radius: 24px; border: 2px solid blue;">
        <div class="d-flex flex-column justify-content-start px-3">
            <div class="d-flex align-items-end flex-row">
                <div class="me-3">
                    <h1>
                        <?php echo htmlspecialchars($class['name']); ?>
                    </h1>
                </div>
                <div class="me-auto">
                    <h3>
                        <?php echo htmlspecialchars($class['created_by']); ?>
                    </h3>
                </div>
                <h3>Code :
                    <?php echo htmlspecialchars($class['code']); ?>
                </h3>
            </div>
            <h4 class="px-4">
                <?php echo htmlspecialchars($class['description']); ?>
            </h4>
        </div>
    </div>

    <?php if ($_SESSION['role'] == 'teacher'): ?>
        <div class="d-flex justify-content-center my-5">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahMateriModal">
                <i class="bi bi-plus"></i> Tambah Materi
            </button>
        </div>
    <?php endif; ?>

    <div class="m-5">
        <h2>Materi</h2>
    </div>

    <?php if (empty($materials)): ?>
        <div class="d-flex flex-column justify-content-start p-3">
            <p>Belum Ada Materi</p>
        </div>
    <?php else: ?>
        <?php foreach ($materials as $material): ?>
            <div class="container mb-3" style="border: 2px solid gray; border-radius: 24px;">
                <div class="d-flex flex-column justify-content-start p-3">
                    <a href="home.php?page=class_content&tab=materi&class_id=<?php echo $class_id; ?>&material_id=<?php echo $material['material_id']; ?>"
                        class="text-decoration-none text-dark">
                        <div class="me-3">
                            <h5>
                                <?php echo htmlspecialchars($material['created_by']); ?> Memposting materi baru :
                                <?php echo htmlspecialchars($material['title']); ?>
                            </h5>
                        </div>
                        <h6>
                            <?php echo htmlspecialchars($material['created_at']); ?>
                        </h6>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
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
            <form action="action_add_material.php" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="class_id" value="<?php echo $class_id; ?>">
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
                        <input class="form-control" type="file" id="materi_file" name="materi_file">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="add_material" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>