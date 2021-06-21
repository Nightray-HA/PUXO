<!DOCTYPE html>
<html>
<head>
    <title>Chart</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <?php
    session_start();
    include 'koneksi.php';
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
            <li><a href="home.php?kategori=1">Game Development</a></li>
            <li><a href="home.php?kategori=2">Mobile Programming </a></li>
            <li><a href="home.php?kategori=3">Web Programming</a></li>
            <li><a href="home.php?kategori=4">Desktop Programming</a></li>
            <li><a href="chart.php">Sebaran kategori task</a></li>
        </ul>
    </nav>

    <div class = "banner">
        <img src="img/banner.jpg">
    </div>

    <div class = "wrap-card">
        <?php
        include 'koneksi.php';
        if(isset($_GET['kategori'])){
            $kategori = $_GET['kategori'];
            $query = "SELECT * FROM task  AS a INNER JOIN foto_task AS b ON  a.ID_TASK = b.ID_FT where status_task = '0' and id_kategori =  $kategori  order by a.id_task desc limit 8"; 
        }else{
            $query = "SELECT * FROM task AS a INNER JOIN foto_task AS b ON  a.ID_TASK = b.ID_FT where status_task = '0' order by a.id_task desc limit 8 "; 
        }
        $hasil = mysqli_query($koneksi, $query);
        if(!$hasil){
            die("Query error:".mysqli_errno($koneksi)." - ".mysqli_error($koneksi));
        }
        while($row = mysqli_fetch_assoc($hasil)){
        ?>
        <div class = "card">
            <img class = "image-card" src="task_img/<?php echo $row['FILE_GAMBAR'];?>" alt="...">
            <div class = "text-card">
                <h4><b><?php echo $row['JUDUL_TASK'];?></b></h4>
                <p><?php echo $row['DETAIL_TASK'];?></p>
            </div>
            <div class = "card-link"><a href="task.php?task=<?php echo $row['ID_TASK'];?>&username=<?php echo $row['PEN_USERNAME']; ?>">Baca selengkapnya...</a></div>
        </div>
        <?php }?>
    </div>
</body>
</html>