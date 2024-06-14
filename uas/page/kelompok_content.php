<?php
include '../db/koneksi.php';
include 'function_user.php';
include 'function_class.php';
include 'function_group.php';

$class_id = isset($_GET['class_id']) ? $_GET['class_id'] : 0;

$groups = getGroupsByClassId($conn, $class_id);
$students = getStudentsWithoutGroups($conn, $class_id);
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
    <div class="d-flex justify-content-center mb-5">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahKelompokModal">
            <i class="bi bi-plus"></i>Tambah Kelomopok
        </button>
    </div>

    <?php foreach ($groups as $group): ?>
        <div class="container p-3 mb-4" style="border: 2px solid gray; border-radius: 24px;">
            <div class="d-flex flex-column justify-content-start">
                <div class="me-3">
                    <h3><?php echo htmlspecialchars($group['name']); ?></h3>
                </div>
                <div class="d-flex flex-column justify-content-start px-3">
                    <h4>Leader</h4>
                    <div class="ms-3">
                        <h5><?php echo htmlspecialchars($group['leader']); ?></h5>
                    </div>
                </div>
                <div class="d-flex flex-column justify-content-start px-3">
                    <h4>Member</h4>
                    <div class="d-flex flex-column ms-3">
                        <?php foreach ($group['members'] as $member): ?>
                            <h5><?php echo htmlspecialchars($member); ?></h5>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<div class="modal fade" id="tambahKelompokModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="tambahKelompokModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="tambahKelompokModalLabel">Tambah Kelompok</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="action_add_group.php">
                <div class="modal-body">
                    <input type="hidden" name="class_id" value="<?php echo $class_id; ?>">
                    <div class="mb-3">
                        <label for="group_name" class="form-label">Nama Kelompok</label>
                        <input type="text" class="form-control" id="group_name" name="group_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="group_desc" class="form-label">Deskripsi Kelompok</label>
                        <textarea class="form-control" id="group_desc" name="group_desc" rows="3" required></textarea>
                    </div>
                    <?php foreach ($students as $student): ?>
                        <div class="d-flex align-items-center mb-2">
                            <div class="flex-shrink-0 p-2">
                                <input type="radio" class="form-check-input" name="leader"
                                    value="<?php echo htmlspecialchars($student['user_id']); ?>" required>
                            </div>
                            <div class="flex-grow-1 p-2 d-flex align-items-center">
                                <img src="<?php echo htmlspecialchars($student['profile_pic']); ?>"
                                    class="rounded-circle me-3" width="50" height="50" alt="...">
                                <div><?php echo htmlspecialchars($student['name']); ?></div>
                            </div>
                            <div class="flex-shrink-0 p-2">
                                <input type="checkbox" class="form-check-input" name="members[]"
                                    value="<?php echo htmlspecialchars($student['user_id']); ?>">
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
