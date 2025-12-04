<?php 
include '../user/includes/db.php'; 
include '../user/includes/header.php'; 

$paket      = $_POST['paket'] ?? '';
$harga      = (int)($_POST['harga'] ?? 0);
$tanggal    = $_POST['tanggal'] ?? '';
$jam        = $_POST['jam'] ?? '';
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Payment - <?= $paket ?></title>
<script src="https://cdn.tailwindcss.com"></script>

<style>
    .addon-card { transition: 0.2s; }
    .addon-card:hover { transform: translateY(-3px); }
    .btn-round { @apply w-8 h-8 flex items-center justify-center rounded-full border cursor-pointer; }
</style>
</head>

<body class="bg-gray-100 pt-28">

<div class="max-w-6xl mx-auto px-4 grid grid-cols-1 md:grid-cols-3 gap-8">

<form action="booking_success.php" method="POST" enctype="multipart/form-data" class="contents">

    <!-- ===================================================== -->
    <!-- LEFT SECTION : DETAIL PAKET + ADDONS + BACKGROUND    -->
    <!-- ===================================================== -->
    <div class="md:col-span-2 space-y-6">

        <!-- NOTIF -->
        <div class="bg-blue-50 border border-pink-200 text-pink-500 px-4 py-3 rounded-lg">
            Ini adalah halaman terakhir. Pastikan pesanan dan data terisi dengan benar.
        </div>

        <!-- DETAIL PAKET -->
        <div class="bg-white shadow rounded-xl p-5">
            <h2 class="font-bold text-lg text-pink-500 mb-4">Detail Paket</h2>

            <div class="flex items-center gap-4">
                <img src="../uploads/sample.jpg" class="w-28 h-20 rounded-lg object-cover">
                <div>
                    <p class="font-semibold text-gray-800"><?= $paket ?></p>
                    <p class="text-gray-500 text-sm">
                        <?= $tanggal ?> | <?= $jam ?>
                    </p>
                </div>
            </div>
        </div>

        <!-- ADD-ONS -->
        <div>
            <h2 class="font-bold text-lg text-pink-500 mb-3">Add-ons</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <?php
                $addons = [
                    [ "title" => "Costume", "harga" => 10000, "desc" => "Pilihan kostum: Cow, Dino, Harry Potter, etc" ],
                    [ "title" => "Keychain", "harga" => 15000, "desc" => "2 keychain (include foto)" ],
                    [ "title" => "Extra Time", "harga" => 20000, "desc" => "Penambahan waktu selama 10 menit" ],
                    [ "title" => "Extra Print", "harga" => 5000, "desc" => "Cetak foto 4R (10,2 x 15,2cm)" ],
                ];
                foreach ($addons as $a):
                ?>
                <div class="addon-card bg-white p-4 rounded-xl shadow-sm border">
                    <h3 class="font-bold text-pink-500"><?= $a['title'] ?></h3>
                    <p class="text-sm text-gray-600 mb-2">
                        Rp <?= number_format($a['harga'],0,',','.') ?>/pcs
                    </p>
                    <p class="text-xs text-gray-500 mb-4"><?= $a['desc'] ?></p>

                    <div class="flex justify-between items-center">
                        <p class="font-semibold text-gray-700">
                            Rp <span id="subtotal-<?= $a['title'] ?>">0</span>
                        </p>

                        <div class="flex items-center gap-2">
                            <div class="btn-round border-gray-300" onclick="changeQty('<?= $a['title'] ?>', -1)">−</div>
                            <span id="qty-<?= $a['title'] ?>">0</span>
                            <div class="btn-round border-gray-300" onclick="changeQty('<?= $a['title'] ?>', 1)">+</div>
                        </div>

                        <input type="hidden" name="addon_qty[<?= $a['title'] ?>]" id="input-<?= $a['title'] ?>" value="0">
                        <input type="hidden" id="price-<?= $a['title'] ?>" value="<?= $a['harga'] ?>">
                    </div>
                </div>
                <?php endforeach; ?>

            </div>
        </div>

        <!-- ========================= -->
        <!-- BACKGROUND DROPDOWN      -->
        <!-- ========================= -->
        <div class="bg-white p-5 shadow rounded-xl">
            <h3 class="font-bold text-lg text-pink-500 mb-3">Pilih Warna Background</h3>

            <select name="background" class="w-full px-3 py-3 border rounded-xl">
                <option value="Putih">Putih</option>
                <option value="Hitam">Hitam</option>
                <option value="Coksu">Coksu</option>
                <option value="Pink">Pink</option>
                <option value="Abu-abu">Abu-abu</option>
                <option value="Merah">Merah</option>
                <option value="Biru">Biru</option>
            </select>
        </div>

        <!-- ========================= -->
        <!-- CUSTOMER FORM            -->
        <!-- ========================= -->
        <div class="bg-white p-5 shadow rounded-xl">
            <h3 class="font-bold text-lg text-pink-500 mb-3">Detail Customer</h3>

            <label class="text-sm font-semibold text-gray-500">Nama</label>
            <input type="text" name="nama" required class="w-full px-3 py-2 border rounded-xl mb-3">

            <label class="text-sm font-semibold text-gray-500">Alamat</label>
            <textarea name="alamat" required class="w-full px-3 py-2 border rounded-xl mb-3"></textarea>

            <label class="text-sm font-semibold text-gray-500">Email</label>
            <input type="email" name="email" required class="w-full px-3 py-2 border rounded-xl mb-3">
        </div>


        <!-- ========================= -->
        <!-- METODE PEMBAYARAN (QRIS) -->
        <!-- ========================= -->
        <div class="bg-white p-5 shadow rounded-xl">
            <h3 class="font-bold text-lg text-pink-500 mb-4">Metode Pembayaran</h3>

            <p class="font-semibold text-gray-500 mb-3">QRIS (Scan & Pay)</p>

            <img src="assets/img/qris.png" class="w-48 mx-auto rounded-lg shadow mb-3">

            <a href="assets/img/qris.png" download class="text-pink-600 underline text-sm block text-center mb-4">
                Download QRIS
            </a>

            <label class="block mb-2 font-semibold text-pink-500">Upload Bukti Pembayaran</label>
            <input type="file" name="bukti" required accept="image/*"
                   class="w-full px-3 py-2 border rounded-xl">
        </div>

    </div>

    <!-- ===================================================== -->
    <!-- RIGHT SECTION : TOTAL                                -->
    <!-- ===================================================== -->
    <div class="bg-white shadow rounded-xl p-6 h-fit">

        <h2 class="font-bold text-lg text-pink-500 mb-3">Detail Pembayaran</h2>

        <div class="text-sm text-gray-700 border-b pb-3 mb-4">
            <p class="flex justify-between">
                <span>Paket</span>
                <span class="font-semibold"><?= $paket ?></span>
            </p>
            <p class="flex justify-between">
                <span>Harga</span>
                <span>Rp <?= number_format($harga,0,',','.') ?></span>
            </p>
        </div>

        <div class="flex justify-between font-bold text-lg text-pink-500 mb-3">
            <span>Total</span>
            <span>Rp <span id="totalDisplay"><?= number_format($harga,0,',','.') ?></span></span>
        </div>

        <input type="hidden" name="total" id="totalFinal" value="<?= $harga ?>">

        <button class="w-full bg-gray-300 hover:bg-pink-500 text-white py-3 rounded-xl font-bold mt-4">
            Bayar
        </button>

    </div>

</form>

</div>


<!-- SCRIPT HITUNG TOTAL -->
<script>
let basePrice = <?= $harga ?>;

function changeQty(name, delta) {
    let qtyEl = document.getElementById("qty-" + name);
    let price = parseInt(document.getElementById("price-" + name).value);
    let inputEl = document.getElementById("input-" + name);

    let qty = parseInt(qtyEl.innerHTML) + delta;
    if (qty < 0) qty = 0;

    qtyEl.innerHTML = qty;
    inputEl.value = qty;

    calculateTotal();
}

function calculateTotal() {
    let total = basePrice;

    document.querySelectorAll("[id^='input-']").forEach(el => {
        let qty = parseInt(el.value);
        let item = el.id.replace("input-", "");
        let price = parseInt(document.getElementById("price-" + item).value);
        total += qty * price;
    });

    document.getElementById("totalDisplay").innerHTML = total.toLocaleString("id-ID");
    document.getElementById("totalFinal").value = total;
}
</script>

</body>
</html>
