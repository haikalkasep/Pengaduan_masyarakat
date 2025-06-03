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
    <title>edit profile</title>
</head>
<body>
    <form action="" method="post">
        <label for="nik">nik</label>
        <input type="number" name="nik" id="nik" value="<?= $data['nik'] ?? 'nik tidak ditemukan' ?>"><br>
        <label for="username">username</label>
        <input type="username" name="username" id="username" value="<?= $data['username'] ?? 'username tidak ditemukan' ?>"><br>
                <label for="password">password</label>
        <input type="password" name="password" id="password" placeholder="masukan password baru"><br>
        <label for="nama_lengkap">nama lengkap</label>
        <input type="text" name="nama_lengkap" id="nama_lengkap" value="<?= $data['nama'] ?? 'nama lengkap tidak ditemukan' ?>"><br>
        <label for="telepon">telepon</label>
        <input type="number" name="telepon" id="telepon" value="<?= $data['telp'] ?? 'nomor telepon tidak ditemukan' ?>"><br>
        <button type="submit" name="submit">Simpan</button>
    </form>
</body>
</html>