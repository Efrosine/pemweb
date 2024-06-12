<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/style.css">
    <title>Login</title>


</head>

<body class="d-flex justify-content-center align-items-center vh-100">

    <div class="container centered-container">
        <div class="my-5 ">
            <h1 class="text-center">Login</h1>
            </divcl>
            <div class="mb-3">
                <label for="uuid" class="form-label">uuid</label>
                <input type="number" class="form-control" id="uuid" placeholder="220605110152">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" class="form-control" aria-describedby="passwordHelpBlock">
            </div>
            <div class="text-center my-3">
                <a href="form_regis.php">Belum punya akun ? Daftar</a>
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary mb-3" style="width: 200px;">Login</button>
            </div>
        </div>

        <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>