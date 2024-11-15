<?php 
include 'koneksi.php'; // Pastikan koneksi database sudah benar

// Cek jika form sudah disubmit
if (isset($_POST['nama_produk'])) {
    // Ambil data dari form
    $nama = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    $stock = $_POST['stock'];

    // Validasi angka untuk harga dan stok
    if (!is_numeric($harga) || !is_numeric($stock)) {
        echo "<script>alert('Harga dan stok harus berupa angka');</script>";
    } else {
        // Menggunakan prepared statement untuk menghindari SQL Injection
        $stmt = $koneksi->prepare("INSERT INTO produk (nama_produk, harga, stock) VALUES (?, ?, ?)");

        // Mengikat parameter ke statement
        $stmt->bind_param("sii", $nama, $harga, $stock); // 's' untuk string, 'i' untuk integer

        // Menjalankan statement dan mengecek hasilnya
        if ($stmt->execute()) {
            // Jika berhasil, tampilkan alert dan redirect ke halaman produk
            echo "<script>alert('Produk berhasil ditambahkan'); window.location.href='?page=produk';</script>";
        } else {
            // Jika gagal, beri pesan error
            echo "<script>alert('Gagal menambahkan produk');</script>";
        }

        // Menutup prepared statement
        $stmt->close();
    }
}
?>

<div class="container-fluid px-4">
    <h1 class="mt-4"><strong style="color: #0056b3;">Tambah Produk</strong></h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active"><strong>Produk</strong></li>
    </ol>
    
    <!-- Tombol Kembali -->
    <a href="?page=produk" class="btn btn-danger mb-3"><i class="fas fa-arrow-left"></i> Kembali</a>
    
    <div class="card shadow-sm">
        <div class="card-body">
            <form method="post">
                <!-- Table Form yang lebih rapi -->
                <div class="form-group row mb-3">
                    <label for="nama_produk" class="col-sm-3 col-form-label"><strong style="color: #0056b3;">Nama Produk</strong></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="nama_produk" name="nama_produk" placeholder="Masukkan Nama Produk" required>
                    </div>
                </div>

                <div class="form-group row mb-3">
                    <label for="harga" class="col-sm-3 col-form-label"><strong style="color: #0056b3;">Harga</strong></label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" id="harga" name="harga" step="0.01" placeholder="Masukkan Harga Produk" required>
                    </div>
                </div>

                <div class="form-group row mb-3">
                    <label for="stock" class="col-sm-3 col-form-label"><strong style="color: #0056b3;">Stok</strong></label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" id="stock" name="stock" placeholder="Masukkan Jumlah Stok" required>
                    </div>
                </div>

                <div class="form-group row justify-content-center">
                    <div class="col-sm-9">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                        <button type="reset" class="btn btn-danger ml-2">
                            <i class="fas fa-times"></i> Reset
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Menambahkan link ke Font Awesome untuk ikon -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
