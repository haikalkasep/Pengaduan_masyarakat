<?php 
$server = "localhost";
$username = "root";
$password = "";
$database = "pp_masyarakat";
$conn = mysqli_connect($server, $username, $password, $database);

function register($data) {
    global $conn;
    $nik = htmlspecialchars($data['nik']);
    $nama_lengkap = htmlspecialchars($data['nama_lengkap']);
    $name = htmlspecialchars($data['name']);
    $password = htmlspecialchars($data['password']);
    $telepon = htmlspecialchars($data['telepon']);

    // cek nik sudah ada
    $result = mysqli_query($conn, "SELECT nik FROM masyarakat WHERE nik = '$nik'");
    if (mysqli_fetch_assoc($result)) {
        echo "<script>
                alert('nik sudah terdaftar');
              </script>";
        return false;
    }

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // masukkan data ke database
    mysqli_query($conn, "INSERT INTO masyarakat VALUES ('$nik', '$nama_lengkap', '$name', '$password', '$telepon')");

    return mysqli_affected_rows($conn);
}
function tambahPengaduan($nik) {
    global $conn;
    $nik = $nik['nik'];

    // Cek apakah nik ada di tabel masyarakat
    $result = mysqli_query($conn, "SELECT nik FROM masyarakat WHERE nik = '$nik'");
    if (mysqli_num_rows($result) == 0) {
        echo "<script>
                alert('Nik tidak ditemukan di database. Silakan login ulang.');
              </script>";
        return false;
    }

    $judul = htmlspecialchars($_POST['judul']);
    $tgl_pengaduan = htmlspecialchars($_POST['tgl_pengaduan']);
    $isi_laporan = htmlspecialchars($_POST['isi_laporan']);
    $foto = upload();
    if (!$foto) {
        return false;
    }

    // masukkan data ke database dengan penanganan error
    $query = "INSERT INTO pengaduan VALUES ('','$judul','$tgl_pengaduan','$nik','$isi_laporan','$foto','0')";
mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
function upload() {
    $namaFile = $_FILES['foto']['name'];
    $ukuranFile = $_FILES['foto']['size'];
    $error = $_FILES['foto']['error'];
    $tmpName = $_FILES['foto']['tmp_name'];
    // cek apakah tidak ada foto yang diupload
    if ($error === 4) {
        echo "<script>
                alert('pilih foto terlebih dahulu');
              </script>";
        return false;
    }
    // cek apakah yang diupload adalah foto
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
                alert('yang anda upload bukan foto');
              </script>";
        return false;
    }
    // cek jika ukuran terlalu besar
    if ($ukuranFile > 1000000) {
        echo "<script>
                alert('ukuran foto terlalu besar');
              </script>";
        return false;
    }
    // lolos pengecekan, foto siap diupload
    // generate nama foto baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.' . $ekstensiGambar;
    move_uploaded_file($tmpName, '../assets/img/' . $namaFileBaru);
    return $namaFileBaru;
}
?>