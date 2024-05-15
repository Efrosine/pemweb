<html>

<head>
    <title>Koneksi Database Buku Tamu</title>
</head>

<body>
    <h1>Database Buku Tamu</h1>
    <?php
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "db_akademik";
    $koneksi = new mysqli($host, $username, $password, $dbname);
    if ($koneksi) {
        echo "Koneksi ke server berhasil.";
    } else {
        echo "Koneksi ke server gagal.";
    }

    ?>
</body>

</html>