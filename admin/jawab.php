<?php
session_start();
require_once '../function/logic.php';

if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin" && $_SESSION["role"] !== "petugas") {
    header("Location: login_admin.php");
    exit;
}
$id_pengaduan = intval($_GET['id']);
$id_user = $_SESSION["id"];
if(isset($_POST["kirim"])){
if(tambah_tanggapan($_POST) > 0){
    echo "<script>
            alert('Tanggapan berhasil dikirim');
            document.location.href = 'laporan_valid.php';
          </script>";
} else {
    echo "<script>
            alert('Tanggapan galagal dikirim');
            document.location.href = 'laporan_valid.php';
          </script>";
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jawab Pengaduan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded shadow-md w-full max-w-lg">
        <h1 class="text-2xl font-bold mb-6 text-center text-blue-700">Jawab Pengaduan</h1>
        <form action="" method="post" class="space-y-4">
            <div>
                <label for="tanggapan" class="block mb-2 font-semibold text-gray-700">Tanggapan</label>
                <textarea name="tanggapan" id="tanggapan" required class="w-full p-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400" rows="5"></textarea>
            </div>
            <input type="hidden" name="id_pengaduan" value="<?php echo $id_pengaduan; ?>">
            <input type="hidden" name="id_user" value="<?php echo $id_user; ?>">
            <div class="flex justify-end">
                <button type="submit" name="kirim" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded shadow transition">Kirim</button>
            </div>
        </form>
    </div>
</body>
</html>