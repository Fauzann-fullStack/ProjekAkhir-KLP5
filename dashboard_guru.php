<?php
session_start();

// Hanya guru yang boleh masuk
if (!isset($_SESSION['akses']) || $_SESSION['akses'] !== "guru") {
    echo "Akses ditolak.";
    exit();
}

$nama_guru = $_SESSION['nama'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Guru</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Background gradasi CSS */
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #4e73df, #1cc88a); /* gradasi biru ke hijau */
        }

        /* Card dashboard modern */
        .dashboard-box {
            background: rgba(255, 255, 255, 0.95); /* semi-transparan tapi tetap jelas */
            border-radius: 25px;
            padding: 50px 30px;
            width: 420px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.25);
            transition: transform 0.3s, box-shadow 0.3s;
            text-align: center;
        }

        .dashboard-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 50px rgba(0,0,0,0.3);
        }

        h2 {
            font-weight: 700;
            color: #333;
            margin-bottom: 40px;
        }

        /* Tombol modern */
        .btn-lg {
            border-radius: 12px;
            font-weight: bold;
            padding: 12px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #2e59d9;
            transform: translateY(-2px);
        }

        .btn-success:hover {
            background-color: #1aa179;
            transform: translateY(-2px);
        }

        .btn-danger:hover {
            background-color: #c82333;
            transform: translateY(-2px);
        }

        /* Responsif */
        @media (max-width: 576px) {
            .dashboard-box {
                width: 90%;
                padding: 30px 20px;
            }

            h2 {
                font-size: 1.5rem;
            }

            .btn-lg {
                font-size: 0.95rem;
            }
        }
    </style>
</head>
<body>

    <div class="dashboard-box">
        <h2>Selamat Datang,<br><b><?= htmlspecialchars($nama_guru) ?></b></h2>

        <div class="d-grid gap-3">
            <a href="data_siswa.php" class="btn btn-primary btn-lg">Kelola Data Siswa</a>
            <a href="kelola_surah.php" class="btn btn-success btn-lg">Kelola Surah</a>
            <a href="logout.php" class="btn btn-danger btn-lg">Logout</a>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
