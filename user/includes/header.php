<?php session_start(); ?>

<!-- ===== HEADER ===== -->
<header class="bg-pink-500 px-6 py-4 shadow-md fixed top-0 left-0 w-full z-50">
    <div class="flex justify-between items-center max-w-6xl mx-auto">

        <!-- Logo -->
        <img src="assets/img/logo-komukuna.png" alt="Logo" class="h-12">

        <!-- Navigation -->
        <nav class="space-x-10 text-lg font-semibold text-white">
            <a href="index.php" class="hover:text-purple-900 transition">Home</a>
            <a href="booking.php" class="hover:text-purple-900 transition">Booking</a>
            <a href="pricelist.php" class="hover:text-purple-900 transition">Pricelist</a>
            <a href="contact.php" class="hover:text-purple-900 transition">Contact</a>
            <a href="terms.php" class="hover:text-purple-900 transition">S&K</a>
        </nav>

        <!-- Logout Icon -->
        <?php if (isset($_SESSION['login'])): ?>
            <a href="auth/logout.php"
               class="flex items-center gap-2 bg-white text-pink-600 px-4 py-2 rounded-full font-semibold
                      hover:bg-purple-900 hover:text-white transition">

                <!-- Icon Logout (Heroicons) -->
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="h-5 w-5"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor"
                     stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v1" />
                </svg>

                Logout
            </a>
        <?php endif; ?>

    </div>
</header>

<script src="https://cdn.tailwindcss.com"></script>
