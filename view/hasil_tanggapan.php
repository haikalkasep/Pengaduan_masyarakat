<?php 
session_start();
require_once '../function/logic.php';
$id = $_GET['id_pengaduan'] = isset($_GET['id_pengaduan']) ? $_GET['id_pengaduan'] : null;
$data = tampil("SELECT * FROM pengaduan WHERE id_pengaduan = $id")[0];
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
                                else echo 'bg-gray-200 text-gray-800';
                            ?>">
                            <?php echo $data['status']; ?>
                        </span>
                    </td>
                </tr>
                <tr>
                    <th class="text-left px-6 py-4 bg-green-50">Foto</th>
                    <td class="px-6 py-4">
                        <?php if ($data["foto"] == "default.jpg"): ?>
                            <span class="text-gray-500 italic">tidak ada foto</span>
                        <?php else: ?>
                            <img src="../assets/img/<?php echo $data['foto']; ?>" class="w-72 rounded shadow cursor-zoom-in transition-transform hover:scale-105" alt="Foto Pengaduan" id="fotoPengaduan">
                            <!-- Modal Zoom -->
                            <div id="modalZoom" class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50 hidden">
                                <span class="absolute top-6 right-8 text-white text-3xl cursor-pointer font-bold" id="closeModal">&times;</span>
                                <img src="../assets/img/<?php echo $data['foto']; ?>" class="max-w-full max-h-[80vh] rounded-lg shadow-2xl border-4 border-white" alt="Zoom Foto">
                            </div>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php
                // Ambil tanggapan dari database
                $tanggapan = tampil("SELECT * FROM tanggapan WHERE id_pengaduan = $id");
                ?>
                <tr class="border-b">
                    <th class="text-left px-6 py-4 bg-green-50">Tanggapan</th>
                    <td class="px-6 py-4">
                        <?php if (!empty($tanggapan)): ?>
                            <?php foreach ($tanggapan as $t): ?>
                                <div class="mb-2">
                                    <span class="block text-gray-700"><?php echo htmlspecialchars($t['tanggapan']); ?></span>
                                    <span class="text-xs text-gray-400">Oleh: <?php echo htmlspecialchars($t['nama_petugas'] ?? 'Petugas'); ?>, <?php echo htmlspecialchars($t['tgl_tanggapan']); ?></span>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <span class="text-gray-500 italic">Belum ada tanggapan</span>
                        <?php endif; ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
   <a href="lihat_tanggapan.php"><button class="mt-6 px-6 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">Kembali</button></a>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var img = document.getElementById('fotoPengaduan');
    var modal = document.getElementById('modalZoom');
    var closeBtn = document.getElementById('closeModal');
    if(img && modal && closeBtn) {
        img.onclick = function() {
            modal.classList.remove('hidden');
        };
        closeBtn.onclick = function() {
            modal.classList.add('hidden');
        };
        modal.onclick = function(e) {
            if (e.target === modal) {
                modal.classList.add('hidden');
            }
        };
    }
});
</script>
</body>
</html>