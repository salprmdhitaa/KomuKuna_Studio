<?php
require_once __DIR__ . '/../user/includes/db.php';

// Ambil data user
$result = mysqli_query($conn, "
    SELECT id, username, role
    FROM users
    ORDER BY id DESC
");
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>List User</title>
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
               class="block px-4 py-2 rounded hover:bg-pink-500">
                Product
            </a>

            <a href="user_list.php"
               class="block px-4 py-2 rounded bg-pink-500 font-semibold">
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

    <!-- ================= MAIN ================= -->
    <main class="flex-1 p-8">

        <div class="max-w-5xl mx-auto bg-white p-6 rounded-xl shadow">

            <h1 class="text-2xl font-bold text-pink-600 mb-6">
                Daftar User
            </h1>

            <table class="w-full border text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border p-3">No</th>
                        <th class="border p-3 text-left">Username</th>
                        <th class="border p-3 text-center">Role</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr class="hover:bg-gray-50">
                        <td class="border p-3 text-center"><?= $no++ ?></td>
                        <td class="border p-3">
                            <?= htmlspecialchars($row['username']) ?>
                        </td>
                        <td class="border p-3 text-center">
                            <span class="
                                px-3 py-1 rounded-full text-xs font-semibold
                                <?= $row['role'] === 'admin'
                                    ? 'bg-red-100 text-red-600'
                                    : 'bg-green-100 text-green-600'
                                ?>
                            ">
                                <?= ucfirst($row['role']) ?>
                            </span>
                        </td>
                    </tr>
                    <?php endwhile; ?>

                    <?php if (mysqli_num_rows($result) === 0): ?>
                    <tr>
                        <td colspan="3"
                            class="border p-4 text-center text-gray-500">
                            Tidak ada data user
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>

        </div>

    </main>
</div>

</body>
</html>
