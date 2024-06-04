<?php
session_start();

// Pastikan pengguna telah login
if (!isset($_SESSION['user_id'])) {
    // Jika pengguna belum login, kembalikan ke halaman login atau tampilkan pesan error
    header("Location: login.php?message=User not logged in");
    exit();
}

?>