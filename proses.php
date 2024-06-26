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

    foreach ($categories as $category) {
        // Ambil id_category dari nama kategori
        $sqlCategory = "SELECT id_category FROM tb_category WHERE category = ?";
        $stmtCategory = $conn->prepare($sqlCategory);
        if (!$stmtCategory) {
            throw new Exception("Prepare statement failed: " . $conn->error);
        }
        $stmtCategory->bind_param("s", $category);
        if (!$stmtCategory->execute()) {
            throw new Exception("Execute failed: " . $stmtCategory->error);
        }
        $resultCategory = $stmtCategory->get_result();
        if ($resultCategory->num_rows > 0) {
            $row = $resultCategory->fetch_assoc();
            $id_category = $row['id_category'];

            // Masukkan kategori ke tb_tampil_category
            $stmt->bind_param("ii", $user_id, $id_category);
            if (!$stmt->execute()) {
                throw new Exception("Execute failed: " . $stmt->error);
            }
        } else {
            throw new Exception("Category not found: " . $category);
        }
        $stmtCategory->close();
    }

    // Komit transaksi
    $conn->commit();

    $stmt->close();
    $conn->close();

    // Redirect ke index.php setelah sukses menyimpan data
    header("Location: index.php?message=Data saved successfully");
    exit();
    
    } catch (Exception $e) {
        // Rollback transaksi jika terjadi error
        $conn->rollback();
    
        // Tutup statement dan koneksi
        if ($stmt) $stmt->close();
        $conn->close();
    
        // Redirect kembali ke halaman sebelumnya dengan pesan error
        header("Location: after-login.php?message=Error saving user data: " . urlencode($e->getMessage()));
        exit();
    }

?>