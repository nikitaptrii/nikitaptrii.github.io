<?php
session_start();
require 'db_connection.php'; // Memasukkan file koneksi database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hash password sebelum menyimpannya
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Memasukkan pengguna baru ke dalam database
    $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $hashedPassword);

    if ($stmt->execute()) {
        header('Location: login.php'); // Arahkan ke halaman login
        exit();
    } else {
        $error = "Username sudah digunakan.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f4f8;
            color: #333;
            line-height: 1.6;
        }
        
        header {
            background-color: #007BFF;
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }
        
        h1 {
            margin: 0;
        }
        
        main {
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 80vh; /* Tinggi halaman */
        }
        
        .container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            text-align: center;
            width: 300px; /* Lebar kotak */
        }
        
        .error {
            color: red;
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin: 10px 0 5px;
        }
        
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        
        .btn {
            display: inline-block;
            background-color: #007BFF;
            color: #fff;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        
        .btn:hover {
            background-color: #0056b3;
        }
        
        footer {
            text-align: center;
            padding: 20px 0;
            background-color: #f8f9fa;
            position: absolute;
            width: 100%;
            bottom: 0;
        }
    </style>
</head>
<body>
    <header>
        <h1>Daftar Pengguna Baru</h1>
    </header>
    <main>
        <div class="container">
            <?php if (isset($error)): ?>
                <p class="error"><?php echo htmlspecialchars($error); ?></p>
            <?php endif; ?>
            <form method="POST">
                <label for="username">Username:</label>
                <input type="text" name="username" required>
                <label for="password">Password:</label>
                <input type="password" name="password" required>
                <button type="submit" class="btn">Daftar</button>
            </form>
            <p>Sudah punya akun? <a href="login.php">Login di sini</a>.</p>
        </div>
    </main>
    <footer>
        <p>&copy; 2024 Web Authentikasi. All rights reserved.</p>
    </footer>
</body>
</html>
