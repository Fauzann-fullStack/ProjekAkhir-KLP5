<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['akses']) || $_SESSION['akses'] != "guru") {
    die("Akses ditolak!");
}

// Gunakan id_siswa dari URL
if (!isset($_GET['id_siswa'])) {
    die("ID siswa tidak ditemukan.");
}
$id_siswa = (int)$_GET['id_siswa'];

// Ambil data siswa
$q = mysqli_query($conn, "SELECT * FROM data_siswa WHERE id_siswa=$id_siswa");
if (!mysqli_num_rows($q)) {
    die("Data siswa tidak ditemukan.");
}
$siswa = mysqli_fetch_assoc($q);

// Ambil daftar surah untuk dropdown
$surah = mysqli_query($conn, "SELECT * FROM surah ORDER BY id_surah ASC");

// Proses submit
if (isset($_POST['submit'])) {
    $id_surah = $_POST['id_surah'];
    $ayat_mulai = $_POST['ayat_mulai'];
    $ayat_sampai = $_POST['ayat_sampai'];
    $tanggal = $_POST['tanggal_update'];
    $guru = $_POST['guru_pemeriksa'];
    $catatan = $_POST['catatan_guru'];
    $status = $_POST['status_hafalan'];

    mysqli_query($conn, "INSERT INTO proses_hafalan 
        (id_siswa, id_surah, ayat_mulai, ayat_sampai, tanggal_update, guru_pemeriksa, catatan_guru, status_hafalan)
        VALUES ('$id_siswa','$id_surah','$ayat_mulai','$ayat_sampai','$tanggal','$guru','$catatan','$status')");

    echo "<script>alert('Hafalan berhasil ditambahkan!');
          window.location='progres.php?id=$id_siswa';</script>";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tambah Hafalan</title>
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
    max-width: 600px;
    margin: auto;
}
h2 {
    text-align: center;
    margin-bottom: 20px;
    font-weight: bold;
    color: #333;
}
.btn-back {
    display: block;
    width: 150px;
    margin: 10px auto 0;
    padding: 10px;
    text-align: center;
    background-color: #6c757d;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    font-weight: bold;
}
.btn-back:hover {
    background-color: #5a6268;
}
</style>
</head>
<body>

<div class="card">
    <h2>Tambah Hafalan: <?= htmlspecialchars($siswa['nama']); ?> (<?= htmlspecialchars($siswa['kelas']); ?>)</h2>
    <form method="POST">
        <div class="mb-3">
            <label>Surah</label>
            <select name="id_surah" class="form-control" required>
                <option value="">-- Pilih Surah --</option>
                <?php while ($s = mysqli_fetch_assoc($surah)) { ?>
                    <option value="<?= $s['id_surah']; ?>"><?= $s['nama_surah']; ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="mb-3">
            <label>Ayat Mulai</label>
            <input type="number" name="ayat_mulai" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Ayat Sampai</label>
            <input type="number" name="ayat_sampai" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Tanggal Setor</label>
            <input type="date" name="tanggal_update" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Guru Pemeriksa</label>
            <input type="text" name="guru_pemeriksa" class="form-control">
        </div>

        <div class="mb-3">
            <label>Catatan Guru</label>
            <textarea name="catatan_guru" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label>Status Hafalan</label>
            <select name="status_hafalan" class="form-control">
                <option value="Lancar">Lancar</option>
                <option value="Perlu diulang">Perlu diulang</option>
            </select>
        </div>

        <button type="submit" name="submit" class="btn btn-success w-100">Tambah Hafalan</button>
    </form>

    <a href="progres.php?id=<?= $id_siswa; ?>" class="btn-back">Kembali</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
