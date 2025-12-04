<?php 
include '../user/includes/db.php'; 
include '../user/includes/header.php'; 

// ===== Ambil paket dari URL =====
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

// Jika paket tidak valid
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

    <!-- ================== LEFT: Paket Detail ================== -->
    <div class="w-full max-w-sm">
        <div class="bg-white shadow-lg rounded-2xl overflow-hidden">
            <img src="<?= $data['img'] ?>" class="w-full h-64 object-cover">
            <div class="p-5">

                <h3 class="text-lg font-bold text-pink-500 mb-3">
                    <?= $data['nama'] ?> - Rp. <?= number_format($data['harga'],0,',','.') ?>
                </h3>

                <div class="w-full h-px bg-gray-200 mb-4"></div>

                <div class="text-gray-600 text-sm mb-6">
                    <?php foreach ($data['deskripsi'] as $d): ?>
                        <p class="mb-1"><?= $d ?></p>
                    <?php endforeach; ?>
                </div>

            </div>
        </div>
    </div>

    
    <!-- ================= MIDDLE: Pilih Tanggal & Jam ================= -->
    <div class="bg-white shadow-md rounded-xl p-6 max-w-md">

        <h3 class="text-xl font-bold mb-1 text-pink-500">
            Pilih tanggal dan waktu
        </h3>
        <div class="w-full h-px bg-gray-200 mb-4 mt-3"></div>

        <!-- Tanggal -->
        <label class="block mt-4 text-sm font-semibold mb-1 text-gray-600">Tanggal</label>
        <input type="date" name="tanggal" 
               class="w-full px-3 py-2 border rounded-lg mb-5">

        <!-- Jam -->
        <label class="block text-sm font-semibold mb-1 text-gray-600">Jam</label>

        <div id="jam-list" class="grid grid-cols-3 gap-3 mt-2">

            <?php 
            $jam_list = ["09:00","09:30","10:00","10:30","11:00","11:30","12:00",
                         "12:30","13:00","13:30","14:00","14:30","15:00","15:30",
                         "16:00","16:30","17:00","17:30","18:00","18:30","19:00",
                         "19:30","20:00"];

            $counter = 0;
            foreach ($jam_list as $jam):
            ?>

            <label class="jam-item flex items-center gap-2 p-2 border rounded-lg cursor-pointer hover:bg-gray-50
                <?= $counter > 5 ? 'hidden' : '' ?>">
                <input type="radio" name="jam" value="<?= $jam ?>">
                <span><?= $jam ?></span>
            </label>

            <?php $counter++; endforeach; ?>

        </div>

        <button onclick="toggleJam()" 
                id="btn-toggle"
                class="mt-4 text-pink-500 underline text-sm font-medium">
            Tampilkan semua jadwal
        </button>

    </div>


    <!-- ================= RIGHT: Ringkasan Booking ================= -->
    <div class="bg-white shadow-lg rounded-xl p-6 h-fit">

        <h3 class="text-xl font-bold mb-1 text-pink-500">Tanggal dan Waktu Booking</h3>
        <div class="w-full h-px bg-gray-200 mb-4 mt-3"></div>

        <p class="text-gray-600 text-sm mb-3">
            <span class="font-semibold">Tanggal :</span> 
            <span id="display-tanggal">Belum memilih</span>
        </p>

        <p class="text-gray-600 text-sm mb-3">
            <span class="font-semibold">Waktu :</span> 
            <span id="display-jam">Belum memilih</span>
        </p>

        <div class="w-full h-px bg-gray-200 my-4"></div>

        <p class="flex justify-between text-pink-500 font-semibold mb-5">
            <span>Harga paket</span>
            <span>Rp <?= number_format($data['harga'],0,',','.') ?></span>
        </p>

        <form action="booking_payment.php" method="POST" id="form-lanjut">

            <input type="hidden" name="paket" value="<?= $data['nama'] ?>">
            <input type="hidden" name="harga" value="<?= $data['harga'] ?>">

            <input type="hidden" name="tanggal" id="send-tanggal">
            <input type="hidden" name="jam" id="send-jam">

            <button class="w-full bg-gray-300 text-gray-600 py-3 rounded-lg font-semibold cursor-not-allowed" 
                id="btn-lanjut" disabled>
                Selanjutnya
            </button>

        </form>

    </div>
</div>



<!-- ================= SCRIPT ================= -->
<script>
let showAll = false;

function toggleJam() {
    const items = document.querySelectorAll(".jam-item");
    const btnToggle = document.getElementById("btn-toggle");

    if (!showAll) {
        items.forEach(el => el.classList.remove("hidden"));
        btnToggle.textContent = "Tampilkan sedikit jadwal";
        showAll = true;
    } else {
        let count = 0;
        items.forEach(el => {
            if (count > 5) el.classList.add("hidden");
            count++;
        });
        btnToggle.textContent = "Tampilkan semua jadwal";
        showAll = false;
    }
}


const dateInput = document.querySelector("input[name='tanggal']");
const jamInputs = document.querySelectorAll("input[name='jam']");
const dispTanggal = document.getElementById("display-tanggal");
const dispJam = document.getElementById("display-jam");
const btnLanjut = document.getElementById("btn-lanjut");

dateInput.addEventListener("change", () => {
    dispTanggal.textContent = dateInput.value;
    applyReady();
});

jamInputs.forEach(j => {
    j.addEventListener("change", () => {
        dispJam.textContent = j.value;
        applyReady();
    });
});

function applyReady() {
    if (dateInput.value && dispJam.textContent !== "Belum memilih") {

        document.getElementById("send-tanggal").value = dateInput.value;
        document.getElementById("send-jam").value = dispJam.textContent;

        btnLanjut.disabled = false;
        btnLanjut.classList.remove("bg-gray-300","text-gray-600","cursor-not-allowed");
        btnLanjut.classList.add("bg-pink-500","hover:bg-pink-600","text-white","cursor-pointer");
    }
}
</script>

</body>
</html>
