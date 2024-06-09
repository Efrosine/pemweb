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

        <div class="mb-3 row">
            <label for="userId" class="col-sm-2 col-form-label">UserId</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" id="userId" placeholder="220605110152">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="password" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="password" aria-describedby="passwordHelpBlock">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="emailUser" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="emailUser" aria-describedby="passwordHelpBlock">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="inputState" class="col-sm-2 col-form-label">Role</label>
            <div class="col-sm-10">
                <select id="inputState" class="form-select">
                    <option selected>Pengajar</option>
                    <option>Siswa</option>
                </select>
            </div>
        </div>

        <div class="text-center my-3">
            <a href="form_login.php">Sudah punya akun ? Login</a>
        </div>

        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary mb-3" style="width: 300px;">Daftar</button>
        </div>
    </div>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>