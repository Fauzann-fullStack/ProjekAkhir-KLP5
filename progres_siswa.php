<?php
include "koneksi.php";

if (!isset($_GET['id'])) { die("ID siswa tidak ditemukan."); }

$id = (int) $_GET['id'];

$q = mysqli_query($conn, "SELECT * FROM data_siswa WHERE id_siswa=$id");
if (!mysqli_num_rows($q)) { die("Data siswa tidak ditemukan."); }
$siswa = mysqli_fetch_assoc($q);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Progres Hafalan Siswa</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #4e73df, #1cc88a);
            font-family: Arial, sans-serif;
            padding: 20px;
            min-height: 100vh;
        }

        .card {
            background: #fff;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.2);
            margin-bottom: 20px;
            max-width: 1100px;
            margin-left: auto;
            margin-right: auto;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background: #4e73df;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .btn-back {
            display: block;
            width: 150px;
            margin: 20px auto 0;
            padding: 10px;
            text-align: center;
            background-color: #6c757d;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .btn-back:hover {
            background-color: #5a6268;
        }

    </style>
</head>
<body>

<div class="card">
    <h2>Hafalan: <?= $siswa['nama']; ?> (<?= $siswa['kelas']; ?>)</h2>

    <table>
        <thead>
            <tr>
                <th>Surah</th>
                <th>Ayat Mulai</th>
                <th>Ayat Sampai</th>
                <th>Tanggal</th>
                <th>Guru Pemeriksa</th>
                <th>Catatan Guru</th>
                <th>Status Hafalan</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $data = mysqli_query($conn,
        "SELECT p.*, s.nama_surah 
         FROM proses_hafalan p
         JOIN surah s ON p.id_surah = s.id_surah
         WHERE id_siswa=$id 
         ORDER BY tanggal_update DESC");

        if (!mysqli_num_rows($data)) {
            echo "<tr><td colspan='7'>Belum ada hafalan.</td></tr>";
        }

        while ($d = mysqli_fetch_assoc($data)) {
        ?>
            <tr>
                <td><?= $d['nama_surah'] ?></td>
                <td><?= $d['ayat_mulai'] ?></td>
                <td><?= $d['ayat_sampai'] ?></td>
                <td><?= $d['tanggal_update'] ?></td>
                <td><?= $d['guru_pemeriksa'] ?: '-' ?></td>
                <td><?= $d['catatan_guru'] ?: '-' ?></td>
                <td>
                    <?php 
                        if ($d['status_hafalan'] == "Lancar") {
                            echo "<span class='badge bg-success'>Lancar</span>";
                        } elseif ($d['status_hafalan'] == "P    erlu diulang") {
                            echo "<span class='badge bg-danger'>Perlu Diulang</span>";
                        } else {
                            echo "-";
                        }
                    ?>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

    <a href="siswa_login.php" class="btn-back">Kembali</a>
</div>

</body>
</html>
 