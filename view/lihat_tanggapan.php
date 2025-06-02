<?php
session_start();
require_once '../function/logic.php';
// Cek apakah user sudah login
if (!isset($_SESSION["nik"])) {
    header("Location: login.php");
    exit;
}
$nik = $_SESSION["nik"];
// tampilkan data pengaduan berdasarkan nik
$data = tampil("SELECT * FROM pengaduan WHERE nik = '$nik' and status = 'selesai' ORDER BY id_pengaduan DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tanggapan Laporan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-green-200 min-h-screen flex items-center justify-center">
                <div class="absolute top-6 left-6">
        <a href="index.php" class="inline-block bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded">
            &larr; Kembali
        </a>
    </div>
    <div class="bg-white rounded-xl shadow-lg p-8 w-full max-w-2xl">
        <h2 class="text-2xl font-bold text-center mb-6">Tanggapan</h2>
        <table class="w-full text-center border-separate border-spacing-y-2">
            <thead>
                <tr class="bg-gray-100">
                    <th class="py-2 px-4 rounded-tl-lg">No</th>
                    <th class="py-2 px-4">Judul Pengaduan</th>
                    <th class="py-2 px-4 rounded-tr-lg">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                 foreach ($data as $ikan): ?>
                <tr class="border-b">
                    <td class="py-2 px-4"><?= $i++ ?></td>
                    <td class="py-2 px-4"><?= htmlspecialchars($ikan['judul']) ?></td>
                    <td class="py-2 px-4">
                        <?php if ($ikan['status'] == 'selesai'): ?>
                           <a href="hasil_tanggapan.php?id_pengaduan=<?php echo $ikan["id_pengaduan"] ?>"><span class="bg-grey-400 text-gray-700 px-3 py-1 rounded-full text-sm font-semibold">cek tanggapan</span></a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>