<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "db_akademik";
$koneksi = mysqli_connect($host, $username, $password, $dbname);

if ($koneksi) {
    echo "Success";
    echo "<br>";
} else {
    echo "Server not connected";
    echo "<br>";
}