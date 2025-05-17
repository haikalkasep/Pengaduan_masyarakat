<?php
session_start();
require_once '../function/logic.php';

if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin" && $_SESSION["role"] !== "petugas") {
    header("Location: login_admin.php");
    exit;
}
if (!isset($_GET['id'])) {
    echo "ID pengaduan tidak ditemukan.";
    exit;
}

$id = intval($_GET['id']);
$data = tampil("SELECT * FROM pengaduan WHERE id_pengaduan = '$id'")[0];
if (!$data) {
    echo "Data pengaduan tidak ditemukan.";
    exit;
}
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
            <td><?php echo htmlspecialchars($data['judul']); ?></td>
        </tr>
        <tr>
            <th>Isi Laporan</th>
            <td><?php echo nl2br(htmlspecialchars($data['isi_laporan'])); ?></td>
        </tr>
        <tr>
            <th>Tanggal</th>
            <td><?php echo htmlspecialchars($data['tgl_kejadian']); ?></td>
        </tr>
        <tr>
            <th>Status</th>
            <td><?php echo htmlspecialchars($data['status']); ?></td>
        </tr>
        <tr>
            <th>Foto</th>
            <td>
                <?php if ($data["foto"] == "default.jpg"): ?>
                    tidak ada foto
                <?php else: ?>
                          <img src="../assets/img/<?php echo htmlspecialchars($data['foto']); ?>" width="300">
                <?php endif; ?>
            </td>
        </tr>
    </table>
    <a href="laporan_menunggu.php" class="btn btn-secondary">Kembali</a>
</div>
</body>
</html>