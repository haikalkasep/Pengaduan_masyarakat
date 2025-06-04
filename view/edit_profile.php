<?php 
session_start();
require_once '../function/logic.php';
$nik = $_SESSION["nik"];
$data = tampil("SELECT * FROM masyarakat WHERE nik = '$nik'")[0] ?? 'nik tidak ditemukan';  
if(isset($_POST["submit"])){
    if (editProfile_masyarakat($_POST) > 0) {
        echo "<script>
                alert('berhasil mengubah data');
                document.location.href = 'index.php';
              </script>";
    } else {
        echo "<script>
                alert('gagal mengubah data');
              </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-green-100 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-lg">
        <h1 class="text-3xl font-bold mb-4 text-center text-green-700">Edit Profil</h1>
        <p class="text-gray-600 mb-6 text-center">Perbarui informasi pribadi Anda di bawah ini.</p>
        <form action="" method="post" class="space-y-4">
            <div>
                <input type="hidden" name="nik" id="nik" value="<?= $data['nik'] ?? 'nik tidak ditemukan' ?>" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                <label for="username" class="block text-gray-700 font-semibold">username</label>
                <input type="username" name="username" id="username" value="<?= $data['username'] ?? 'username tidak ditemukan' ?>" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                <label for="password" class="block text-gray-700 font-semibold">password</label>
                <input type="password" name="password" id="password" placeholder="masukan password baru" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                <label for="nama_lengkap" class="block text-gray-700 font-semibold">nama lengkap</label>
                <input type="text" name="nama_lengkap" id="nama_lengkap" value="<?= $data['nama'] ?? 'nama lengkap tidak ditemukan' ?>" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                <label for="telepon" class="block text-gray-700 font-semibold">telepon</label>
                <input type="number" name="telepon" id="telepon" value="<?= $data['telp'] ?? 'nomor telepon tidak ditemukan' ?>" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>
            <div class="flex justify-center gap-4">                
                <a href="index.php" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded flex items-center">Kembali</a>
                <button type="submit" name="submit" class="bg-green-600 text-white px-6 py-2 rounded-md hover:bg-green-700 transition">Edit</button>
                <a href="hapus_user.php?id=<?php echo $data["nik"] ?>" class="bg-red-700 hover:bg-red-400 text-white px-4 py-2 rounded flex items-center">Hapus Akun</a>

            </div>
        </form>
    </div>
</body>
</html>