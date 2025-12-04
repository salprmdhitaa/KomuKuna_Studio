<?php include '../user/includes/db.php'; ?>
<?php include '../user/includes/header.php'; ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>KomuKuna Studio</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-white text-gray-800 pt-28">

<!-- ===== BANNER / SLIDER ===== -->
<section class="max-w-6xl mx-auto mt-8 px-4">
    <div class="relative w-full h-auto bg-white shadow-xl rounded-3xl overflow-hidden">
        <img src="assets/img/banner1.jpg" class="w-full h-48 sm:h-64 md:h-72 lg:h-80 object-cover">

        <!-- Tombol kiri -->
        <button class="absolute top-1/2 left-4 -translate-y-1/2 bg-white p-2 rounded-full shadow text-purple-600">
            ❮
        </button>

        <!-- Tombol kanan -->
        <button class="absolute top-1/2 right-4 -translate-y-1/2 bg-white p-2 rounded-full shadow text-purple-600">
            ❯
        </button>
    </div>
</section>

<section class="text-center mt-20 px-4">
    <h2 class="text-2xl sm:text-3xl font-bold text-pink-500">
        Every Shot Tells a Story.
    </h2>
    <p class="text-xl text-gray-500 mt-2">
        Abadikam setiap momentmu bersama KomuKuna Studio
    </p>
</section>

<!-- ===== CARD PAKET ===== -->
<section class="max-w-6xl mx-auto px-4 mt-12">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
         <!-- CARD 2 -->
        <div class="bg-white shadow-lg rounded-xl overflow-hidden">
            <img src="assets/img/self-photo.jpg" class="w-full h-72 object-cover">
            <div class="p-5">
                <!-- Judul diperbesar -->
                <h3 class="text-xl font-bold text-pink-500 mb-3">Self Photo Reguler</h3>

                <!-- Divider -->
                <div class="w-full h-px bg-gray-200 mb-4"></div>

                <!-- Deskripsi -->
                <h4 class="text-sm font-medium text-gray-500">15Mins</h4>
                <h4 class="text-sm font-medium text-gray-500">1 Background</h4>
                <h4 class="text-sm font-medium text-gray-500">3 Person(s)</h4>
                <h4 class="text-sm font-medium text-gray-500">Free Photo Print (2r or 4r)</h4>
                <h4 class="text-sm font-medium text-gray-500">Free All Property (Except Costum)</h4>
                <h4 class="text-sm font-medium text-gray-500 mb-6">Free All Soft File</h4>
            </div>
        </div>

        <!-- CARD 2 -->
        <div class="bg-white shadow-lg rounded-xl overflow-hidden">
            <img src="assets/img/self-photo.jpg" class="w-full h-72 object-cover">
            <div class="p-5">
                <!-- Judul diperbesar -->
                <h3 class="text-xl font-bold text-pink-500 mb-3">Self Photo Premium</h3>

                <!-- Divider -->
                <div class="w-full h-px bg-gray-200 mb-4"></div>

                <!-- Deskripsi -->
                <h4 class="text-sm font-medium text-gray-500">30 Mins</h4>
                <h4 class="text-sm font-medium text-gray-500">1 Background</h4>
                <h4 class="text-sm font-medium text-gray-500">5 Person(s)</h4>
                <h4 class="text-sm font-medium text-gray-500">Free Photo Print (2r or 4r)</h4>
                <h4 class="text-sm font-medium text-gray-500">Free All Property (Except Costum)</h4>
                <h4 class="text-sm font-medium text-gray-500 mb-6">Free All Soft File</h4>
            </div>
        </div>


        <!-- CARD 2 -->
        <div class="bg-white shadow-lg rounded-xl overflow-hidden">
            <img src="assets/img/american-school.jpg" class="w-full h-72 object-cover">
            <div class="p-5">
               <!-- Judul diperbesar -->
                <h3 class="text-xl font-bold text-pink-500 mb-3">American School</h3>

                <!-- Divider -->
                <div class="w-full h-px bg-gray-200 mb-4"></div>

                <!-- Deskripsi -->
                <h4 class="text-sm font-medium text-gray-500">1 Background</h4>
                <h4 class="text-sm font-medium text-gray-500">Free Photo Print (2r or 4r)</h4>
                <h4 class="text-sm font-medium text-gray-500">Free vest, suit, and tie.</h4>
                <h4 class="text-sm font-medium text-gray-500">Free All Property (Except costum)</h4>
                <h4 class="text-sm font-medium text-gray-500">Free All Soft File </h4>
            </div>
        </div>

        <!-- CARD 4 -->
        <div class="bg-white shadow-lg rounded-xl overflow-hidden">
            <img src="assets/img/pas-photo.jpg" class="w-full h-72 object-cover">
            <div class="p-5">
                <!-- Judul diperbesar -->
                <h3 class="text-xl font-bold text-pink-500 mb-3">Pas Photo Session</h3>

                <!-- Divider -->
                <div class="w-full h-px bg-gray-200 mb-4"></div>

                <!-- Deskripsi -->
                 <h4 class="text-sm font-medium text-gray-500">1 Background</h4>
                <h4 class="text-sm font-medium text-gray-500">3 Person(s)</h4>
                <h4 class="text-sm font-medium text-gray-500">Free Photo Print (2r or 4r)</h4>
                <h4 class="text-sm font-medium text-gray-500">Free vest, suit, and tie</h4>
                <h4 class="text-sm font-medium text-gray-500">Free All Property (Except costum)</h4>
                <h4 class="text-sm font-medium text-gray-500 mb-6">Free All Soft File</h4>
            </div>
        </div>

    </div>
</section>

<!-- ===== SECTION TENTANG + MASCOT (TEKS KIRI - MASCOT KANAN) ===== -->
<section class="max-w-6xl mx-auto px-6 mt-14">
    <div class="flex flex-col md:flex-row items-center gap-10">

        <!-- TEKS KIRI -->
        <div class="md:w-1/2 text-left">
            <p class="text-xl text-gray-700 leading-relaxed">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor 
                incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud 
                exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
            </p>
        </div>

        <!-- MASCOT KANAN -->
        <div class="md:w-1/2 flex justify-center">
            <img src="assets/img/komukuna-mascot.png" class="h-52 md:h-64">
        </div>

    </div>
</section>

<!-- ===== FOOTER ===== -->
<footer class="bg-pink-500 mt-16 py-12 text-white">
    <div class="max-w-6xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-10">

        <!-- Info -->
        <div>
            <img src="assets/img/logo-komukuna.png" class="h-12 mb-4">
            <p class="text-sm text-white">+1 (7635) 547-12-97</p>
            <p class="text-sm text-white">support@lift.agency</p>
        </div>

        <!-- Quick Links -->
        <div>
            <h4 class="font-bold mb-3 text-white">Quick Links</h4>
            <ul class="text-sm space-y-1">
                <li><a href="#" class="text-white">Product</a></li>
                <li><a href="#" class="text-white">Company</a></li>
                <li><a href="#" class="text-white">Information</a></li>
                <li><a href="#" class="text-white">Lift Media</a></li>
            </ul>
        </div>

        <!-- Subscribe -->
        <div>
            <h4 class="font-bold mb-3 text-white">Subscribe</h4>
            <div class="flex">
                <input type="email" placeholder="Get product updates"
                    class="px-3 py-2 border rounded-l-md w-full text-black">
                <button class="bg-purple-600 text-white px-4 rounded-r-md">➤</button>
            </div>
        </div>

    </div>

    <p class="text-center mt-10 text-sm text-white">
        A product of Komu Kuna Studio • © 2024 Lift Media. All rights reserved.
    </p>
</footer>

</body>
</html>
