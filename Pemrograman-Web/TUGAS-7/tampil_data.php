<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

$level = $_SESSION['level'];
$username = $_SESSION['username'];

if ($level == "2") {
    $query = "SELECT * FROM identitas";
} else {
    $npm = $_SESSION['npm'];
    $query = "SELECT * FROM identitas WHERE npm='$npm'";
}

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Identitas</title>
    <link rel="stylesheet" href="css/tampil_data.css">
</head>
<body>
    <h2>Data Identitas</h2>
    <a href="logout.php">Logout</a>
    <a href="input.php">Tambah Data</a>
    <table border="1">
        <tr>
            <th>NPM</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Jenis Kelamin</th>
            <th>Tanggal Lahir</th>
            <th>Email</th>
            <?php if ($level == "2") { echo "<th>Aksi</th>"; } ?>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= $row['npm'] ?></td>
                <td><?= $row['nama'] ?></td>
                <td><?= $row['alamat'] ?></td>
                <td><?= $row['jk'] ?></td>
                <td><?= $row['tgl_lhr'] ?></td>
                <td><?= $row['email'] ?></td>
                <?php if ($level == "2"): ?>
                    <td>
                        <a href="edit.php?npm=<?= $row['npm'] ?>">Edit</a> | 
                        <a href="delete.php?npm=<?= $row['npm'] ?>" onclick="return confirm('Yakin ingin menghapus data ini?');">Hapus</a>
                    </td>
                <?php endif; ?>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
