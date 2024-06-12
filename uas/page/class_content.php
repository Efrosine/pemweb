<?php
$tab = isset($_GET['tab']) ? $_GET['tab'] : 'materi'; // Ambil tab dari parameter GET, default ke 'materi'
?>
<div class="d-flex flex-column justify-content-start">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link <?php echo ($tab == 'materi') ? 'active' : ''; ?>" id="materi-tab"
                data-bs-toggle="tab" data-bs-target="#materi" type="button" role="tab" aria-controls="materi"
                aria-selected="<?php echo ($tab == 'materi') ? 'true' : 'false'; ?>">materi</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link <?php echo ($tab == 'tugas') ? 'active' : ''; ?>" id="tugas-tab"
                data-bs-toggle="tab" data-bs-target="#tugas" type="button" role="tab" aria-controls="tugas"
                aria-selected="<?php echo ($tab == 'tugas') ? 'true' : 'false'; ?>">tugas</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link <?php echo ($tab == 'kelompok') ? 'active' : ''; ?>" id="kelompok-tab"
                data-bs-toggle="tab" data-bs-target="#kelompok" type="button" role="tab" aria-controls="kelompok"
                aria-selected="<?php echo ($tab == 'kelompok') ? 'true' : 'false'; ?>">kelompok</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link <?php echo ($tab == 'forum') ? 'active' : ''; ?>" id="forum-tab"
                data-bs-toggle="tab" data-bs-target="#forum" type="button" role="tab" aria-controls="forum"
                aria-selected="<?php echo ($tab == 'forum') ? 'true' : 'false'; ?>">forum</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link <?php echo ($tab == 'orang') ? 'active' : ''; ?>" id="orang-tab"
                data-bs-toggle="tab" data-bs-target="#orang" type="button" role="tab" aria-controls="orang"
                aria-selected="<?php echo ($tab == 'orang') ? 'true' : 'false'; ?>">orang</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link <?php echo ($tab == 'nilai') ? 'active' : ''; ?>" id="nilai-tab"
                data-bs-toggle="tab" data-bs-target="#nilai" type="button" role="tab" aria-controls="nilai"
                aria-selected="<?php echo ($tab == 'nilai') ? 'true' : 'false'; ?>">nilai</button>
        </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content px-5 pt-4">
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