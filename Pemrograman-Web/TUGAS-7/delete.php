<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['username']) || $_SESSION['level'] != "2") {
    header("Location: index.php");
    exit;
}

if (isset($_GET['npm'])) {
    $npm = $_GET['npm'];
    $query = "DELETE FROM identitas WHERE npm='$npm'";
    if (mysqli_query($conn, $query)) {
        header("Location: tampil_data.php");
    } else {
        echo "Gagal menghapus data!";
    }
}
?>
    