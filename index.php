<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            background-image : url('anjay.jpg')
        }
    </style>
    <title>Menu Utama</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex justify-content-center align-items-center vh-100">

    <div class="card shadow-lg p-4 text-center" style="width: 350px; border-radius: 20px;">
        <h3 class="mb-4">Pilih Role</h3>

        <div class="d-grid gap-3">
            <a href="siswa_login.php" class="btn btn-primary btn-lg">Saya Siswa</a>
            <a href="login_guru.php" class="btn btn-success btn-lg">Saya Guru</a>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
