<?php 
session_start(); // Mulai sesi

include('config.php'); // Pastikan file config.php benar

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

// Gunakan prepared statement untuk keamanan
$sql = "SELECT * FROM user WHERE username = ? AND password = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $_SESSION['user_id'] = $row['id_user']; // Simpan user_id ke sesi
    $_SESSION['username'] = $row['username']; // Simpan username ke sesi (opsional)
    $_SESSION['loggedin'] = true; // untuk membuat status login
    header("Location: after-login.php"); // Arahkan ke halaman setelah login
    exit(); // Pastikan tidak ada kode lain yang dieksekusi setelah redirect
} else {
    header("Location: login.php?msg=n"); // Kembalikan ke halaman login dengan pesan error
    exit();
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InfoZone</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>

<div class="container">
    <div class="card">
        <h2>Login</h2>
        <h4>InfoZone</h4>
        <form action="login.php" method="POST">
            <label for="username">Username</label>
            <input type="text" id="username" placeholder="Username" name="username" required><br><br>
            <label for="password">Password</label>
            <input type="password" id="password" placeholder="Password" name="password" required><br><br>
            <button type="submit" name="login">Login</button>
            <p>Belum memiliki akun? <a href="register.php">Sign Up</a></p>
            <p>Kembali ke beranda? <a href="index.php">Go Back</a></p>
        </form>
    </div>
</div>
</body>
</html>