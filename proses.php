<?php
session_start();

// Pastikan pengguna telah login
if (!isset($_SESSION['user_id'])) {
    // Jika pengguna belum login, kembalikan ke halaman login atau tampilkan pesan error
    header("Location: login.php?message=User not logged in");
    exit();
}

$user_id = $_SESSION['user_id'];
$categories = $_POST['categories'] ?? [];

// Koneksi ke database
include('config.php');

// Periksa koneksi
if ($conn->connect_error) {
    // Jika gagal terhubung ke database, kembalikan ke halaman sebelumnya atau tampilkan pesan error
    header("Location: previous_page.php?message=Database connection failed: " . $conn->connect_error);
    exit();
}

// Mulai transaksi
$conn->begin_transaction();

try {
    // Hapus kategori lama dari user
    $sql = "DELETE FROM tb_tampil_category WHERE id_user = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        throw new Exception("Prepare statement failed: " . $conn->error);
    }
    $stmt->bind_param("i", $user_id);
    if (!$stmt->execute()) {
        throw new Exception("Execute failed: " . $stmt->error);
    }

    // Masukkan kategori baru
    $sql = "INSERT INTO tb_tampil_category (id_user, id_category) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
            throw new Exception("Prepare statement failed: " . $conn->error);
    }
    
}

?>