<?php
// admin_dashboard.php
// Dashboard admin sederhana dengan Tailwind CSS, mengikuti style index.php
// Pastikan file ini diletakkan pada folder yang sama struktur projectnya dengan index.php

// Contoh pengecekan session (aktifkan kalau perlu)
// session_start();
// if (!isset($_SESSION['user']) || $_SESSION['role'] !== 'admin') {
//     header('Location: ../user/login.php');
//     exit;
// }

include '../user/includes/db.php';
include '../user/includes/header.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - KomuKuna Studio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer>
        // Toggle sidebar
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('-translate-x-full');
        }

        // Simple filter for table (client-side)
        function filterTable() {
            const q = document.getElementById('searchUser').value.toLowerCase();
            const rows = document.querySelectorAll('#clientsTable tbody tr');
            rows.forEach(r => {
                const text = r.innerText.toLowerCase();
                r.style.display = text.includes(q) ? '' : 'none';
            });
        }
    </script>
</head>
<body class="bg-white text-gray-800">

<!-- Topbar -->
<header class="fixed top-0 left-0 right-0 bg-white shadow z-30">
    <div class="max-w-6xl mx-auto px-4 py-3 flex items-center justify-between">
        <div class="flex items-center gap-4">
            <button onclick="toggleSidebar()" class="p-2 rounded-md hover:bg-gray-100">
                <!-- menu icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
            <a href="index.php" class="flex items-center gap-3">
                <img src="assets/img/logo-komukuna.png" alt="KomuKuna" class="h-8">
                <span class="font-bold text-lg text-pink-500">KomuKuna Admin</span>
            </a>
        </div>

        <div class="flex items-center gap-4">
            <div class="relative">
                <input id="searchUser" oninput="filterTable()" type="search" placeholder="Cari client / order..." class="px-3 py-2 border rounded-md w-64 focus:outline-none focus:ring-2 focus:ring-purple-300">
            </div>
            <div class="flex items-center gap-3">
                <button class="p-2 rounded-md hover:bg-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                </button>

                <div class="flex items-center gap-3">
                    <img src="assets/img/avatar-admin.jpg" alt="Admin" class="h-9 w-9 rounded-full object-cover">
                    <div class="text-left">
                        <div class="text-sm font-medium">Admin</div>
                        <div class="text-xs text-gray-500">komukuna@studio.com</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<main class="pt-20 max-w-6xl mx-auto px-4">
    <div class="flex gap-6">
        <!-- Sidebar -->
        <aside id="sidebar" class="w-64 bg-white border rounded-xl p-4 h-[80vh] overflow-auto transform transition-transform -translate-x-0 md:translate-x-0">
            <nav class="space-y-4">
                <a href="admin_dashboard.php" class="flex items-center gap-3 p-3 rounded-lg bg-pink-50 text-pink-600 font-semibold">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10 2a2 2 0 00-2 2v1H6a2 2 0 00-2 2v1h12V7a2 2 0 00-2-2h-2V4a2 2 0 00-2-2z" />
                        <path d="M4 13v1a3 3 0 003 3h6a3 3 0 003-3v-1H4z" />
                    </svg>
                    Dashboard
                </a>

                <a href="#" class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M8 9a3 3 0 100-6 3 3 0 000 6z" />
                        <path fill-rule="evenodd" d="M2 13.5A7.5 7.5 0 0110 6v1a6.5 6.5 0 00-6.5 6.5H2z" clip-rule="evenodd" />
                    </svg>
                    Clients
                </a>

                <a href="#" class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M3 3h14v2H3V3z" />
                        <path d="M3 7h14v10H3V7z" />
                    </svg>
                    Packages
                </a>

                <a href="#" class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M5 3a2 2 0 00-2 2v10l4-2 4 2 4-2 4 2V5a2 2 0 00-2-2H5z" />
                    </svg>
                    Orders
                </a>

                <a href="#" class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M4 3h12v2H4V3z" />
                        <path d="M4 7h12v6H4V7z" />
                    </svg>
                    Settings
                </a>

                <a href="../user/includes/logout.php" class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 text-red-600">
                    Logout
                </a>
            </nav>
        </aside>

        <!-- Content -->
        <section class="flex-1">
            <!-- Summary cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white shadow rounded-xl p-5">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-xs text-gray-500">Total Orders</div>
                            <div class="text-2xl font-bold">1,254</div>
                        </div>
                        <div class="bg-pink-50 text-pink-600 rounded-full p-3">
                            <!-- icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M3 3h14v2H3V3z" />
                                <path d="M3 7h14v8H3V7z" />
                            </svg>
                        </div>
                    </div>
                    <div class="text-sm text-gray-400 mt-3">+12% dari minggu lalu</div>
                </div>

                <div class="bg-white shadow rounded-xl p-5">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-xs text-gray-500">New Clients</div>
                            <div class="text-2xl font-bold">321</div>
                        </div>
                        <div class="bg-purple-50 text-purple-600 rounded-full p-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M8 9a3 3 0 100-6 3 3 0 000 6z" />
                                <path fill-rule="evenodd" d="M2 13.5A7.5 7.5 0 0110 6v1a6.5 6.5 0 00-6.5 6.5H2z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                    <div class="text-sm text-gray-400 mt-3">Konversi lead meningkat</div>
                </div>

                <div class="bg-white shadow rounded-xl p-5">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-xs text-gray-500">Revenue (This Month)</div>
                            <div class="text-2xl font-bold">Rp 34.500.000</div>
                        </div>
                        <div class="bg-green-50 text-green-600 rounded-full p-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M3 3h14v2H3V3z" />
                                <path d="M3 7h14v8H3V7z" />
                            </svg>
                        </div>
                    </div>
                    <div class="text-sm text-gray-400 mt-3">Target bulanan 70% tercapai</div>
                </div>
            </div>

            <!-- Orders table -->
            <div class="bg-white shadow rounded-xl p-5 mb-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold">Recent Orders</h3>
                    <div class="text-sm text-gray-500">Update terakhir: <?php echo date('d M Y'); ?></div>
                </div>

                <div class="overflow-auto">
                    <table id="clientsTable" class="w-full text-left table-auto">
                        <thead>
                            <tr class="text-sm text-gray-500 border-b">
                                <th class="py-3 px-2">Order ID</th>
                                <th class="py-3 px-2">Client</th>
                                <th class="py-3 px-2">Package</th>
                                <th class="py-3 px-2">Tanggal</th>
                                <th class="py-3 px-2">Status</th>
                                <th class="py-3 px-2">Total</th>
                                <th class="py-3 px-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- contoh data statis; ganti dengan data dari DB -->
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-3 px-2">#KMK-1023</td>
                                <td class="py-3 px-2">Dewi Sartika</td>
                                <td class="py-3 px-2">Self Photo Premium</td>
                                <td class="py-3 px-2">2024-11-25</td>
                                <td class="py-3 px-2"><span class="px-2 py-1 rounded-full text-xs bg-yellow-100 text-yellow-700">Pending</span></td>
                                <td class="py-3 px-2">Rp 120.000</td>
                                <td class="py-3 px-2">
                                    <a href="#" class="text-sm text-purple-600 hover:underline">Detail</a>
                                    <span class="mx-2">|</span>
                                    <a href="#" class="text-sm text-red-600 hover:underline">Batalkan</a>
                                </td>
                            </tr>

                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-3 px-2">#KMK-1022</td>
                                <td class="py-3 px-2">Rudi Hartono</td>
                                <td class="py-3 px-2">Pas Photo Session</td>
                                <td class="py-3 px-2">2024-11-24</td>
                                <td class="py-3 px-2"><span class="px-2 py-1 rounded-full text-xs bg-green-100 text-green-700">Completed</span></td>
                                <td class="py-3 px-2">Rp 75.000</td>
                                <td class="py-3 px-2">
                                    <a href="#" class="text-sm text-purple-600 hover:underline">Detail</a>
                                </td>
                            </tr>

                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-3 px-2">#KMK-1021</td>
                                <td class="py-3 px-2">Sari Puspita</td>
                                <td class="py-3 px-2">American School</td>
                                <td class="py-3 px-2">2024-11-20</td>
                                <td class="py-3 px-2"><span class="px-2 py-1 rounded-full text-xs bg-red-100 text-red-700">Canceled</span></td>
                                <td class="py-3 px-2">Rp 0</td>
                                <td class="py-3 px-2">
                                    <a href="#" class="text-sm text-purple-600 hover:underline">Detail</a>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Clients list and quick actions -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-10">
                <div class="lg:col-span-2 bg-white shadow rounded-xl p-5">
                    <h3 class="text-lg font-semibold mb-4">Clients</h3>
                    <div class="overflow-auto">
                        <table class="w-full text-left table-auto">
                            <thead>
                                <tr class="text-sm text-gray-500 border-b">
                                    <th class="py-3 px-2">Name</th>
                                    <th class="py-3 px-2">Email</th>
                                    <th class="py-3 px-2">Phone</th>
                                    <th class="py-3 px-2">Joined</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="py-3 px-2">Eka Prasetya</td>
                                    <td class="py-3 px-2">eka@mail.com</td>
                                    <td class="py-3 px-2">0812-3456-7890</td>
                                    <td class="py-3 px-2">2024-06-11</td>
                                </tr>
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="py-3 px-2">Nina Melati</td>
                                    <td class="py-3 px-2">nina@mail.com</td>
                                    <td class="py-3 px-2">0813-9876-5432</td>
                                    <td class="py-3 px-2">2024-07-02</td>
                                </tr>
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="py-3 px-2">Ardi Nugroho</td>
                                    <td class="py-3 px-2">ardi@mail.com</td>
                                    <td class="py-3 px-2">0815-1111-2222</td>
                                    <td class="py-3 px-2">2024-08-15</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="bg-white shadow rounded-xl p-5">
                    <h3 class="text-lg font-semibold mb-4">Quick Actions</h3>
                    <div class="space-y-3">
                        <a href="#" class="block px-4 py-2 border rounded-lg hover:bg-gray-50">Buat Order Baru</a>
                        <a href="#" class="block px-4 py-2 border rounded-lg hover:bg-gray-50">Tambah Paket</a>
                        <a href="#" class="block px-4 py-2 border rounded-lg hover:bg-gray-50">Lihat Laporan</a>
                        <a href="#" class="block px-4 py-2 border rounded-lg hover:bg-gray-50">Export CSV</a>
                    </div>
                </div>
            </div>

            <!-- Footer kecil di bawah konten -->
            <div class="text-center text-sm text-gray-500 mb-10">
                © <?php echo date('Y'); ?> KomuKuna Studio • Admin Panel
            </div>
        </section>
    </div>
</main>

</body>
</html>
