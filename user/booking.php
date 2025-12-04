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

<section class="text-center mt-5 px-4">
    <h2 class="text-2xl sm:text-3xl font-bold text-pink-400">
        Find the One That Fits You
    </h2>
    <p class="text-xl text-gray-500 mt-2">
        Pilih paket yang pas untuk hasil foto terbaikmu
    </p>
</section>

<!-- ===== CARD PAKET ===== -->
<section class="max-w-6xl mx-auto px-4 mt-12 mb-16">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">

        <!-- CARD 1 -->
        <div class="bg-white shadow-lg rounded-xl overflow-hidden flex flex-col mb-10">
            <img src="assets/img/self-photo.jpg" class="w-full h-72 object-cover">

            <div class="p-5 flex flex-col h-full">
                <h3 class="text-xl font-bold text-pink-500 mb-3">Self Photo Reguler - Rp. 35.000</h3>

                <div class="w-full h-px bg-gray-200 mb-4"></div>

                <h4 class="text-sm font-medium text-gray-500">15 Mins</h4>
                <h4 class="text-sm font-medium text-gray-500">1 Background</h4>
                <h4 class="text-sm font-medium text-gray-500">3 Person(s)</h4>
                <h4 class="text-sm font-medium text-gray-500">Free Photo Print (2r or 4r)</h4>
                <h4 class="text-sm font-medium text-gray-500">Free All Property (Except Costum)</h4>
                <h4 class="text-sm font-medium text-gray-500 mb-6">Free All Soft File</h4>

                <a href="booking_detail.php?paket=self-photo"
                   class="mt-auto block text-center bg-pink-400 hover:bg-pink-500 text-white py-2 rounded-lg">
                    Pilih Paket
                </a>
            </div>
        </div>

        <!-- CARD 2 -->
        <div class="bg-white shadow-lg rounded-xl overflow-hidden flex flex-col mb-10">
            <img src="assets/img/self-photo.jpg" class="w-full h-72 object-cover">

            <div class="p-5 flex flex-col h-full">
                <h3 class="text-xl font-bold text-pink-500 mb-3">Self Photo Premium - Rp. 60.000</h3>

                <div class="w-full h-px bg-gray-200 mb-4"></div>

                <h4 class="text-sm font-medium text-gray-500">30 Mins</h4>
                <h4 class="text-sm font-medium text-gray-500">1 Background</h4>
                <h4 class="text-sm font-medium text-gray-500">5 Person(s)</h4>
                <h4 class="text-sm font-medium text-gray-500">Free Photo Print (2r or 4r)</h4>
                <h4 class="text-sm font-medium text-gray-500">Free All Property (Except Costum)</h4>
                <h4 class="text-sm font-medium text-gray-500 mb-6">Free All Soft File</h4>

                <a href="booking_detail.php?paket=self-photo"
                   class="mt-auto block text-center bg-pink-400 hover:bg-pink-500 text-white py-2 rounded-lg">
                    Pilih Paket
                </a>
            </div>
        </div>

        <!-- CARD 3 -->
        <div class="bg-white shadow-lg rounded-xl overflow-hidden flex flex-col mb-10">
            <img src="assets/img/american-school.jpg" class="w-full h-72 object-cover">

            <div class="p-5 flex flex-col h-full">
                <h3 class="text-xl font-bold text-pink-500 mb-3">American School - Rp. 40.000</h3>

                <div class="w-full h-px bg-gray-200 mb-4"></div>

                <h4 class="text-sm font-medium text-gray-500">1 Background</h4>
                <h4 class="text-sm font-medium text-gray-500">3 Person(s)</h4>
                <h4 class="text-sm font-medium text-gray-500">Free Photo Print (2r or 4r)</h4>
                <h4 class="text-sm font-medium text-gray-500">Free vest, suit, and tie</h4>
                <h4 class="text-sm font-medium text-gray-500">Free All Property (Except costum)</h4>
                <h4 class="text-sm font-medium text-gray-500 mb-6">Free All Soft File</h4>

                <a href="booking_detail.php?paket=self-photo"
                   class="mt-auto block text-center bg-pink-400 hover:bg-pink-500 text-white py-2 rounded-lg">
                    Pilih Paket
                </a>
            </div>
        </div>

        <!-- CARD 4 -->
        <div class="bg-white shadow-lg rounded-xl overflow-hidden flex flex-col mb-10">
            <img src="assets/img/pas-photo.jpg" class="w-full h-72 object-cover">

            <div class="p-5 flex flex-col h-full">
                <h3 class="text-xl font-bold text-pink-500 mb-3">Pas Photo Session - Rp. 30.000</h3>

                <div class="w-full h-px bg-gray-200 mb-4"></div>

                <h4 class="text-sm font-medium text-gray-500">Free Edit Background & Retouch</h4>
                <h4 class="text-sm font-medium text-gray-500">Free Photo Print (2x3, 3x4, 4x6, or 4r)</h4>
                <h4 class="text-sm font-medium text-gray-500 mb-6">Free All Soft File</h4>

                <a href="booking_detail.php?paket=pas-photo"
                   class="mt-auto block text-center bg-pink-400 hover:bg-pink-500 text-white py-2 rounded-lg">
                    Pilih Paket
                </a>
            </div>
        </div>

    </div>
</section>

</body>
</html>
