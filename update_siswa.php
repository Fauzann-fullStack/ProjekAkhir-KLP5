<?php
session_start();

if (!isset($_SESSION['akses']) || $_SESSION['akses'] != "guru") {
    die("Akses ditolak!");
}

include "koneksi.php";

$id = $_POST['id_siswa'];
$nama = $_POST['nama'];
$kelas = $_POST['kelas'];
$jk = $_POST['jenis_kelamin'];

mysqli_query($conn,"UPDATE data_siswa SET 
        nama='$nama',
        kelas='$kelas',
        jenis_kelamin='$jk'
        WHERE id_siswa=$id");

header("Location: data_siswa.php");