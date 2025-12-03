<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['akses']) || $_SESSION['akses'] != "guru") {
    die("Akses ditolak!");
}

if (
    !isset($_GET['id_siswa']) ||
    !isset($_GET['id_surah']) ||
    !isset($_GET['mulai']) ||
    !isset($_GET['sampai'])
) {
    die("Parameter tidak lengkap!");
}

$id_siswa = $_GET['id_siswa'];
$id_surah = $_GET['id_surah'];
$mulai = $_GET['mulai'];
$sampai = $_GET['sampai'];

// Ambil data progres berdasarkan kombinasi kolom
$query = mysqli_query($conn, "
    SELECT * FROM proses_hafalan 
    WHERE id_siswa='$id_siswa' 
    AND id_surah='$id_surah'
    AND ayat_mulai='$mulai'
    AND ayat_sampai='$sampai'
");

$data = mysqli_fetch_assoc($query);

if (!$data) {
    die("Data progres tidak ditemukan!");
}

// Ambil daftar surah untuk dropdown
$surah = mysqli_query($conn, "SELECT * FROM surah ORDER BY id_surah ASC");

if (isset($_POST['update'])) {
    $id_surah_baru = $_POST['id_surah'];
    $ayat_mulai_baru = $_POST['ayat_mulai'];
    $ayat_sampai_baru = $_POST['ayat_sampai'];
    $tanggal = $_POST['tanggal_update'];
    $guru = $_POST['guru_pemeriksa'];
    $catatan = $_POST['catatan_guru'];
    $status = $_POST['status_hafalan'];

    mysqli_query($conn, "
        UPDATE proses_hafalan SET
            id_surah = '$id_surah_baru',
            ayat_mulai = '$ayat_mulai_baru',
            ayat_sampai = '$ayat_sampai_baru',
            tanggal_update = '$tanggal',
            guru_pemeriksa = '$guru',
            catatan_guru = '$catatan',
            status_hafalan = '$status'
        WHERE id_siswa='$id_siswa'
        AND id_surah='$id_surah'
        AND ayat_mulai='$mulai'
        AND ayat_sampai='$sampai'
    ");

    echo "<script>alert('Progres berhasil diperbarui!'); 
    window.location='progres.php?id=$id_siswa';</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Progres</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">

<h3>Edit Progres Hafalan</h3>
<hr>

<form method="POST">

    <label>Surah</label>
    <select name="id_surah" class="form-control mb-2" required>
        <?php while ($s = mysqli_fetch_assoc($surah)) { ?>
            <option value="<?= $s['id_surah']; ?>" 
                <?= $s['id_surah'] == $data['id_surah'] ? 'selected' : ''; ?>>
                <?= $s['nama_surah']; ?>
            </option>
        <?php } ?>
    </select>

    <label>Ayat Mulai</label>
    <input type="number" name="ayat_mulai" class="form-control mb-2" value="<?= $data['ayat_mulai']; ?>" required>

    <label>Ayat Sampai</label>
    <input type="number" name="ayat_sampai" class="form-control mb-2" value="<?= $data['ayat_sampai']; ?>" required>

    <label>Tanggal Setor</label>
    <input type="date" name="tanggal_update" class="form-control mb-2" value="<?= $data['tanggal_update']; ?>" required>

    <label>Guru Pemeriksa</label>
    <input type="text" name="guru_pemeriksa" class="form-control mb-2" value="<?= $data['guru_pemeriksa']; ?>">

    <label>Catatan Guru</label>
    <textarea name="catatan_guru" class="form-control mb-2"><?= $data['catatan_guru']; ?></textarea>

    <label>Status Hafalan</label>
    <select name="status_hafalan" class="form-control mb-3">
        <option value="Lancar" <?= $data['status_hafalan'] == "Lancar" ? 'selected' : ''; ?>>Lancar</option>
        <option value="Perlu diulang" <?= $data['status_hafalan'] == "Perlu diulang" ? 'selected' : ''; ?>>Perlu diulang</option>
    </select>

    <button type="submit" name="update" class="btn btn-primary">Update</button>
    <a href="progres.php?id=<?= $id_siswa; ?>" class="btn btn-secondary">Kembali</a>

</form>

</body>
</html>