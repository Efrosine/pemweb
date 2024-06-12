<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/style.css">
    <title>Registrasi</title>
</head>

<body class="d-flex justify-content-center align-items-center vh-100">
    <div class="centered-container">
        <div class="text-center my-5">
            <h1>Registrasi</h1>
        </div>

        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger">
                <?php echo htmlspecialchars($_GET['error']); ?>
            </div>
        <?php endif; ?>

        <form action="action_regis.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>

            <div class="mb-3">
                <label for="uuid" class="form-label">UUID</label>
                <input type="text" class="form-control" id="uuid" name="uuid" placeholder="220605110152" required>
            </div>

            <div class="mb-3">
                <label for="emailUser" class="form-label">Email</label>
                <input type="email" class="form-control" id="emailUser" name="email" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select id="role" class="form-select" name="role" required>
                    <option value="teacher">Pengajar</option>
                    <option value="student">Siswa</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="ppuser" class="form-label">Foto User</label>
                <input class="form-control" type="file" id="ppuser" name="profile_pic" accept="image/*">
            </div>

            <div class="text-center my-3">
                <a href="form_login.php">Sudah punya akun? Login</a>
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary mb-3" style="width: 300px;">Daftar</button>
            </div>
        </form>
    </div>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>