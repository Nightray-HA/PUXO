<!DOCTYPE html>
<html>
<head>
    <title>Task</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <?php
        session_start();
        if(empty($_SESSION['username'])){
            header("Location:index.php?error=invalid");
        }
        $foto = $_SESSION['foto']; 
    ?>
<div class = "wrap-head">
        <div class = "logo-puxo"><img src="img/puxo.png" alt=""></div>
        <div class = "profile">
            <a href="profil.php"><img src="profil_img/<?php echo $foto;?>"></a>
        </div>
        <div class = "menu-utama">
            <ul>
                <li><a href="buattask.php">Buat Task</a></li>
            </ul>
        </div>
    </div>

    <nav class = "wrap-navbar">
        <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="home.php?kategori=0">Game Development</a></li>
            <li><a href="home.php?kategori=2">Mobile Programming </a></li>
            <li><a href="home.php?kategori=1">Web Programming</a></li>
            <li><a href="home.php?kategori=3">Desktop Programming</a></li>
        </ul>
    </nav>

    <div class = "banner">
        <img src="img/banner.jpg">
    </div>


    <div class = "wrap-card">
        <?php
        include 'koneksi.php';        
        $task = $_GET['task'];
        $owner = $_GET['username']; 
        $query = "SELECT * FROM task AS a INNER JOIN foto_task AS b ON  a.ID_TASK = b.ID_TASK where  a.id_task = $task"; 
        $hasil = mysqli_query($koneksi, $query);
        if(!$hasil){
            die("Query error:".mysqli_errno($koneksi)." - ".mysqli_error($koneksi));
        }
        $row = mysqli_fetch_assoc($hasil);
        $judul = $row['JUDUL_TASK'];
        $gambar = $row['FILE_GAMBAR'];
        $detail = $row['DETAIL_TASK'];
        $tanggal = $row['TANGGAL_DIBUAT'];
        $idkategori = $row['ID_KATEGORI'];
        $hasil = mysqli_query($koneksi, "SELECT * FROM KATEGORI_TASK WHERE ID_KATEGORI = $idkategori ");
        $row = mysqli_fetch_assoc($hasil);
        $kategori = $row['NAMA_KATEGORI'];
        ?>
        <div class = "full-card">
            <img src="task_img/<?php echo $gambar;?>" alt="...">
            <div class = "text-task">
                <h4><b><?php echo $judul;?></b></h4>
                <p>Kategori : <?php echo $kategori;?></p>
                <p>Tanggal dibuat: <?php echo $tanggal;?></p>
                <p>Oleh : <?php echo $owner;?></p>
                <br>
                <p><?php echo $detail;?></p>
                </div>
            <div class = "card-link"><a href="ambil.php?task=<?php echo $task; ?>&username=<?php echo $owner;?>">Ambil Task!</a></div>
        </div>
    </div>
</body>
</html>