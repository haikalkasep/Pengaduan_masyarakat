<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-green-200 font-sans">
    <div id="mainContent">
        <header class="bg-white border-b border-blue-500 flex items-center justify-between px-4 py-2">
            <div class="w-8"></div> <!-- placeholder for left side -->
            <h1 class="font-bold text-3xl text-center flex-grow" style="font-family: 'Comic Sans MS', cursive, sans-serif;">Laporin!</h1>
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

        <div class="container mx-auto mt-8">
            <h2 class="text-center text-2xl font-bold mb-6">Halaman Admin</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <a href="laporan_menunggu.php" class="bg-yellow-400 text-center p-6 rounded-lg shadow-md transition transform hover:scale-105 hover:bg-yellow-300 cursor-pointer block">
                    <p class="text-4xl font-bold">6</p>
                    <p class="text-lg">Laporan Menunggu</p>
                </a>
                <a href="laporan_valid.php" class="bg-green-500 text-center p-6 rounded-lg shadow-md transition transform hover:scale-105 hover:bg-green-400 cursor-pointer block">
                    <p class="text-4xl font-bold">2</p>
                    <p class="text-lg">Laporan Valid</p>
                </a>
                <a href="laporan_ditolak.php" class="bg-red-500 text-center p-6 rounded-lg shadow-md transition transform hover:scale-105 hover:bg-red-400 cursor-pointer block">
                    <p class="text-4xl font-bold">1</p>
                    <p class="text-lg">Laporan Ditolak</p>
                </a>
                <a href="total_laporan.php" class="bg-blue-500 text-center p-6 rounded-lg shadow-md transition transform hover:scale-105 hover:bg-blue-400 cursor-pointer block">
                    <p class="text-4xl font-bold">9</p>
                    <p class="text-lg">Total Laporan</p>
                </a>
                <a href="admin_list.php" class="bg-orange-400 text-center p-6 rounded-lg shadow-md transition transform hover:scale-105 hover:bg-orange-300 cursor-pointer block">
                    <p class="text-4xl font-bold">3</p>
                    <p class="text-lg">Jumlah Admin</p>
                </a>
                <a href="petugas_list.php" class="bg-purple-500 text-center p-6 rounded-lg shadow-md transition transform hover:scale-105 hover:bg-purple-400 cursor-pointer block">
                    <p class="text-4xl font-bold">9</p>
                    <p class="text-lg">Jumlah Petugas</p>
                </a>
                <a href="#" class="bg-indigo-500 text-center p-6 rounded-lg shadow-md transition transform hover:scale-105 hover:bg-indigo-400 cursor-pointer block">
                    <p class="text-4xl font-bold">12</p>
                    <p class="text-lg">Total Admin & Petugas</p>
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
                <a href="login_admin.php" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">YA</a>
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
