<?php
session_start();

// Hanya guru yang boleh masuk
if (!isset($_SESSION['akses']) || $_SESSION['akses'] !== "guru") {
    die("Akses ditolak!");
}

include "koneksi.php";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #8efdffff, #81ee95ff);

        }
        .container-box {
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 4px 20px rgba(0,0,0,0.1);
            margin-top: 40px;
        }
        h2 {
            font-weight: bold;
        }
        .btn-custom {
            padding: 8px 16px;
            font-size: 15px;
        }
        table {
            border-radius: 10px;
            overflow: hidden;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="container-box">

        <h2 class="text-center mb-4">Data Siswa</h2>

        <div class="d-flex justify-content-between mb-3">
            <a href="tambah_siswa.php" class="btn btn-primary btn-custom">+ Tambah Siswa</a>
            <a href="dashboard_guru.php" class="btn btn-secondary btn-custom">Kembali</a>
        </div>

        <table class="table table-bordered table-striped text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Jenis Kelamin</th>
                    <th style="width: 220px;">Aksi</th>
                </tr>
            </thead>

            <tbody>
            <?php
            $q = mysqli_query($conn, "SELECT * FROM data_siswa");

            while ($s = mysqli_fetch_assoc($q)) {
            ?>
                <tr>
                    <td><?= $s['id_siswa'] ?></td>
                    <td><?= $s['nama'] ?></td>
                    <td><?= $s['kelas'] ?></td>
                    <td><?= $s['jenis_kelamin'] ?></td>
                    <td>
                        <a href="edit_siswa.php?id=<?= $s['id_siswa'] ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="hapus_siswa.php?id=<?= $s['id_siswa'] ?>" onclick="return confirm('Hapus?')" class="btn btn-danger btn-sm">Hapus</a>
                        <a href="progres.php?id=<?= $s['id_siswa'] ?>" class="btn btn-info btn-sm text-white">Progres</a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>

    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
