<?php

echo "<h1>Mat 7 Buku Tamu</h1>";

// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_akademik";

$koneksi = new mysqli($servername, $username, $password, $dbname);
if ($koneksi->connect_error) {
    die("Koneksi ke database gagal: " . $koneksi->connect_error);
}

// Query untuk mendapatkan data dari tabel bukutamu
$sql = "SELECT nama, email, komentar FROM bukutamu";
$result = $koneksi->query($sql);

// Membuat tabel HTML untuk menampilkan data
echo "<table border='1'>";
echo "<tr><th>Nama</th><th>Email</th><th>Komentar</th></tr>";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["nama"] . "</td><td>" . $row["email"] . "</td><td>" . $row["komentar"] . "</td></tr>";
    }
} else {
    echo "<tr><td colspan='3'>Tidak ada data</td></tr>";
}

echo "</table>";

$koneksi->close();
