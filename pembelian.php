<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mt-4">
        <h1 class="display-4 text-dark">Pembelian</h1>
        <a href="?page=pembelian_tambah" class="btn btn-custom shadow-sm">
            + Tambah Pembelian
        </a>
    </div>
    <ol class="breadcrumb mb-4 text-muted">
        <li class="text-dark">Pembelian</li>
    </ol>

    <!-- Tabel Pembelian dengan desain modern -->
    <div class="card custom-card shadow-lg">
        <div class="card-body p-4">
            <table class="table custom-table table-hover">
                <thead class="text-muted">
                    <tr>
                        <th>Tanggal Pembelian</th>
                        <th>Pelanggan</th>
                        <th>Total Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                // Pastikan koneksi sudah ada
                if ($koneksi) {
                    $query = mysqli_query($koneksi, "SELECT penjualan.*, pelanggan.nama_pelanggan FROM penjualan LEFT JOIN pelanggan ON pelanggan.id_pelanggan = penjualan.id_pelanggan");

                    if (!$query) {
                        die("Query failed: " . mysqli_error($koneksi));
                    }

                    // Loop untuk menampilkan data
                    while ($data = mysqli_fetch_array($query)) {
                        ?>
                        <tr>
                            <td><?php echo isset($data['tanggal_penjualan']) ? $data['tanggal_penjualan'] : 'Tidak ada'; ?></td>
                            <td><?php echo isset($data['nama_pelanggan']) ? $data['nama_pelanggan'] : 'Tidak ada'; ?></td>
                            <td>Rp <?php echo isset($data['total_harga']) ? number_format($data['total_harga'], 0, ',', '.') : 'Tidak ada'; ?></td>
                            <td>
                                <a href="?page=penjualan_ubah&id=<?php echo $data['id_penjualan']; ?>" class="btn btn-outline-custom btn-sm mx-1 rounded-pill" title="Lihat">
                                    <i class="bi bi-search"></i>
                                </a>
                                <a href="?page=penjualan_hapus&id=<?php echo $data['id_penjualan']; ?>" class="btn btn-outline-danger btn-sm mx-1 rounded-pill" onclick="return confirm('Apakah Anda yakin ingin menghapus pembelian ini?');" title="Hapus">
                                    <i class="bi bi-trash3-fill"></i>
                                </a>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo '<tr><td colspan="4" class="text-center text-muted">Gagal terhubung ke database.</td></tr>';
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Menambahkan link ke Font Awesome untuk ikon -->
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<!-- Menambahkan link ke Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

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

    /* Tombol dengan efek outline dan neumorphism */
    .btn-outline-custom {
        border: 2px solid #4e73df;
        color: #4e73df;
        padding: 5px 15px;
        border-radius: 50px;
        transition: all 0.3s ease;
    }

    .btn-outline-custom:hover {
        background-color: #4e73df;
        color: white;
    }

    .btn-outline-danger {
        border: 2px solid #e74a3b;
        color: #e74a3b;
        transition: all 0.3s ease;
    }

    .btn-outline-danger:hover {
        background-color: #e74a3b;
        color: white;
    }
</style>
