<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Menunggu</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-green-300 min-h-screen">
    <div class="p-6 flex items-center">
        <a href="javascript:history.back()" class="text-black text-3xl">
            <svg xmlns="http://www.w3.org/2000/svg" class="inline h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </a>
    </div>
    <div class="flex flex-col items-center">
        <div class="w-12 h-12 bg-yellow-300 rounded-full mb-2"></div>
        <h1 class="text-3xl font-bold text-black mb-6">Laporan Menunggu</h1>
        <div class="bg-white rounded-2xl shadow-md w-full max-w-4xl p-8">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-300 rounded-t-lg">
                        <th class="py-3 px-4 text-left rounded-tl-lg">ID Pengaduan</th>
                        <th class="py-3 px-4 text-left">Judul Pengaduan</th>
                        <th class="py-3 px-4 text-left rounded-tr-lg">Validasi</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    <tr class="border-b">
                        <td class="py-2 px-4">P001</td>
                        <td class="py-2 px-4">Laporan Jalanan Rusak</td>
                        <td class="py-2 px-4">
                            <div class="bg-yellow-300 rounded-full h-6 w-28"></div>
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="py-2 px-4">P002</td>
                        <td class="py-2 px-4">Geng motor</td>
                        <td class="py-2 px-4">
                            <div class="bg-yellow-300 rounded-full h-6 w-28"></div>
                        </td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4">P003</td>
                        <td class="py-2 px-4">Air keruh</td>
                        <td class="py-2 px-4">
                            <div class="bg-yellow-300 rounded-full h-6 w-28"></div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
