<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/style.css">
    <title>Registasi</title>
</head>

<body class="d-flex justify-content-center align-items-center vh-100">
    <div class="centered-container">
        <div class="text-center my-5">
            <h1>Registasi</h1>
        </div>

        <form action="">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama">
            </div>

            <div class="mb-3">
                <label for="uuid" class="form-label">uuid</label>
                <input type="number" class="form-control" id="uuid" placeholder="220605110152">
            </div>

            <div class="mb-3">
                <label for="emailUser" class="form-label">Email</label>
                <input type="email" class="form-control" id="emailUser" aria-describedby="passwordHelpBlock">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" aria-describedby="passwordHelpBlock">
            </div>

            <div class="mb-3">
                <label for="inputState" class="form-label">Role</label>
                <select id="inputState" class="form-select">
                    <option selected>Pengajar</option>
                    <option>Siswa</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="ppuser" class="form-label">Foto User</label>
                <input class="form-control" type="file" id="ppuser">
            </div>

            <div class="text-center my-3">
                <a href="form_login.php">Sudah punya akun ? Login</a>
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary mb-3" style="width: 300px;">Daftar</button>
            </div>
    </div>
    </form>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>