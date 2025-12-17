<?php
include '../user/includes/db.php';
include '../user/includes/header.php';

// =============================
// Ambil paket dari URL
// =============================
$paket = $_GET['paket'] ?? null;

$paket_list = [
    "self-photo" => [
        "nama" => "Self Photo Reguler",
        "harga" => 35000,
        "deskripsi" => [
            "15 mins photo session",
            "1 Background",
            "3 Person(s)",
            "Free Photo Print (2r or 4r)",
            "Free All Property except costum",
            "Free All Soft File"
        ],
        "img" => "assets/img/self-photo.jpg"
    ],
    "self-photo-premium" => [
        "nama" => "Self Photo Premium",
        "harga" => 60000,
        "deskripsi" => [
            "30 mins photo session",
            "1 Background",
            "5 Person(s)",
            "Free Photo Print (2r or 4r)",
            "Free All Property except costum",
            "Free All Soft File"
        ],
        "img" => "assets/img/self-photo.jpg"
    ],
    "american-school" => [
        "nama" => "American School",
        "harga" => 40000,
        "deskripsi" => [
            "1 Background",
            "3 Person(s)",
            "Free vest, suit & tie",
            "Free Photo Print",
            "Free All Soft File"
        ],
        "img" => "assets/img/american-school.jpg"
    ],
    "pas-photo" => [
        "nama" => "Pas Photo Session",
        "harga" => 30000,
        "deskripsi" => [
            "Free Edit Background",
            "Free Retouch",
            "Free Photo Print (2x3, 3x4, 4x6, or 4r)",
            "Free All Soft File"
        ],
        "img" => "assets/img/pas-photo.jpg"
    ],
];

if (!$paket || !isset($paket_list[$paket])) {
    echo "<p class='text-center text-red-500 mt-20 text-xl'>Paket tidak ditemukan.</p>";
    exit;
}

$data = $paket_list[$paket];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Booking Detail - <?= $data['nama'] ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 pt-28">

<div class="max-w-6xl mx-auto px-4 grid grid-cols-1 md:grid-cols-3 gap-10 items-start">

    <!-- ================= LEFT (PAKET) ================= -->
    <div class="w-full max-w-sm">
        <div class="bg-white shadow-lg rounded-2xl overflow-hidden">
            <img src="<?= $data['img'] ?>" class="w-full h-64 object-cover">
            <div class="p-5">

                <h3 class="text-lg font-bold text-pink-500 mb-3">
                    <?= $data['nama'] ?> - Rp <?= number_format($data['harga'],0,',','.') ?>
                </h3>

                <div class="border-t my-4"></div>

                <div class="text-gray-600 text-sm space-y-1">
                    <?php foreach ($data['deskripsi'] as $d): ?>
                        <p>• <?= $d ?></p>
                    <?php endforeach; ?>
                </div>

            </div>
        </div>
    </div>

    <!-- ================= MIDDLE (FORM) ================= -->
    <form action="booking_payment.php" method="POST"
          class="bg-white shadow-md rounded-xl p-6 max-w-md">

        <h3 class="text-xl font-bold text-pink-500 mb-1">
            Pilih Tanggal & Waktu
        </h3>
        <div class="border-t my-4"></div>

        <!-- Hidden data -->
        <input type="hidden" name="paket" value="<?= $data['nama'] ?>">
        <input type="hidden" name="harga" value="<?= $data['harga'] ?>">
        <input type="hidden" name="tanggal" id="send-tanggal">
        <input type="hidden" name="jam" id="send-jam">

        <!-- Tanggal -->
        <label class="block text-sm font-semibold text-gray-600 mb-1">Tanggal</label>
        <input type="date" id="input-tanggal"
               class="w-full px-3 py-2 border rounded-lg mb-5" required>

        <!-- Jam -->
        <label class="block text-sm font-semibold text-gray-600 mb-1">Jam</label>

        <div id="jam-list" class="grid grid-cols-3 gap-3 mt-2">
            <?php
            $jam_list = [
                "09:00","09:30","10:00","10:30","11:00","11:30","12:00",
                "12:30","13:00","13:30","14:00","14:30","15:00","15:30",
                "16:00","16:30","17:00","17:30","18:00","18:30","19:00",
                "19:30","20:00"
            ];

            foreach ($jam_list as $i => $jam):
            ?>
            <label class="jam-item flex items-center gap-2 p-2 border rounded-lg cursor-pointer hover:bg-gray-50 <?= $i > 5 ? 'hidden' : '' ?>">
                <input type="radio" name="jam-radio" value="<?= $jam ?>">
                <span><?= $jam ?></span>
            </label>
            <?php endforeach; ?>
        </div>

        <button type="button" onclick="toggleJam()"
                id="btn-toggle"
                class="mt-4 text-pink-500 underline text-sm font-medium">
            Tampilkan semua jadwal
        </button>

        <button type="submit"
                id="btn-lanjut"
                disabled
                class="w-full mt-6 bg-gray-300 text-gray-600 py-3 rounded-lg font-semibold cursor-not-allowed">
            Selanjutnya
        </button>
    </form>

    <!-- ================= RIGHT (SUMMARY) ================= -->
    <div class="bg-white shadow-lg rounded-xl p-6 h-fit">
        <h3 class="text-xl font-bold text-pink-500 mb-1">Ringkasan Booking</h3>
        <div class="border-t my-4"></div>

        <p class="text-gray-600 text-sm mb-2">
            <b>Tanggal :</b> <span id="display-tanggal">Belum memilih</span>
        </p>
        <p class="text-gray-600 text-sm mb-4">
            <b>Waktu :</b> <span id="display-jam">Belum memilih</span>
        </p>

        <div class="border-t my-4"></div>

        <p class="flex justify-between font-semibold text-pink-500">
            <span>Harga Paket</span>
            <span>Rp <?= number_format($data['harga'],0,',','.') ?></span>
        </p>
    </div>

</div>

<!-- ================= SCRIPT ================= -->
<script>
let showAll = false;

function toggleJam() {
    const items = document.querySelectorAll(".jam-item");
    const btn = document.getElementById("btn-toggle");

    showAll = !showAll;
    items.forEach((el, i) => {
        if (i > 5) el.classList.toggle("hidden", !showAll);
    });

    btn.textContent = showAll
        ? "Tampilkan sedikit jadwal"
        : "Tampilkan semua jadwal";
}

const dateInput = document.getElementById("input-tanggal");
const jamRadios = document.querySelectorAll("input[name='jam-radio']");
const btnLanjut = document.getElementById("btn-lanjut");

dateInput.addEventListener("change", () => {
    document.getElementById("display-tanggal").textContent = dateInput.value;
    document.getElementById("send-tanggal").value = dateInput.value;
    checkReady();
});

jamRadios.forEach(radio => {
    radio.addEventListener("change", () => {
        document.getElementById("display-jam").textContent = radio.value;
        document.getElementById("send-jam").value = radio.value;
        checkReady();
    });
});

function checkReady() {
    if (document.getElementById("send-tanggal").value &&
        document.getElementById("send-jam").value) {

        btnLanjut.disabled = false;
        btnLanjut.classList.remove("bg-gray-300","text-gray-600","cursor-not-allowed");
        btnLanjut.classList.add("bg-pink-500","hover:bg-pink-600","text-white");
    }
}
</script>

</body>
</html>
