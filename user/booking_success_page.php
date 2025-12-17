<?php
session_start();
require_once __DIR__ . '/includes/db.php';

/*
|--------------------------------------------------------------------------
| Ambil booking terakhir (paling baru)
|--------------------------------------------------------------------------
*/
$query = mysqli_query($conn, "
    SELECT * FROM bookings
    ORDER BY id DESC
    LIMIT 1
");

if (!$query || mysqli_num_rows($query) === 0) {
    header("Location: booking.php");
    exit;
}

$booking = mysqli_fetch_assoc($query);

// Decode add-ons JSON
$addons = json_decode($booking['addons'], true) ?? [];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Booking Berhasil</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">

<div class="bg-white max-w-xl w-full rounded-xl shadow-lg p-6">
    
    <!-- ICON -->
    <div class="text-center mb-4">
        <div class="text-purple-500 text-6xl">✔</div>
        <h1 class="text-2xl font-bold text-pink-600 mt-2">
            Booking Berhasil!
        </h1>
        <p class="text-pink-500 text-sm">
            Terima kasih, pesanan Anda telah kami terima.
        </p>
    </div>

    <!-- DETAIL -->
    <div class="border-t pt-4 space-y-2 text-sm">

        <div class="flex justify-between">
            <span class="text-gray-500">Nama</span>
            <span class="font-semibold"><?= htmlspecialchars($booking['nama_pemesan']) ?></span>
        </div>

        <div class="flex justify-between">
            <span class="text-gray-500">Email</span>
            <span><?= htmlspecialchars($booking['email']) ?></span>
        </div>

        <div class="flex justify-between">
            <span class="text-gray-500">Paket</span>
            <span><?= htmlspecialchars($booking['paket_nama']) ?></span>
        </div>

        <div class="flex justify-between">
            <span class="text-gray-500">Tanggal</span>
            <span><?= $booking['tanggal_booking'] ?> | <?= $booking['jam_booking'] ?></span>
        </div>

        <div class="flex justify-between">
            <span class="text-gray-500">Background</span>
            <span><?= $booking['background'] ?></span>
        </div>

        <!-- ADD ONS -->
        <?php if (!empty($addons)): ?>
        <div>
            <p class="text-gray-500 mb-1">Add-ons</p>
            <ul class="list-disc list-inside text-gray-700">
                <?php foreach ($addons as $name => $qty): ?>
                    <?php if ($qty > 0): ?>
                        <li><?= htmlspecialchars($name) ?> (<?= $qty ?>)</li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php endif; ?>

        <div class="flex justify-between font-bold text-pink-500 text-lg mt-3">
            <span>Total</span>
            <span>Rp <?= number_format($booking['total'], 0, ',', '.') ?></span>
        </div>

        <div class="flex justify-between mt-2">
            <span class="text-gray-500">Status</span>
            <span class="px-3 py-1 rounded-full text-xs bg-yellow-100 text-yellow-600">
                <?= ucfirst($booking['status']) ?>
            </span>
        </div>

    </div>

    <!-- ACTION -->
    <div class="mt-6 flex gap-3">
        <a href="booking.php" class="w-1/2 text-center border rounded-lg py-2 hover:bg-gray-50">
            Booking Lagi
        </a>
        <a href="..user/index.php" class="w-1/2 text-center bg-pink-500 text-white rounded-lg py-2 hover:bg-pink-600">
            Ke Beranda
        </a>
    </div>

</div>

</body>
</html>
