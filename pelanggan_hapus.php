<?php 
    // Pastikan koneksi sudah terhubung
    if (!$koneksi) {
        die("Koneksi gagal: " . mysqli_connect_error());
    }

    // Ambil ID dari parameter URL dan periksa apakah ID adalah angka
    $id = $_GET['id'];
    if (!is_numeric($id)) {
        echo '<script>alert("ID tidak valid"); location.href="?page=pelanggan";</script>';
        exit;
    }

    // Siapkan prepared statement untuk menghapus data
    $stmt = $koneksi->prepare("DELETE FROM pelanggan WHERE id_pelanggan = ?");
    $stmt->bind_param("i", $id);

    // Eksekusi dan periksa hasilnya
    $stmt->bind_param("i", $id);
    if (!$stmt->execute()) {
        die("Error executing statement: " . $stmt->error);
    } else {
        echo '<script>alert("Hapus Data Berhasil"); location.href="?page=pelanggan";</script>';
    }
    // Tutup statement
    $stmt->close();
?>
