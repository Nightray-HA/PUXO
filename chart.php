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
        $username = $_SESSION['username'];
        ?>
        <div class = "wrap-head">
            <div class = "logo-puxo"><img src="img/puxo.png"></div>
            <div class = "profile">
            <a href="profil.php"><img src="profil_img/<?php echo $foto;?>"></a>
            </div>
            <div class = "menu-utama">
                <ul>
                    <li><a href="home.php">Home</a></li>
                    <li><a href="buattask.php">Buat Task</a></li>
                </ul>
            </div>
        </div>
        
        <div class = "black-nav">
        </div> 
        <div class = "wrap-bodys">
        <div class = "chart">
        <canvas id="myChart"></canvas> 
        </div>
        </div>

    <script type="text/javascript" src="Chart.js"></script>
    <script>
		var ctx = document.getElementById("myChart").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: ["Game Development", "Mobile Programming", "Web Programmming", "Desktop Programming"],
				datasets: [{
					label: '',
					data: [
                    <?php 
					$jumlah_game = mysqli_query($koneksi,"select * from task where ID_KATEGORI=1");
					echo mysqli_num_rows($jumlah_game);
					?>,
                    <?php 
					$jumlah_web = mysqli_query($koneksi,"select * from task where ID_KATEGORI=2");
					echo mysqli_num_rows($jumlah_web);
					?>,
                    <?php 
					$jumlah_mobile = mysqli_query($koneksi,"select * from task where ID_KATEGORI=3");
					echo mysqli_num_rows($jumlah_mobile);
					?>,
                    <?php 
					$jumlah_desktop = mysqli_query($koneksi,"select * from task where ID_KATEGORI=4");
					echo mysqli_num_rows($jumlah_desktop);
					?>
					],
					backgroundColor: [
					'rgba(255, 99, 132, 0.7)',
					'rgba(54, 162, 235, 0.7)',
					'rgba(255, 206, 86, 0.7)',
					'rgba(75, 192, 192, 0.7)'
					],
					borderColor: [
					'rgba(255,99,132,1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(75, 192, 192, 1)'
					],
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});
	</script>
    </body>
</html>