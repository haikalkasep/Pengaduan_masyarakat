<?php
session_start();
// cek session
if(!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}
if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin" && $_SESSION["role"] !== "petugas"){
    header("location: login_admin.php");
}
require_once '../function/logic.php';
// ambil data laporan valid
$id = $_SESSION["id"];
$valid = tampil("SELECT * FROM pengaduan WHERE status = 'valid'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan valid</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-green-200 font-sans">
    <div class="p-6 flex items-center">
        <a href="index_admin.php" class="text-black text-3xl">
            <svg xmlns="http://www.w3.org/2000/svg" class="inline h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </a>
    </div>
    <div class="flex flex-col items-center">
        <div class="w-12 h-12 bg-green-500 rounded-full mb-2"></div>
        <h1 class="text-3xl font-bold text-black mb-6">Laporan valid</h1>
        <div class="bg-white rounded-2xl shadow-md w-full max-w-4xl p-8">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-300 rounded-t-lg">
                        <th class="py-3 px-4 text-left rounded-tl-lg">No</th>
                        <th class="py-3 px-4 text-left">Judul Pengaduan</th>
                        <th class="py-3 px-4 text-left">Detail</th>
                        <th class="py-3 px-4 text-left rounded-tr-lg">Jawab</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    <?php
                    $no = 1;
                    foreach($valid as $row):
                    ?>
                    <tr class="border-b">
                        <td class="py-2 px-4"><?php echo $no++ ?></td>
                        <td class="py-2 px-4"><?php echo $row["judul"] ?></td>
                        <td class="py-2 px-4">
                            <a href="detail_pengaduan.php?id=<?php echo $row['id_pengaduan'] ?>" class="text-blue-500 hover:underline">Lihat Detail</a>
                        <td class="py-2 px-4">
                            <a href="jawab.php?id=<?php echo $row['id_pengaduan']?>" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">jawab</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
