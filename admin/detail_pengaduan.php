<?php
session_start();
require_once '../function/logic.php';

if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin" && $_SESSION["role"] !== "petugas") {
    header("Location: login_admin.php");
    exit;
}

$id = intval($_GET['id']);
$tanggapan = tampil("SELECT * FROM tanggapan WHERE id_pengaduan = '$id'");
$data = tampil("SELECT * FROM pengaduan WHERE id_pengaduan = '$id'")[0];

?>
<!DOCTYPE html>
<html>
<head>
    <title>Detail Pengaduan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-green-100 min-h-screen flex flex-col">
<div class="container mx-auto mt-10 max-w-2xl">
    <h2 class="text-2xl font-bold mb-6 text-green-800">Detail Pengaduan</h2>
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full">
            <tbody>
                <tr class="border-b">
                    <th class="text-left px-6 py-4 bg-green-50 w-1/3">Judul</th>
                    <td class="px-6 py-4"><?php echo $data['judul']; ?></td>
                </tr>
                <tr class="border-b">
                    <th class="text-left px-6 py-4 bg-green-50">Isi Laporan</th>
                    <td class="px-6 py-4"><?php echo $data['isi_laporan']; ?></td>
                </tr>
                <tr class="border-b">
                    <th class="text-left px-6 py-4 bg-green-50">Tanggal</th>
                    <td class="px-6 py-4"><?php echo $data['tgl_kejadian']; ?></td>
                </tr>
                <tr class="border-b">
                    <th class="text-left px-6 py-4 bg-green-50">Status</th>
                    <td class="px-6 py-4">
                        <span class="inline-block px-3 py-1 rounded-full text-sm
                            <?php
                                if ($data['status'] == 'proses') echo 'bg-yellow-200 text-yellow-800';
                                elseif ($data['status'] == 'selesai') echo 'bg-green-200 text-green-800';
                                elseif ($data['status'] == 'valid') echo 'bg-green-400 text-white';
                                elseif ($data['status'] == '0') echo 'bg-red-200 text-red-800';
                                else echo 'bg-gray-200 text-gray-800';
                            ?>">
                            <?php
                                if ($data['status'] == '0') {
                                    echo 'ditolak';
                                } else {
                                    echo $data['status'];
                                }
                            ?>
                        </span>
                    </td>
                </tr>
                                <tr class="border-b">
                    <th class="text-left px-6 py-4 bg-green-50">Tanggapan</th>
                    <td class="px-6 py-4"><?php echo $tanggapan['tanggapan']; ?></td>
                </tr>
                <tr>
                    <th class="text-left px-6 py-4 bg-green-50">Foto</th>
                    <td class="px-6 py-4">
                        <?php if ($data["foto"] == "default.jpg"): ?>
                            <span class="text-gray-500 italic">tidak ada foto</span>
                        <?php else: ?>
                            <img src="../assets/img/<?php echo $data['foto']; ?>" class="w-72 rounded shadow" alt="Foto Pengaduan">
                        <?php endif; ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <button class="mt-6 px-6 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition" onclick="window.history.back();">Kembali</button>
</div>
</body>
</html>