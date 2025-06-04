<?php
session_start();
// cek session
if(!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}
$username = tampil("SELECT username FROM masyarakat WHERE nik = '{$_SESSION['nik']}'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Laporin!</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-green-200 min-h-screen flex flex-col">
    <!-- Header -->
    <header class="bg-white border-b border-blue-500 flex items-center justify-between px-4 py-2">
        <div class="w-8"></div> <!-- placeholder for left side -->
        <h1 class="font-bold text-3xl flex-grow" style="font-family: 'Comic Sans MS', cursive, sans-serif;">Laporin!</h1>
        <a href="edit_profile.php" class="flex items-center mr-4">
        <div class="flex items-center mr-4">
            <div class="flex items-center bg-green-100 rounded-xl px-4 py-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A9 9 0 1112 21a9 9 0 01-6.879-3.196z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <div class="flex flex-col items-start">
                    <span class="font-bold text-green-700 text-base">
                        <?php echo $username; ?>
                    </span>
                    <span class="text-gray-600 text-sm">
                        masyarakat
                    </span>
                </div>
            </div>
        </div>
        </a>
        <!-- Navbar Links -->
        <nav class="flex items-center space-x-8 mr-4">
            <a href="faq.php" class="text-gray-700 hover:text-green-700 font-medium transition">FAQ</a>
            <a href="about.php" class="text-gray-700 hover:text-green-700 font-medium transition">About Us</a>
        </nav>
        <div class="relative inline-block text-left">
            <button id="dropdownButton" type="button" class="inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none" aria-expanded="true" aria-haspopup="true">
                Menu
                <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.27a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                </svg>
            </button>
            <div id="dropdownMenu" class="origin-top-right absolute right-0 mt-2 w-28 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden" role="menu" aria-orientation="vertical" aria-labelledby="dropdownButton" tabindex="-1">
                <div class="py-1" role="none">
                    <button id="logoutButton" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100 w-full text-left" role="menuitem" tabindex="-1">Logout</button>
                </div>
            </div>
        </div>
    </header>

    <!-- Logout Confirmation Dialog -->
    <div id="logoutDialog" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
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

    <!-- Main Content -->
    <main class="flex-grow flex flex-col items-center justify-center px-4 py-8 text-center">
        <h2 class="text-2xl font-semibold mb-2">PENGADUAN MASYARAKAT</h2>
        <p class="mb-4">Selamat datang di layanan pengaduan masyarakat</p>
        <p class="text-blue-500 max-w-xl mb-10">
            Laporkan masalah atau keluhan anda mengenai pelayanan atau fasilitas publik dengan mudah melalui layanan ini.
        </p>

        <!-- Cards -->
        <div class="flex flex-col sm:flex-row gap-6 max-w-4xl w-full justify-center">
            <!-- Card 1 -->
            <a href="pengaduan.php" class="flex-1">
                <div class="bg-white rounded-lg p-6 flex flex-col items-center text-center shadow-md h-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 20h9" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 3.5a2.121 2.121 0 113 3L7 19l-4 1 1-4 12.5-12.5z" />
                    </svg>
                    <h3 class="font-bold mb-2">MEMBUAT LAPORAN</h3>
                    <p>Laporkan keluhan anda melalui form pengaduan online</p>
                </div>
            </a>
            <!-- Card 2 -->
            <a href="status_pengaduan_user.php" class="flex-1">
                <div class="bg-white rounded-lg p-6 flex flex-col items-center text-center shadow-md h-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 20h9" />
                    </svg>
                    <h3 class="font-bold mb-2">VERIFIKASI</h3>
                    <p>Laporan yang anda buat akan di verifikasi dan validasi terlebih dahulu</p>
                </div>
            </a>
            <!-- Card 3 -->
            <a href="lihat_tanggapan.php" class="flex-1">
                <div class="bg-white rounded-lg p-6 flex flex-col items-center text-center shadow-md h-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 8h10M7 12h6m-3 8a9 9 0 100-18 9 9 0 000 18z" />
                    </svg>
                    <h3 class="font-bold mb-2">TANGGAPAN</h3>
                    <p>Dapatkan tanggapan dari laporan yang anda buat</p>
                </div>
            </a>
        </div>
    </main>
    <script>
        const dropdownButton = document.getElementById('dropdownButton');
        const dropdownMenu = document.getElementById('dropdownMenu');
        const logoutButton = document.getElementById('logoutButton');
        const logoutDialog = document.getElementById('logoutDialog');
        const cancelLogout = document.getElementById('cancelLogout');

        dropdownButton.addEventListener('click', () => {
            dropdownMenu.classList.toggle('hidden');
        });

        // Show logout confirmation dialog
        logoutButton.addEventListener('click', () => {
            logoutDialog.classList.remove('hidden');
        });

        // Hide logout confirmation dialog
        cancelLogout.addEventListener('click', () => {
            logoutDialog.classList.add('hidden');
        });

        // Close dropdown when clicking outside
        window.addEventListener('click', (e) => {
            if (!dropdownButton.contains(e.target) && !dropdownMenu.contains(e.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });
    </script>
</body>
</html>
