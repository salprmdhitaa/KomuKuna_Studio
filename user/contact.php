<?php include '../user/includes/db.php'; ?>
<?php include '../user/includes/header.php'; ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>KomuKuna Studio</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

    <div class="flex flex-col md:flex-row justify-center items-center gap-10 mt-48 mb-24">

        <!-- CARD WHATSAPP -->
        <a href="https://wa.me/6281234567890" target="_blank"
           class="w-72 h-96 border-2 border-gray-300 rounded-3xl shadow-md 
                  flex flex-col items-center justify-center text-center px-6 
                  hover:shadow-xl transition">

            <svg class="w-24 h-24 text-pink-400 mb-6" fill="none" stroke="currentColor" stroke-width="1.5"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M20.52 3.48A11.81 11.81 0 0012 .67 11.86 11.86 0 001.41 17.6L.06 23.68a1 1 0 001.24 1.23l6-1.42A11.83 11.83 0 0012 23.33a11.86 11.86 0 008.52-19.85z"/>
            </svg>

            <p class="text-gray-600 mb-8">
                Customer Service Support tersedia untuk menjawab semua kebutuhan Kamu.
                Tekan tombol WhatsApp untuk mulai mengobrol dengan kami.
            </p>

            <button class="mt-5 bg-pink-400 text-white px-8 py-3 rounded-full hover:bg-pink-500">
                Via WhatsApp
            </button>
        </a>

        <!-- CARD INSTAGRAM -->
        <a href="https://instagram.com/akun_instagram_kamu" target="_blank"
           class="w-72 h-96 border-2 border-gray-300 rounded-3xl shadow-md 
                  flex flex-col items-center justify-center text-center px-6 
                  hover:shadow-xl transition">

            <svg class="w-24 h-24 text-pink-400 mb-6" fill="none" stroke="currentColor" stroke-width="1.5"
                 viewBox="0 0 24 24">
                <rect width="20" height="20" x="2" y="2" rx="5" ry="5"/>
                <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"/>
                <circle cx="17.5" cy="6.5" r="1.5"/>
            </svg>

            <p class="text-gray-600 mb-8">
                Customer Service Support tersedia untuk menjawab semua kebutuhan Kamu.
                Tekan tombol Instagram untuk mulai mengobrol dengan kami.
            </p>

            <button class="mt-5 bg-pink-400 text-white px-8 py-3 rounded-full hover:bg-pink-500">
                Via Instagram
            </button>
        </a>

    </div>
</section>


    <!-- GOOGLE MAPS -->
    <div class="mt-12">
        <h2 class="text-2xl font-bold text-pink-500 mb-10 text-center mt-2">Lokasi Studio</h2>

        <div class="w-full h-80 rounded-xl overflow-hidden shadow-md">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3952.09307638152!2d110.365!3d-7.821!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zN8KwNDknMTUuOSJTIDExMMKwMjInMDQuMCJF!5e0!3m2!1sid!2sid!4v123456789"
                width="100%" 
                height="100%" 
                style="border:0;"
                allowfullscreen="" 
                loading="lazy">
            </iframe>
        </div>
    </div>

</div>

</body>
</html>
