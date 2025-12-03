<?php
include "koneksi.php";

// Pastikan id_siswa ada
if (!isset($_GET['id_siswa'])) {
    die("ID siswa tidak ditemukan!");
}

$id_siswa = $_GET['id_siswa'];

// Ambil data siswa
$q_siswa = mysqli_query($conn, "SELECT * FROM data_siswa WHERE id_siswa='$id_siswa'");
$siswa = mysqli_fetch_assoc($q_siswa);

if (!$siswa) {
    die("Data siswa tidak ditemukan!");
}

// Ambil daftar surah
$surah = mysqli_query($conn, "SELECT * FROM surah ORDER BY id_surah ASC");

// Jika form dikirim
if (isset($_POST['tambah'])) {

    $id_surah       = $_POST['id_surah'];
    $ayat_mulai     = $_POST['ayat_mulai'];
    $ayat_selesai   = $_POST['ayat_selesai'];
    $tanggal_update = $_POST['tanggal_update'];
    $guru           = $_POST['guru_pemeriksa'];
    $catatan        = $_POST['catatan_guru'];
    $status         = $_POST['status_hafalan'];

    // Insert data
    $insert = mysqli_query($conn, "
        INSERT INTO proses_hafalan 
        (id_siswa, id_surah, ayat_mulai, ayat_sampai, tanggal_update, guru_pemeriksa, catatan_guru, status_hafalan)
        VALUES 
        ('$id_siswa', '$id_surah', '$ayat_mulai', '$ayat_selesai', '$tanggal_update', '$guru', '$catatan', '$status')
    ");

    if ($insert) {
        echo "<script>
                alert('Progres hafalan berhasil ditambahkan!');
                window.location='progres.php?id=$id_siswa';
              </script>";
    } else {
        echo "Gagal menyimpan data!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Progres Hafalan</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #eef2f5;
            padding: 30px;
        }

        .box {
            width: 480px;
            margin: auto;
            background: white;
            padding: 22px;
            border-radius: 10px;
            box-shadow: 0px 0px 8px rgba(0,0,0,0.15);
        }

        h2 {
            text-align: center;
            margin-bottom: 18px;
        }

        label {
            font-weight: bold;
        }

        input, select, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 14px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        textarea { height: 80px; }

        button {
            width: 100%;
            padding: 12px;
            background: #28a745;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 6px;
            cursor: pointer;
        }

        button:hover { background: #218838; }

        .back {
            margin-top: 15px;
            text-align: center;
        }

        .back a {
            color: #007bff;
            text-decoration: none;
        }
    </style>

</head>
<body>

<div class="box">

    <h2>Tambah Progres Hafalan</h2>

    <p><b>Nama Siswa:</b> <?= $siswa['nama']; ?></p>

    <form method="post">

        <label>Surah:</label>
        <select name="id_surah" required>
            <option value="">-- Pilih Surah --</option>
            <?php while ($s = mysqli_fetch_assoc($surah)) { ?>
                <option value="<?= $s['id_surah']; ?>">
                    <?= $s['id_surah']; ?> - <?= $s['nama_surah']; ?>
                </option>
            <?php } ?>
        </select>

        <label>Ayat Mulai:</label>
        <input type="number" name="ayat_mulai" required>

        <label>Ayat Selesai:</label>
        <input type="number" name="ayat_selesai" required>

        <label>Tanggal Update:</label>
        <input type="date" name="tanggal_update" required>

        <label>Guru Pemeriksa:</label>
        <input type="text" name="guru_pemeriksa" required>

        <label>Catatan Guru:</label>
        <textarea name="catatan_guru" placeholder="Opsional"></textarea>

        <label>Status Hafalan:</label>
        <select name="status_hafalan" required>
            <option value="">-- Pilih Status --</option>
            <option value="Lancar">Lancar</option>
            <option value="Perlu diulang">Perlu diulang</option>
        </select>

        <button type="submit" name="tambah">Simpan</button>

    </form>

    <div class="back">
        <a href="progres.php?id=<?= $id_siswa ?>">Kembali</a>
    </div>

</div>

</body>
</html>