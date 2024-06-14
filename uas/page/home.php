<?php
session_start();
include '../db/koneksi.php';
include 'function_class.php';
include 'function_user.php';
include 'function_material.php';

$user = isAuthorized($conn);
if (!$user) {
    header("Location: form_login.php");
    exit();
}

$classes = getClassesByUserId($conn, $user['user_id']);
// Include these lines after user authorization check
$class_name = $user['name']; // Default to user name

if (isset($_GET['page']) && $_GET['page'] === 'class_content' && isset($_GET['class_id'])) {
    $class_id = intval($_GET['class_id']);
    $class = getClassById($conn, $class_id); // Assume getClassById is a function that retrieves class details by ID
    if ($class) {
        $class_name = $class['name'];
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['logout'])) {
        logout();
    } elseif (isset($_POST['create_class'])) {
        $class_name = $_POST['class_name'];
        $class_desc = $_POST['class_desc'];
        $result = createClass($conn, $class_name, $class_desc, $_SESSION['user_id']);
        if ($result !== true) {
            $error_msg = $result;
        }
    } elseif (isset($_POST['join_class'])) {
        $class_code = $_POST['class_code'];
        $result = joinClass($conn, $_SESSION['user_id'], $class_code);
        if ($result !== true) {
            $error_msg = $result;
        }
    }
}

?>

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
    <!-- Error Message Alert -->
    <?php if (!empty($error_msg)): ?>
        <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 11">
            <div class="toast align-items-center text-bg-danger border-0 show" role="alert" aria-live="assertive"
                aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        <?php echo htmlspecialchars($error_msg); ?>
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <nav class="navbar navbar-expand-lg bg-body-tertiary position-fixed w-100 z-3">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="../data/logo.png" alt="Logo" width="50" height="50"
                    class="d-inline-block align-text-center rounded-circle">
                KelassssRuum
            </a>
            <div class="d-flex justify-content-center flex-grow-1">
                <span class="navbar-text mx-auto">
                    <?php echo htmlspecialchars($class_name); ?>
                </span>
            </div>
            <div class="d-flex align-items-center">
                <?php if ($user['role'] == 'teacher'): ?>
                    <button type="button" class="btn btn-primary me-5" data-bs-toggle="modal"
                        data-bs-target="#tambahKelasModal">
                        <i class="bi bi-plus"></i> Tambah Kelas
                    </button>
                <?php else: ?>
                    <button type="button" class="btn btn-primary me-5" data-bs-toggle="modal"
                        data-bs-target="#gabungKelasModal">
                        <i class="bi bi-plus"></i> Gabung Kelas
                    </button>
                <?php endif; ?>
                <div class="dropdown">
                    <a class="nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <img src="<?php echo htmlspecialchars($user['profile_pic']); ?>" alt="pp"
                            class="rounded-circle me-5" width="50" height="50">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form method="post" action="">
                                <button type="submit" name="logout" class="dropdown-item"
                                    style="border: none; background: none;">Logout</button>
                            </form>
                        </li>
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
                            <?php foreach ($classes as $class): ?>
                                <li><a class="nav-link text-white ms-3"
                                        href="home.php?page=class_content&class_id=<?php echo htmlspecialchars($class['class_id']); ?>"><?php echo htmlspecialchars($class['name']); ?></a>
                                </li>
                            <?php endforeach; ?>
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
                    if ($page === 'class_content' && isset($_GET['class_id'])) {
                        $class_id = intval($_GET['class_id']);
                        if ($class_id >= 1) {
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

    <!-- Modal Tambah Kelas untuk Teacher -->
    <div class="modal fade" id="tambahKelasModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="tambahKelasModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="tambahKelasModalLabel">Tambah Kelas</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="post">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="class_name" class="form-label">Nama Kelas</label>
                            <input type="text" class="form-control" id="class_name" name="class_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="class_desc" class="form-label">Deskripsi Kelas</label>
                            <input type="text" class="form-control" id="class_desc" name="class_desc" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="create_class" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Gabung Kelas untuk Student -->
    <div class="modal fade" id="gabungKelasModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="gabungKelasModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="gabungKelasModalLabel">Gabung Kelas</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="post">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="class_code" class="form-label">Kode Kelas</label>
                            <input type="text" class="form-control" id="class_code" name="class_code" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="join_class" class="btn btn-primary">Gabung</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="../bootstrap/js/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"
        integrity="sha384-eJ3tzG6txP3pIQYSpuF3J5g8o/hU/Ce6uB5hUAZTLbsNfEL8A0xl3ajGz9lF7MkR"
        crossorigin="anonymous"></script>
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>