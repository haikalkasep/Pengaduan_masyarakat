<?php
session_start();
require_once '../function/logic.php';
// Cek apakah user sudah login sebagai admin atau petugas
if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin" && $_SESSION["role"] !== "petugas") {
    header("Location: login_admin.php");
    exit;
}
// Cek apakah user sudah login
if (!isset($_SESSION["login"]) || $_SESSION["login"] !== true) {
    header("Location: login_admin.php");
    exit;
}
// Data untuk dashboard
$laporanMenunggu = count(tampil("SELECT * FROM pengaduan WHERE status ='proses' " ));
$laporanValid = count(tampil("SELECT * FROM pengaduan WHERE status ='valid' ")); 
$laporanDitolak = count(tampil("SELECT * FROM pengaduan WHERE status = '0'")); 
$laporanSelesai = count(tampil("SELECT * FROM pengaduan WHERE status = 'selesai'"));
$totalLaporan = $laporanMenunggu + $laporanValid + $laporanDitolak + $laporanSelesai; 
$jumlahAdmin = count(tampil("SELECT * FROM petugas WHERE level = 'admin'")); 
$jumlahPetugas = count(tampil("SELECT * FROM petugas WHERE level = 'petugas'")); 
$jumlahAdminPetugas = $jumlahAdmin + $jumlahPetugas; 
// Ambil username petugas yang sedang login
$id = $_SESSION['id'];
$username = tampil("SELECT username FROM petugas WHERE id_petugas = $id")[0];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-green-200 font-sans">
    <?php if(isset($_GET["pesan"]) && $_GET["pesan"] == "akses_ditolak"): ?>
    <div class="fixed top-6 left-1/2 transform -translate-x-1/2 z-50 max-w-lg bg-red-100 border border-red-400 text-red-700 px-6 py-4 rounded-lg shadow text-center flex items-center gap-3">
        <svg class="w-7 h-7 text-red-500 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9z" />
        </svg>
        <span class="font-semibold text-lg">Akses ditolak!</span>
        <span class="ml-2">Silakan login sebagai <b>admin</b> untuk mengakses halaman ini.</span>
    </div>
    <?php endif; ?>
    <div id="mainContent">
        <header class="bg-white border-b border-blue-500 flex items-center justify-between px-4 py-2">
            <div class="w-8"></div> <!-- placeholder for left side -->
            <h1 class="font-bold text-3xl flex-grow" style="font-family: 'Comic Sans MS', cursive, sans-serif;">Laporin!</h1>
            <div class="flex items-center gap-4">
                <!-- Profile Info -->
                 <a href="edit.php">
                <div class="flex items-center bg-green-100 px-3 py-1 rounded-lg shadow text-green-800">
                    <svg class="w-6 h-6 mr-2 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <div>
                        <div class="font-semibold leading-tight"><?php echo $username["username"]; ?></div>
                        <div class="text-xs text-gray-500 capitalize leading-tight"><?php echo htmlspecialchars($_SESSION['role'] ?? ''); ?></div>
                    </div>
                </div></a>
                <!-- Dropdown -->
                <div class="relative inline-block text-left">
                    <button id="dropdownButton" type="button" class="inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none" aria-expanded="true" aria-haspopup="true">
                        Menu
                        <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.27a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div id="dropdownMenu" class="origin-top-right absolute right-0 mt-2 w-40 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden" role="menu" aria-orientation="vertical" aria-labelledby="dropdownButton" tabindex="-1">
                        <div class="py-1" role="none">
                            <!-- Hapus link profile di dropdown -->
                            <button id="logoutButton" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100 w-full text-left" role="menuitem" tabindex="-1">Logout</button>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="container mx-auto mt-8">
            <h2 class="text-center text-2xl font-bold mb-6"> Selamat Datang Di Halaman Admin</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <a href="laporan_menunggu.php" class="bg-yellow-400 text-center p-6 rounded-lg shadow-md transition transform hover:scale-105 hover:bg-yellow-300 cursor-pointer block">
                    <p class="text-4xl font-bold"><?php echo $laporanMenunggu ?></p>
                    <p class="text-lg">Laporan Menunggu</p>
                </a>
                <a href="laporan_valid.php" class="bg-green-500 text-center p-6 rounded-lg shadow-md transition transform hover:scale-105 hover:bg-green-400 cursor-pointer block">
                    <p class="text-4xl font-bold"><?php echo $laporanValid ?></p>
                    <p class="text-lg">Laporan Valid</p>
                </a>
                <a href="laporan_ditolak.php" class="bg-red-500 text-center p-6 rounded-lg shadow-md transition transform hover:scale-105 hover:bg-red-400 cursor-pointer block">
                    <p class="text-4xl font-bold"><?php echo $laporanDitolak ?></p>
                    <p class="text-lg">Laporan Ditolak</p>
                </a>
                <a href="laporan_selesai.php" class="bg-blue-500 text-center p-6 rounded-lg shadow-md transition transform hover:scale-105 hover:bg-blue-500 cursor-pointer block">
                    <p class="text-4xl font-bold"><?php echo $laporanSelesai ?></p>
                    <p class="text-lg">Laporan Selesai</p>
                </a>
                <a href="total_laporan.php" class="bg-white text-center p-6 rounded-lg shadow-md transition transform hover:scale-105 hover:bg-white cursor-pointer block">
                    <p class="text-4xl font-bold"><?php echo $totalLaporan ?></p>
                    <p class="text-lg">Total Laporan</p>
                </a>
                <a href="jumlah_admin.php" class="bg-orange-400 text-center p-6 rounded-lg shadow-md transition transform hover:scale-105 hover:bg-orange-300 cursor-pointer block">
                    <p class="text-4xl font-bold"><?php echo $jumlahAdmin ?></p>
                    <p class="text-lg">Jumlah Admin</p>
                </a>
                <a href="petugas_list.php" class="bg-purple-500 text-center p-6 rounded-lg shadow-md transition transform hover:scale-105 hover:bg-purple-400 cursor-pointer block">
                    <p class="text-4xl font-bold"><?php echo $jumlahPetugas ?></p>
                    <p class="text-lg">Jumlah Petugas</p>
                </a>
            </div>
        </div>
    </div>
    <div id="logoutDialog" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white rounded-lg p-6 w-80 text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7" />
            </svg>
            <p class="text-lg font-semibold mb-4">Apakah anda yakin ingin Logout?</p>
            <div class="flex justify-center gap-4">
                <a href="logout.php" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">YA</a>
                <button id="cancelLogout" class="bg-gray-300 px-4 py-2 rounded-lg hover:bg-gray-400">TIDAK</button>
            </div>
        </div>
    </div>
    <script>
        // Dropdown logic
        const dropdownButton = document.getElementById('dropdownButton');
        const dropdownMenu = document.getElementById('dropdownMenu');
        dropdownButton.addEventListener('click', function() {
            dropdownMenu.classList.toggle('hidden');
        });
        document.addEventListener('click', function(e) {
            if (!dropdownButton.contains(e.target) && !dropdownMenu.contains(e.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });

        // Logout dialog logic
        const logoutButton = document.getElementById('logoutButton');
        const logoutDialog = document.getElementById('logoutDialog');
        const cancelLogout = document.getElementById('cancelLogout');
        logoutButton.addEventListener('click', function() {
            dropdownMenu.classList.add('hidden');
            logoutDialog.classList.remove('hidden');
        });
        cancelLogout.addEventListener('click', function() {
            logoutDialog.classList.add('hidden');
        });
    </script>
</body>
</html>
