<?php include "koneksi.php"; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Siswa</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #4e73df, #1cc88a);
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        .container-card {
            background: #fff;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.2);
            max-width: 500px;
            margin: auto;
            margin-bottom: 30px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .btn-submit {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border-radius: 5px;
            background-color: #4e73df;
            color: white;
            border: none;
            font-weight: bold;
            cursor: pointer;
        }

        .btn-submit:hover {
            background-color: #2e59d9;
        }

        /* Tabel full width layar */
        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            margin-top: 20px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.2);
        }

        th, td {
            text-align: center;
            padding: 10px;
            border: 1px solid #ddd;
        }

        th {
            background-color: #4e73df;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        /* Tombol Kembali versi card */
        .btn-back {
            display: block;
            width: 200px;
            margin: 20px auto 0;
            padding: 10px;
            text-align: center;
            background-color: #6c757d;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            transition: background-color 0.3s, transform 0.2s;
        }

        .btn-back:hover {
            background-color: #5a6268;
            transform: translateY(-2px);
        }

        @media (max-width: 576px) {
            th, td {
                padding: 8px;
            }
        }
    </style>
</head>
<body>

<div class="container-card">
    <h2>Masukkan ID Siswa</h2>

    <form action="progres_siswa.php" method="GET">
        <input type="number" name="id" class="form-control" placeholder="ID Siswa" required>
        <button type="submit" class="btn-submit">Lihat Hafalan</button>
    </form>
</div>

<h2 class="text-center text-white">Data Siswa</h2>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Jenis Kelamin</th>
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
        </tr>
    <?php } ?>
    </tbody>
</table>

<!-- Tombol Kembali versi card -->
<a href="index.php" class="btn-back">Kembali</a>

</body>
</html>
