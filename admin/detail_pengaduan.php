<?php
session_start();
require_once '../function/logic.php';

if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin" && $_SESSION["role"] !== "petugas") {
    header("Location: login_admin.php");
    exit;
}

$id = intval($_GET['id']);
$data = tampil("SELECT * FROM pengaduan WHERE id_pengaduan = '$id'")[0];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Detail Pengaduan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h2>Detail Pengaduan</h2>
    <table class="table table-bordered">
        <tr>
            <th>Judul</th>
            <td><?php echo $data['judul']; ?></td>
        </tr>
        <tr>
            <th>Isi Laporan</th>
            <td><?php echo $data['isi_laporan']; ?></td>
        </tr>
        <tr>
            <th>Tanggal</th>
            <td><?php echo $data['tgl_kejadian']; ?></td>
        </tr>
        <tr>
            <th>Status</th>
            <td><?php echo $data['status']; ?></td>
        </tr>
        <tr>
            <th>Foto</th>
            <td>
                <?php if ($data["foto"] == "default.jpg"): ?>
                    tidak ada foto
                <?php else: ?>
                          <img src="../assets/img/<?php echo $data['foto']; ?>" width="300">
                <?php endif; ?>
            </td>
        </tr>
    </table>
    <button class="btn btn-secondary" onclick="window.history.back();">Kembali</button>
</div>
</body>
</html>