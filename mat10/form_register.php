<form action="aksi_register.php" method="POST">
    <table>
        <tr>
            <td>Username</td>
            <td><input type="text" name="username"></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input type="text" name="password"></td>
        </tr>
        <tr>
            <td>Level</td>
            <td><select name="level">
                    <option value="Admin">Admin</option>
                    <option value="Kasir">Kasir</option>
                </select></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><input type="text" name="email"></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="register" value="Register"></td>
            <a href="login.php">Login</a>
        </tr>
    </table>
</form>