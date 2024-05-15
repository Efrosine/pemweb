<!DOCTYPE html>
<html>

<head>
    <title>Insert Data</title>
</head>

<body>
    <form action="aksi.php" method="post">
        <table>
            <tr>
                <td>Nama</td>
                <td><input type="text" name="nama"></td>
            </tr>

            <tr>
                <td>Gender</td>
                <td>
                    <select name="gender">
                        <?php
                        include "koneksi.php";
                        $sql = "SELECT * FROM gender";
                        $result = $koneksi->query($sql);
                        while ($row = $result->fetch_array()) {
                            $id_gender = $row['id_gender'];
                            $gender = $row['gender'];
                            echo "<option value='" . $id_gender . "'>" . $gender . "</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <td>Email</td>
            <td><input type="text" name="email"></td>
            </tr>
            <tr>
                <td>Role</td>
                <td>
                    <select name="role">
                        <?php
                        include "koneksi.php";
                        $sql = "SELECT * FROM role";
                        $result = $koneksi->query($sql);
                        while ($row = $result->fetch_array()) {
                            $id_role = $row['id_role'];
                            $role = $row['role'];
                            echo "<option value='" . $id_role . "'>" . $role . "</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Simpan"></td>
                <td><input type="reset" value="Reset"></td>
            </tr>
        </table>
    </form>
</body>

</html>