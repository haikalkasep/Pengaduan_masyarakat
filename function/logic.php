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
    $result = mysqli_query($conn, "SELECT*FROM masyarakat WHERE username = '$name'");
    if (mysqli_fetch_assoc($result)) {
        echo "<script>
                alert('username sudah terdaftar');
              </script>";
        return false;
    }
    $res8olt = mysqli_query($conn, "SELECT*FROM masyarakat WHERE nik = '$nik'");
    if (mysqli_fetch_assoc($res8olt)) {
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
function tambah_admin($data) {
    global $conn;
    $username = htmlspecialchars($data['username']);
    $password = htmlspecialchars($data['password']);
    $nama_admin = htmlspecialchars($data['nama']);
    $telepon = htmlspecialchars($data['telp']);


    // masukkan data ke database
    mysqli_query($conn, "INSERT INTO petugas VALUES('', '$nama_admin', '$username', '$password','$telepon','admin')");

    return mysqli_affected_rows($conn);
}
function edit_admin($data) {
    global $conn;
    $id_petugas = htmlspecialchars($data['id_petugas']);
    $nama = htmlspecialchars($data['nama']);
    $username = htmlspecialchars($data['username']);
    $password = htmlspecialchars($data['password']);
    $telp = htmlspecialchars($data['telp']);
    $password_lama = htmlspecialchars($data['password_lama']);
    // jika password tidak diubah, gunakan password lama
    if ($password == '') {
        $password = $password_lama;
    }

    // update data admin
    mysqli_query($conn, "UPDATE petugas SET nama_petugas = '$nama', username = '$username', password = '$password', telp = '$telp' WHERE id_petugas = '$id_petugas'");

    return mysqli_affected_rows($conn);
}
function tambah_petugas($data) {
    global $conn;
    $username = htmlspecialchars($data['username']);
    $password = htmlspecialchars($data['password']);
    $nama_admin = htmlspecialchars($data['nama']);
    $telepon = htmlspecialchars($data['telp']);


    // masukkan data ke database
    mysqli_query($conn, "INSERT INTO petugas VALUES('', '$nama_admin', '$username', '$password','$telepon','petugas')");

    return mysqli_affected_rows($conn);
}
function hapus_akun_petugas($id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM tanggapan WHERE id_petugas = '$id'");
    mysqli_query($conn, "DELETE FROM petugas WHERE id_petugas = '$id'");
    return mysqli_affected_rows($conn);
}
function hapus_akun_masyarakat($nik) {
    global $conn;
    mysqli_query($conn, "DELETE FROM pengaduan WHERE nik = '$nik'");
    mysqli_query($conn, "DELETE FROM masyarakat WHERE nik = '$nik'");
    return mysqli_affected_rows($conn);
}
function editProfile_masyarakat($data) {
    global $conn;
    $nik = htmlspecialchars($data['nik']);
    $username = htmlspecialchars($data['username']);
    $password = htmlspecialchars($data['password']);
    $nama_lengkap = htmlspecialchars($data['nama_lengkap']);
    $telepon = htmlspecialchars($data['telepon']);

    // jika password tidak diubah, gunakan password lama
    if ($password == '') {
        $password = tampil("SELECT password FROM masyarakat WHERE nik = '$nik'")[0]['password'];
    } else {
        // enkripsi password
        $password = password_hash($password, PASSWORD_DEFAULT);
    }

    // update data masyarakat
    mysqli_query($conn, "UPDATE masyarakat SET username = '$username', password = '$password', nama = '$nama_lengkap', telp = '$telepon' WHERE nik = '$nik'");

    return mysqli_affected_rows($conn);
}
?>