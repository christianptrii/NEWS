<?php
// Memulai sesi
session_start();

// Menyertakan file konfigurasi database
include('config.php');

// Mengecek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari form
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $created_at = date('Y-m-d H:i:s');
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InfoZone</title>
    <link rel="stylesheet" href="login.css">
<body>
    <div class="container">
        <div class="card">
            <h2>Register</h2>
            <h4>InfoZone</h4>
                <form action="register.php" method="post">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required><br><br>
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required><br><br>
                    <button type="submit" name="register">Login</button>
                    <p>Sudah Punya Akun? <a href="login.php">Silahkan login</a></p>
                </form>
        </div>
    </div>
</body>
</html>