<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <title>Login</title>

    <style>
        body,
        html {
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .centered-container {
            width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 2px solid gray;
            border-radius: 24px;
            box-sizing: border-box;
        }
    </style>
</head>

<body>

    <div class="container centered-container ">
        <div class="mx-7 ">
            <h1 class="text-center">Login</h1>
            </divcl>
            <div class="mb-3">
                <label for="userId" class="form-label">UserId</label>
                <input type="email" class="form-control" id="userId" placeholder="220605110152">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" class="form-control" aria-describedby="passwordHelpBlock">
            </div>
            <div class="text-center my-3">
                <a href="#">Belum punya akun ? Daftar</a>
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary mb-3" style="width: 200px;">Login</button>
            </div>
        </div>

        <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>