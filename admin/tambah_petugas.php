<?php
session_start();
require_once '../function/logic.php';
$err = '';
$sukses = '';
if(isset($_POST["submit"])){
    if(tambah_petugas($_POST) > 0){
        $sukses = "petugas berhasil ditambahkan";
    } else {
        $err = "Gagal menambahkan petugas";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah petugas</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-green-50 min-h-screen flex items-center justify-center">
    <div class="bg-white rounded-xl shadow-lg p-8 w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-green-800 text-center">Tambah petugas</h2>
        <?php if($err): ?>
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded"><?php echo $err; ?></div>
        <?php endif; ?>
        <?php if($sukses): ?>
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded"><?php echo $sukses; ?></div>
        <?php endif; ?>
        <form method="post" action="">
            <div class="mb-4">
                <label class="block mb-1 font-semibold text-green-700">Nama petugas</label>
                <input type="text" name="nama" class="w-full border border-green-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-400" required>
            </div>
            <div class="mb-4">
                <label class="block mb-1 font-semibold text-green-700">Username</label>
                <input type="text" name="username" class="w-full border border-green-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-400" required>
            </div>
            <div class="mb-4">
                <label class="block mb-1 font-semibold text-green-700">Password</label>
                <input type="password" name="password" class="w-full border border-green-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-400" required>
            </div>
            <div class="mb-6">
                <label class="block mb-1 font-semibold text-green-700">Telepon</label>
                <input type="text" name="telp" class="w-full border border-green-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-400" required>
            </div>
            <div class="flex justify-between">
                <a href="petugas_list.php" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded">Kembali</a>
                <button name="submit" type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded font-semibold">Tambah</button>
            </div>
        </form>
    </div>
</body>
</html>
