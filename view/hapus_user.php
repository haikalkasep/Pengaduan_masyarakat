<?php
session_start();
require_once '../function/logic.php';
 $masyarakat = intval($_GET['id']);
 
if (hapus_akun_masyarakat($masyarakat) > 0) {
    echo "<script>
            alert('Akun berhasil dihapus');
            document.location.href = 'logout.php';
          </script>";
} else {
    echo "<script>
            alert('Akun gagal dihapus');
            document.location.href = 'index_admin.php';
          </script>";
}

 ?>