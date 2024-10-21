<?php

$userName = isset($_COOKIE['username']) ? $_COOKIE['username'] : '';
$userAge = isset($_COOKIE['userage']) ? $_COOKIE['userage'] : '';
$userColor = isset($_COOKIE['usercolor']) ? $_COOKIE['usercolor'] : '';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $color = $_POST['color'];

    setcookie('username', $name, time() + (7 * 86400), "/");
    setcookie('userage', $age, time() + (7 * 86400), "/");
    setcookie('usercolor', $color, time() + (7 * 86400), "/");

    // Refresh halaman untuk menampilkan cookie yang baru diset
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Cookies</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            color: #333;
            margin: 0;
            padding: 0;
            transition: background-color 0.5s; /* Animasi perubahan warna */
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .welcome-message {
            font-size: 20px;
            color: #007BFF;
            margin-top: 10px;
        }

        form {
            margin-top: 20px;
        }

        input {
            padding: 10px;
            margin: 5px;
            width: calc(100% - 22px);
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            padding: 10px 15px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        /* Menyembunyikan form */
        .hidden {
            display: none;
        }
    </style>
</head>
<body style="background-color: <?php echo $userColor ?: '#f0f0f0'; ?>;">
    <div class="container">
        <h1>Halaman Web Sederhana dengan Cookies</h1>
        <p class="welcome-message">
            <?php if ($userName && $userAge && $userColor): ?>
                Selamat datang kembali, <?php echo htmlspecialchars($userName); ?>! Anda berusia <?php echo htmlspecialchars($userAge); ?> tahun dan warna favorit Anda adalah <?php echo htmlspecialchars($userColor); ?>.
            <?php else: ?>
                Silakan masukkan informasi Anda di bawah ini:
            <?php endif; ?>
        </p>

        <form method="post" class="<?php echo ($userName && $userAge && $userColor) ? 'hidden' : ''; ?>">
            <input type="text" name="name" placeholder="Nama Anda" required value="<?php echo htmlspecialchars($userName); ?>">
            <input type="number" name="age" placeholder="Umur Anda" required value="<?php echo htmlspecialchars($userAge); ?>">
            <input type="text" name="color" placeholder="Warna Favorit Anda" required value="<?php echo htmlspecialchars($userColor); ?>">
            <button type="submit">Simpan Informasi</button>
        </form>
    </div>
</body>
</html>
