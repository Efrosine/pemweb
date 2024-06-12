<?php
$class_id = isset($_GET['class_id']) ? $_GET['class_id'] : 0; // Ambil ID kelas dari parameter GET
?>
<div class="d-flex flex-column">
    <div class="d-flex justify-content-center">
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                Semua Tugas
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Semua Tugas</a></li>
                <li><a class="dropdown-item" href="#">Tugas Individu</a></li>
                <li><a class="dropdown-item" href="#">Tugas Kelompok</a></li>
            </ul>
        </div>
        <button type="button" class="btn btn-primary ms-5">
            <i class="bi bi-plus"></i>Tambah Tugas
        </button>
    </div>
    <h2>Tugas Individu</h2>
    <div class="m-3 p-3" style="border: 2px solid gray;border-radius: 24px;">
        <div class="d-flex flex-column justify-content-start">
            <a href="home.php?page=class_content&class_id=<?php echo $class_id; ?>&tugas_individu_id=1"
                class="text-decoration-none text-dark">
                <h3>Nm Tuagas</h3>
                <h4>tgl</h4>
                <hr>
                <div class="p-3">
                    <h5>Petunjuk</h5>
                </div>
            </a>
        </div>
    </div>
    <h2>Tugas Kelompok</h2>
    <div class="m-3 p-3" style="border: 2px solid gray;border-radius: 24px;">
        <div class="d-flex flex-column justify-content-start">
            <a href="home.php?page=class_content&class_id=<?php echo $class_id; ?>&tugas_kelompok_id=1"
                class="text-decoration-none text-dark">
                <div class="d-flex flex-row align-items-end">
                    <h3>Nm Tuagas</h3>
                    <div class="ms-3">
                        <h4>Nm Kelompok</h4>
                    </div>
                </div>
                <h4>tgl</h4>
                <hr>
                <div class="p-3">
                    <h5>Petunjuk</h5>
                </div>
            </a>
        </div>
    </div>
</div>