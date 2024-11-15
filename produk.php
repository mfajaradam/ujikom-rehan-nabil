<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mt-4">
        <h1 class="display-4 text-dark">Produk</h1>
        <a href="?page=produk_tambah" class="btn btn-custom shadow-sm">
            <i class="fas fa-plus-circle"></i> Tambah Produk
        </a>
    </div>
    <ol class="breadcrumb mb-4 text-muted">
        <li class="breadcrumb-item active text-dark">Produk</li>
    </ol>

    <div class="card custom-card shadow-lg">
        <div class="card-body p-4">
            <!-- Tabel Produk -->
            <table class="table table-hover table-striped custom-table">
                <thead class="text-muted">
                    <tr>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Stock</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        // Query untuk mendapatkan data produk
                        $query = "SELECT id_produk, nama_produk, harga, stock FROM produk";
                        $result = mysqli_query($koneksi, $query);
                        
                        // Periksa apakah query berhasil dan ada data
                        if (mysqli_num_rows($result) > 0) {
                            while ($data = mysqli_fetch_array($result)) {
                    ?>
                        <tr>
                            <td><?php echo htmlspecialchars($data['nama_produk']); ?></td>
                            <td>Rp <?php echo number_format($data['harga'], 0, ',', '.'); ?></td>
                            <td><?php echo $data['stock']; ?></td>
                            <td class="d-flex justify-content-center">
                                <a href="?page=produk_ubah&id=<?php echo urlencode($data['id_produk']); ?>" class="btn btn-outline-custom btn-sm mx-1 rounded-pill" title="Ubah">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="?page=produk_hapus&id=<?php echo urlencode($data['id_produk']); ?>" class="btn btn-outline-danger btn-sm mx-1 rounded-pill" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?');" title="Hapus">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                    <?php
                            }
                        } else {
                            // Jika tidak ada data
                            echo "<tr><td colspan='4' class='text-center text-muted'>Tidak ada data produk</td></tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Menambahkan link ke Font Awesome untuk ikon -->
<script src="https://kit.fontawesome.com/a076d05399.js"></script>

<!-- Menambahkan CSS untuk mempercantik tampilan -->
<style>
    /* Tombol dengan desain neumorphism */
    .btn-custom {
        background-color: #4e73df;
        color: #fff;
        padding: 10px 20px;
        border-radius: 50px;
        box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.1), -5px -5px 10px rgba(255, 255, 255, 0.4);
        transition: all 0.3s ease;
    }

    .btn-custom:hover {
        background-color: #3e5e9e;
        transform: scale(1.05);
    }

    /* Tabel dengan desain neumorphism */
    .custom-table th, .custom-table td {
        text-align: center;
        padding: 1rem;
        font-size: 16px;
        border-radius: 10px;
    }

    .custom-table {
        background: #f0f4f8;
        box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.1), -5px -5px 15px rgba(255, 255, 255, 0.3);
    }

    /* Mengubah header tabel menjadi warna soft */
    .custom-table thead {
        background: #f5f8fd;
        color: #6c757d;
        font-weight: bold;
    }

    /* Menambah hover pada baris tabel */
    .custom-table tbody tr:hover {
        background: #e2e8f0;
        transform: scale(1.02);
        transition: all 0.3s ease-in-out;
    }

    .custom-card {
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 10px 10px 30px rgba(0, 0, 0, 0.1), -10px -10px 30px rgba(255, 255, 255, 0.5);
    }

    .card-body {
        padding: 2rem;
    }

    .breadcrumb-item.active {
        font-weight: bold;
        color: #4e73df;
    }

    /* Neumorphism Card */
    .shadow-lg {
        box-shadow: 12px 12px 20px rgba(0, 0, 0, 0.2), -12px -12px 20px rgba(255, 255, 255, 0.6);
    }
</style>
