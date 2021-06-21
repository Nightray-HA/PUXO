<?php  
    session_start();
    $username = $_SESSION['username'];
	include 'koneksi.php';
	require 'reportexcel/vendor/autoload.php'; //open library
	use PhpOffice\PhpSpreadsheet\Spreadsheet;
	use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

	$spreadsheet = new Spreadsheet(); //membuat objek dari konstruktor
	$sheet = $spreadsheet->getActiveSheet();
	$sheet->setCellValue('A1',	'No');
	$sheet->setCellValue('B1',	'Judul');
	$sheet->setCellValue('C1',	'Tanggal Selesai');

	$query = mysqli_query($koneksi, "SELECT * FROM task WHERE PEN_USERNAME = '$username' ");//query select data
	$i = 2;
	$no = 1;
	while($row = mysqli_fetch_array($query)){
		$sheet->setCellValue('A'.$i, $no++);
		$sheet->setCellValue('B'.$i, $row['JUDUL_TASK']);
		$sheet->setCellValue('C'.$i, $row['TANGGAL_SELESAI']);
		$i++;
	}

	$styleArray = [
		'borders' => [
			'allBorders' => [
				'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
			],
		],
	];
	$i = $i - 1;
	$sheet->getStyle('A1:AK'.$i)->applyFromArray($styleArray);

	$writer = new Xlsx($spreadsheet);
	$writer->save('List pekerjaan.xlsx');
    header("location:profil.php");
?>