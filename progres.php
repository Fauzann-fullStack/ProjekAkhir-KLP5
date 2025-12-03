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

        .table thead th {
            background-color: #4e73df;
            color: #fff;
            text-align: center;
        }

        .table td, .table th {
            text-align: center;
            vertical-align: middle;
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
    <h2>Hafalan: <?= htmlspecialchars($siswa['nama']); ?> (<?= htmlspecialchars($siswa['kelas']); ?>)</h2>

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
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
                 ORDER BY tanggal_update DESC"
            );

            if (!$data || mysqli_num_rows($data) == 0) {
                echo "<tr><td colspan='7' class='text-center'>Belum ada hafalan</td></tr>";
            } else {
                while ($d = mysqli_fetch_assoc($data)) { ?>
                    <tr>
                        <td><?= htmlspecialchars($d['nama_surah']); ?></td>
                        <td><?= htmlspecialchars($d['ayat_mulai']); ?></td>
                        <td><?= htmlspecialchars($d['ayat_sampai']); ?></td>
                        <td><?= htmlspecialchars($d['tanggal_update']); ?></td>
                        <td><?= htmlspecialchars($d['guru_pemeriksa'] ?: '-'); ?></td>
                        <td><?= htmlspecialchars($d['catatan_guru'] ?: '-'); ?></td>
                        <td>
                            <?php 
                                if ($d['status_hafalan'] == "Lancar") {
                                    echo "<span class='badge bg-success'>Lancar</span>";
                                } elseif ($d['status_hafalan'] == "Perlu diulang") {
                                    echo "<span class='badge bg-danger'>Perlu Diulang</span>";
                                } else {
                                    echo "-";
                                }
                            ?>
                        </td>
                    </tr>
                <?php } 
            }
            ?>
            </tbody>
        </table>
    </div>

    <a href="data_siswa.php" class="btn-back">Kembali</a>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
