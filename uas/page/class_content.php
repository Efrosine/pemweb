<?php
$tab = isset($_GET['tab']) ? $_GET['tab'] : 'materi'; // Ambil tab dari parameter GET, default ke 'materi'

include '../db/koneksi.php';
include 'function_class.php';
include 'function_user.php';

$user = isAuthorized($conn);
$class_id = intval($_GET['class_id']);
$class = getClassById($conn, $class_id);
?>
<div class="d-flex flex-column justify-content-start">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link <?php echo ($tab == 'materi') ? 'active' : ''; ?>"
                href="home.php?page=class_content&class_id=<?php echo $class_id; ?>&tab=materi" role="tab">materi</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link <?php echo ($tab == 'tugas') ? 'active' : ''; ?>"
                href="home.php?page=class_content&class_id=<?php echo $class_id; ?>&tab=tugas" role="tab">tugas</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link <?php echo ($tab == 'kelompok') ? 'active' : ''; ?>"
                href="home.php?page=class_content&class_id=<?php echo $class_id; ?>&tab=kelompok"
                role="tab">kelompok</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link <?php echo ($tab == 'forum') ? 'active' : ''; ?>"
                href="home.php?page=class_content&class_id=<?php echo $class_id; ?>&tab=forum" role="tab">forum</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link <?php echo ($tab == 'orang') ? 'active' : ''; ?>"
                href="home.php?page=class_content&class_id=<?php echo $class_id; ?>&tab=orang" role="tab">orang</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link <?php echo ($tab == 'nilai') ? 'active' : ''; ?>"
                href="home.php?page=class_content&class_id=<?php echo $class_id; ?>&tab=nilai" role="tab">nilai</a>
        </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content px-4 pt-4">
        <div class="tab-pane <?php echo ($tab == 'materi') ? 'active' : ''; ?>" id="materi" role="tabpanel"
            aria-labelledby="materi-tab" tabindex="0">
            <?php
            if (isset($_GET['material_id'])) {
                include ('detail_materi.php');
            } else {
                include ('materi_content.php');
            }
            ?>
        </div>
        <div class="tab-pane <?php echo ($tab == 'tugas') ? 'active' : ''; ?>" id="tugas" role="tabpanel"
            aria-labelledby="tugas-tab" tabindex="0">
            <?php
            if (isset($_GET['tugas_individu_id'])) {
                include ('detail_tugas_individu.php'); // Memuat detail tugas individu
            } elseif (isset($_GET['tugas_kelompok_id'])) {
                include ('detail_tugas_kelompok.php'); // Memuat detail tugas kelompok
            } else {
                include ('tugas_content.php'); // Memuat daftar tugas
            }
            ?>
        </div>
        <div class="tab-pane <?php echo ($tab == 'kelompok') ? 'active' : ''; ?>" id="kelompok" role="tabpanel"
            aria-labelledby="kelompok-tab" tabindex="0">
            <?php
            include ('kelompok_content.php');
            ?>
        </div>
        <div class="tab-pane <?php echo ($tab == 'forum') ? 'active' : ''; ?>" id="forum" role="tabpanel"
            aria-labelledby="forum-tab" tabindex="0">
            <?php
            include ('forum_content.php');
            ?>
        </div>
        <div class="tab-pane <?php echo ($tab == 'orang') ? 'active' : ''; ?>" id="orang" role="tabpanel"
            aria-labelledby="orang-tab" tabindex="0">
            <?php
            include ('orang_content.php');
            ?>
        </div>
        <div class="tab-pane <?php echo ($tab == 'nilai') ? 'active' : ''; ?>" id="nilai" role="tabpanel"
            aria-labelledby="nilai-tab" tabindex="0">
            <?php
            include ('nilai_content.php');
            ?>
        </div>
    </div>
</div>