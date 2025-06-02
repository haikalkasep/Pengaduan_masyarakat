<?php
session_start();
require_once '../function/logic.php';

if (!isset($_SESSION["role"]) || $_SESSION["role"] != "petugas" and $_SESSION["role"] != "admin") {
    header("Location: login_admin.php");
    exit;
}

$admins = tampil("SELECT * FROM petugas WHERE level = 'petugas'");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Petugas</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-green-50 min-h-screen flex flex-col">
    <div class="container mx-auto mt-10 max-w-3xl">
        <h2 class="text-2xl font-bold mb-6 text-green-800">Daftar Petugas</h2>
        <div class="mb-4 flex justify-end">
            <a href="tambah_petugas.php" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded shadow transition">
                + Tambah Petugas
            </a>
        </div>
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full">
                <thead>
                    <tr class="bg-green-100">
                        <th class="px-6 py-3 text-left font-semibold text-green-800">No</th>
                        <th class="px-6 py-3 text-left font-semibold text-green-800">Nama Petugas</th>
                        <th class="px-6 py-3 text-left font-semibold text-green-800">Username</th>
                        <th class="px-6 py-3 text-left font-semibold text-green-800">Telepon</th>
                        <?php
                        if($_SESSION['role'] == 'admin'):?>
                        <th class="px-6 py-3 text-left font-semibold text-green-800">Aksi</th>
                        <?php else: ?>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($admins): ?>
                        <?php foreach ($admins as $i => $admin):
                            if($_SESSION["id"] == $admin['id_petugas']) {
                                continue; // Skip the logged-in admin
                            }
                             ?>
                        <tr class="<?php echo $i % 2 == 0 ? 'bg-green-50' : ''; ?>">
                            <td class="px-6 py-4"><?php echo $i + 1; ?></td>
                            <td class="px-6 py-4"><?php echo htmlspecialchars($admin['nama_petugas']); ?></td>
                            <td class="px-6 py-4"><?php echo htmlspecialchars($admin['username']); ?></td>
                            <td class="px-6 py-4"><?php echo htmlspecialchars($admin['telp']); ?></td>
                            <?php if($_SESSION['role'] == 'admin'): ?>
                            <td class="px-6 py-4">
                                <a href="edit.php?id=<?php echo $admin['id_petugas']; ?>" class="text-blue-600 hover:text-blue-800">Edit</a>
                                <a href="hapus_admin.php?id=<?php echo $admin['id_petugas']; ?>" class="text-red-600 hover:text-red-800 ml-4" onclick="return confirm('Yakin ingin menghapus admin ini?');">Hapus</a>
                            </td>
                            <?php else: ?>
                            <?php endif; ?>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">Tidak ada data pertugas.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <a href="index_admin.php"><button class="mt-6 px-6 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">Kembali</button></a>
    </div>
</body>
</html>
