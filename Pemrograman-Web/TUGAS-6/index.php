<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Authentikasi</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Londrina+Sketch&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to right, #e7eef5, #f0f4f8);
            color: #333;
            line-height: 1.6;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            padding: 20px; 
        }

        header {
            background-color: #007BFF;
            color: #fff;
            padding: 20px 0;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
        }

        h1 {
            margin: 0;
            font-size: 2.5em;
            letter-spacing: 1px;
            font-family: "Lobster", sans-serif;
            font-weight: 400;
            font-style: normal;
        }

        main {
            flex: 1;
            display: flex;
            justify-content: center; /* Space between left and right */
            align-items: flex-start; /* Align items to the start */
            padding: 250px;
        }

        .login-container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            padding: 30px;
            text-align: center;
            width: 350px;
            transition: transform 0.3s;
            margin: 0 auto; /* Centering it horizontally */

        }

        .login-container:hover {
            transform: translateY(-5px);
        }

        .welcome {
            margin-bottom: 20px;
            font-size: 1.5em;
            color: #007BFF;
        }

        .btn {
            display: inline-block;
            background-color: #007BFF;
            color: #fff;
            padding: 12px 20px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s, transform 0.3s;
            font-size: 1em;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .btn:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        footer {
            text-align: center;
            padding: 20px 0;
            background-color: #f8f9fa;
            box-shadow: 0 -4px 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            border-radius: 10px;
        }

        footer p {
            margin: 0;
            color: #555;
        }


        @media (max-width: 600px) {
            .login-container {
                width: 90%;
            }

            h1 {
                font-size: 2em;
            }

            main {
                flex-direction: column; /* Stack items on small screens */
                align-items: center;
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>Selamat Datang di Halaman Utama</h1>
    </header>
    <main>
        <div class="login-container">
            <?php if (isset($_SESSION['username'])): ?>
                <p class="welcome">Halo, <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong>! Anda sudah login.</p>
                <a href="logout.php" class="btn">Logout</a>
            <?php else: ?>
                <p>Silakan <a href="login.php" class="btn">login</a> untuk melanjutkan.</p>
            <?php endif; ?>
        </div>
    </main>
    <footer>
        <p>&copy; 2024 Web Authentikasi. All rights reserved.</p>
    </footer>
</body>
</html>
