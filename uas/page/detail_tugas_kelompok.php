<?php
include ('function_task.php');
include ('function_submission.php');
include ('function_discussion.php');

$tugas_kelompok_id = isset($_GET['tugas_kelompok_id']) ? $_GET['tugas_kelompok_id'] : 0;
$class_id = isset($_GET['class_id']) ? $_GET['class_id'] : 0;
$task_details = getTaskDetails($conn, $tugas_kelompok_id);
$user_id = $_SESSION['user_id'];
$user_role = $_SESSION['role'];

$submission = getGroupSubmission($conn, $user_id, $tugas_kelompok_id);
$grade = getGroupGrade($conn, $submission ? $submission['stdy_group_submission_id'] : 0);
$status = 'untracked';
if ($submission) {
    $status = $grade ? 'done' : 'waiting';
}

$group_id = getGroupIdByUserIdAndClassId($conn, $user_id, $class_id);
$group_discussions = getGroupDiscussions($conn, $group_id);
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
                        <input type="hidden" name="task_id" value="<?php echo $tugas_kelompok_id; ?>">
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

<div class="d-flex flex-column">
    <?php foreach ($group_discussions as $discussion): ?>
        <div class="m-3 p-3" style="border: 2px solid gray; border-radius: 24px;">
            <div class="d-flex flex-column">
                <h4><?php echo htmlspecialchars($discussion['name']); ?></h4>
                <div class="d-flex">
                    <h5 class="flex-grow-1"><?php echo htmlspecialchars($discussion['content']); ?></h5>
                    <h5><?php echo htmlspecialchars($discussion['created_at']); ?></h5>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<div class="position-fixed mx-5 mb-5" style="bottom: 0; left: 250; width: 70%;">
    <form action="action_add_group_discussion.php" method="post">
        <input type="hidden" name="group_id" value="<?php echo $group_id; ?>">
        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
        <div class="input-group mb-3">
            <input type="text" class="form-control border-primary px-3 py-2" name="content" placeholder="Tulis pesan"
                aria-label="Tulis Pesan" aria-describedby="button-addon2" required>
            <button class="btn btn-primary" type="submit" id="btn-kirim">Kirim</button>
        </div>
    </form>
</div>


<!-- Modal -->
<div class="modal fade" id="editTugasklmpModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="editTugasklmpModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editTugasklmpModalLabel">Edit Tugas</h1>
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