<?php
session_start();
$valid = 0;
if(empty($_POST["judul"])){
    header("location:buattask.php?error=kosong");
}else{
    $valid++;
}
if(empty($_POST["detail"])){
    header("location:buattask.php?error=kosong");
}else{
    $valid++;
}
if(empty($_POST["kategori"])){
    header("location:buattask.php?error=kosong");
}else{
    $valid++;
}

if($valid>=3){
include 'koneksi.php';
$username = $_SESSION['username'];
$kategori = $_POST['kategori'];
$judul = $_POST['judul'];
$detail = $_POST['detail'];
$tanggal= $_POST['tanggal'];
$foto = $_FILES['foto']['name'];
$x = explode('.',$foto);
$ekstensi = strtolower(end($x));
$file_tmp = $_FILES['foto']['tmp_name'];
$ekstensi_acc = array('jpg','jpeg','png','gif');

if(in_array($ekstensi, $ekstensi_acc)===true){
    move_uploaded_file($file_tmp, 'task_img/'.$foto);
    $query = "INSERT INTO task SET PEN_USERNAME = '$username', ID_KATEGORI = $kategori , JUDUL_TASK = '$judul', DETAIL_TASK = '$detail', TANGGAL_DIBUAT = '$tanggal', STATUS_TASK = '0' ";
    $hasil = mysqli_query($koneksi, $query);
        if(!$hasil){
            die("Query error:".mysqli_errno($koneksi)." - ".mysqli_error($koneksi));
        }
    $query = "SELECT ID_TASK FROM task where status_task = '0' order by id_task desc limit 1";
    $id = "";
    $hasil = mysqli_query($koneksi, $query);
    if(!$hasil){
        die("Query error:".mysqli_errno($koneksi)." - ".mysqli_error($koneksi));
    }
    if($row = mysqli_fetch_assoc($hasil)){
        $id = $row['ID_TASK'];
    }   
    $query = "INSERT INTO foto_task SET FILE_GAMBAR= '$foto', ID_TASK = '$id' ";
    $hasil = mysqli_query($koneksi, $query);
        if(!$hasil){
            die("Query error:".mysqli_errno($koneksi)." - ".mysqli_error($koneksi));
        }
    header("location:buattask.php?error=alert");
}else{
    header("location:buattask.php?error=gagal");
}
}

?>