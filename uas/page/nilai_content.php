<?php
include '../db/koneksi.php';
include 'function_grade.php';
include 'function_study_group_grade.php';
include 'function_submission.php';
include 'function_group.php';
include 'function_user.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <style>
        .table th,
        .table td {
            min-width: 150px;
            /* Menetapkan lebar kolom konstan */
        }
    </style>
    <title>Scrollable Table</title>
</head>

<body>
    <?php
    $class_id = $_GET['class_id'];
    $students = getStudentsByClassId($conn, $class_id);
    $tugas = getTasksByClassId($conn, $class_id);

    ?>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Nama</th>
                    <?php foreach ($tugas as $task): ?>
                        <th scope="col">
                            <div>
                                <?php if ($_SESSION['role'] == 'teacher'): ?>
                                    <form method="post" action="">
                                        <button type="submit" name="tugas_id" value="<?php echo $task['task_id']; ?>"
                                            class="btn btn-link p-0 m-0 align-baseline" data-bs-toggle="modal"
                                            data-bs-target="#penilaianModal_<?php echo $task['task_id']; ?>">
                                            <?php echo htmlspecialchars($task['title']); ?>
                                        </button>
                                    </form>
                                <?php else: ?>
                                    <?php echo htmlspecialchars($task['title']); ?>
                                <?php endif; ?>
                            </div>
                            <small><?php echo htmlspecialchars($task['due_time']); ?></small>
                        </th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $student): ?>
                    <tr>
                        <th scope="row"><?php echo htmlspecialchars($student['name']); ?></th>
                        <?php foreach ($tugas as $task): ?>
                            <?php
                            $submission = getSubmission($conn, $student['user_id'], $task['task_id']);
                            if ($task['type'] == 'individual'):
                                $grade = $submission ? getGrade($conn, $student['user_id'], $submission['submission_id']) : 0;
                            else:
                                $group_id = getGroupIdByUserIdAndClassId($conn, $student['user_id'], $class_id);
                                $group_submission = $group_id ? getGroupSubmission($conn, $group_id, $task['task_id']) : null;
                                $grade = $group_submission ? getStudyGroupGrade($conn, $student['user_id'], $group_submission['study_group_submission_id']) : '-';
                            endif;
                            ?>
                            <td><?php echo $grade; ?></td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php if (isset($_POST['tugas_id']) && $_SESSION['role'] == 'teacher'): ?>
        <?php $tugas_id = $_POST['tugas_id']; ?>
        <div class="modal fade show" id="penilaianModal" tabindex="-1" aria-labelledby="penilaianModalLabel"
            aria-hidden="true" style="display: block;">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <form method="post" action="action_update_grade.php">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="penilaianModalLabel">Penilaian Tugas ID:
                                <?php echo $tugas_id; ?>
                            </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="tugas_id" value="<?php echo $tugas_id; ?>">
                            <?php foreach ($students as $student): ?>
                                <?php
                                $submission = getSubmission($conn, $student['user_id'], $tugas_id);
                                $grade = $submission ? getGradeDetails($conn, $submission['submission_id']) : null;
                                $grade_value = $grade ? $grade['grade'] : 0;
                                $feedback = $grade ? htmlspecialchars($grade['feedback'] ?? '-') : '-';
                                ?>
                                <div class="mb-3">
                                    <label for="nilai_<?php echo $student['user_id']; ?>"
                                        class="form-label"><?php echo $student['name']; ?></label>
                                    <input type="number" class="form-control" id="nilai_<?php echo $student['user_id']; ?>"
                                        name="nilai[<?php echo $student['user_id']; ?>]" min="0" max="100"
                                        value="<?php echo $grade_value; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="feedback_<?php echo $student['user_id']; ?>" class="form-label">Feedback</label>
                                    <textarea class="form-control" id="feedback_<?php echo $student['user_id']; ?>"
                                        name="feedback[<?php echo $student['user_id']; ?>]"
                                        rows="3"><?php echo $feedback; ?></textarea>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="simpan_penilaian" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php foreach ($tugas as $task): ?>
        <?php if ($_SESSION['role'] == 'teacher'): ?>
            <div class="modal fade" id="penilaianModal_<?php echo $task['task_id']; ?>" tabindex="-1"
                aria-labelledby="penilaianModalLabel_<?php echo $task['task_id']; ?>" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <form method="post" action="action_update_grade.php">
                            <input type="hidden" name="class_id" value="<?php echo $class_id; ?>">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="penilaianModalLabel_<?php echo $task['task_id']; ?>">Penilaian
                                    Tugas ID: <?php echo $task['task_id']; ?></h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="tugas_id" value="<?php echo $task['task_id']; ?>">
                                <?php foreach ($students as $student): ?>
                                    <?php
                                    $submission = getSubmission($conn, $student['user_id'], $task['task_id']);
                                    $grade = $submission ? getGradeDetails($conn, $submission['submission_id']) : null;
                                    $grade_value = $grade ? $grade['grade'] : 0;
                                    $feedback = $grade ? htmlspecialchars($grade['feedback'] ?? '-') : '-';
                                    ?>
                                    <div class="mb-3">
                                        <label for="nilai_<?php echo $student['user_id']; ?>"
                                            class="form-label"><?php echo $student['name']; ?></label>
                                        <input type="number" class="form-control" id="nilai_<?php echo $student['user_id']; ?>"
                                            name="nilai[<?php echo $student['user_id']; ?>]" min="0" max="100"
                                            value="<?php echo $grade_value; ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="feedback_<?php echo $student['user_id']; ?>" class="form-label">Feedback</label>
                                        <textarea class="form-control" id="feedback_<?php echo $student['user_id']; ?>"
                                            name="feedback[<?php echo $student['user_id']; ?>]"
                                            rows="3"><?php echo $feedback; ?></textarea>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="simpan_penilaian" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>

    <script src="../bootstrap/js/popper.min.js"></script>
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
        <?php if (isset($_POST['tugas_id']) && $_SESSION['role'] == 'teacher'): ?>
            var myModal = new bootstrap.Modal(document.getElementById('penilaianModal'), {});
            myModal.show();
        <?php endif; ?>
    </script>

</body>

</html>