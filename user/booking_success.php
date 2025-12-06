<?php
include '../user/includes/db.php';

// ==========================
// VALIDASI AKSES
// ==========================
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    ?>
    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="utf-8">
        <title>Akses Tidak Valid</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="bg-gray-100 pt-24">
    <div class="max-w-md mx-auto bg-white p-6 rounded-xl shadow text-center">
        <h1 class="text-xl font-bold text-pink-500 mb-3">Akses tidak valid</h1>
        <p class="text-gray-600 mb-4">Halaman ini hanya dapat diakses setelah melakukan pembayaran.</p>
        <a href="booking_payment.php" class="inline-block bg-pink-500 text-white px-4 py-2 rounded-lg">Kembali</a>
    </div>
    </body>
    </html>
    <?php
    exit;
}

// ==========================
// AMBIL INPUT
// ==========================
$paket      = $_POST['paket']      ?? '';
$harga      = (int)($_POST['harga']      ?? 0);
$tanggal    = $_POST['tanggal']    ?? '';
$jam        = $_POST['jam']        ?? '';
$background = $_POST['background'] ?? '';
$nama       = $_POST['nama']       ?? '';
$alamat     = $_POST['alamat']     ?? '';
$email      = $_POST['email']      ?? '';
$total      = (int)($_POST['total'] ?? 0);

$addons     = $_POST['addon_qty'] ?? [];
$addonJSON  = json_encode($addons);

// ==========================
// UPLOAD BUKTI
// ==========================
$uploadDir = __DIR__ . '/../uploads/';

if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$filename = "";
if (isset($_FILES['bukti']) && $_FILES['bukti']['error'] === UPLOAD_ERR_OK) {

    $original = basename($_FILES['bukti']['name']);
    $sanitize = preg_replace('/[^A-Za-z0-9_\.-]/', '_', $original);
    $filename = time() . "_" . $sanitize;

    $target = $uploadDir . $filename;

    if (!move_uploaded_file($_FILES['bukti']['tmp_name'], $target)) {
        die("Gagal mengunggah bukti pembayaran.");
    }

} else {
    die("Bukti pembayaran tidak ditemukan.");
}

// ==========================
// SIMPAN KE DATABASE (FIX!!!)
// ==========================

$stmt = $koneksi->prepare("
    INSERT INTO booking (paket, tanggal, jam, background, nama, alamat, email, addons, total, bukti)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
");

$stmt->bind_param(
    "ssssssssds",
    $paket,
    $tanggal,
    $jam,
    $background,
    $nama,
    $alamat,
    $email,
    $addonJSON,
    $total,
    $filename
);

if (!$stmt->execute()) {
    die("Gagal menyimpan pesanan: " . $stmt->error);
}

$stmt->close();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Booking Berhasil</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 pt-24">

<div class="max-w-2xl mx-auto bg-white shadow-xl rounded-2xl p-8">

    <div class="text-center">
        <div class="w-20 h-20 mx-auto rounded-full bg-pink-100 flex items-center justify-center text-4xl text-pink-500 mb-4">✓</div>

        <h1 class="text-2xl font-bold text-pink-500">Booking Berhasil!</h1>
        <p class="text-gray-600 mt-1">Terima kasih, <b><?= htmlspecialchars($nama) ?></b>. Pesananmu telah diterima.</p>
    </div>

    <div class="mt-6 bg-gray-50 p-5 rounded-xl">
        <h2 class="font-semibold text-pink-500 mb-2">Detail Pemesanan</h2>

        <div class="text-gray-700 text-sm space-y-2">
            <p><b>Paket:</b> <?= htmlspecialchars($paket) ?></p>
            <p><b>Tanggal:</b> <?= htmlspecialchars($tanggal) ?></p>
            <p><b>Jam:</b> <?= htmlspecialchars($jam) ?></p>
            <p><b>Background:</b> <?= htmlspecialchars($background) ?></p>

            <?php
            $hasAddon = false;
            foreach ($addons as $name => $qty) {
                if ((int)$qty > 0) $hasAddon = true;
            }
            ?>

            <?php if ($hasAddon): ?>
                <p><b>Add-ons:</b></p>
                <ul class="list-disc ml-6">
                    <?php foreach ($addons as $name => $qty): ?>
                        <?php if ((int)$qty > 0): ?>
                            <li><?= htmlspecialchars($name) ?> — <?= (int)$qty ?> pcs</li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <p class="text-lg font-bold text-pink-600 mt-3">
                Total: Rp <?= number_format((int)$total, 0, ',', '.') ?>
            </p>
        </div>
    </div>

    <div class="mt-6 text-center">
        <p class="font-semibold mb-3">Bukti Pembayaran</p>
        <img src="../uploads/<?= htmlspecialchars($filename) ?>" class="mx-auto w-48 rounded-xl shadow mb-4">

        <div class="flex justify-center gap-3">
            <a href="../uploads/<?= htmlspecialchars($filename) ?>" download class="px-4 py-2 bg-pink-500 text-white rounded-lg">Download Bukti</a>
            <a href="index.php" class="px-4 py-2 border rounded-lg">Kembali ke Beranda</a>
        </div>
    </div>

</div>

</body>
</html>
