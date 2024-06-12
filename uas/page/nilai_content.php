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
                        <th scope="col">Nama</th>
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <th scope="col">
                                <div>
                                    <form method="post" action="">
                                        <button type="submit" name="tugas_id" value="<?php echo $i; ?>"
                                            class="btn btn-link p-0 m-0 align-baseline">Nama tugas
                                            <?php echo $i; ?></button>
                                    </form>
                                </div>
                                <small>tgl</small>
                            </th>
                        <?php endfor; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $names = ["Mark", "Jacob", "Larry", "John", "Jane", "Michael", "Sarah", "David", "Emily", "Daniel"];
                    for ($j = 0; $j < 10; $j++):
                        ?>
                        <tr>
                            <th scope="row"><?php echo $j + 1; ?></th>
                            <td><?php echo $names[$j]; ?></td>
                            <?php for ($k = 1; $k <= 4; $k++): ?>
                                <td><?php echo rand(50, 100); ?></td>
                            <?php endfor; ?>
                        </tr>
                    <?php endfor; ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php if (isset($_POST['tugas_id'])): ?>
        <?php $tugas_id = $_POST['tugas_id']; ?>
        <div class="modal fade show" id="penilaianModal" tabindex="-1" aria-labelledby="penilaianModalLabel"
            aria-modal="true" role="dialog" style="display: block;">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="penilaianModalLabel">Penilaian Tugas ID: <?php echo $tugas_id; ?>
                        </h1>
                        <form method="post" action="">
                            <button type="submit" name="close_modal" class="btn-close" aria-label="Close"></button>
                        </form>

                    </div>
                    <div class="modal-body">
                        <form method="post" action="">
                            <input type="hidden" name="tugas_id" value="<?php echo $tugas_id; ?>">
                            <?php foreach ($names as $name): ?>
                                <div class="mb-3">
                                    <label for="nilai_<?php echo $name; ?>" class="form-label"><?php echo $name; ?></label>
                                    <input type="number" class="form-control" id="nilai_<?php echo $name; ?>"
                                        name="nilai[<?php echo $name; ?>]" min="0" max="100">
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