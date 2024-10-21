<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['username']) || $_SESSION['level'] != "2") {
    header("Location: index.php");
    exit;
}

if (isset($_POST['submit'])) {
    $npm = $_POST['npm'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $jk = $_POST['jk'];
    $tgl_lhr = $_POST['tgl_lhr'];
    $email = $_POST['email'];

    $query = "INSERT INTO identitas (npm, nama, alamat, jk, tgl_lhr, email) VALUES ('$npm', '$nama', '$alamat', '$jk', '$tgl_lhr', '$email')";
    if (mysqli_query($conn, $query)) {
        header("Location: tampil_data.php");
    } else {
        echo "Gagal menambah data!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Data</title>
    <link rel="stylesheet" href="css/tambah.css">
</head>
<body>
    <form method="POST" action="">
        <h2>Tambah Data</h2>
        <label for="nama">Nama</label>
        <input type="text" id="nama" name="nama" placeholder="Nama" required>
    
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Email" required>
    
        <label for="tgl_lhr">Tanggal Lahir</label>
        <input type="date" id="tgl_lhr" name="tgl_lhr" required>
    
        <label for="npm">NPM</label>
        <input type="text" id="npm" name="npm" placeholder="NPM" required>
    
        <label for="alamat">Alamat</label>
        <input type="text" id="alamat" name="alamat" placeholder="Alamat" required>
    
        <label for="jk">Jenis Kelamin</label>
        <select id="jk" name="jk">
        <option value="L">Laki-laki</option>
        <option value="P">Perempuan</option>
        </select>
    
        <button type="submit" name="submit">Tambah</button>
    </form>
</body>
</html>
