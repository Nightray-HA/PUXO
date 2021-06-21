<?php
include 'koneksi.php';
$task = $_GET['task'];
$tanggal = date('Y-m-d');
$query = "UPDATE task set TANGGAL_SELESAI = '$tanggal' WHERE ID_TASK = $task";
$hasil = mysqli_query($koneksi, $query);
    if(!$hasil){
        die("Query error:".mysqli_errno($koneksi)." - ".mysqli_error($koneksi));
    }
header("location:profil.php");
?>