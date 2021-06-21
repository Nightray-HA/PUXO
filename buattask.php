<html>
    <head>
        <title>Buat Task</title>
        <link rel="stylesheet" type="text/css" href="css/form.css">
    </head>
    <body>
        <?php
        session_start();
        if(empty($_SESSION['username'])){
            header("Location:index.php?error=invalid");
        }
        $foto = $_SESSION['foto']; 
        $username = $_SESSION['username'];

        if(isset($_GET['error'])){
            if ($_GET['error']=="kosong"){
                echo "<script>alert('Pastikan semua kolom telah terisi')</script>";
            }
            if($_GET['error']=="alert"){
                echo "<script>alert('Data Berhasil disimpan, tak berhasil dibuat')</script>";
            }
            if($_GET['error']== "gagal"){
                echo "<script>alert('Data gagal disimpan. Pastikan foto sudah diupload dengan format .jpg, .png, atau .gif')</script>";
            }
        }
        ?>

        <div class = "wrap-head">
            <div class = "logo-puxo"><img src="img/puxo.png"></div>
            <div class = "profile">
            <a href="profil.php"><img src="profil_img/<?php echo $foto;?>"></a>
        </div>
            <div class = "menu-utama">
                <ul>
                    <li><a href="home.php">Home</a></li>
                </ul>
            </div>
        </div>
        </div>
        <div class = "black-nav">
        <section>
            <div id="login-box">
            <div class="left">
            <h1>Buat task untuk aplikasi anda</h1>
                <form action="submit_task.php" method="post" enctype="multipart/form-data">
                <input type="text"  name="judul" placeholder="Judul.." />
                <textarea name="detail" id="" style = "resize: none; width: 230px; height: 260px;" ></textarea>
            </div>
            <div class="right">
                <div class = "empty"></div>
                <span class="uploadgambar">Pilih ilustrasi task</span>
                <input type="file" name = "foto" accept="image/*"/>
                <input type="hidden" name = "tanggal" value="<?php echo date("Y-m-d");?>">
                <br>
                <br>
                <span>Kategori Task</span>
                <br>
                <input type="radio" name="kategori" value = "1"><label>Game Development</label>
                <br>
                <input type="radio" name="kategori" value = "2"><label>Mobile Programming</label>
                <br>
                <input type="radio" name="kategori" value = "3"><label>Web Programming</label>
                <br>
                <input type="radio" name="kategori" value = "4"><label>Desktop Programming</label>
                <br>
                <br>
                <input type="submit" name="task_submit" id = "submit">
            </div>
            </form>
        </section>    
    </body>
</html>''