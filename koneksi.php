<?php
// Memastikan session dimulai hanya jika belum ada sesi yang aktif
if (session_status() === PHP_SESSION_NONE) {
    session_start();  // Memulai sesi jika belum ada sesi yang aktif
}

// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ukk_kasir";

try {
    // Membuat koneksi
    $koneksi = new mysqli($servername, $username, $password, $dbname);

    // Mengecek apakah koneksi berhasil
    if ($koneksi->connect_error) {
        throw new Exception("Koneksi gagal: " . $koneksi->connect_error);
    }
    // Koneksi berhasil
    // echo "Koneksi berhasil";
} catch (Exception $e) {
    // Menangani kesalahan jika koneksi gagal
    die("Terjadi kesalahan: " . $e->getMessage());
}
?>