<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tentang Project</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Montserrat', sans-serif; }
    </style>
</head>
<body class="bg-gradient-to-br from-green-200 via-green-50 to-green-400 min-h-screen flex justify-center">
    <div class="bg-white/90 backdrop-blur-md rounded-3xl shadow-2xl border border-green-200 p-10 w-full max-w-2xl relative flex flex-col items-center animate-fade-in mt-32 mb-10">
        <!-- My Istri -->
        <div class="relative flex flex-col items-center z-10 mb-6">
            <!-- Glow/Gradient effect -->
            <div class="absolute w-40 h-40 rounded-full bg-gradient-to-tr from-green-300 via-green-100 to-green-400 blur-2xl opacity-70 -z-10"></div>
            <div class="relative group transition-all duration-300">
                <div class="flex items-center justify-center">
                    <img src="../assets/img/Logo_Laporin-removebg-preview.png" alt="logo" class="w-56 h-56 object-contain transition-all duration-300 group-hover:scale-105 drop-shadow-lg bg-transparent border-none rounded-none shadow-none">
                </div>
                <div class="mt-3 text-center">
                    <span class="text-green-700 font-bold text-lg italic drop-shadow-lg tracking-wide bg-white/70 px-4 py-1 rounded-full border border-green-200 shadow">
                        Laporin!
                    </span>
                </div>
            </div>
        </div>
        <div class="w-full">
            <h2 class="text-3xl font-extrabold text-center mb-4 text-green-800 tracking-wide drop-shadow">Tentang Project Pengaduan Masyarakat</h2>
            <p class="mb-6 text-justify text-green-900 leading-relaxed text-lg">
                Project <b>Pengaduan Masyarakat</b> ini dibuat untuk memenuhi tugas Project Based Learning (PJBL). 
                Aplikasi ini bertujuan untuk memudahkan masyarakat dalam menyampaikan laporan atau pengaduan secara online, 
                serta memudahkan petugas dalam menindaklanjuti laporan yang masuk.
            </p>
            <h3 class="text-2xl font-bold mb-3 text-green-700 text-center">Kelompok 4</h3>
            <div class="flex justify-center mb-4">
                <table class="min-w-[300px] border border-green-300 rounded-lg overflow-hidden shadow">
                    <tr class="bg-green-100">
                        <th class="border border-green-200 px-4 py-2 text-left font-semibold text-green-800">Nama Anggota</th>
                    </tr>
                    <tr>
                        <td class="border border-green-100 px-4 py-2">HAIKAL ADELIA PUTRA</td>
                    </tr>
                    <tr class="bg-green-50">
                        <td class="border border-green-100 px-4 py-2">ELSA LESTARI</td>
                    </tr>
                    <tr>
                        <td class="border border-green-100 px-4 py-2">ANGGA PERMANA</td>
                    </tr>
                    <tr class="bg-green-50">
                        <td class="border border-green-100 px-4 py-2">ADI RIANSYAH</td>
                    </tr>
                </table>
            </div>
            <div class="text-center mt-6">
                <a href="index.php" class="inline-block bg-gradient-to-r from-green-500 to-green-700 hover:from-green-600 hover:to-green-800 text-white font-bold py-2 px-6 rounded-full shadow-lg transition-all duration-300 hover:scale-105">
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
    <script>
        // Fade-in animation
        document.querySelector('.animate-fade-in')?.classList.add('opacity-0');
        setTimeout(() => {
            document.querySelector('.animate-fade-in')?.classList.remove('opacity-0');
            document.querySelector('.animate-fade-in')?.classList.add('transition-opacity', 'duration-700', 'opacity-100');
        }, 100);
    </script>
</body>
</html>