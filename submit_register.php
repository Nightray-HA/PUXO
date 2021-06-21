<?php
$valid = 0;
    if(empty($_POST["username"])){
        header("location:register.php?error=kosong");
    }else{
        $username = cek_input($_POST["username"]);
        if(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
            header("location:register.php?error=username");
        }else{
            $valid++;
        }
    }

    if(empty($_POST["nama"])){
        header("location:register.php?error=kosong");
    }else{
        $nama = cek_input($_POST["nama"]);
        if(!preg_match("/^[a-zA-Z ]*$/", $nama)){
            header("location:register.php?error=nama");
        }else{
            $valid++;
        }
    }

    if(empty($_POST["email"])){
        header("location:register.php?error=kosong");
    }else{
        $email = cek_input($_POST["email"]);
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            header("location:register.php?error=email");
        }else{
            $valid++;
        }
    }

    if(empty($_POST["alamat"])){
        header("location:register.php?error=kosong");
    }

    if(empty($_POST["telp"])){
        header("location:register.php?error=kosong");
    }else{
        $telp = cek_input($_POST["telp"]);
        if(!is_numeric($telp)){
            header("location:register.php?error=telp");
        }else{
            $valid++;
        }
    }

    if(empty($_POST["password"])){
        header("location:register.php?error=kosong");
    }else{
        $password = cek_input($_POST["password"]);
        if(!preg_match("/^[a-zA-Z0-9]*$/", $password)){
            header("location:register.php?error=pass");
        }else{
            $valid++;
        }
    }
    function cek_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
if($valid >= 5 ){
include 'koneksi.php';
$username = $_POST['username'];
$nama = $_POST['nama'];
$email = $_POST['email'];
$telp = $_POST['telp'];
$pass = $_POST['password'];
$alamat = $_POST['alamat'];
$foto = $_FILES['foto']['name'];
$x = explode('.',$foto);
$ekstensi = strtolower(end($x));
$file_tmp = $_FILES['foto']['tmp_name'];
$ekstensi_acc = array('jpg','jpeg','png','gif');

if(in_array($ekstensi, $ekstensi_acc)===true){
    move_uploaded_file($file_tmp, 'profil_img/'.$foto);
    $query = "INSERT INTO pengguna VALUES('$username','$nama','$email','$pass','$telp','$alamat')";
    $hasil = mysqli_query($koneksi, $query);
        if(!$hasil){
            die("Query error:".mysqli_errno($koneksi)." - ".mysqli_error($koneksi));
        }
    $query = "INSERT INTO foto_profil SET NAMA_FILE= '$foto', USERNAME = '$username' ";
    $hasil = mysqli_query($koneksi, $query);
        if(!$hasil){
            die("Query error:".mysqli_errno($koneksi)." - ".mysqli_error($koneksi));
        }
    header("location:index.php?alert=register");
}else{
    header("location:register.php?error=gagal");
}
}
?>