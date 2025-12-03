<?php
session_start();

if (!isset($_SESSION['akses']) || $_SESSION['akses'] != "guru") {
    die("Akses ditolak!");
}

include "koneksi.php";

$id = $_GET['id'];
$q = mysqli_query($conn, "SELECT * FROM data_siswa WHERE id_siswa=$id");
$s = mysqli_fetch_assoc($q);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Siswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 500px;
            margin: 50px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
            color: #555;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        /* Tombol sejajar */
        .btn-group {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .btn-group button,
        .btn-group a {
            flex: 1;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            font-weight: bold;
            transition: background-color 0.3s;
            text-decoration: none;
            color: white;
            cursor: pointer;
            border: none;
        }

        .btn-update {
            background-color: #4CAF50;
        }

        .btn-update:hover {
            background-color: #45a049;
        }

        .btn-back {
            background-color: #6c757d;
        }

        .btn-back:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Edit Siswa</h2>

    <form action="update_siswa.php" method="POST">
        <input type="hidden" name="id_siswa" value="<?= $s['id_siswa'] ?>">

        <label>Nama:</label>
        <input name="nama" value="<?= htmlspecialchars($s['nama']); ?>">

        <label>Kelas:</label>
        <input name="kelas" value="<?= htmlspecialchars($s['kelas']); ?>">

        <label>Jenis Kelamin:</label>
        <select name="jenis_kelamin">
            <option <?= $s['jenis_kelamin']=='L'?'selected':'' ?>>L</option>
            <option <?= $s['jenis_kelamin']=='P'?'selected':'' ?>>P</option>
        </select>

        <!-- Tombol Update dan Kembali sejajar -->
        <div class="btn-group">
            <button type="submit" class="btn-update">Update</button>
            <a href="data_siswa.php" class="btn-back">Kembali</a>
        </div>
    </form>
</div>

</body>
</html>
