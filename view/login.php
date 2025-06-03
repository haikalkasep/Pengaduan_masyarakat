<?php
session_start();
require_once '../function/logic.php';
if(isset($_POST['submit'])){
    $username = $_POST["username"];
    $password = $_POST["password"];
    $result = mysqli_query($conn, "SELECT * FROM masyarakat WHERE username = '$username'");
    // cek nik
    if(mysqli_num_rows(($result)) > 0){
        //cek password
        $row = mysqli_fetch_assoc($result);
        if(password_verify($password, $row["password"])){
            // set session
            $_SESSION["login"] = true;
            $_SESSION["nik"] = $row["nik"];
            $_SESSION["username"] = $row["username"];
            header("Location: index.php");
            exit;
        }
        $error = true;
    }
    $error1 = true;
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-green-200 flex flex-col items-center justify-center min-h-screen">
    <h1 class="text-4xl font-bold text-center mb-6" style="font-family: 'Comic Sans MS', cursive, sans-serif;">Laporin!</h1>
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-xl text-center mb-6">Login</h2>
        <?php if(isset($error)): ?>
        <p class="text-red-500 text-center mb-4">Password salah</p>
        <?php elseif(isset($error1)): ?>
        <p class="text-red-500 text-center mb-4">user tidak terdaftar</p>
        <?php endif; ?>
        <form action="" method="post" class="space-y-4">
            <div>
                <label for="username" class="block text-sm font-medium">Username:</label>
                <input type="text" name="username" id="username" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>
            <div>
                <label for="password" class="block text-sm font-medium">Password:</label>
                <input type="password" name="password" id="password" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>
            <button name="submit" class="w-full bg-green-500 text-white py-2 rounded-lg hover:bg-green-600 transition">Login</button>
        </form>
        <div class="text-center mt-4">
            <a href="../admin/login_admin.php" class="text-sm text-blue-500 hover:underline">Login sebagai admin</a>
        </div>
        <div class="text-center mt-4">
            <p class="text-sm">Belum punya akun? <a href="register.php" class="text-blue-500 hover:underline">Daftar disini</a></p>
        </div>
    </div>
</body>
</html>