<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" href="../bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
    <title>Home</title>
</head>

<body class="d-flex flex-column vh-100">
    <nav class="navbar navbar-expand-lg bg-body-tertiary position-fixed w-100 z-3">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="#" alt="Logo" width="50" height="50" class="d-inline-block align-text-center">
                KelassssRuum
            </a>
            <div class="d-flex justify-content-center flex-grow-1">
                <span class="navbar-text mx-auto">
                    Siswa
                </span>
            </div>
            <div class="d-flex align-items-center">
                <a class="btn btn-primary me-3" href="#" role="button"><i class="bi bi-plus"></i> Tambah Kelas</a>
                <div class="dropdown">
                    <a class="nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <img src="#" alt="pp" class="rounded-circle me-5" width="50" height="50">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Logout</a></li>
                    </ul>
                </div>
            </div>
    </nav>

    <div class="d-flex">
        <!-- Sidebar -->
        <div class="bg-primary vh-100 position-fixed" style="top:0; left:0; width:250px; padding-top: 90px;">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active text-white" aria-current="page"
                        href="home.php?page=home_content">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#" data-bs-toggle="collapse" data-bs-target="#classDropdown"
                        aria-expanded="true" aria-controls="classDropdown">Kelas yang diikuti</a>
                    <div class="collapse show" id="classDropdown">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                            <li><a class="nav-link text-white" href="home.php?page=class_content&id=1">Class 1</a></li>
                            <li><a class="nav-link text-white" href="home.php?page=class_content&id=2">Class 2</a></li>
                            <li><a class="nav-link text-white" href="home.php?page=class_content&id=3">Class 3</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="d-flex flex-grow-1 flex-column vh-100 overflow-auto" style="margin-left: 250px; padding-top:90px">
            <!-- Dynamic content will be loaded here -->
            <?php
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
                $allowed_pages = ['home_content', 'class_content'];
                if (in_array($page, $allowed_pages)) {
                    if ($page === 'class' && isset($_GET['id'])) {
                        $id = intval($_GET['id']);
                        if ($id >= 1 && $id <= 3) {
                            include ('class_content.php');
                        } else {
                            echo '<h1>Class Not Found</h1><p>The class you are looking for does not exist.</p>';
                        }
                    } else {
                        include ($page . '.php');
                    }
                } else {
                    echo '<h1>Page Not Found</h1><p>The page you are looking for does not exist.</p>';
                }
            } else {
                include ('home_content.php');
            }
            ?>
        </div>
    </div>
    <script src="../bootstrap/js/popper.min.js"></script>
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>