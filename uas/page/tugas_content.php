<?php
include '../db/koneksi.php';
include 'function_task.php';
include 'function_group.php';

$class_id = isset($_GET['class_id']) ? $_GET['class_id'] : 0;
$user_role = $_SESSION['role']; // Assuming user role is stored in session
$user_id = $_SESSION['user_id']; // Assuming user ID is stored in session

$type_filter = isset($_GET['type']) ? $_GET['type'] : 'all';

$tasks = [];

if ($type_filter == 'individual') {
    $tasks = getTasksByClassIdAndType($conn, $class_id, 'individual');
} elseif ($type_filter == 'group') {
    if (isStudentInGroup($conn, $user_id, $class_id) || $user_role == 'teacher') {
        $tasks = getTasksByClassIdAndType($conn, $class_id, 'group');
    } else {
        $tasks = [];
    }
} else {
    if (isStudentInGroup($conn, $user_id, $class_id) || $user_role == 'teacher') {
        $tasks = getTasksByClassIdAndType($conn, $class_id);
    } else {
        $tasks = getTasksByClassIdAndType($conn, $class_id, 'individual');
    }
}


?>

<div class="d-flex flex-column">
    <div class="d-flex justify-content-center">
        <div class="btn-group" role="group" aria-label="button group">
            <a href="home.php?page=class_content&tab=tugas&class_id=<?php echo $class_id; ?>&type=all"
                class="btn btn-outline-primary <?php echo $type_filter == 'all' ? 'active' : ''; ?>">Semua</a>
            <a href="home.php?page=class_content&tab=tugas&class_id=<?php echo $class_id; ?>&type=individual"
                class="btn btn-outline-primary <?php echo $type_filter == 'individual' ? 'active' : ''; ?>">Individu</a>
            <a href="home.php?page=class_content&tab=tugas&class_id=<?php echo $class_id; ?>&type=group"
                class="btn btn-outline-primary <?php echo $type_filter == 'group' ? 'active' : ''; ?>">Kelompok</a>
        </div>
        <?php if ($user_role == 'teacher'): ?>
            <button type="button" class="btn btn-primary ms-5" data-bs-toggle="modal" data-bs-target="#tambahTugasiModal">
                <i class="bi bi-plus"></i>Tambah Tugas
            </button>
        <?php endif; ?>
    </div>

    <?php if (empty($tasks)): ?>
        <div class="m-3 p-3" style="border: 2px solid gray; border-radius: 24px;">
            <p>Tidak ada tugas untuk ditampilkan.</p>
        </div>
    <?php else: ?>
        <?php foreach ($tasks as $task): ?>
            <div class="m-3 p-3" style="border: 2px solid gray; border-radius: 24px;">
                <div class="d-flex flex-column justify-content-start">
                    <?php if ($task['type'] == 'individual'): ?>
                        <a href="home.php?page=class_content&tab=tugas&class_id=<?php echo $class_id; ?>&tugas_individu_id=<?php echo $task['task_id']; ?>"
                            class="text-decoration-none text-dark">
                        <?php else: ?>
                            <a href="home.php?page=class_content&tab=tugas&class_id=<?php echo $class_id; ?>&tugas_kelompok_id=<?php echo $task['task_id']; ?>"
                                class="text-decoration-none text-dark">
                            <?php endif; ?>
                            <h3><?php echo htmlspecialchars($task['title']); ?></h3>
                            <h4><?php echo htmlspecialchars($task['due_time']); ?></h4>
                            <hr>
                            <div class="p-3">
                                <h5><?php echo htmlspecialchars($task['description']); ?></h5>
                            </div>
                        </a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<!-- Modal -->
<div class="modal fade" id="tambahTugasiModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="tambahTugasiModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="tambahTugasiModalLabel">Tambah Tugas</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="action_add_task.php" method="post">
                <div class="modal-body">
                    <input type="hidden" name="class_id" value="<?php echo $class_id; ?>">
                    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                    <div class="mb-3">
                        <label for="task_title" class="form-label">Judul Tugas</label>
                        <input type="text" class="form-control" id="task_title" name="task_title" required>
                    </div>
                    <div class="mb-3">
                        <label for="task_desc" class="form-label">Petujuk Tugas</label>
                        <input type="text" class="form-control" id="task_desc" name="task_desc" required>
                    </div>
                    <div class="mb-3">
                        <label for="task_file" class="form-label">Pilih File Pendukung</label>
                        <input class="form-control" type="file" id="task_file">
                    </div>
                    <div class="mb-3">
                        <label for="task_type" class="form-label">Tipe Tugas</label>
                        <select class="form-select" id="task_type" name="task_type"
                            aria-label="Example select with button addon">
                            <option value="individual">Individu</option>
                            <option value="group">Group</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="task_due_time" class="form-label">Due Date</label>
                        <input type="date" class="form-control" id="task_due_time" name="task_due_time" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>