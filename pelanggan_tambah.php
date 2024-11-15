<?php
include 'koneksi.php'; // Pastikan koneksi database sudah benar

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mendapatkan input dari form
    $nama_pelanggan = isset($_POST['nama_pelanggan']) ? $_POST['nama_pelanggan'] : '';
    $alamat = isset($_POST['alamat']) ? $_POST['alamat'] : '';
    $no_telepon = isset($_POST['no_telepon']) ? $_POST['no_telepon'] : '';

    // Validasi dan Sanitasi Input
    $nama_pelanggan = mysqli_real_escape_string($koneksi, $nama_pelanggan);
    $alamat = mysqli_real_escape_string($koneksi, $alamat);
    $no_telepon = mysqli_real_escape_string($koneksi, $no_telepon);

    // Validasi input
    if (empty($nama_pelanggan)) {
        echo '<script>alert("Nama pelanggan tidak boleh kosong.");</script>';
    } elseif (empty($alamat)) {
        echo '<script>alert("Alamat tidak boleh kosong.");</script>';
    } elseif (!is_numeric($no_telepon) || strlen($no_telepon) < 10) {
        echo '<script>alert("Nomor telepon tidak valid. Pastikan nomor telepon terdiri dari angka dan lebih dari 10 digit.");</script>';
    } else {
        // Menyiapkan query dengan prepared statement untuk mencegah SQL Injection
        $query = $koneksi->prepare("INSERT INTO pelanggan (nama_pelanggan, alamat, no_telepon) VALUES (?, ?, ?)");

        // Menyiapkan tipe data untuk parameter: 's' = string
        $query->bind_param("sss", $nama_pelanggan, $alamat, $no_telepon);

        // Menjalankan query dan memeriksa apakah berhasil
        if ($query->execute()) {
            echo '<script>alert("Tambah Data Berhasil"); window.location.href="?page=pembelian";</script>';
        } else {
            // Menampilkan error jika query gagal
            echo '<script>alert("Tambah Data Gagal: ' . htmlspecialchars($query->error) . '");</script>';
        }

        // Menutup prepared statement
        $query->close();
    }
}
?>

<div class="container-fluid px-4">
    <h1 class="mt-4 text-dark">Tambah Pelanggan</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Pelanggan</li>
    </ol>
    <a href="?page=pembelian" class="btn btn-danger">Kembali</a>
    <hr>

    <!-- Form Input Data Pelanggan -->
    <form method="post">
        <table class="table table-bordered">
            <tr>
                <td width="200">Nama Pelanggan</td>
                <td width="1">:</td>
                <td><input class="form-control" type="text" name="nama_pelanggan" value="<?php echo isset($nama_pelanggan) ? htmlspecialchars($nama_pelanggan) : ''; ?>" required></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td><input class="form-control" type="text" name="alamat" value="<?php echo isset($alamat) ? htmlspecialchars($alamat) : ''; ?>" required></td>
            </tr>
            <tr>
                <td>Nomor Telepon</td>
                <td>:</td>
                <td><input class="form-control" type="text" name="no_telepon" value="<?php echo isset($no_telepon) ? htmlspecialchars($no_telepon) : ''; ?>" required></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="reset" class="btn btn-danger">Reset</button>
                </td>
            </tr>
        </table>
    </form>
</div>
