<!DOCTYPE html>
<html>

<head>
    <title>Hasil Buku Tamu</title>
</head>

<body>
    <h1>Buku Tamu</h1>
    <h2>Rekap Tamu UIN Maliki</h2>

    <table border='1'>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Gender</th>
            <th>Email</th>
            <th>Role</th>

        </tr>
        <?php
        include "koneksi.php";
        $no = 1;
        $sql = "SELECT * FROM bukutamu, role, gender where bukutamu.id_role = role.id_role and bukutamu.id_gender = gender.id_gender";
        $result = $koneksi->query($sql);
        while ($row = $result->fetch_array()) {
            echo "<tr>";
            echo "<td>" . $no++ . "</td>";
            echo "<td>" . $row['nama'] . "</td>";
            echo "<td>" . $row['gender'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['role'] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
    <a href='form_6.php'>Edit</a>
</body>