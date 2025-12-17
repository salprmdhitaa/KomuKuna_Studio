<?php
session_start();
require_once __DIR__ . '/includes/db.php';

// ================================
// Cegah akses langsung
// ================================
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.php");
    exit;
}

// ================================
// Ambil & amankan data POST
// ================================
$paket_nama      = $_POST['paket_nama'] ?? '';
$tanggal_booking = $_POST['tanggal_booking'] ?? '';
$jam_booking     = $_POST['jam_booking'] ?? '';
$background      = $_POST['background'] ?? '';
$nama_pemesan    = $_POST['nama_pemesan'] ?? '';
$alamat          = $_POST['alamat'] ?? '';
$email           = $_POST['email'] ?? '';

// ✅ ADD-ONS → JSON (FIX UTAMA)
$addons_array = $_POST['addons'] ?? [];
$addons       = json_encode($addons_array, JSON_UNESCAPED_UNICODE);

// ✅ TOTAL (BUKAN harga)
$total = isset($_POST['total']) ? (int)$_POST['total'] : 0;

// ================================
// Upload bukti pembayaran
// ================================
$bukti_pembayaran = null;
$upload_dir = "../uploads/";

if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

if (
    isset($_FILES['bukti_pembayaran']) &&
    $_FILES['bukti_pembayaran']['error'] === 0
) {
    $ext = pathinfo($_FILES['bukti_pembayaran']['name'], PATHINFO_EXTENSION);
    $file_name = time() . '_' . uniqid() . '.' . $ext;

    move_uploaded_file(
        $_FILES['bukti_pembayaran']['tmp_name'],
        $upload_dir . $file_name
    );

    $bukti_pembayaran = $file_name;
}

// ================================
// Simpan ke Database (AMAN)
// ================================
$sql = "INSERT INTO bookings (
    paket_nama,
    tanggal_booking,
    jam_booking,
    background,
    nama_pemesan,
    alamat,
    email,
    addons,
    total,
    bukti_pembayaran,
    status
) VALUES (?,?,?,?,?,?,?,?,?,?, 'pending')";

$stmt = $conn->prepare($sql);

// 🔥 JUMLAH TIPE = JUMLAH VARIABEL (10)
$stmt->bind_param(
    "ssssssssis", // ✅ BENAR (10 TYPE)
    $paket_nama,
    $tanggal_booking,
    $jam_booking,
    $background,
    $nama_pemesan,
    $alamat,
    $email,
    $addons,
    $total,
    $bukti_pembayaran
);

$stmt->execute();

// ================================
// Redirect sukses
// ================================
header("Location: booking_success_page.php");
exit;
