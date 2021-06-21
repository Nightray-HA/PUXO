<?php 
include'koneksi.php';
$task = $_GET['task'];
$owner = $_GET['owner'];
// Menggunakan dompdf
require_once("dompdf/autoload.inc.php");
use Dompdf\Dompdf;
$dompdf = new Dompdf ();
$hasil = mysqli_query($koneksi, "SELECT * FROM task where ID_TASK = '$task'");
$row = mysqli_fetch_assoc($hasil);
        $judul = $row['JUDUL_TASK'];
        $detail = $row['DETAIL_TASK'];
        $tanggal = $row['TANGGAL_DIBUAT'];
        $idkategori = $row['ID_KATEGORI'];
        $hasil = mysqli_query($koneksi, "SELECT * FROM KATEGORI_TASK WHERE ID_KATEGORI = '$idkategori' ");
        $row = mysqli_fetch_assoc($hasil);
        $kategori = $row['NAMA_KATEGORI'];
        $hasil = mysqli_query($koneksi, "SELECT * FROM pengguna WHERE username = '$owner' ");
        $row = mysqli_fetch_assoc($hasil);
        $telp = $row['NO_TELP'];
        $email = $row['EMAIL_PENGGUNA'];
$html = "<html><body>";
$html .= "<center><h3>Detail Pekerjaan</h3></center><hr/><br/>";
$html .= "<h4><b>Judul : ".$judul."</b></h4>
    <br>
    <p>Kategori : ".$kategori."</p>
    <p>Tanggal dibuat: ".$tanggal."</p>
    <p>Oleh : ".$owner."</p>
    <p>Kontak Owner: ".$telp." / ".$email." </p>
    <br>
    <p>".$detail."</p>";
$html .= "</body></html>";
//membuat konstruktor dompdf
$dompdf->loadHtml($html);
// Setting ukuran dan orientasi kertas
$dompdf->setPaper('A4', 'portrait');
// Rendering dari HTML ke PDF
$dompdf->render();
// Melakukan output file Pdf
$dompdf->stream('detail_pekerjaan_'.$judul.'.pdf');
?>