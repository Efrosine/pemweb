<?php
include '../db/koneksi.php';
include 'function_user.php';
include 'function_class.php';

$class_id = isset($_GET['class_id']) ? $_GET['class_id'] : 0;

$teachers = getUsersByRoleAndClass($conn, 'teacher', $class_id);
$students = getUsersByRoleAndClass($conn, 'student', $class_id);

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
    <?php if ($user['role'] == 'teacher'): ?>
        <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-primary ms-5" data-bs-toggle="modal" data-bs-target="#tambahOrangModal">
                <i class="bi bi-plus"></i> Tambah Orang
            </button>
        </div>
    <?php endif; ?>
    <h2>Pengajar</h2>
    <form method="POST" action="action_delete_members.php">
        <div class="m-3">
            <input type="hidden" name="class_id" value="<?php echo $class_id; ?>">
            <?php foreach ($teachers as $teacher): ?>
                <div class="d-flex mb-3 align-items-center">
                    <input type="checkbox" name="delete_members[]" value="<?php echo $teacher['user_id']; ?>"
                        class="form-check-input me-2">
                    <img src="<?php echo htmlspecialchars($teacher['profile_pic']); ?>" class="rounded-circle me-5"
                        width="50" height="50" alt="...">
                    <h5><?php echo htmlspecialchars($teacher['name']); ?></h5>
                </div>
            <?php endforeach; ?>
        </div>
        <h2>Siswa</h2>
        <div class="m-3">
            <?php foreach ($students as $student): ?>
                <div class="d-flex mb-3 align-items-center">
                    <input type="checkbox" name="delete_members[]" value="<?php echo $student['user_id']; ?>"
                        class="form-check-input me-2">
                    <img src="<?php echo htmlspecialchars($student['profile_pic']); ?>" class="rounded-circle me-5"
                        width="50" height="50" alt="...">
                    <h5><?php echo htmlspecialchars($student['name']); ?></h5>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-danger">Hapus Anggota Terpilih</button>
        </div>
    </form>
</div>



<div class="modal fade" id="tambahOrangModal" data-bs-backdrop="static" tabindex="-1"
    aria-labelledby="tambahOrangModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahOrangModalLabel">Tambah Orang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="action_add_orang.php">
                    <input type="hidden" name="class_id" value="<?php echo $class_id; ?>">
                    <div class="mb-3">
                        <label for="uuid_user" class="form-label">UUID User</label>
                        <select class="form-control" id="uuid_user" name="uuid_user" required>
                            <option value="">Pilih User</option>
                            <?php
                            $users = getAllUsers($conn);
                            foreach ($users as $user) {
                               
                                    echo '<option value="' . $user['uuid'] . '">' . htmlspecialchars($user['name']) . '</option>';
                                
                            }
                            ?>
                        </select>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>