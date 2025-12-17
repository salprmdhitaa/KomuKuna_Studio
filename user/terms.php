<?php
include '../user/includes/db.php';
include '../user/includes/header.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Terms & Conditions | KomuKuna Studio</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 text-gray-800 pt-28">

<!-- CONTENT -->
<div class="max-w-5xl mx-auto px-6 pb-16">

    <div class="bg-white rounded-xl shadow p-8">

        <h1 class="text-3xl font-bold text-pink-600 mb-6">
            Syarat & Ketentuan
        </h1>

        <p class="mb-4 text-gray-700">
            Dengan menggunakan layanan <strong>KomuKuna Studio</strong>,
            pengguna dianggap telah membaca, memahami, dan menyetujui
            seluruh syarat dan ketentuan berikut.
        </p>

        <!-- SECTION 1 -->
        <h2 class="text-xl font-semibold text-pink-600 mt-6 mb-2">
            1. Ketentuan Umum
        </h2>
        <p class="text-gray-700">
            KomuKuna Studio menyediakan layanan fotografi studio untuk
            keperluan pribadi maupun komersial. Pengguna wajib memberikan
            data yang benar dan lengkap saat melakukan pemesanan.
        </p>

        <!-- SECTION 2 -->
        <h2 class="text-xl font-semibold text-pink-600 mt-6 mb-2">
            2. Akun Pengguna
        </h2>
        <ul class="list-disc pl-6 text-gray-700 space-y-1">
            <li>Pengguna bertanggung jawab atas keamanan akun</li>
            <li>Dilarang menggunakan akun untuk aktivitas ilegal</li>
            <li>Setiap aktivitas yang terjadi melalui akun menjadi tanggung jawab pengguna</li>
        </ul>

        <!-- SECTION 3 -->
        <h2 class="text-xl font-semibold text-pink-600 mt-6 mb-2">
            3. Pemesanan & Pembayaran
        </h2>
        <p class="text-gray-700">
            Pemesanan dianggap sah setelah pembayaran dikonfirmasi oleh pihak
            KomuKuna Studio. Pembatalan sepihak dapat dikenakan ketentuan tambahan.
        </p>

        <!-- SECTION 4 -->
        <h2 class="text-xl font-semibold text-pink-600 mt-6 mb-2">
            4. Privasi & Data
        </h2>
        <p class="text-gray-700">
            Data pengguna dijaga kerahasiaannya dan hanya digunakan untuk
            keperluan layanan KomuKuna Studio.
        </p>

        <!-- SECTION 5 -->
        <h2 class="text-xl font-semibold text-pink-600 mt-6 mb-2">
            5. Perubahan Ketentuan
        </h2>
        <p class="text-gray-700">
            KomuKuna Studio berhak mengubah syarat dan ketentuan sewaktu-waktu
            tanpa pemberitahuan sebelumnya.
        </p>

        <!-- FOOT NOTE -->
        <div class="mt-8 p-4 bg-pink-50 rounded-lg text-sm text-gray-700">
            Terakhir diperbarui: <strong><?= date('d F Y') ?></strong>
        </div>

    </div>

</div>

</body>
</html>
