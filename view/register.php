<?php 
require_once '../function/logic.php';
if (isset($_POST['submit'])) {
    $nik = $_POST['nik'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $name = $_POST['name'];
    $password = $_POST['password'];
    $telepon = $_POST['telepon'];

    if (register($_POST) > 0) {
        echo "<script>
                alert('berhasil mendaftar');
                document.location.href = 'login.php';
              </script>";
    } else {
        echo "<script>
                alert('gagal mendaftar');
              </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-green-200 flex flex-col items-center justify-center min-h-screen">
    <h1 class="text-4xl font-bold text-center mb-6" style="font-family: 'Comic Sans MS', cursive, sans-serif;">Laporin!</h1>
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold text-center mb-2">Register</h2>
        <p class="text-sm text-center text-gray-600 mb-6">Please enter your Name, Login, and your Password</p>
        <form action="" method="post" class="space-y-4">
            <div>
                <label for="nik" class="block text-sm font-medium">NIK:</label>
                <input type="text" name="nik" id="nik" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>
            <div>
                <label for="nama_lengkap" class="block text-sm font-medium">Full Name:</label>
                <input type="text" name="nama_lengkap" id="nama_lengkap" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>
            <div>
                <label for="name" class="block text-sm font-medium">Username:</label>
                <input type="text" name="name" id="name" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>
            <div>
                <label for="password" class="block text-sm font-medium">Password:</label>
                <input type="password" name="password" id="password" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>
            <div>
                <label for="telepon" class="block text-sm font-medium">Phone:</label>
                <input type="text" name="telepon" id="telepon" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>
            <button name="submit" class="w-full bg-green-500 text-white py-2 rounded-lg hover:bg-green-600 transition">Register</button>
        </form>
        <div class="text-center mt-4">
            <p class="text-sm">Sudah punya akun? <a href="login.php" class="text-blue-500 hover:underline">Login!</a></p>
        </div>
    </div>
</body>
</html>