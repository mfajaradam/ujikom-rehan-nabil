<?php 
    // Pastikan variabel koneksi database tersedia
    if (!isset($koneksi)) {
        die("Koneksi database tidak ditemukan.");
    }

    // Validasi parameter id
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    if ($id <= 0) {
        die("ID produk tidak valid.");
    }

    if(isset($_POST['nama_produk'])) {
        $nama = $_POST['nama_produk'];
        $harga = $_POST['harga'];
        $stock = $_POST['stock'];

        // Gunakan prepared statement untuk mencegah SQL injection
        $stmt = $koneksi->prepare("UPDATE produk SET nama_produk=?, harga=?, stock=? WHERE id_produk=?");
        $stmt->bind_param("sdii", $nama, $harga, $stock, $id);
        
        if ($stmt->execute()) {
            echo '<script>alert("Data Berhasil Diubah"); window.location.href="?page=produk";</script>';
        } else {
            echo '<script>alert("Data Gagal Diubah")</script>';
        }
        
        $stmt->close();
    }

    // Ambil data produk berdasarkan id
    $stmt = $koneksi->prepare("SELECT * FROM produk WHERE id_produk=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    $stmt->close();

    // Periksa jika data tidak ditemukan
    if (!$data) {
        die("Produk tidak ditemukan.");
    }
?>
<div class="container-fluid px-4">
    <h1 class="mt-4 text-dark">Edit Produk</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Produk</li>
    </ol>
    <a href="?page=produk" class="btn btn-danger">Kembali</a>
    <hr>
    
    <form method="post">
        <table class="table table-bordered">
            <tr>
                <td width="200">Nama Produk</td>
                <td width="1">:</td>
                <td><input class="form-control" value="<?php echo htmlspecialchars($data['nama_produk']); ?>" type="text" name="nama_produk"></td>
            </tr>
            <tr>
                <td width="200">Harga</td>
                <td width="1">:</td>
                <td><input class="form-control" value="<?php echo htmlspecialchars($data['harga']); ?>" type="text" name="harga"></td>
            </tr>
            <tr>
                <td>Stock</td>
                <td>:</td>
                <td><input class="form-control" value="<?php echo htmlspecialchars($data['stock']); ?>" type="number" step="1" name="stock"></td>
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
