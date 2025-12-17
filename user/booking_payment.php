<?php
include '../user/includes/db.php';
include '../user/includes/header.php';

// ==============================
// Validasi data dari booking_detail
// ==============================
$paket_nama = $_POST['paket'] ?? "";
$harga      = isset($_POST['harga']) ? (int)$_POST['harga'] : 0;
$tanggal    = $_POST['tanggal'] ?? "";
$jam        = $_POST['jam'] ?? "";

if ($paket_nama === "" || $harga <= 0 || $tanggal === "" || $jam === "") {
    echo "<script>
            alert('Akses tidak valid. Silakan booking ulang.');
            window.location.href='booking.php';
          </script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Pembayaran - <?= htmlspecialchars($paket_nama) ?></title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 pt-28">

<div class="max-w-6xl mx-auto px-4 grid grid-cols-1 md:grid-cols-3 gap-8">

<form action="booking_success.php" method="POST" enctype="multipart/form-data" class="contents">

<!-- ================= DATA HIDDEN ================= -->
<input type="hidden" name="paket_nama" value="<?= htmlspecialchars($paket_nama) ?>">
<input type="hidden" name="tanggal_booking" value="<?= $tanggal ?>">
<input type="hidden" name="jam_booking" value="<?= $jam ?>">
<input type="hidden" name="total" id="totalFinal" value="<?= $harga ?>">

<!-- ================= LEFT ================= -->
<div class="md:col-span-2 space-y-6">

    <!-- INFO -->
    <div class="bg-pink-50 border border-pink-200 text-pink-600 px-4 py-3 rounded-lg">
        Halaman terakhir. Pastikan data booking sudah benar sebelum melakukan pembayaran.
    </div>

    <!-- DETAIL PAKET -->
    <div class="bg-white shadow rounded-xl p-5">
        <h2 class="font-bold text-lg text-pink-500 mb-4">Detail Paket</h2>
        <p class="font-semibold"><?= $paket_nama ?></p>
        <p class="text-gray-500 text-sm"><?= $tanggal ?> | <?= $jam ?></p>
        <p class="mt-2 font-semibold text-pink-500">
            Rp <?= number_format($harga,0,',','.') ?>
        </p>
    </div>

    <!-- ADD ONS -->
    <div>
        <h2 class="font-bold text-lg text-pink-500 mb-3">Add-ons</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <?php
        $addons = [
            ["id"=>"Costume","title"=>"Costume","harga"=>10000],
            ["id"=>"Keychain","title"=>"Keychain","harga"=>15000],
            ["id"=>"ExtraTime","title"=>"Extra Time","harga"=>20000],
            ["id"=>"ExtraPrint","title"=>"Extra Print","harga"=>5000],
        ];
        foreach ($addons as $a):
        ?>
            <div class="bg-white p-4 rounded-xl shadow border">
                <h3 class="font-bold text-pink-500"><?= $a['title'] ?></h3>
                <p class="text-sm text-gray-600 mb-2">
                    Rp <?= number_format($a['harga'],0,',','.') ?>
                </p>

                <div class="flex justify-between items-center">
                    <div class="flex items-center gap-2">
                        <button type="button" onclick="changeQty('<?= $a['id'] ?>',-1)"
                            class="w-8 h-8 bg-gray-200 rounded-full">-</button>
                        <span id="qty-<?= $a['id'] ?>">0</span>
                        <button type="button" onclick="changeQty('<?= $a['id'] ?>',1)"
                            class="w-8 h-8 bg-gray-200 rounded-full">+</button>
                    </div>

                    <input type="hidden" name="addons[<?= $a['title'] ?>]"
                           id="input-<?= $a['id'] ?>" value="0">
                    <input type="hidden" id="price-<?= $a['id'] ?>"
                           value="<?= $a['harga'] ?>">
                </div>
            </div>
        <?php endforeach; ?>
        </div>
    </div>

    <!-- BACKGROUND -->
    <div class="bg-white shadow rounded-xl p-5">
        <h3 class="font-bold text-lg text-pink-500 mb-3">Background</h3>
        <select name="background" class="w-full px-3 py-2 border rounded-xl">
            <option>Putih</option>
            <option>Hitam</option>
            <option>Coksu</option>
            <option>Pink</option>
            <option>Abu-abu</option>
        </select>
    </div>

    <!-- CUSTOMER -->
    <div class="bg-white shadow rounded-xl p-5">
        <h3 class="font-bold text-lg text-pink-500 mb-3">Data Pemesan</h3>

        <label class="text-sm">Nama</label>
        <input name="nama_pemesan" required
               class="w-full px-3 py-2 border rounded-xl mb-3">

        <label class="text-sm">Alamat</label>
        <textarea name="alamat" required
                  class="w-full px-3 py-2 border rounded-xl mb-3"></textarea>

        <label class="text-sm">Email</label>
        <input type="email" name="email" required
               class="w-full px-3 py-2 border rounded-xl mb-3">
    </div>

    <!-- PAYMENT -->
    <div class="bg-white shadow rounded-xl p-5">
        <h3 class="font-bold text-lg text-pink-500 mb-3">Pembayaran</h3>
        <img src="assets/img/qris.png"
             class="w-40 mx-auto mb-4 rounded-lg shadow">

        <label class="text-sm">Upload Bukti Pembayaran</label>
        <input type="file" name="bukti_pembayaran" accept="image/*" required
               class="w-full px-3 py-2 border rounded-xl mt-2">
    </div>

</div>

<!-- ================= RIGHT ================= -->
<div class="bg-white shadow rounded-xl p-6 h-fit">
    <h2 class="font-bold text-lg text-pink-500 mb-4">Ringkasan Pembayaran</h2>

    <p class="text-sm mb-1"><?= $paket_nama ?></p>
    <p class="text-sm mb-3">
        Rp <?= number_format($harga,0,',','.') ?>
    </p>

    <div class="flex justify-between text-lg font-bold text-pink-500 mb-4">
        <span>Total</span>
        <span>Rp <span id="totalDisplay"><?= number_format($harga,0,',','.') ?></span></span>
    </div>

    <button type="submit"
            class="w-full bg-pink-500 hover:bg-pink-600 text-white py-3 rounded-xl font-bold">
        Konfirmasi Booking
    </button>
</div>

</form>
</div>

<script>
let basePrice = <?= $harga ?>;

function changeQty(id, delta) {
    let qtyEl = document.getElementById("qty-" + id);
    let price = parseInt(document.getElementById("price-" + id).value);
    let input = document.getElementById("input-" + id);

    let qty = parseInt(qtyEl.textContent) + delta;
    if (qty < 0) qty = 0;

    qtyEl.textContent = qty;
    input.value = qty;

    calculateTotal();
}

function calculateTotal() {
    let total = basePrice;

    document.querySelectorAll("[id^='input-']").forEach(el => {
        let qty = parseInt(el.value);
        let id = el.id.replace("input-", "");
        let price = parseInt(document.getElementById("price-" + id).value);
        total += qty * price;
    });

    document.getElementById("totalDisplay").textContent =
        total.toLocaleString("id-ID");
    document.getElementById("totalFinal").value = total;
}
</script>

</body>
</html>
