<?php
include '../db/koneksi.php';
include 'function_class.php';
include 'function_user.php';
$user = isAuthorized($conn);
$classes = getClassesByUserId($conn, $user['user_id']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Class Cards</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
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
        foreach ($classes as $class) {
            echo '
                <a href="home.php?page=class_content&class_id=' . htmlspecialchars($class['class_id']) . '" class="text-decoration-none">
                    <div class="card mx-2 mb-3">
                        <div class="card-header bg-danger text-white d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title mb-0">' . htmlspecialchars($class['name']) . '</h5>
                                <p class="card-text mb-0">Instructor: ' . htmlspecialchars($class['created_by']) . '</p>
                            </div>
                            <div class="rounded-circle bg-success" style="width: 50px; height: 50px;">
                                <img src="' . htmlspecialchars($class['profile_pic']) . '" alt="Instructor Pic" class="rounded-circle" style="width: 50px; height: 50px;">
                            </div>
                        </div>
                        <div class="card-body bg-secondary">
                            <p class="card-text">' . htmlspecialchars($class['description']) . '</p>
                        </div>
                    </div>
                </a>
            ';
        }
        ?>
    </div>

    <script src="../bootstrap/js/bootstrap.min.js"></script>
</body>

</html>