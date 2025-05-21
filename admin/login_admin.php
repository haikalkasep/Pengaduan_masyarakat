<?php
session_start();
require_once '../function/logic.php';
if(isset($_POST["submit"])){
    $nama  = $_POST["nama"];
    $password = $_POST["password"];
    $result = mysqli_query($conn, "SELECT * FROM petugas WHERE username = '$nama'");
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        if($password == $row["password"]){
            // set session
            $_SESSION["role"] = $row["level"];
            $_SESSION["login"] = true;
            $_SESSION["id"] = $row["id_petugas"];
            header("Location: index_admin.php");
            exit;
        }
        $error = true;
    } $error1 = true;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-green-200 flex flex-col items-center justify-center min-h-screen">
    <h1 class="text-4xl font-bold text-center mb-6">Admin & Petugas Login</h1>
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold text-center mb-2">Login</h2>
        <p class="text-sm text-center text-gray-600 mb-6">Please enter your Username and Password</p>
        <?php if(isset($error)): ?>
        <p class="text-red-500 text-center mb-4">Invalid password</p>
        <?php elseif(isset($error1)): ?>
        <p class="text-red-500 text-center mb-4">Username not registered</p>
        <?php endif; ?>
        <form action="" method="post" class="space-y-4">
            <div>
                <label for="nama" class="block text-sm font-medium">Username:</label>
                <input type="text" name="nama" id="nama" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>
            <div>
                <label for="password" class="block text-sm font-medium">Password:</label>
                <input type="password" name="password" id="password" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>
            <button type="submit" name="submit" class="w-full bg-green-500 text-white py-2 rounded-lg hover:bg-green-600 transition">Login</button>
        </form>
    </div>
</body>
</html>