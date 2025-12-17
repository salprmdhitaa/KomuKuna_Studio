<?php
session_start();
require_once __DIR__ . '/../user/includes/db.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../user/login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-pink-600 text-white flex flex-col">
        <div class="p-6 text-2xl font-bold border-b border-pink-400">
            KomuKuna Studio
        </div>

        <nav class="flex-1 p-4 space-y-2">
            <a href="booking_manage.php"
               class="block px-4 py-2 rounded hover:bg-pink-500">
                Booking
            </a>

            <a href="product_manage.php"
               class="block px-4 py-2 rounded hover:bg-pink-500">
                Product
            </a>

            <a href="user_list.php"
               class="block px-4 py-2 rounded hover:bg-pink-500">
                User
            </a>
        </nav>

        <div class="p-4 border-t border-pink-400">
            <a href="logout.php"
               class="block text-center px-4 py-2 rounded bg-gray-400 hover:bg-pink-600">
                Logout
            </a>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 p-8">
        <h1 class="text-3xl font-bold text-pink-600 mb-6">
            Dashboard Admin
        </h1>

        <!-- INFO BOX -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-xl shadow">
                <h3 class="text-gray-500">Total Booking</h3>
                <p class="text-3xl font-bold text-pink-600">—</p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow">
                <h3 class="text-gray-500">Total Product</h3>
                <p class="text-3xl font-bold text-pink-600">—</p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow">
                <h3 class="text-gray-500">Total User</h3>
                <p class="text-3xl font-bold text-pink-600">—</p>
            </div>
        </div>

    </main>

</div>

</body>
</html>
