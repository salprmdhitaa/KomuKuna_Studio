<?php
require_once __DIR__ . '/../user/includes/db.php';
$result = mysqli_query($conn, "SELECT * FROM products ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Manage Product</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-pink-600 text-white flex flex-col flex-shrink-0">

        <div class="p-6 text-2xl font-bold border-b border-pink-400">
            KomuKuna Studio
        </div>

        <nav class="flex-1 p-4 space-y-2">
            <a href="booking_manage.php"
               class="block px-4 py-2 rounded hover:bg-pink-500">
                Booking
            </a>

            <a href="product_manage.php"
               class="block px-4 py-2 rounded bg-pink-500 font-semibold">
                Product
            </a>

            <a href="user_list.php"
               class="block px-4 py-2 rounded hover:bg-pink-500">
                User
            </a>
        </nav>

        <div class="p-4 border-t border-pink-400">
            <a href="logout.php"
               class="block text-center px-4 py-2 rounded bg-gray-200 text-pink-600 hover:bg-gray-100">
                Logout
            </a>
        </div>
    </aside>

    <!-- ================= MAIN CONTENT ================= -->
    <main class="flex-1 p-8">

        <div class="max-w-6xl mx-auto bg-white p-6 rounded-xl shadow">

            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-pink-600">
                    Daftar Product
                </h1>

                <a href="product_add.php"
                   class="bg-pink-500 text-white px-4 py-2 rounded-lg hover:bg-pink-600">
                    + Tambah Product
                </a>
            </div>

            <table class="w-full border text-sm">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="border p-3">Gambar</th>
                        <th class="border p-3">Nama Paket</th>
                        <th class="border p-3">Harga</th>
                        <th class="border p-3">Maks. Orang</th>
                        <th class="border p-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr class="hover:bg-gray-50">
                        <td class="border p-2 text-center">
                            <?php if (!empty($row['gambar'])): ?>
                                <img src="../uploads/products/<?= htmlspecialchars($row['gambar']) ?>"
                                     class="w-20 mx-auto rounded-lg">
                            <?php else: ?>
                                <span class="text-gray-400 italic">No Image</span>
                            <?php endif; ?>
                        </td>

                        <td class="border p-2 font-medium">
                            <?= htmlspecialchars($row['nama_paket']) ?>
                        </td>

                        <td class="border p-2">
                            Rp <?= number_format($row['harga'],0,',','.') ?>
                        </td>

                        <td class="border p-2 text-center">
                            <?= $row['maksimal_orang'] ?>
                        </td>

                        <td class="border p-2 text-center space-x-2">
                            <a href="product_edit.php?id=<?= $row['id'] ?>"
                               class="inline-block px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">
                                Edit
                            </a>
                            <a href="product_delete.php?id=<?= $row['id'] ?>"
                               onclick="return confirm('Hapus produk ini?')"
                               class="inline-block px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">
                                Hapus
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>

        </div>

    </main>
</div>

</body>
</html>
