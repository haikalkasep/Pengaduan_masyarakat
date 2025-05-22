<?php 
$server = "localhost";
$username = "root";
$password = "";
$database = "pp";
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
    $tanggal_laporan = date('Y-m-d');
    $tgl_kejadian = htmlspecialchars($_POST['tgl_kejadian']);
    $isi_laporan = htmlspecialchars($_POST['isi_laporan']);
    $foto = upload();


    // masukkan data ke database dengan penanganan error
    $query = "INSERT INTO pengaduan VALUES ('','$judul','$tanggal_laporan','$tgl_kejadian','$nik','$isi_laporan','$foto','proses')";
mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
function upload() {
    $namaFile = $_FILES['foto']['name'];
    $ukuranFile = $_FILES['foto']['size'];
    $error = $_FILES['foto']['error'];
    $tmpName = $_FILES['foto']['tmp_name'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    // generate nama foto baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.' . $ekstensiGambar;
    if(!$namaFile) {
        return 'default.jpg';
    }else{
    move_uploaded_file($tmpName, '../assets/img/' . $namaFileBaru);

    return $namaFileBaru;
    }
}
function tampil($query){
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}
function valid($query) {
    global $conn;
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}
function tolak($query) {
    global $conn;
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}
function tambah_tanggapan($data) {
    global $conn;
    $id_pengaduan = htmlspecialchars($data['id_pengaduan']);
    $tanggapan = htmlspecialchars($data['tanggapan']);
    $tanggal_tanggapan = date('Y-m-d');
    $id_petugas = htmlspecialchars($data['id_user']);

    // masukkan data ke database
    mysqli_query($conn, "INSERT INTO tanggapan VALUES ('', '$id_pengaduan', '$tanggal_tanggapan', '$tanggapan', '$id_petugas')");

    // update status pengaduan
    mysqli_query($conn, "UPDATE pengaduan SET status = 'selesai' WHERE id_pengaduan = '$id_pengaduan'");

    return mysqli_affected_rows($conn);
}
?>