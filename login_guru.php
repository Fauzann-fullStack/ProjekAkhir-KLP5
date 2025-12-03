<?php
session_start();
include "koneksi.php";

$error = "";

// Jika form disubmit (POST)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query = mysqli_query($conn, "SELECT * FROM proses_role WHERE nama='$nama' LIMIT 1");

    if ($query && mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_assoc($query);

        if ($password == $data['password']) {

            // Session
            $_SESSION['id_role'] = $data['id'];
            $_SESSION['nama']    = $data['nama'];
            $_SESSION['akses']   = $data['akses'];

            // Arahkan sesuai role
            if ($data['akses'] === "guru") {
                header("Location: dashboard_guru.php");
                exit();
            } else {
                header("Location: data_siswa.php");
                exit();
            }

        } else {
            $error = "Password salah!";
        }

    } else {
        $error = "Nama role tidak ditemukan!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Guru</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #4e73df, #1cc88a);
            font-family: Arial, sans-serif;
        }

        .login-card {
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.2);
            width: 350px;
        }

        .login-card h2 {
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .btn-back {
            display: block;
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border-radius: 5px;
            background-color: #6c757d;
            color: #fff;
            text-decoration: none;
            text-align: center;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .btn-back:hover {
            background-color: #5a6268;
        }

        .error-message {
            color: red;
            text-align: center;
            margin-top: 10px;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="login-card">
    <h2>Login Guru</h2>

    <form method="post">
        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>

    <?php if (!empty($error)): ?>
        <div class="error-message"><?= $error ?></div>
    <?php endif; ?>

    <a href="index.php" class="btn-back">Kembali</a>
</div>

</body>
</html>
