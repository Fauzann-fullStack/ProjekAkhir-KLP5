<?php
session_start();
if (!isset($_SESSION['akses']) || $_SESSION['akses'] != "guru") {
    die("Akses ditolak!");
}
include "koneksi.php";
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Kelola Surah</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

<style>
body {
    min-height: 100vh;
    font-family: Arial, sans-serif;
    background: linear-gradient(135deg, #4e73df, #1cc88a);
    padding: 20px;
}

h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #fff;
    font-weight: bold;
}

.table-container {
    background: #fff;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.2);
    overflow-x: auto;
}

#customSearch {
    margin-bottom: 15px;
    width: 250px;
}

.bottom-controls {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 10px;
}

.btn-back {
    margin: 0;
}

table.dataTable thead th {
    background-color: #4e73df;
    color: white;
    text-align: center;
}

table.dataTable tbody td {
    text-align: center;
}

table.dataTable tbody tr:nth-child(even) {
    background-color: #f2f2f2;
}
</style>
</head>
<body>

<div class="container">
    <h2>Daftar Surah</h2>

    <div class="table-container">
        <!-- Search box kiri -->
        <input type="text" id="customSearch" class="form-control" placeholder="Cari Surah...">

        <table id="surahTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Surah</th>
                    <th>Jumlah Ayat</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = mysqli_query($conn, "SELECT * FROM surah");
                while ($s = mysqli_fetch_assoc($query)) {
                ?>
                <tr>
                    <td><?= $s['id_surah'] ?></td>
                    <td><?= $s['nama_surah'] ?></td>
                    <td><?= $s['jumlah_ayat'] ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

        <!-- Bottom Controls -->
        <div class="bottom-controls">
            <a href="dashboard_guru.php" class="btn btn-secondary btn-back">← Kembali ke Dashboard</a>
            <div id="tableInfo" style="text-align:center;"></div>
            <div id="tablePaginate"></div>
        </div>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function() {
    var table = $('#surahTable').DataTable({
        paging: true,
        info: true,
        lengthChange: false,
        searching: true
    });

    // Search custom
    $('#customSearch').on('keyup', function() {
        table.search(this.value).draw();
    });
    $('#surahTable_filter').hide();

    // Pindahkan info & pagination
    $('#tableInfo').append(table.table().container().querySelector('.dataTables_info'));
    $('#tablePaginate').append(table.table().container().querySelector('.dataTables_paginate'));
});
</script>

</body>
</html>
