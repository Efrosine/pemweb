<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css">
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
                        <?php for ($i = 1; $i <= 25; $i++): ?>
                            <th scope="col">
                                <div>Nama tugas <?php echo $i; ?></div>
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
                            <?php for ($k = 1; $k <= 24; $k++): ?>
                                <td><?php echo rand(50, 100); ?></td>
                            <?php endfor; ?>
                        </tr>
                    <?php endfor; ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
</body>

</html>