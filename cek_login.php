<?php
include "koneksi.php";
$username = $_POST['username'];
$pass = $_POST['password'];
$query = "SELECT * FROM pengguna where username = '$username' and pass = '$pass'";

$hasil = mysqli_query($koneksi, $query);
        if(!$hasil){
            die("Query error:".mysqli_errno($koneksi)." - ".mysqli_error($koneksi));
        }

if($row = mysqli_fetch_assoc($hasil)){
    session_start();
    $_SESSION['username'] = $username;
    $_SESSION['nama'] = $row['NAMA_PENGGUNA'];

    $query = "SELECT * FROM foto_profil where username = '$username'";
        $hasil = mysqli_query($koneksi, $query);
        if(!$hasil){
            die("Query error:".mysqli_errno($koneksi)." - ".mysqli_error($koneksi));
        }
        if($row = mysqli_fetch_assoc($hasil)){
            $_SESSION['foto']= $row['NAMA_FILE'];
        }
    header("location:home.php");
}else{
    header("location:index.php?error=login");
}
?>