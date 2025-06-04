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
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #fff; color: #222; }
        .container { max-width: 800px; margin: 40px auto; padding: 36px 40px 32px 40px; border: 1.5px solid #16a34a; border-radius: 12px; background: #f8fafc; box-shadow: 0 2px 16px #0001; }
        .header-instansi { text-align: center; margin-bottom: 32px; border-bottom: 2px solid #16a34a; padding-bottom: 18px; }
        .header-instansi img { width: 70px; vertical-align: middle; margin-right: 18px; }
        .header-instansi .judul { font-size: 1.5em; font-weight: bold; color: #166534; }
        .header-instansi .alamat { font-size: 1em; color: #555; margin-top: 4px; }
        h2 { text-align: center; margin-bottom: 32px; color: #166534; letter-spacing: 1px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 28px; background: #fff; }
        th, td { padding: 12px 10px; border-bottom: 1px solid #e5e7eb; text-align: left; font-size: 1.05em; }
        th { background: #dcfce7; width: 200px; color: #166534; font-weight: 600; }
        tr:last-child td, tr:last-child th { border-bottom: none; }
        .foto { margin-top: 10px; }
        .footer { margin-top: 48px; text-align: right; font-size: 1em; }
        .ttd { margin-top: 60px; text-align: right; }
        .ttd .nama { margin-top: 60px; font-weight: bold; text-decoration: underline; }
        .ttd .jabatan { margin-bottom: 60px; }
        .section-title { font-size: 1.1em; font-weight: 600; color: #16a34a; margin-top: 32px; margin-bottom: 10px; border-left: 4px solid #16a34a; padding-left: 10px; }
        @media print {
            .no-print { display: none; }
            body { background: #fff; }
            .container { border: none; box-shadow: none; }
        }
    </style>
</head>
<body class="bg-green-200 font-sans" onload="window.print()">
<div class="container">
    <div class="header-instansi">
        <img src="../assets/img/logo.png" alt="Logo Instansi" onerror="this.style.display='none'">
        <span class="judul">PEMERINTAH KOTA TOKYO<br>DINAS PENGADUAN MASYARAKAT</span>
        <div class="alamat">Jl. Jelekong, SHibuya, Telp. (021) 12345678</div>
    </div>
    <h2>Laporan Detail Pengaduan</h2>
    <div class="section-title">Data Pengaduan</div>
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
            <th>Status</th>
            <td>
                <?php
                    if ($data['status'] == '0') echo 'Ditolak';
                    else echo ucfirst($data['status']);
                ?>
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
    <div class="section-title">Data Pelapor</div>
    <table>
        <tr>
            <th>Nama Pelapor</th>
            <td><?= $masyarakat ? htmlspecialchars($masyarakat['nama']) : '-' ?></td>
        </tr>
        <tr>
            <th>NIK Pelapor</th>
            <td><?= htmlspecialchars($data['nik']) ?></td>
        </tr>
    </table>
    <div class="section-title">Isi Laporan</div>
    <table>
        <tr>
            <th>Isi Laporan</th>
            <td><?= nl2br(htmlspecialchars($data['isi_laporan'])) ?></td>
        </tr>
    </table>
    <div class="section-title">Tanggapan</div>
    <table>
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
    </table>
    <div class="footer">
        <div>Dicetak pada: <?= date('d-m-Y') ?></div>
        <div class="no-print" style="margin-top:12px;">
            <button onclick="window.history.back()" style="padding:8px 18px;border:none;background:#16a34a;color:#fff;border-radius:5px;cursor:pointer;">Tutup</button>
        </div>
    </div>
    <div class="ttd">
        <div class="jabatan"><?php echo $petugas["level"] ?></div>
        <div class="nama"><?= $petugas ? htmlspecialchars($petugas['nama_petugas']) : '____________________' ?></div>
    </div>
</div>
</body>
</html>
