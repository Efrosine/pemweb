<?php
include ('function_task.php');
include ('function_submission.php');

$tugas_individu_id = isset($_GET['tugas_individu_id']) ? $_GET['tugas_individu_id'] : 0;
$class_id = isset($_GET['class_id']) ? $_GET['class_id'] : 0;
$task_details = getTaskDetails($conn, $tugas_individu_id);
$user_id = $_SESSION['user_id'];
$user_role = $_SESSION['role'];

$submission = getSubmission($conn, $user_id, $tugas_individu_id);
$grade = getGrade($conn, $submission ? $submission['submission_id'] : 0);
$status = 'untracked';
if ($submission) {
    $status = $grade ? 'done' : 'waiting';
}
?>
<div class="d-flex">
    <div class="d-flex flex-column flex-grow-1">
        <div class="flex-grow-1">
            <div class="d-flex">
                <div class="d-flex flex-column flex-grow-1">
                    <div class="flex-grow-1">
                        <div class="d-flex">
                            <h1 class="me-auto"><?php echo htmlspecialchars($task_details['title']); ?></h1>
                            <?php if ($user_role == 'teacher'): ?>
                                <div>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#editTugasModal">
                                        <i class="bi bi-pencil"></i> Edit Tugas
                                    </button>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="d-flex">
                            <h4 class="mt-auto mb-0"><?php echo htmlspecialchars($task_details['created_by_name']); ?>
                            </h4>
                            <p class="ms-3 me-auto mb-0 mt-auto">
                                <?php echo htmlspecialchars($task_details['created_at']); ?>
                            </p>
                            <p class="mb-0 mt-auto">Tenggat: <?php echo htmlspecialchars($task_details['due_time']); ?>
                            </p>
                        </div>
                        <hr>
                        <div class="mb-5">
                            <p><?php echo htmlspecialchars($task_details['description']); ?></p>
                        </div>
                    </div>
                </div>
            </div>


            <div>
                <div class="d-flex flex-column align-items-center justify-content-center">
                    <form action="action_upload_submission.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="task_id" value="<?php echo $tugas_individu_id; ?>">
                        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                        <input type="hidden" name="class_id" value="<?php echo $class_id; ?>">
                        <div class="mb-3">
                            <label for="upload_file" class="form-label">Upload File</label>
                            <input class="form-control" type="file" id="upload_file" name="upload_file">
                        </div>
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
                <p><?php echo $status ? htmlspecialchars($status) : 'untracked'; ?></p>
                <p><?php echo $grade ? htmlspecialchars($grade['grade']) : '-'; ?></p>
                <p><?php echo $grade ? htmlspecialchars($grade['evaluator_name']) : '-'; ?></p>
                <p class="text-break"><?php echo $grade ? htmlspecialchars($grade['feedback']) : '-'; ?></p>
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
<div class="modal fade" id="editTugasModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="editTugasModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editTugasModalLabel">Edit Tugas</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="action_edit_task.php" method="post">
                <div class="modal-body">
                    <input type="hidden" name="task_id" value="<?php echo $task_details['task_id']; ?>">
                    <input type="hidden" name="class_id" value="<?php echo $class_id; ?>">
                    <div class="mb-3">
                        <label for="task_title" class="form-label">Judul Tugas</label>
                        <input type="text" class="form-control" id="task_title" name="task_title"
                            value="<?php echo htmlspecialchars($task_details['title']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="task_desc" class="form-label">Petunjuk Tugas</label>
                        <textarea class="form-control" id="task_desc" name="task_desc" rows="3"
                            required><?php echo htmlspecialchars($task_details['description']); ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="task_type" class="form-label">Tipe Tugas</label>
                        <select class="form-select" id="task_type" name="task_type" required>
                            <option value="individual" <?php echo ($task_details['type'] == 'individual') ? 'selected' : ''; ?>>Individu</option>
                            <option value="group" <?php echo ($task_details['type'] == 'group') ? 'selected' : ''; ?>>
                                Kelompok</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="task_due_time" class="form-label">Due Date</label>
                        <input type="date" class="form-control" id="task_due_time" name="task_due_time"
                            value="<?php echo htmlspecialchars($task_details['due_time']); ?>" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>