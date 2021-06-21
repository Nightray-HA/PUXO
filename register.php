<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Register Account</title>
        <link rel="stylesheet" href="css/form.css"> 
    </head>
    <body>
    <?php
        $alert = "";
        if(isset($_GET['error'])){
            $alert = $_GET['error'];
        }
        if($alert == "gagal"){
            echo "<script>alert('Data gagal disimpan. Pastikan foto sudah diupload dengan format .jpg, .png, atau .gif')</script>";
        }
        if($alert == "kosong"){
            echo "<script>alert('Data gagal disimpan. Pastikan semua form telah diisi')</script>";
        }
        if($alert == "username"){
            echo "<script>alert('Username hanya boleh diisi dengan huruf dan angka')</script>";
        }
        if($alert == "nama"){
            echo "<script>alert('Nama hanya boleh diisi huruf dan spasi')</script>";
        }
        if($alert == "telp"){
            echo "<script>alert('Nomor telepon/HP hanya boleh angka')</script>";
        }
        if($alert == "email"){
            echo "<script>alert('Format email salah, harap isi dengan benar!')</script>";
        }
        if($alert == "pass"){
            echo "<script>alert('Password hanya oleh diisi huruf dan angka')</script>";
        }

    ?>
        <div class = "wrap-head">
            <div class = "logo-puxo">
                <a href="index.php"><img src="img/puxo.png" alt=""></a>
            </div>
        </div>
        <section>
            <div id="login-box">
            <div class="left">
            <h1>Sign up</h1>
                <form action="submit_register.php" method="post" enctype="multipart/form-data" onSubmit="validasi()">
                <input type="text" id = "username" name="username" maxlength = "16" placeholder="Username" />
                <input type="text" id = "nama" name="nama" maxlength = "20" placeholder="Nama Lengkap" />
                <input type="email" id = "email" name="email" maxlength = "30" placeholder="E-mail" />
                <input type="text" id = "alamat" name="alamat" placeholder="alamat" />
                <input type="text" id = "telp" name="telp" maxlength = "15" placeholder="no. telp/hp" />
                <input type="password" id = "password" name="password" maxlength = "16" placeholder="Password" /> 
            
            <input type="submit" name="signup_submit" id = "submit" value="Sign me up"/>
            <p class="message">Already have an account? <a href="index.php">Login here</a></p>
            </div>
            <div class="right">
                <span class="uploadgambar">Pilih foto anda</span>
                <input type="file" name = "foto" accept="image/*"/>
            </div>
            </form>
        </section>
    </body>
</html>