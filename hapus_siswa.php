<?php
session_start();

if (!isset($_SESSION['akses']) || $_SESSION['akses'] != "guru") {
    die("Akses ditolak!");
}

include "koneksi.php";

include "koneksi.php";
$id = $_GET['id'];
mysqli_query($conn,"DELETE FROM data_siswa WHERE id_siswa=$id");
header("Location: data_siswa.php");