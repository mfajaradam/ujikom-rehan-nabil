<?php 
include "koneksi.php"; // Pastikan koneksi sudah terhubung

// Sanitasi dan validasi input ID
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id <= 0) {
    echo "<div class='alert alert-danger'>ID penjualan tidak valid!</div>";
    exit;
}

// Query untuk mendapatkan data penjualan dan pelanggan
$query = mysqli_query($koneksi, "SELECT penjualan.*, pelanggan.nama_pelanggan FROM penjualan 
                                  LEFT JOIN pelanggan ON pelanggan.id_pelanggan = penjualan.id_pelanggan 
                                  WHERE id_penjualan = $id");
$data = mysqli_fetch_array($query);

if (!$data) {
    echo "<div class='alert alert-danger'>Data penjualan tidak ditemukan!</div>";
    exit;
}
?>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 text-dark">Detail Penjualan</h1>
        <a href="?page=pembelian" class="btn btn-outline-danger btn-sm">Kembali</a>
    </div>
    <div class="card">
        <div class="card-header bg-primary text-dark">
            <h5>Informasi Pelanggan</h5>
        </div>
        <div class="card-body">
            <form method="post">
                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label text-dark">Nama Pelanggan</label>
                    <div class="col-sm-9">
                        <select class="form-control form-select" name="id_pelanggan" required>
                            <option value="<?php echo($data['id_pelanggan']); ?>">
                                <?php echo htmlspecialchars($data['nama_pelanggan']); ?>
                            </option>
                        </select>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header bg-secondary text-white">
            <h5>Detail Produk</h5>
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Sub Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $pro = mysqli_query($koneksi, "SELECT * FROM detail_penjualan 
                                                    LEFT JOIN produk ON produk.id_produk = detail_penjualan.id_produk 
                                                    WHERE id_penjualan = $id");
                    $total_harga = 0;

                    while ($produk = mysqli_fetch_array($pro)) {
                        $total_harga += $produk['sub_total'];
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($produk['nama_produk']); ?></td>
                        <td>Rp <?php echo number_format($produk['harga'], 2); ?></td>
                        <td><?php echo htmlspecialchars($produk['jumlah_produk']); ?></td>
                        <td>Rp <?php echo number_format($produk['sub_total'], 2); ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
                <tfoot class="table-light">
                    <tr>
                        <td colspan="3" class="text-end"><strong>Total Harga:</strong></td>
                        <td><strong>Rp <?php echo number_format($total_harga, 2); ?></strong></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
