<?php
session_start();

if (!isset($_SESSION['akses']) || $_SESSION['akses'] != "guru") {
    die("Akses ditolak!");
}

include "koneksi.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Siswa</title>

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #4e73df, #1cc88a);
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: Arial, sans-serif;
        }

        .card {
            width: 450px;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.2);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .btn-back {
            margin-top: 10px;
        }
    </style>
</head>

<body>

<div class="card">
    <h2>Tambah Siswa</h2>

    <form action="simpan_siswa.php" method="POST">

        <div class="mb-3">
            <label class="form-label">ID Siswa</label>
            <input type="number" name="id_siswa" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Kelas</label>
            <input type="text" name="kelas" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-select" required>
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
            </select>
        </div>

        <button class="btn btn-primary w-100">Simpan</button>
    </form>

    <!-- Tombol Kembali -->
    <a href="data_siswa.php" class="btn btn-secondary w-100 btn-back">Kembali</a>
</div>

</body>
</html>
