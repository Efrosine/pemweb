<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/style.css">
    <title>Home</title>
</head>

<body class="d-flex flex-column vh-100">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-primary">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01"
                aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <a class="navbar-brand" href="#">Hidden brand</a>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="home.php?page=home_content">Beranda</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#classDropdown"
                    aria-expanded="true" aria-controls="classDropdown">Kelas yang diikuti</a>
                <div class="collapse show" id="classDropdown"> <!-- Tambahkan kelas 'show' di sini -->
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li><a class="nav-link" href="home.php?page=class_content&id=1">Class 1</a></li>
                        <li><a class="nav-link" href="home.php?page=class_content&id=2">Class 2</a></li>
                        <li><a class="nav-link" href="home.php?page=class_content&id=3">Class 3</a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content-container d-flex flex-column align-items-center justify-content-center">
        <div class="content">
            <div id="main-content">
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
    </div>


    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>