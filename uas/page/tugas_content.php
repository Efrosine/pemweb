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
            <h3>Nm Tuagas</h3>
            <h4>tgl</h4>
            <hr>
            <div class="p-3">
                <h5>Petunjuk</h5>
            </div>
        </div>
    </div>
    <h2>Tugas Kelompok</h2>
    <div class="m-3 p-3" style="border: 2px solid gray;border-radius: 24px;">
        <div class="d-flex flex-column justify-content-start">
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
        </div>
    </div>
</div>

<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
    Launch static backdrop modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Understood</button>
            </div>
        </div>
    </div>
</div>