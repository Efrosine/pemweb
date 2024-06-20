<?php
// Include file function_nilai.php
include 'function_nilai.php';
include '../db/koneksi.php';
include 'function_class.php';

// Ambil class_id dari URL
$class_id = isset($_GET['class_id']) ? $_GET['class_id'] : 0;

// Panggil fungsi untuk mendapatkan data anggota kelas
$student = getClassMembers($conn, $class_id);
$group = getClassGroup($conn, $class_id);




$groupTasks = array_filter($tasks, function ($task) {
    return $task['type'] === 'group';
});

$individualTasks = array_filter($tasks, function ($task) {
    return $task['type'] === 'individual';
});

function getGradeBySubmission($conn, $user_id, $task_id)
{
    $grade = '';
    $sql = "SELECT g.grade FROM grade g JOIN submission s ON g.submission_id = s.submission_id WHERE s.user_id = ? AND s.task_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $user_id, $task_id);
    $stmt->execute();
    $stmt->bind_result($grade);
    $stmt->fetch();
    return $grade ? $grade : 0;
}
function getGroupGradeBySubmission($conn, $user_id, $task_id)
{
    $grade = '';
    $sql = "SELECT g.grade FROM grade g JOIN submission s ON g.submission_id = s.submission_id WHERE s.user_id = ? AND s.task_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $user_id, $task_id);
    $stmt->execute();
    $stmt->bind_result($grade);
    $stmt->fetch();
    return $grade ? $grade : 0;
}


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
    <div class="d-flex flex-column">

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Nama (Indi)</th>
                        <?php foreach ($individualTasks as $task): ?>
                            <th scope="col">
                                <div>
                                    <form method="post" action="">
                                        <input type="hidden" name="tugas_name" value="<?php echo $task['title']; ?>">
                                        <button type="submit" name="tugas_id" value="<?php echo $task['task_id']; ?>"
                                            class="btn btn-link p-0 m-0 align-baseline"><?php echo htmlspecialchars($task['title']); ?></button>
                                    </form>
                                </div>
                            </th>

                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($students as $student): ?>
                        <tr>
                            <th scope="row"><?php echo htmlspecialchars($student['name']); ?></th>
                            <?php foreach ($individualTasks as $task): ?>
                                <td><?php echo getGradeBySubmission($conn, $student['user_id'], $task['task_id']); ?></td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Nama Kel</th>
                        <?php foreach ($groupTasks as $task): ?>
                            <th scope="col">
                                <div>
                                    <form method="post" action="">
                                        <button type="submit" name="tugas_id" value="<?php echo $task['task_id']; ?>"
                                            class="btn btn-link p-0 m-0 align-baseline"><?php echo htmlspecialchars($task['title']); ?></button>
                                    </form>
                                </div>
                            </th>

                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($group as $gc): ?>
                        <tr>
                            <th scope="row"><?php echo htmlspecialchars($group['name']); ?></th>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

        </div>
    </div>

    <?php if (isset($_POST['tugas_id'])): ?>
        <?php $tugas_id = $_POST['tugas_id'];
        $tugas_name = $_POST['tugas_name'] ?>

        <div class="modal fade show" id="penilaianModal" tabindex="-1" aria-labelledby="penilaianModalLabel"
            aria-modal="true" role="dialog" style="display: block;">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <form method="post" action="">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="penilaianModalLabel">Penilaian Tugas :
                                <?php echo $tugas_name; ?>
                            </h1>
                            <button type="submit" name="close_modal" class="btn-close" aria-label="Close"></button>
                        </div>
                    </form>
                    <div class="modal-body">
                        <form method="post" action="action_save_grade.php">
                            <input type="hidden" name="tugas_id" value="<?php echo $tugas_id; ?>">
                            <input type="hidden" name="teacher_id" value="<?php echo $_SESSION['user_id']; ?>">
                            <?php foreach ($students as $student): ?>
                                <div class="mb-3">
                                    <input type="hidden" name="class_id" value="<?php echo $class_id; ?>">
                                    <label for="nilai_<?php echo $student['user_id']; ?>"
                                        class="form-label"><?php echo $student['name']; ?></label>
                                    <input type="number" class="form-control" id="nilai_<?php echo $student['user_id']; ?>"
                                        name="nilai[<?php echo $student['user_id']; ?>]" min="0" max="100"
                                        value="<?php echo getGradeBySubmission($conn, $student['user_id'], $tugas_id); ?>">
                                </div>
                            <?php endforeach; ?>
                            <div class="modal-footer">
                                <button type="submit" name="simpan_penilaian" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <script src="../bootstrap/js/popper.min.js"></script>
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>