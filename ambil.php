<?php
session_start();
include 'koneksi.php';
$task = $_GET['task'];
$username = $_SESSION['username'];
$query = "UPDATE task set USERNAME = '$username', STATUS_TASK = '1' WHERE ID_TASK = $task";
$hasil = mysqli_query($koneksi, $query);
    if(!$hasil){
        die("Query error:".mysqli_errno($koneksi)." - ".mysqli_error($koneksi));
    }
header("location:profil.php?alert=ambil");
//BELUM SELESAI
?>