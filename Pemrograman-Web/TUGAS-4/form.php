<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nikita Putri Prabowo | 140810230010</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Concert+One&display=swap" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&display=swap');
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: "Josefin Sans", sans-serif;
            font-optical-sizing: auto;
            font-weight: 400;
            font-style: italic;
            background-color: #F7B8C6;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            max-width: 600px;
            background-color: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .container:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.25);
        }

        h2 {
            text-align: center;
            color: #DE6034;
            margin-bottom: 30px;
            font-size: 30px;
            font-family: "Concert One", sans-serif;
            font-weight: 700;
            font-style: normal;
        }

        label {
            font-weight: bold;
            color: #555;
            margin-bottom: 10px;
            display: block;
        }

        input[type="text"], input[type="date"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 16px;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        input[type="text"]:focus, input[type="date"]:focus {
            border-color: #00796b;
            box-shadow: 0 0 8px rgba(0, 121, 107, 0.3);
        }

        .radio-label {
            font-weight: normal;
            margin-right: 20px;
            color: #555;
        }

        .radio-group {
            margin-bottom: 20px;
        }

        input[type="submit"] {
            background-color: #E2C9CF;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #DCA18F;
            transform: translateY(-2px);
        }

        .result {
            background-color: #f4c2c1;
            padding: 20px;
            border-radius: 8px;
            margin-top: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .result p {
            margin: 10px 0;
            font-size: 16px;
            color: #555;
        }
    </style>
</head>
<body>

    <div class="container">
        <?php
        // Jika form sudah di-submit, tampilkan hasil inputan
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Ambil data dari form
            $npm = $_POST['npm'];
            $nama = strtoupper($_POST['nama']); // Ubah ke huruf besar
            $alamat = strtoupper($_POST['alamat']); // Ubah ke huruf besar
            $tempat_lahir = $_POST['tempat_lahir'];
            $tanggal_lahir = $_POST['tanggal_lahir'];
            $jenis_kelamin = $_POST['jenis_kelamin'];
            $hobi = $_POST['hobi'];

            echo "<div class='result'>";
            echo "<h3>Data Mahasiswa yang Dimasukkan:</h3>";
            echo "<p><strong>NPM:</strong> $npm</p>";
            echo "<p><strong>Nama:</strong> $nama</p>";
            echo "<p><strong>Alamat:</strong> $alamat</p>";
            echo "<p><strong>Tempat Lahir:</strong> $tempat_lahir</p>";
            echo "<p><strong>Tanggal Lahir:</strong> $tanggal_lahir</p>";
            echo "<p><strong>Jenis Kelamin:</strong> $jenis_kelamin</p>";
            echo "<p><strong>Hobi:</strong> $hobi</p>";
            echo "</div>";
        } else {
        ?>

        <h2>Form Input Data Mahasiswa</h2>

        <form action="" method="POST">
            <label for="npm">NPM</label>
            <input type="text" id="npm" name="npm" placeholder="Masukan npm anda" required>

            <label for="nama">Nama</label>
            <input type="text" id="nama" name="nama" placeholder="Masukan nama anda" required>

            <label for="alamat">Alamat</label>
            <input type="text" id="alamat" name="alamat" placeholder="Masukan alamat anda" required>

            <label for="tempat_lahir">Tempat Lahir</label>
            <input type="text" id="tempat_lahir" name="tempat_lahir" placeholder="Masukan nama kota/kabupaten" required>

            <label for="tanggal_lahir">Tanggal Lahir</label>
            <input type="date" id="tanggal_lahir" name="tanggal_lahir" required>

            <label for="jenis_kelamin">Jenis Kelamin</label>
            <input type="radio" id="laki" name="jenis_kelamin" value="Laki-Laki" required>
            <label class="radio-label" for="laki">Laki-Laki</label>
            <input type="radio" id="perempuan" name="jenis_kelamin" value="Perempuan" required>
            <label class="radio-label" for="perempuan">Perempuan</label>

            <label for="hobi">Hobi:</label>
            <input type="text" id="hobi" name="hobi" placeholder="Masukan hobi anda" required>

            <input type="submit" value="Submit">
        </form>

        <?php
        }
        ?>
    </div>

</body>
</html> 