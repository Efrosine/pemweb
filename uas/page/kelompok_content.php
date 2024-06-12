<div class="d-flex flex-column">
    <div class="d-flex justify-content-center mb-5">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahKelompokModal">
            <i class="bi bi-plus"></i>Tambah Kelomopok
        </button>
    </div>

    <div class="container p-3" style="border: 2px solid gray;border-radius: 24px;">
        <div class="d-flex flex-column justify-content-start">
            <div class="me-3">
                <h3>Nm Kelomopok</h3>
            </div>
            <div class="d-flex flex-column justify-content-start px-3">
                <h4>Leader</h4>
                <div class="ms-3">
                    <h5>nmLeader</h5>
                </div>
            </div>
            <div class="d-flex flex-column justify-content-start px-3">
                <h4>Member</h4>
                <div class="d-flex flex-column ms-3">
                    <h5>nmMember</h5>
                    <h5>nmMember</h5>
                    <h5>nmMember</h5>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="tambahKelompokModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="tambahKelompokModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="tambahKelompokModalLabel">Tambah Kelompok</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <div class="mb-3">
                        <label for="group_name" class="form-label">Nama Kelompok</label>
                        <input type="text" class="form-control" id="group_name" name="group_name" required>
                    </div>
                    <div class="d-flex">
                        <div class="flex-shrink-0 p-2"><strong>Ketua</strong></div>
                        <div class="flex-grow-1 p-2"><strong>Nama</strong></div>
                        <div class="flex-shrink-0 p-2"><strong>Member</strong></div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 p-2">
                            <input type="radio" class="form-check-input" name="leader" value="Nama Mahasiswa 1"
                                required>
                        </div>
                        <div class="flex-grow-1 p-2 d-flex align-items-center">
                            <img src="https://via.placeholder.com/50" class="rounded-circle me-3" alt="...">
                            <div>Nama Mahasiswa 1</div>
                        </div>
                        <div class="flex-shrink-0 p-2">
                            <input type="checkbox" class="form-check-input" name="members[]" value="Nama Mahasiswa 1">
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 p-2">
                            <input type="radio" class="form-check-input" name="leader" value="Nama Mahasiswa 2"
                                required>
                        </div>
                        <div class="flex-grow-1 p-2 d-flex align-items-center">
                            <img src="https://via.placeholder.com/50" class="rounded-circle me-3" alt="...">
                            <div>Nama Mahasiswa 2</div>
                        </div>
                        <div class="flex-shrink-0 p-2">
                            <input type="checkbox" class="form-check-input" name="members[]" value="Nama Mahasiswa 2">
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 p-2">
                            <input type="radio" class="form-check-input" name="leader" value="Nama Mahasiswa 3"
                                required>
                        </div>
                        <div class="flex-grow-1 p-2 d-flex align-items-center">
                            <img src="https://via.placeholder.com/50" class="rounded-circle me-3" alt="...">
                            <div>Nama Mahasiswa 3</div>
                        </div>
                        <div class="flex-shrink-0 p-2">
                            <input type="checkbox" class="form-check-input" name="members[]" value="Nama Mahasiswa 3">
                        </div>
                    </div>
                    </tbody>
                    </table>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Tambah</button>
            </div>
        </div>
    </div>
</div>