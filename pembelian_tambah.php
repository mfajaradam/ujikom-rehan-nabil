<?php 
// Pastikan sesi dimulai
include('koneksi.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_pelanggan'], $_POST['produk'])) {
    // Validasi dan sanitasi input
    $id_pelanggan = mysqli_real_escape_string($koneksi, $_POST['id_pelanggan']);
    $produk = $_POST['produk'];
    $total = 0;
    $tanggal = date('Y-m-d H:i:s');

    // Mulai transaksi
    $koneksi->begin_transaction();

    try {
        // Menyimpan data penjualan
        $stmt = $koneksi->prepare("INSERT INTO penjualan (tanggal_penjualan, id_pelanggan) VALUES (?, ?)");
        $stmt->bind_param("si", $tanggal, $id_pelanggan);
        
        if (!$stmt->execute()) {
            throw new Exception("Gagal menambah data penjualan: " . $stmt->error);
        }
        
        // Mendapatkan ID penjualan yang baru
        $idTerakhir = $koneksi->insert_id;

        // Menyimpan detail penjualan
        foreach ($produk as $key => $val) {
            if ($val > 0) { 
                // Mengambil informasi produk
                $stmt = $koneksi->prepare("SELECT * FROM produk WHERE id_produk = ?");
                $stmt->bind_param("i", $key);
                $stmt->execute();
                $result = $stmt->get_result();
                $pr = $result->fetch_assoc();

                if ($pr) {
                    // Cek apakah stok mencukupi
                    if ($pr['stock'] < $val) {
                        throw new Exception("Stock produk {$pr['nama_produk']} tidak mencukupi.");
                    }

                    // Menghitung subtotal
                    $sub = $val * $pr['harga'];
                    $total += $sub;

                    // Menyimpan detail penjualan
                    $stmtDetail = $koneksi->prepare("INSERT INTO detail_penjualan (id_penjualan, id_produk, jumlah_produk, sub_total) VALUES (?, ?, ?, ?)");
                    $stmtDetail->bind_param("iiid", $idTerakhir, $key, $val, $sub);
                    if (!$stmtDetail->execute()) {
                        throw new Exception("Gagal menambah detail penjualan: " . $stmtDetail->error);
                    }

                    // Mengurangi stok produk
                    $new_stok = $pr['stock'] - $val;
                    $stmtUpdateStok = $koneksi->prepare("UPDATE produk SET stock = ? WHERE id_produk = ?");
                    $stmtUpdateStok->bind_param("ii", $new_stok, $key);
                    if (!$stmtUpdateStok->execute()) {
                        throw new Exception("Gagal memperbarui stok produk: " . $stmtUpdateStok->error);
                    }
                } else {
                    throw new Exception("Produk dengan ID $key tidak ditemukan.");
                }
            }
        }

        // Memperbarui total harga penjualan
        $stmtUpdate = $koneksi->prepare("UPDATE penjualan SET total_harga = ? WHERE id_penjualan = ?");
        $stmtUpdate->bind_param("di", $total, $idTerakhir);
        if (!$stmtUpdate->execute()) {
            throw new Exception("Gagal memperbarui total harga: " . $stmtUpdate->error);
        }

        // Menyelesaikan transaksi
        $koneksi->commit();

        // Menyimpan total harga ke dalam sesi
        $_SESSION['total_harga'] = $total;

        // Menampilkan pesan sukses
        echo '<div class="alert alert-success">Berhasil menambah data penjualan.</div>';
        echo '<script>window.location.href="?page=pembelian";</script>';

    } catch (Exception $e) {
        // Jika ada kesalahan, rollback transaksi
        $koneksi->rollback();

        // Menampilkan error
        echo '<div class="alert alert-danger">Error: ' . $e->getMessage() . '</div>';
    }
}
?>

<div class="container-fluid px-4">
    <h1 class="mt-4 text-dark">Tambah Penjualan</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Penjualan</li>
    </ol>
    <a href="?page=pembelian" class="btn btn-danger mb-3">+ Kembali</a>
    <hr>
    <form method="post">
        <div class="card shadow-lg border-light">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 mb-3">
                        <label for="id_pelanggan" class="text-dark">Pilih Pelanggan</label>
                        <select class="form-select" name="id_pelanggan" id="id_pelanggan" required>
                            <option value="">Pilih Pelanggan</option>
                            <?php 
                            $p = mysqli_query($koneksi, "SELECT * FROM pelanggan");
                            while ($pel = mysqli_fetch_assoc($p)) {
                            ?>
                                <option value="<?php echo htmlspecialchars($pel['id_pelanggan']); ?>">
                                    <?php echo htmlspecialchars($pel['nama_pelanggan']); ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $pro = mysqli_query($koneksi, "SELECT * FROM produk");
                        while ($produk = mysqli_fetch_assoc($pro)) {
                        ?>
                        <tr>
                            <td><?php echo htmlspecialchars($produk['nama_produk']); ?></td>
                            <td>Rp <?php echo number_format($produk['harga'], 0, ',', '.'); ?></td>
                            <td><?php echo $produk['stock']; ?></td>
                            <td>
                                <input class="form-control" type="number" min="0" max="<?php echo htmlspecialchars($produk['stock']); ?>" 
                                       name="produk[<?php echo $produk['id_produk']; ?>]" value="0" required 
                                       oninput="hitungTotal()"
                                       data-harga="<?php echo htmlspecialchars($produk['harga']); ?>">
                            </td>
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-12 text-end">
                        <h4>Total Harga: <span id="total-harga">Rp 0.00</span></h4>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-4">Simpan Penjualan</button>
            </div>
        </div>
    </form>
</div>

<script>
function hitungTotal() {
    const totalElement = document.getElementById('total-harga');
    let total = 0;
    const inputs = document.querySelectorAll('input[type="number"]');

    inputs.forEach(input => {
        const jumlah = parseInt(input.value) || 0;
        const harga = parseFloat(input.dataset.harga) || 0;
        total += jumlah * harga;
    });

    totalElement.innerText = 'Rp ' + total.toLocaleString('id-ID', {minimumFractionDigits: 2});
}
</script>

<?php
// Membersihkan sesi untuk total harga
if (isset($_SESSION['total_harga'])) {
    unset($_SESSION['total_harga']);
}
?>
