<div class="d-flex flex-column">
    <div class="d-flex justify-content-end">
        <button type="button" class="btn btn-primary ms-5" data-bs-toggle="modal" data-bs-target="#tambahOrangModal">
            <i class="bi bi-plus"></i>Tambah Orang
        </button>
    </div>
    <h2>Pengajar</h2>
    <div class="m-3">
        <div class="d-flex ">
            <img src="#" class="rounded-circle me-4" alt="...">
            <h5>nmOrnag </h5>
        </div>
    </div>
    <h2>Siswa</h2>
    <div class="m-3">
        <div class="d-flex ">
            <img src="#" class="rounded-circle me-4" alt="...">
            <h5>nmOrnag </h5>
        </div>
    </div>
</div>

<div class="modal fade" id="tambahOrangModal" data-bs-backdrop="static" tabindex="-1"
    aria-labelledby="tambahOrangModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahOrangModalLabel">Tambah Orang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="id_user" class="form-label">ID User</label>
                        <input type="text" class="form-control" id="id_user" name="id_user" required>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>