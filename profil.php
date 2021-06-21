<!DOCTYPE html>
<html>
<head>
<title>Profil</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <?php
    session_start();
    include 'koneksi.php';
    if(empty($_SESSION['username'])){
        header("Location:index.php?error=invalid");
    }
    if(isset($_GET['alert'])){
        $alert = $_GET['alert'];
        if($alert == "ambil"){
            echo "<script>alert('Berhasil mengambil Task')</script>";
        }
    }
    $foto = $_SESSION['foto']; 
    $username = $_SESSION['username'];
    ?>
    <div class = "wrap-head">
    <div class = "logo-puxo"><img src="img/puxo.png" alt=""></div>
        
        <div class = "menu-utama">
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="buattask.php">Buat Task</a></li>
            </ul>
        </div>
    </div>
    <div class = "black-nav">
    </div>
    <div class = "wrap-sidenav">
        <div class = "side-profil">
        <img src="profil_img/<?php echo $foto;?>">
        <br>
        <br>
        <h2><?php echo $_SESSION['nama']; ?></h2><!--belum selesai-->
        <br>
        <br>
        <ul>
            <li><button class = "ambil">Pekerjaan yang diambil</button></li>
            <li><button class = "buat">Pekerjaan yang dibuat</button></li>
        </ul>
        </div>
        <div class = "logout">
        <a href="logout.php"><p>Logout</p></a>
        </div>
    </div>
    <div class = "wrap-bodys">
        <div class = "konten"  id = "ambil">
            <?php
                $query = "SELECT * FROM task WHERE USERNAME = '$username' ";
                $hasil = mysqli_query($koneksi, $query);
                if(!$hasil){
                    die("Query error:".mysqli_errno($koneksi)." - ".mysqli_error($koneksi));
                }
                if($row = mysqli_fetch_assoc($hasil)){                 
            ?>
                    <table border = "1" width = "700px">
                        <thead>
                        <tr>
                            <th width = "30">No.</th>
                            <th width = "480">Judul task</th>
                            <th width = "95">Detail task</th>
                            <th width = "95">PDF</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $no = 1;
                        $query = "SELECT * FROM task WHERE USERNAME = '$username' ";
                        $hasil = mysqli_query($koneksi, $query);
                        if(!$hasil){
                            die("Query error:".mysqli_errno($koneksi)." - ".mysqli_error($koneksi));
                        }
                        while($row=mysqli_fetch_assoc($hasil)){
                            $owner = $row['PEN_USERNAME'];
                            echo '<tr>
                            <td>'.$no.'</td>
                            <td>'.$row['JUDUL_TASK'].'</td>
                            <td><center><a href="task.php?task='.$row['ID_TASK'].'&username='.$owner.'"><button>Lihat task</button></a></center></td>
                            <td><center><a href="simpanpdf.php?task='.$row['ID_TASK'].'&owner='.$owner.'"><button>Export PDF</button></a></center></td>
                        </tr>';
                        $no++; 
                        }
                        ?>
                        </tbody>
                    </table>
            <?php
                }else{
            ?>
            <h2> Tidak Ada data, Pilih pekerjaan anda di halaman utama </h2>
            <?php } ?>
        </div>
        <div class = "konten" id = "buat">
        <?php
                $query = "SELECT * FROM task WHERE PEN_USERNAME = '$username' ";
                $hasil = mysqli_query($koneksi, $query);
                if(!$hasil){
                    die("Query error:".mysqli_errno($koneksi)." - ".mysqli_error($koneksi));
                }
                if($row = mysqli_fetch_assoc($hasil)){                  
            ?>
                    <table border = "1" width = "700px">
                        <thead>
                        <tr>
                            <th width = "40">No.</th>
                            <th width = "480">Judul task</th>
                            <th width = "100">Selesaikan</th>
                            <th width = "80">Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                         $no = 1;
                         $query = "SELECT * FROM task WHERE PEN_USERNAME = '$username' ";
                         $hasil = mysqli_query($koneksi, $query);
                         if(!$hasil){
                             die("Query error:".mysqli_errno($koneksi)." - ".mysqli_error($koneksi));
                         }
                         while($row=mysqli_fetch_assoc($hasil)){
                            echo '<tr>
                            <td>'.$no.'</td>
                            <td>'.$row['JUDUL_TASK'].'</td>
                            <td><center><a href="selesai.php?task='.$row['ID_TASK'].'"><button>Selesaikan</button></a></center></td>
                            <td>';
                            if($row['TANGGAL_SELESAI'] != NULL){
                                echo "Selesai";
                            }echo '</td>';
                            
                         echo '</tr>';
                         $no++; 
                         }
                         ?>
                        </tbody>
                    </table>
                    <br>
                    <a href="simpanexcel.php"><button>Export to Excel</button></a>
            <?php
                }else{
            ?>
            <h2> Tidak Ada data, Pilih buat task terlebih dahulu </h2>
            <?php } ?>
        </div>
    </div>
</body>
<script src="jquery.js"></script><!--inisiai lokasi file library-->
<script type="text/javascript">
$(document).ready(function(){
$("#ambil").hide("fast");
$(".buat").click(function(){
    $("#ambil").hide("fast")
    $("#buat").show("fast")
    });
$(".ambil").click(function(){
    $("#buat").hide("fast")
    $("#ambil").show("fast")
    });
});
</script>

</html>