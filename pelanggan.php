<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mt-4 text-dark">
        <h1 text>Pelanggan</h1>
        <a href="?page=pelanggan_tambah" class="btn btn-primary btn-lg">+ Tambah Data</a>
    </div>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active text-dark">Pelanggan</li>
    </ol>
    <hr>
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <table class="table table-hover align-middle table-striped">
                <thead>
                    <tr>
                        <th class="text-center bg-dark text-light">Nama Pelanggan</th>
                        <th class="text-center bg-dark text-light">Alamat</th>
                        <th class="text-center bg-dark text-light">No Telepon</th>
                        <th class="text-center bg-dark text-light">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $query = mysqli_query($koneksi, "SELECT * FROM pelanggan");
                    if (!$query) {
                        die("Query failed: " . mysqli_error($koneksi));
                    }

                    while ($data = mysqli_fetch_array($query)) {
                        ?>
                        <tr>
                            <td class="text-center"><?php echo htmlspecialchars($data['nama_pelanggan']); ?></td>
                            <td class="text-center"><?php echo htmlspecialchars($data['alamat']); ?></td>
                            <td class="text-center"><?php echo htmlspecialchars($data['no_telepon']); ?></td>
                            <td class="text-center">
                                <a href="?page=pelanggan_ubah&id=<?php echo $data['id_pelanggan']; ?>" class="btn btn-sm btn-outline-secondary" title="Ubah"><i class="bi bi-pencil"></i></a>
                                <a href="?page=pelanggan_hapus&id=<?php echo $data['id_pelanggan']; ?>" class="btn btn-sm btn-outline-danger" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');"><i class="bi bi-trash3-fill"></i></a>
                            </td>
                        </tr>
                        <?php
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
