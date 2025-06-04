<?php
session_start();
require_once '../function/logic.php';
if(!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>FAQ - Pengaduan Masyarakat</title>
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #f8fafc; color: #222; }
        .container { max-width: 700px; margin: 40px auto; background: #fff; border-radius: 10px; box-shadow: 0 2px 12px #0001; padding: 32px 36px; }
        h2 { color: #166534; text-align: center; margin-bottom: 32px; }
        .faq-item { margin-bottom: 28px; }
        .faq-q { font-weight: bold; color: #16a34a; margin-bottom: 6px; }
        .faq-a { margin-left: 18px; color: #333; }
        @media (max-width: 600px) {
            .container { padding: 18px 8px; }
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Frequently Asked Questions (FAQ)</h2>
    <div class="faq-item">
        <div class="faq-q">1. Apa itu layanan pengaduan masyarakat?</div>
        <div class="faq-a">Layanan pengaduan masyarakat adalah sistem yang digunakan untuk menampung, memproses, dan menindaklanjuti laporan atau keluhan dari masyarakat terkait pelayanan publik atau permasalahan di lingkungan sekitar.</div>
    </div>
    <div class="faq-item">
        <div class="faq-q">2. Siapa saja yang dapat mengajukan pengaduan?</div>
        <div class="faq-a">Semua warga masyarakat yang memiliki NIK (Nomor Induk Kependudukan) dapat mengajukan pengaduan melalui sistem ini.</div>
    </div>
    <div class="faq-item">
        <div class="faq-q">3. Bagaimana cara mengajukan pengaduan?</div>
        <div class="faq-a">Anda dapat mengajukan pengaduan dengan mendaftar/memasukkan NIK, mengisi formulir pengaduan, melengkapi data yang diperlukan, dan mengunggah bukti pendukung jika ada.</div>
    </div>
    <div class="faq-item">
        <div class="faq-q">4. Apakah identitas pelapor dijamin kerahasiaannya?</div>
        <div class="faq-a">Ya, identitas pelapor dijamin kerahasiaannya dan hanya digunakan untuk keperluan verifikasi laporan.</div>
    </div>
    <div class="faq-item">
        <div class="faq-q">5. Bagaimana cara mengetahui status pengaduan saya?</div>
        <div class="faq-a">Anda dapat memantau status pengaduan melalui menu <b>Riwayat Pengaduan</b> setelah login ke sistem.</div>
    </div>
    <div class="faq-item">
        <div class="faq-q">6. Berapa lama waktu penanganan pengaduan?</div>
        <div class="faq-a">Waktu penanganan pengaduan tergantung pada tingkat kompleksitas laporan, namun kami berusaha memberikan tanggapan secepat mungkin.</div>
    </div>
    <div class="faq-item">
        <div class="faq-q">7. Siapa yang dapat saya hubungi jika ada kendala?</div>
        <div class="faq-a">Anda dapat menghubungi petugas melalui kontak yang tersedia di halaman utama atau melalui email resmi instansi.</div>
    </div>
    <div style="text-align:center; margin-top:36px;">
        <a href="index.php" class="no-print">
        <button style="padding:10px 28px; background:#16a34a; color:#fff; border:none; border-radius:6px; font-size:1em; cursor:pointer;">
            Kembali
        </button>
        </a>
    </div>
</div>
</body>
</html>