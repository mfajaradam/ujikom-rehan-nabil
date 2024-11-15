<?php 
include 'koneksi.php';
if(isset($_POST['username']))

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = $_POST['password'];

    $cek = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username'");

    if (mysqli_num_rows($cek) > 0) {
        $data = mysqli_fetch_array($cek);

        if (password_verify($password, $data['password'])) {
            $_SESSION['user'] = $data;
            echo '<script>alert("Selamat Datang, Jangan lupa logout setelah selesai menggunakan halaman ini"); location.href="index.php";</script>';
        } else {
            echo '<script>alert("Username atau Password Salah!");</script>';
        }
    } else {
        echo '<script>alert("Username tidak ditemukan!");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login Aplikasi Kasir</title>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRml+WZ/uD22KeUp+gUHZ50+1c6W44sM6n4e8c4by" crossorigin="anonymous">
        <style>
            * {
                font-family: 'Inter', sans-serif;
            }
            body {
                background: linear-gradient(135deg, #c3ecb2, #5ba0d3);
                display: flex;
                align-items: center;
                justify-content: center;
                height: 100vh;
                margin: 0;
            }
            .card {
                border: none;
                border-radius: 15px;
                background: rgba(255, 255, 255, 0.7);
                backdrop-filter: blur(10px);
                box-shadow: 0 8px 32px rgba(31, 38, 135, 0.37);
                overflow: hidden;
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
                box-shadow: none;
                padding: 12px;
                transition: all 0.3s ease;
            }
            .form-control:focus {
                border-color: #5ba0d3;
                box-shadow: 0 0 8px rgba(91, 160, 211, 0.2);
            }
            .btn-primary {
                background: linear-gradient(135deg, #5ba0d3, #3a3dce);
                border: none;
                border-radius: 12px;
                padding: 10px;
                font-weight: 600;
                color: #fff;
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }
            .btn-primary:hover {
                transform: translateY(-3px);
                box-shadow: 0 4px 10px rgba(58, 61, 206, 0.3);
            }
            .card-footer {
                background: none;
                border-top: none;
                text-align: center;
            }
            .small a {
                color: #5ba0d3;
                text-decoration: none;
                font-weight: 500;
            }
            .small a:hover {
                color: #3a3dce;
            }
        </style>
    </head>
    <body>
        <div class="card">
            <div class="card-header text-center">
                <h3>Login Aplikasi Kasir</h3>
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="form-floating mb-3">
                        <input class="form-control" id="inputEmail" type="text" name="username" placeholder="Masukan Username" required />
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="inputPassword" type="password" name="password" placeholder="Masukan Password" required />
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mt-4">Login</button>
                </form>
            </div>
            <div class="card-footer">
                <div class="small"><a href="register.php">Belum Punya Akun? Register</a></div>
            </div>
        </div>
    </body>
</html>
