<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Class Cards</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        .card {
            margin: 10px;
            width: 240px;
            height: 280px;

        }
    </style>
</head>

<body>

    <div class="d-flex flex-wrap justify-content-start">
        <?php
        // Define the number of classes
        $num_classes = 6;

        // Loop through the number of classes and generate the cards
        for ($i = 1; $i <= $num_classes; $i++) {
            echo '
                <div class="card mx-2 mb-3">
                    <div class="card-header bg-danger text-white d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title mb-0">Class ' . $i . '</h5>
                            <p class="card-text mb-0">Instructor Name ' . $i . '</p>
                        </div>
                        <div class="rounded-circle bg-success" style="width: 50px; height: 50px;"></div>
                    </div>
                    <div class="card-body bg-secondary">
                        <p class="card-text">Description of the class ' . $i . '</p>
                    </div>
                </div>
                ';
        }
        ?>
    </div>

</body>

</html>