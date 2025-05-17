<?php 
session_start();
require_once '../function/logic.php';
// Cek apakah user sudah login
if(!isset($_SESSION["role"]) || ($_SESSION["role"] !== "admin" && $_SESSION["role"] !== "petugas")) {
    header("Location: login_admin.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Validasi Pengaduan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Validasi Pengaduan</h2>
        <?php
        if (!isset($_GET['id'])) {
            echo "<div class='text-red-600 font-semibold mb-4'>ID pengaduan tidak ditemukan.</div>";
            exit;
        }
        $id = $_GET["id"];
        if(isset($_POST["valid"])){
            $query = "UPDATE pengaduan SET status = 'valid' WHERE id_pengaduan = '$id'";
            if (valid($query) > 0) {
                echo "<script>
                        alert('Pengaduan berhasil divalidasi');
                        document.location.href = 'laporan_menunggu.php';
                      </script>";
            } else {
                echo "<script>
                        alert('Pengaduan gagal divalidasi');
                        document.location.href = 'laporan_menunggu.php';
                      </script>";
            }
        } elseif (isset($_POST["tolak"])) {
            $query = "UPDATE pengaduan SET status = '0' WHERE id_pengaduan = '$id'";
            if (tolak($query) > 0) {
                echo "<script>
                        alert('Pengaduan berhasil ditolak');
                        document.location.href = 'laporan_menunggu.php';
                      </script>";
            } else {
                echo "<script>
                        alert('Pengaduan gagal ditolak');
                        document.location.href = 'laporan_menunggu.php';
                      </script>";
            }
        }
        ?>
        <form action="" method="post" class="flex flex-col gap-4">
            <button name="valid" type="submit" class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded transition">Validasi</button>
            <button name="tolak" type="submit" class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded transition">Tolak</button>
        </form>
    </div>
</body>
</html>