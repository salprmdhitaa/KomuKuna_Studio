<?php
require_once __DIR__ . '/../user/includes/db.php';

// ================== VALIDASI ID ==================
if (!isset($_GET['id'])) {
    header("Location: product_manage.php");
    exit;
}

$id = (int) $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM products WHERE id = $id");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    header("Location: product_manage.php");
    exit;
}

// ================== PROSES UPDATE ==================
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama  = $_POST['nama_paket'];
    $desk  = $_POST['deskripsi'];
    $harga = (int) $_POST['harga'];
    $max   = (int) $_POST['maksimal_orang'];

    $gambar = $data['gambar'];
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === 0) {
        $gambar = time() . '_' . basename($_FILES['gambar']['name']);
        move_uploaded_file(
            $_FILES['gambar']['tmp_name'],
            "../uploads/products/" . $gambar
        );
    }

    $stmt = $conn->prepare("
        UPDATE products SET
            nama_paket = ?,
            deskripsi = ?,
            harga = ?,
            maksimal_orang = ?,
            gambar = ?
        WHERE id = ?
    ");
    $stmt->bind_param("ssissi", $nama, $desk, $harga, $max, $gambar, $id);
    $stmt->execute();

    header("Location: product_manage.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Edit Product</title>
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
               class="block px-4 py-2 rounded bg-pink-500 font-semibold">
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

    <!-- ================= MAIN CONTENT ================= -->
    <main class="flex-1 p-8">

        <div class="max-w-xl mx-auto bg-white p-6 rounded-xl shadow">

            <h2 class="text-2xl font-bold text-pink-600 mb-6">
                Edit Product
            </h2>

            <form method="POST" enctype="multipart/form-data" class="space-y-4">

                <div>
                    <label class="block text-sm font-semibold mb-1">Nama Paket</label>
                    <input type="text" name="nama_paket" required
                           value="<?= htmlspecialchars($data['nama_paket']) ?>"
                           class="w-full border px-3 py-2 rounded-lg">
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-1">Deskripsi</label>
                    <textarea name="deskripsi"
                              class="w-full border px-3 py-2 rounded-lg"><?= htmlspecialchars($data['deskripsi']) ?></textarea>
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-1">Harga</label>
                    <input type="number" name="harga" required
                           value="<?= $data['harga'] ?>"
                           class="w-full border px-3 py-2 rounded-lg">
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-1">Maksimal Orang</label>
                    <input type="number" name="maksimal_orang" required
                           value="<?= $data['maksimal_orang'] ?>"
                           class="w-full border px-3 py-2 rounded-lg">
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-1">Gambar</label>
                    <?php if (!empty($data['gambar'])): ?>
                        <img src="../uploads/products/<?= htmlspecialchars($data['gambar']) ?>"
                             class="w-32 rounded-lg mb-2">
                    <?php endif; ?>
                    <input type="file" name="gambar" accept="image/*"
                           class="w-full border px-3 py-2 rounded-lg">
                </div>

                <div class="flex justify-between pt-4">
                    <a href="product_manage.php"
                       class="px-4 py-2 rounded-lg border text-gray-600 hover:bg-gray-100">
                        Kembali
                    </a>

                    <button type="submit"
                            class="px-6 py-2 bg-pink-500 text-white rounded-lg hover:bg-pink-600">
                        Update Product
                    </button>
                </div>

            </form>

        </div>

    </main>
</div>

</body>
</html>
