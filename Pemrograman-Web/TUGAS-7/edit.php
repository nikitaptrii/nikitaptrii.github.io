<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['username']) || $_SESSION['level'] != "2") {
    header("Location: index.php");
    exit;
}

$npm = $_GET['npm'];
$query = "SELECT * FROM identitas WHERE npm='$npm'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $jk = $_POST['jk'];
    $tgl_lhr = $_POST['tgl_lhr'];
    $email = $_POST['email'];

    $updateQuery = "UPDATE identitas SET nama='$nama', alamat='$alamat', jk='$jk', tgl_lhr='$tgl_lhr', email='$email' WHERE npm='$npm'";

    if (mysqli_query($conn, $updateQuery)) {
        header("Location: tampil_data.php"); 
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Identitas</title>
    <link rel="stylesheet" href="css/edit.css">
</head>
<body>
    
    <form method="post">
        <h2 style="margin-bottom: 10px;">Edit Identitas</h2>
        <label for="nama">Nama</label>
        <input type="text" name="nama" value="<?= $row['nama'] ?>" required>
        <br>
        <label for="alamat">Alamat</label>
        <input type="text" name="alamat" value="<?= $row['alamat'] ?>" required>
        <br>
        <label for="jk">Jenis Kelamin</label>
        <select name="jk" required>
            <option value="L" <?= $row['jk'] == 'L' ? 'selected' : '' ?>>Laki-laki</option>
            <option value="P" <?= $row['jk'] == 'P' ? 'selected' : '' ?>>Perempuan</option>
        </select>
        <br>
        <label for="tgl_lhr">Tanggal Lahir</label>
        <input type="date" name="tgl_lhr" value="<?= $row['tgl_lhr'] ?>" required>
        <br>
        <label for="email">Email</label>
        <input type="email" name="email" value="<?= $row['email'] ?>" required>
        <br>
        <input type="submit" value="Update">
        <a  class="kembali-container" href="tampil_data.php">Kembali</a>
    </form>
</body>
</html>
