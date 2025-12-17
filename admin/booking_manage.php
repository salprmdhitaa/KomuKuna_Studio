<?php
session_start();
require_once __DIR__ . '/../user/includes/db.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../user/login.php");
    exit;
}

/* ===============================
   UPDATE STATUS
================================ */
if (isset($_POST['update_status'])) {
    $id     = $_POST['id'];
    $status = $_POST['status'];

    mysqli_query($conn, "
        UPDATE bookings SET status='$status' WHERE id='$id'
    ");
}

/* ===============================
   DELETE BOOKING
================================ */
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM bookings WHERE id='$id'");
    header("Location: booking_manage.php");
    exit;
}

/* ===============================
   GET DATA
================================ */
$data = mysqli_query($conn, "
    SELECT * FROM bookings 
    ORDER BY tanggal_booking DESC, jam_booking DESC
");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Booking</title>
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
               class="block px-4 py-2 rounded bg-pink-500 font-semibold">
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
               class="block text-center px-4 py-2 rounded bg-gray-200 text-pink-600 hover:bg-gray-100">
                Logout
            </a>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 p-8 overflow-x-auto">
        <h1 class="text-3xl font-bold mb-6 text-pink-600">Daftar Booking</h1>

        <div class="bg-white rounded-xl shadow overflow-x-auto">
            <table class="min-w-full text-sm text-gray-700">
                <thead class="bg-pink-600 text-white">
                    <tr>
                        <th class="px-4 py-3">Nama</th>
                        <th class="px-4 py-3">Email</th>
                        <th class="px-4 py-3">Alamat</th>
                        <th class="px-4 py-3">Paket</th>
                        <th class="px-4 py-3">Tanggal</th>
                        <th class="px-4 py-3">Jam</th>
                        <th class="px-4 py-3">Background</th>
                        <th class="px-4 py-3">Add-ons</th>
                        <th class="px-4 py-3">Total</th>
                        <th class="px-4 py-3">Bukti</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                <?php while ($row = mysqli_fetch_assoc($data)) : ?>
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2"><?= $row['nama_pemesan'] ?></td>
                        <td class="px-4 py-2"><?= $row['email'] ?></td>
                        <td class="px-4 py-2"><?= $row['alamat'] ?></td>
                        <td class="px-4 py-2"><?= $row['paket_nama'] ?></td>
                        <td class="px-4 py-2"><?= $row['tanggal_booking'] ?></td>
                        <td class="px-4 py-2"><?= $row['jam_booking'] ?></td>
                        <td class="px-4 py-2"><?= $row['background'] ?></td>
                        <td class="px-4 py-2"><?= $row['addons'] ?></td>
                        <td class="px-4 py-2 font-semibold">
                            Rp <?= number_format($row['total']) ?>
                        </td>

                        <td class="px-4 py-2 text-center">
                            <?php if ($row['bukti_pembayaran']) : ?>
                                <a href="../uploads/<?= $row['bukti_pembayaran'] ?>"
                                   target="_blank"
                                   class="text-pink-600 underline">
                                    Lihat
                                </a>
                            <?php else : ?>
                                -
                            <?php endif; ?>
                        </td>

                        <!-- STATUS -->
                        <td class="px-4 py-2">
                            <?php
                            $statusClass = match($row['status']) {
                                'berhasil' => 'bg-green-100 text-green-700',
                                'pending'  => 'bg-yellow-100 text-yellow-700',
                                'cancel'   => 'bg-red-100 text-red-700',
                                default    => 'bg-gray-100 text-gray-700'
                            };
                            ?>
                            <span class="px-3 py-1 rounded-full text-xs <?= $statusClass ?>">
                                <?= ucfirst($row['status']) ?>
                            </span>
                        </td>

                        <!-- AKSI -->
                        <td class="px-4 py-2">
                            <form method="post" class="flex flex-wrap gap-2">
                                <input type="hidden" name="id" value="<?= $row['id'] ?>">

                                <select name="status"
                                        class="border rounded px-2 py-1 text-sm">
                                    <option value="pending">Pending</option>
                                    <option value="berhasil">Berhasil</option>
                                    <option value="cancel">Cancel</option>
                                </select>

                                <button name="update_status"
                                        class="bg-blue-500 text-white px-3 py-1 rounded text-sm">
                                    Update
                                </button>

                                <a href="?delete=<?= $row['id'] ?>"
                                   onclick="return confirm('Hapus booking ini?')"
                                   class="bg-red-500 text-white px-3 py-1 rounded text-sm">
                                    Hapus
                                </a>
                            </form>
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
