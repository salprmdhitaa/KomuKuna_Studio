<?php
session_start();
require_once __DIR__ . '/../includes/db.php';

$error = '';

if (isset($_POST['register'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = md5($_POST['password']);
    $role     = $_POST['role'];

    $cek = mysqli_query($conn, "SELECT id FROM users WHERE username='$username'");
    if (mysqli_num_rows($cek) > 0) {
        $error = "Username sudah digunakan!";
    } else {
        mysqli_query($conn, "
            INSERT INTO users (username, password, role)
            VALUES ('$username','$password','$role')
        ");

        $_SESSION['success'] = "Registrasi berhasil, silakan login.";
        header("Location: login.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Registrasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

<div class="bg-pink-600 w-full max-w-md p-8 rounded-xl shadow-lg text-white">
    <h2 class="text-3xl font-bold text-center mb-6">Registrasi Akun</h2>

    <?php if ($error): ?>
        <div class="bg-red-500 p-2 rounded mb-4 text-center">
            <?= $error ?>
        </div>
    <?php endif; ?>

    <form method="post" class="space-y-4">
        <input type="text" name="username" placeholder="Username"
               class="w-full px-4 py-2 rounded text-gray-800" required>

        <input type="password" name="password" placeholder="Password"
               class="w-full px-4 py-2 rounded text-gray-800" required>

        <select name="role" class="w-full px-4 py-2 rounded text-gray-800">
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select>

        <button name="register"
                class="w-full bg-white text-pink-600 font-semibold py-2 rounded hover:bg-gray-100 transition">
            Daftar
        </button>
    </form>

    <p class="text-center mt-6 text-sm">
        Sudah punya akun?
        <a href="login.php" class="underline font-semibold hover:text-gray-200">
            Login di sini
        </a>
    </p>
</div>

</body>
</html>
