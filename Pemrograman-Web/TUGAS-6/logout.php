<?php
session_start();
session_destroy(); // Hapus semua session
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to right, #f0f4f8, #e7eef5);
            color: #333;
            line-height: 1.6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            padding: 30px;
            text-align: center;
            width: 300px; /* Lebar kotak */
        }

        h1 {
            font-size: 1.5em;
            margin-bottom: 20px;
        }

        p {
            margin-bottom: 20px;
            font-size: 1em;
            color: #555;
        }

        .btn {
            display: inline-block;
            background-color: #007BFF;
            color: #fff;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s, transform 0.3s;
            font-size: 1em;
        }

        .btn:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Logout Berhasil!</h1>
        <p>Anda telah berhasil keluar dari akun Anda.</p>
        <p><a href="login.php" class="btn">Kembali ke Halaman Login</a></p>
    </div>
</body>
</html>
