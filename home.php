<div class="container-fluid px-4">
    <h1 class="mt-4 text-center text-dark">Dashboard</h1>
    <ol class="breadcrumb mb-4 justify-content-center">
        <li class="breadcrumb-text-dar">Dashboard Overview</li>
    </ol>

    <!-- Row untuk menampilkan Card -->
    <div class="row g-4">
        <!-- Card Total Pelanggan -->
        <div class="col-xl-3 col-md-6">
            <div class="card custom-card shadow-sm border-0 rounded">
                <div class="card-body d-flex align-items-center text-white bg-gradient-primary">
                    <i class="fas fa-users fa-3x me-3 opacity-75"></i>
                    <div>
                        <h5 class="card-title"></h5>
                        <p class="card-text h4 mb-0"><?php echo mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM pelanggan")); ?></p>
                    </div>
                    <span class="badge bg-light text-primary position-absolute top-0 end-0 m-2 p-2 rounded-pill">New</span>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center bg-light">
                    <a href="#" class="small text-primary stretched-link">View Details</a>
                    <i class="fas fa-angle-right text-primary"></i>
                </div>
            </div>
        </div>

        <!-- Card Total Produk -->
        <div class="col-xl-3 col-md-6">
            <div class="card custom-card shadow-sm border-0 rounded">
                <div class="card-body d-flex align-items-center text-white bg-gradient-warning">
                    <i class="fas fa-cogs fa-3x me-3 opacity-75"></i>
                    <div>
                        <h5 class="card-title"></h5>
                        <p class="card-text h4 mb-0"><?php echo mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM produk")); ?></p>
                    </div>
                    <span class="badge bg-light text-warning position-absolute top-0 end-0 m-2 p-2 rounded-pill">Updated</span>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center bg-light">
                    <a href="#" class="small text-primary stretched-link">View Details</a>
                    <i class="fas fa-angle-right text-primary"></i>
                </div>
            </div>
        </div>

        <!-- Card Pembelian -->
        <div class="col-xl-3 col-md-6">
            <div class="card custom-card shadow-sm border-0 rounded">
                <div class="card-body d-flex align-items-center text-white bg-gradient-success">
                    <i class="fas fa-shopping-cart fa-3x me-3 opacity-75"></i>
                    <div>
                        <h5 class="card-title"></h5>
                        <p class="card-text h4 mb-0"><?php echo mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM penjualan")); ?></p>
                    </div>
                    <span class="badge bg-light text-success position-absolute top-0 end-0 m-2 p-2 rounded-pill">Popular</span>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center bg-light">
                    <a href="#" class="small text-primary stretched-link">View Details</a>
                    <i class="fas fa-angle-right text-primary"></i>
                </div>
            </div>
        </div>

        <!-- Card Total User -->
        <div class="col-xl-3 col-md-6">
            <div class="card custom-card shadow-sm border-0 rounded">
                <div class="card-body d-flex align-items-center text-white bg-gradient-danger">
                    <i class="fas fa-user-shield fa-3x me-3 opacity-75"></i>
                    <div>
                        <h5 class="card-title"></h5>
                        <p class="card-text h4 mb-0"><?php echo mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM user")); ?></p>
                    </div>
                    <span class="badge bg-light text-danger position-absolute top-0 end-0 m-2 p-2 rounded-pill">Admin</span>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center bg-light">
                    <a href="#" class="small text-primary stretched-link">View Details</a>
                    <i class="fas fa-angle-right text-primary"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Custom CSS for styling */
    .custom-card {
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.3s ease;
    }
    .custom-card:hover {
        transform: scale(1.05);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
    }
    .bg-gradient-primary {
        background: linear-gradient(135deg, #2196f3, #1e88e5);
    }
    .bg-gradient-warning {
        background: linear-gradient(135deg, #ffc107, #ff9800);
    }
    .bg-gradient-success {
        background: linear-gradient(135deg, #66bb6a, #43a047);
    }
    .bg-gradient-danger {
        background: linear-gradient(135deg, #e57373, #d32f2f);
    }
    .badge {
        font-size: 0.8rem;
        font-weight: 500;
    }
    .card-footer {
        border-top: none;
    }
    .stretched-link {
        transition: color 0.2s ease;
    }
    .stretched-link:hover {
        color: #1e88e5;
    }
    .card-body i {
        opacity: 0.75;
    }
</style>

<!-- Menambahkan link ke Font Awesome untuk ikon -->
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
