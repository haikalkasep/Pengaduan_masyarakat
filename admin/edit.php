<?php
session_start();
require_once '../function/logic.php';
$err = '';
$sukses = '';
if(isset($_POST["submit"])){
    if(edit_admin($_POST) > 0){
        $sukses = "Admin berhasil diubah";
    } else {
        $err = "Gagal mengubah admin";
    }
}
$id = $_SESSION["id"];
$data = tampil("SELECT * FROM petugas WHERE id_petugas = '$id'")[0];
if (!$data) {
    $err = "Data admin tidak ditemukan";
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-green-50 min-h-screen flex flex-col items-center justify-center">
    <h2 class="text-2xl font-bold mb-6 text-green-800 text-center">Edit Petugas/Admin</h2>
    <?php if($err): ?>
        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded"><?php echo $err; ?></div>
    <?php endif; ?>
    <?php if($sukses): ?>
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded"><?php echo $sukses; ?></div>
    <?php endif; ?>
    <form method="post" autocomplete="off" action="#" class="w-full max-w-md flex flex-col items-center">
        <input type="hidden" name="password_lama" value="<?php echo htmlspecialchars($data['password']); ?>">
        <input type="hidden" name="id_petugas" value="<?php echo htmlspecialchars($data['id_petugas']); ?>">
        <div class="mb-4 w-full">
            <label class="block mb-1 font-semibold text-green-700">Nama Admin</label>
            <input type="text" name="nama" class="w-full border border-green-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-400" required value="<?php echo htmlspecialchars($data['nama_petugas']); ?>">
        </div>
        <div class="mb-4 w-full">
            <label class="block mb-1 font-semibold text-green-700">Username</label>
            <input type="text" name="username" class="w-full border border-green-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-400" required value="<?php echo htmlspecialchars($data['username']); ?>">
        </div>
        <div class="mb-4 w-full">
            <label class="block mb-1 font-semibold text-green-700">Password</label>
            <input type="password" name="password" class="w-full border border-green-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-400" placeholder="masukan password baru" ?>
        </div>
        <div class="mb-6 w-full">
            <label class="block mb-1 font-semibold text-green-700">Telepon</label>
            <input type="text" name="telp" class="w-full border border-green-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-400" required value="<?php echo htmlspecialchars($data['telp']); ?>">
        </div>
        <div class="flex justify-between w-full">
            <a href="index_admin.php" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded">Kembali</a>
            <button name="submit" type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded font-semibold">edit</button>
        </div>
    </form>
    <div class="flex flex-col items-center mt-10 w-full">
        <div class="mb-2 text-red-700 font-semibold text-center flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 20c4.418 0 8-3.582 8-8s-3.582-8-8-8-8 3.582-8 8 3.582 8 8 8z" />
            </svg>
            <span>Hati-hati! Tindakan ini akan menghapus akun Anda secara permanen.</span>
        </div>
        <a href="hapus_akun.php?id=<?php echo htmlspecialchars($data['id_petugas']); ?>"
           onclick="return confirm('Yakin ingin menghapus akun ini? Tindakan ini tidak dapat dibatalkan.');"
           class="flex items-center gap-2 bg-gradient-to-r from-red-600 to-red-400 hover:from-red-700 hover:to-red-500 text-white px-8 py-3 rounded-full font-bold shadow-xl transition-all duration-200 border-2 border-red-700 hover:scale-105 text-lg">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
            Hapus Akun
        </a>
    </div>
</body>
</html>