<?php
session_start();
require_once '../function/logic.php';

if (!isset($_SESSION["role"]) || ($_SESSION["role"] !== "admin" && $_SESSION["role"] !== "petugas")) {
    header("Location: login_admin.php");
    exit;
}

$id = intval($_GET['id']);
$dataArr = tampil("SELECT * FROM pengaduan WHERE id_pengaduan = '$id'");
if (!$dataArr) {
    echo "<h2 style='color:red;text-align:center;margin-top:40px'>Data pengaduan tidak ditemukan.</h2>";
    exit;
}
$data = $dataArr[0];

// Ambil data masyarakat
$masyarakatArr = tampil("SELECT * FROM masyarakat WHERE nik = '{$data['nik']}'");
$masyarakat = $masyarakatArr ? $masyarakatArr[0] : null;

// Ambil tanggapan & petugas
$tanggapanArr = tampil("SELECT * FROM tanggapan WHERE id_pengaduan = '$id'");
$tanggapan = $tanggapanArr ? $tanggapanArr[0] : null;
$petugas = null;
if ($tanggapan && $tanggapan['id_petugas']) {
    $petugasArr = tampil("SELECT * FROM petugas WHERE id_petugas = '{$tanggapan['id_petugas']}'");
    $petugas = $petugasArr ? $petugasArr[0] : null;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Cetak Laporan Pengaduan</title>
    <style>
        body { font-family: Arial, sans-serif; background: #fff; color: #222; }
        .container { max-width: 700px; margin: 40px auto; padding: 32px; border: 1px solid #bbb; border-radius: 10px; }
        h2 { text-align: center; margin-bottom: 32px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 24px; }
        th, td { padding: 10px 8px; border-bottom: 1px solid #eee; text-align: left; }
        th { background: #f0fdf4; width: 180px; }
        .foto { margin-top: 10px; }
        .footer { margin-top: 40px; text-align: right; }
        @media print {
            .no-print { display: none; }
            body { background: #fff; }
            .container { border: none; box-shadow: none; }
        }
    </style>
</head>
<body class="bg-green-200 font-sans" onload="window.print()">
<div class="container">
    <h2>Laporan Detail Pengaduan</h2>
    <table>
        <tr>
            <th>Judul</th>
            <td><?= htmlspecialchars($data['judul']) ?></td>
        </tr>
        <tr>
            <th>Tanggal Laporan</th>
            <td><?= htmlspecialchars($data['tanggal_laporan']) ?></td>
        </tr>
        <tr>
            <th>Tanggal Kejadian</th>
            <td><?= htmlspecialchars($data['tgl_kejadian']) ?></td>
        </tr>
        <tr>
            <th>Nama Pelapor</th>
            <td><?= $masyarakat ? htmlspecialchars($masyarakat['nama']) : '-' ?></td>
        </tr>
        <tr>
            <th>NIK Pelapor</th>
            <td><?= htmlspecialchars($data['nik']) ?></td>
        </tr>
        <tr>
            <th>Isi Laporan</th>
            <td><?= nl2br(htmlspecialchars($data['isi_laporan'])) ?></td>
        </tr>
        <tr>
            <th>Status</th>
            <td>
                <?php
                    if ($data['status'] == '0') echo 'Ditolak';
                    else echo ucfirst($data['status']);
                ?>
            </td>
        </tr>
        <tr>
            <th>Tanggapan</th>
            <td>
                <?php
                    if ($tanggapan) {
                        echo nl2br(htmlspecialchars($tanggapan['tanggapan']));
                    } else {
                        echo 'Belum ada tanggapan';
                    }
                ?>
            </td>
        </tr>
        <tr>
            <th>Petugas</th>
            <td>
                <?= $petugas ? htmlspecialchars($petugas['nama_petugas']) : '-' ?>
            </td>
        </tr>
        <tr>
            <th>Foto</th>
            <td>
                <?php if ($data["foto"] && $data["foto"] != "default.jpg"): ?>
                    <img src="../assets/img/<?= htmlspecialchars($data['foto']) ?>" alt="Foto Pengaduan" class="foto" style="max-width:220px;max-height:180px;border-radius:8px;border:1px solid #ccc;">
                <?php else: ?>
                    <span style="color:#888;font-style:italic;">tidak ada foto</span>
                <?php endif; ?>
            </td>
        </tr>
    </table>
    <div class="footer">
        <div>Dicetak pada: <?= date('d-m-Y') ?></div>
        <div class="no-print" style="margin-top:12px;">
            <button onclick="window.history.back()" style="padding:8px 18px;border:none;background:#16a34a;color:#fff;border-radius:5px;cursor:pointer;">Tutup</button>
        </div>
    </div>
</div>
</body>
</html>
