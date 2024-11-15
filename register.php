<?php 
include 'koneksi.php';

if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['nama'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = $_POST['password'];
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $level = 'admin';

    if (empty($username) || empty($password) || empty($nama)) {
        echo '<script>alert("Semua field harus diisi!");</script>';
    } else {
        $password_hashed = password_hash($password, PASSWORD_DEFAULT);
        $insert = mysqli_query($koneksi, "INSERT INTO user(nama, username, password, level) VALUES('$nama', '$username', '$password_hashed', '$level')");

        if ($insert) {
            echo '<script>alert("Registrasi Berhasil"); location.href="login.php";</script>';
        } else {
            echo '<script>alert("Registrasi Gagal, coba lagi.");</script>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Register Aplikasi Kasir</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
        body {
            background: linear-gradient(135deg, #e3f2fd, #bbdefb);
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        .card {
            border: none;
            border-radius: 15px;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            box-shadow: 0 8px 32px rgba(31, 38, 135, 0.37);
            padding: 2rem;
            width: 100%;
            max-width: 400px;
        }
        .card-header h3 {
            font-weight: 600;
            color: #333;
        }
        .form-control {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 12px;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            border-color: #42a5f5;
            box-shadow: 0 0 8px rgba(66, 165, 245, 0.2);
        }
        .btn-primary {
            background: linear-gradient(135deg, #42a5f5, #1976d2);
            border: none;
            border-radius: 12px;
            padding: 10px;
            font-weight: 600;
            color: #fff;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 10px rgba(25, 118, 210, 0.3);
        }
        .card-footer {
            background: none;
            border-top: none;
            text-align: center;
        }
        .small a {
            color: #42a5f5;
            text-decoration: none;
            font-weight: 500;
        }
        .small a:hover {
            color: #1976d2;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="card-header text-center">
            <h3>Register Aplikasi Kasir</h3>
        </div>
        <div class="card-body">
            <form method="post">
                <div class="form-floating mb-3">
                    <input class="form-control" id="inputNama" type="text" name="nama" placeholder="Masukan Nama Lengkap" required />
                </div>
                <div class="form-floating mb-3">
                    <input class="form-control" id="inputUsername" type="text" name="username" placeholder="Masukan Username" required />
                </div>
                <div class="form-floating mb-3">
                    <input class="form-control" id="inputPassword" type="password" name="password" placeholder="Masukan Password" required />
                </div>
                <button type="submit" class="btn btn-primary w-100 mt-4">Register</button>
            </form>
        </div>
        <div class="card-footer">
            <div class="small"><a href="login.php">Sudah Punya Akun? Login</a></div>
        </div>
    </div>
</body>
</html>
