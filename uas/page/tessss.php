<?php
// Include file function_nilai.php
include 'function_nilai.php';
include '../db/koneksi.php';
include 'function_class.php';

// Ambil class_id dari URL
$class_id = isset($_GET['class_id']) ? $_GET['class_id'] : 0;

// Panggil fungsi untuk mendapatkan data anggota kelas
$names = getClassMembers($conn, $class_id);
$task = getIndividualTaskByClassid($conn, $class_id);


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
    <title>Document</title>
</head>

<body>
    <div class="d-flex flex-column">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Nama</th>
                        <?php foreach ($tasks as $task): ?>
                            <th scope="col">
                                <div>
                                    <form method="post" action="">
                                        <button type="submit" name="tugas_id" value="<?php echo $task['task_id']; ?>"
                                            class="btn btn-link p-0 m-0 align-baseline"><?php echo htmlspecialchars($task['title']); ?></button>
                                    </form>
                                </div>
                                <small>tgl</small>
                            </th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
        </div>
    </div>
    <script src="../bootstrap/js/popper.min.js"></script>
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>