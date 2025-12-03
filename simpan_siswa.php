<?php
session_start();

// Cek akses guru
if (!isset($_SESSION['akses']) || $_SESSION['akses'] != "guru") {
    die("Akses ditolak!");
}

include "koneksi.php";

// Tangkap data dari form dan amankan input
$id       = mysqli_real_escape_string($conn, $_POST['id_siswa']);
$nama     = mysqli_real_escape_string($conn, $_POST['nama']);
$kelas    = mysqli_real_escape_string($conn, $_POST['kelas']);
$jk       = mysqli_real_escape_string($conn, $_POST['jenis_kelamin']);

// Cek apakah ID sudah ada di database
$cek = mysqli_query($conn, "SELECT id_siswa FROM data_siswa WHERE id_siswa = '$id'");
if(mysqli_num_rows($cek) > 0){
    echo "<script>alert('ID Siswa sudah ada!'); window.history.back();</script>";
    exit();
}

// Query insert data
$sql = "INSERT INTO data_siswa (id_siswa, nama, kelas, jenis_kelamin) 
        VALUES ('$id', '$nama', '$kelas', '$jk')";

if(mysqli_query($conn, $sql)){
    // Jika sukses, redirect ke halaman data_siswa
    header("Location: data_siswa.php");
    exit();
} else {
    // Jika gagal, tampilkan error
    echo "Error: " . mysqli_error($conn);
}
?>
    