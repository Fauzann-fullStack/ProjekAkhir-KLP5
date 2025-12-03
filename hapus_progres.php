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

mysqli_query($conn, "
    DELETE FROM proses_hafalan
    WHERE id_siswa='$id_siswa'
    AND id_surah='$id_surah'
    AND ayat_mulai='$mulai'
    AND ayat_sampai='$sampai'
");

echo "<script>alert('Progres berhasil dihapus!'); 
window.location='progres.php?id=$id_siswa';</script>";