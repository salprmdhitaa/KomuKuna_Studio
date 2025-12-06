<?php 
include '../user/includes/db.php'; 
include '../user/includes/header.php'; 

// ==================================================
// VALIDASI DATA DARI booking_detail.php
// ==================================================
$paket      = $_POST['paket'] ?? "";
$harga      = isset($_POST['harga']) ? (int)$_POST['harga'] : 0;
$tanggal    = $_POST['tanggal'] ?? "";
$jam        = $_POST['jam'] ?? "";

// Jika ada yang kosong → redirect balik
if ($paket == "" || $harga == 0 || $tanggal == "" || $jam == "") {
    echo "<script>
            alert('Akses tidak valid! Data paket tidak lengkap.');
            window.location.href='booking.php';
          </script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Payment - <?= htmlspecialchars($paket) ?></title>
<script src="https://cdn.tailwindcss.com"></script>

<style>
    .addon-card { transition: 0.2s; }
    .addon-card:hover { transform: translateY(-3px); }
</style>
</head>

<body class="bg-gray-100 pt-28">

<div class="max-w-6xl mx-auto px-4 grid grid-cols-1 md:grid-cols-3 gap-8">

<form action="./booking_success.php" method="POST" enctype="multipart/form-data">


    <!-- ============================================ -->
    <!-- DATA YANG HARUS DIKIRIM -->
    <!-- ============================================ -->
    <input type="hidden" name="paket" value="<?= $paket ?>">
    <input type="hidden" name="harga" value="<?= $harga ?>">
    <input type="hidden" name="tanggal" value="<?= $tanggal ?>">
    <input type="hidden" name="jam" value="<?= $jam ?>">

    <!-- LEFT SECTION -->
    <div class="md:col-span-2 space-y-6">

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

        <!-- ADD ONS -->
        <div>
            <h2 class="font-bold text-lg text-pink-500 mb-3">Add-ons</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <?php
            $addons = [
                [ "title" => "Costume", "harga" => 10000, "desc" => "Pilihan kostum" ],
                [ "title" => "Keychain", "harga" => 15000, "desc" => "2 keychain (include foto)" ],
                [ "title" => "Extra Time", "harga" => 20000, "desc" => "Penambahan 10 menit" ],
                [ "title" => "Extra Print", "harga" => 5000, "desc" => "Cetak foto 4R" ],
            ];
            foreach ($addons as $a):
            ?>
                <div class="addon-card bg-white p-4 rounded-xl shadow-sm border">
                    <h3 class="font-bold text-pink-500"><?= $a['title'] ?></h3>
                    <p class="text-sm text-gray-600 mb-2">
                        Rp <?= number_format($a['harga'],0,',','.') ?>
                    </p>

                    <div class="flex justify-between items-center">
                        <p class="font-semibold text-gray-700">Rp <span id="subtotal-<?= $a['title'] ?>">0</span></p>

                        <div class="flex items-center gap-2">
                            <div onclick="changeQty('<?= $a['title'] ?>', -1)" class="w-8 h-8 flex justify-center items-center bg-gray-200 rounded-full cursor-pointer">-</div>
                            <span id="qty-<?= $a['title'] ?>">0</span>
                            <div onclick="changeQty('<?= $a['title'] ?>', 1)" class="w-8 h-8 flex justify-center items-center bg-gray-200 rounded-full cursor-pointer">+</div>
                        </div>

                        <input type="hidden" name="addon_qty[<?= $a['title'] ?>]" id="input-<?= $a['title'] ?>" value="0">
                        <input type="hidden" id="price-<?= $a['title'] ?>" value="<?= $a['harga'] ?>">
                    </div>
                </div>
            <?php endforeach; ?>

            </div>
        </div>

        <!-- BACKGROUND -->
        <div class="bg-white shadow rounded-xl p-5">
            <h3 class="font-bold text-lg text-pink-500 mb-3">Pilih Background</h3>
            <select name="background" class="w-full px-3 py-2 border rounded-xl">
                <option value="Putih">Putih</option>
                <option value="Hitam">Hitam</option>
                <option value="Coksu">Coksu</option>
                <option value="Pink">Pink</option>
                <option value="Abu-abu">Abu-abu</option>
                <option value="Merah">Merah</option>
                <option value="Biru">Biru</option>
            </select>
        </div>

        <!-- CUSTOMER DATA -->
        <div class="bg-white shadow rounded-xl p-5">
            <h3 class="font-bold text-lg text-pink-500 mb-3">Detail Customer</h3>

            <label>Nama</label>
            <input type="text" name="nama" required class="w-full px-3 py-2 border rounded-xl mb-3">

            <label>Alamat</label>
            <textarea name="alamat" required class="w-full px-3 py-2 border rounded-xl mb-3"></textarea>

            <label>Email</label>
            <input type="email" name="email" required class="w-full px-3 py-2 border rounded-xl mb-3">
        </div>

        <!-- PAYMENT -->
        <div class="bg-white shadow rounded-xl p-5">
            <h3 class="font-bold text-lg text-pink-500 mb-4">Metode Pembayaran</h3>

            <p>Scan QRIS di bawah:</p>
            <img src="assets/img/qris.png" class="w-48 mx-auto rounded-lg shadow mb-3">

            <label>Upload Bukti Pembayaran</label>
            <input type="file" name="bukti" accept="image/*" required class="w-full px-3 py-2 border rounded-xl mt-2">
        </div>

    </div>

    <!-- RIGHT SIDE: TOTAL -->
    <div class="bg-white shadow rounded-xl p-6 h-fit">
        <h2 class="font-bold text-lg text-pink-500 mb-3">Detail Pembayaran</h2>

        <p class="text-sm">Paket: <b><?= $paket ?></b></p>
        <p class="text-sm mb-4">Harga: Rp <?= number_format($harga,0,',','.') ?></p>

        <div class="flex justify-between text-lg font-bold text-pink-500">
            <span>Total</span>
            <span>Rp <span id="totalDisplay"><?= number_format($harga,0,',','.') ?></span></span>
        </div>

        <input type="hidden" name="total" id="totalFinal" value="<?= $harga ?>">

        <button type="submit" class="w-full bg-pink-500 hover:bg-pink-600 text-white py-3 rounded-xl font-bold mt-4">
            Bayar
        </button>
    </div>

</form>

</div>

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
