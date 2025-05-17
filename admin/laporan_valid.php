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
$valid = tampil("SELECT * FROM pengaduan WHERE status = 'valid'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Sukses</h1>
</body>
</html>