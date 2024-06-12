<div class="bg-primary text-white vh-100 d-flex flex-column position-fixed" style="width:250px;">
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link active text-white" aria-current="page" href="home.php?page=home_content">Beranda</a>
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