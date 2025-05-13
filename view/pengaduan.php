<?php
session_start();
require_once '../function/logic.php';

// Cek apakah user sudah login
if (!isset($_SESSION["nik"])) {
    header("Location: login.php");
    exit;
}

$nik = $_SESSION["nik"];
if (isset($_POST['submit'])) {
    // Insert data
    if (tambahPengaduan($_POST) > 0) {
        echo "<script>
                alert('Berhasil mengajukan pengaduan');
                document.location.href = 'hasil.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal mengajukan pengaduan');
              </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pengaduan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-green-200 flex items-center justify-center min-h-screen">
    <div class="bg-green-100 p-8 rounded-lg shadow-lg w-full max-w-md">
        <h1 class="text-2xl font-bold mb-6">BUAT LAPORAN</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidenn" name="nik" value="<?= $nik ?>" hidden>
            <div class="mb-4">
                <label for="judul" class="block text-gray-700">Judul Laporan</label>
                <input type="text" id="judul" name="judul" class="w-full p-2 border border-gray-300 rounded mt-1">
            </div>
            <div class="mb-4">
                <label for="tgl_pengaduan" class="block text-gray-700">Tanggal Kejadian</label>
                <input type="date" id="tgl_pengaduan" name="tgl_pengaduan" class="w-full p-2 border border-gray-300 rounded mt-1">
            </div>
            <div class="mb-4">
                <label for="isi_laporan" class="block text-gray-700">Isi Laporan</label>
                <textarea id="isi_laporan" name="isi_laporan" class="w-full p-2 border border-gray-300 rounded mt-1" rows="4"></textarea>
            </div>
            <div class="mb-4">
                <label for="foto" class="block text-gray-700">Upload Foto</label>
                <input type="file" id="foto" name="foto" class="w-full p-2 border border-gray-300 rounded mt-1">
            </div>
            <button type="submit" class="bg-blue-500 text-white p-2 rounded w-full" name="submit">Kirim Laporan</button>
        </form>
    </div>
</body>
</html>
