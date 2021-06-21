<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PUXO</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
  <?php
  session_start();
  if(empty($_SESSION['username'])){
    $alert = "";
    if(isset($_GET['error'])){
      $alert = $_GET['error'];
    }
    if($alert == "invalid"){
      echo "<script>alert('Anda harus login terlebih dahulu')</script>";
    }else if($alert == "login"){
      echo "<script>alert('Password atau Username yang anda masukkan salah')</script>";
    }else if($alert == "register"){
      echo "<script>alert('Berhasil Register')</script>";
    }else if($alert == "invalid"){
      echo "<script>alert('Silakan login terlebih dahulu')</script>";
    }
  }else{
    header("location:home.php");
  }
 
  ?>
    <div class = "wrap-head">
      <div class = "logo-puxo">
        <a href="index.php"><img src="img/puxo.png" alt=""></a>
      </div>
    </div>
    <br>
    <h1 class = "text">Cari programmermu disini dan kerjakan job programmermu sekarang</h1>
    <div class="login-page">
        <div class="form">
          <form class="login-form" method = "POST" action = "cek_login.php">
            <input type="text" name = "username" id = "username" placeholder="username" maxlength = "16"/>
            <input type="password" name = "password" id = "username" placeholder="password"  maxlength = "16"/>
            <button type = "submit" name = "login">Login</button>
            <p class="message">Not registered? <a href="register.php">Create an account</a></p>
          </form>
        </div>
    </div>
</body>
</html>