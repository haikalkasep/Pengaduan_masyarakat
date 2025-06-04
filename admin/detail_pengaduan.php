<?php
session_start();
require_once '../function/logic.php';

if (!isset($_SESSION["role"]) || ($_SESSION["role"] !== "admin" && $_SESSION["role"] !== "petugas")) {
    header("Location: login_admin.php");
    exit;
}

$id = intval($_GET['id']);
$tanggapanArr = tampil("SELECT * FROM tanggapan WHERE id_pengaduan = '$id'");
$dataArr = tampil("SELECT * FROM pengaduan WHERE id_pengaduan = '$id'");

if (!$dataArr) {
    // Data pengaduan tidak ditemukan
    echo "<h2 class='text-center text-red-600 mt-10'>Data pengaduan tidak ditemukan.</h2>";
    exit;
}

$data = $dataArr[0];
$tanggapan = $tanggapanArr ? $tanggapanArr[0] : null;

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
    <div class="bg-white shadow-md rounded-lg overflow-hidden relative">
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
                    <?php if($data["status"] !== "selesai" ): ?>
                    <td class="px-6 py-4">belum ada tanggapan</td>
                    <?php elseif($data["status"] == "selesai" ): ?>
                    <td class="px-6 py-4"><?php echo $tanggapan['tanggapan'] ?? "Tidak ada Tanggapan"; ?></td>
                    <?php endif; ?>
                </tr>
                <tr>
                    <th class="text-left px-6 py-4 bg-green-50">Foto</th>
                    <td class="px-6 py-4">
                        <?php if ($data["foto"] == "default.jpg"): ?>
                            <span class="text-gray-500 italic">tidak ada foto</span>
                        <?php else: ?>
                            <img src="../assets/img/<?php echo $data['foto']; ?>" class="w-72 rounded shadow cursor-pointer transition hover:scale-105" alt="Foto Pengaduan" id="fotoPengaduan">
                            <!-- Modal -->
                            <div id="modalFoto" class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50 hidden">
                                <span class="absolute top-4 right-8 text-white text-4xl font-bold cursor-pointer select-none" id="closeModal">&times;</span>
                                <img src="../assets/img/<?php echo $data['foto']; ?>" class="max-h-[80vh] max-w-[90vw] rounded-lg shadow-2xl border-4 border-white" alt="Foto Besar">
                            </div>
                        <?php endif; ?>
                    </td>
                </tr>
            </tbody>
        </table>
        <!-- Button Cetak Laporan dipindahkan ke bawah -->
    </div>
     <div class="mt-6 flex justify-end gap-4">
    <?php if($data["status"] == 'selesai'): ?>
        <a href="cetak_detail.php?id=<?php echo $id ?>"><button class="px-5 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition shadow">
            Cetak Laporan
        </button></a>
    <?php endif; ?>
    <button class="px-6 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition" onclick="window.history.back();">Kembali</button>
    </div>
</div>
<script>
    const foto = document.getElementById('fotoPengaduan');
    const modal = document.getElementById('modalFoto');
    const closeModal = document.getElementById('closeModal');
    if(foto && modal && closeModal) {
        foto.onclick = () => modal.classList.remove('hidden');
        closeModal.onclick = () => modal.classList.add('hidden');
        modal.onclick = (e) => { if(e.target === modal) modal.classList.add('hidden'); }
    }
</script>
</body>
</html>