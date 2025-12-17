<?php
session_start();
require_once __DIR__ . '/../includes/db.php';

$error = '';
$success = '';

if (isset($_SESSION['success'])) {
    $success = $_SESSION['success'];
    unset($_SESSION['success']);
}

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = md5($_POST['password']);

    $query = mysqli_query($conn, "
        SELECT * FROM users 
        WHERE username='$username' AND password='$password'
    ");

    if (mysqli_num_rows($query) === 1) {
        $user = mysqli_fetch_assoc($query);

        $_SESSION['login']  = true;
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role']   = $user['role'];

       if ($user['role'] === 'admin') {
            header("Location: ../admin/admin_dashboard.php");
        } else {
            header("Location: ../index.php");
        }
        exit;

    } else {
        $error = "Username atau password salah!";
    }
}
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

<div class="bg-pink-600 w-full max-w-md p-8 rounded-xl shadow-lg text-white">
    <h2 class="text-3xl font-bold text-center mb-6">KomuKuna Studio</h2>

    <?php if ($error): ?>
        <div class="bg-red-500 p-2 rounded mb-4 text-center">
            <?= $error ?>
        </div>
    <?php endif; ?>

    <form method="post" class="space-y-4">
        <input type="text" name="username" placeholder="Username"
               class="w-full px-4 py-2 rounded text-gray-800 focus:outline-none" required>

        <input type="password" name="password" placeholder="Password"
               class="w-full px-4 py-2 rounded text-gray-800 focus:outline-none" required>

        <button name="login"
                class="w-full bg-white text-pink-600 font-semibold py-2 rounded hover:bg-gray-100 transition">
            Login
        </button>
    </form>

    <p class="text-center mt-6 text-sm">
        Belum punya akun?
        <a href="register.php" class="underline font-semibold hover:text-gray-200">
            Registrasi di sini
        </a>
    </p>
</div>

</body>
</html>
