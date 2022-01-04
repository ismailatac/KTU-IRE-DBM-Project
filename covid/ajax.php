<?php
$con = mysqli_connect("localhost", "root", "", "denire");
mysqli_set_charset($con, "UTF8");

$operation=$_GET["page"];

switch($operation) {
		case 'DelEmp':
		$GelenID = $_GET["ID"];
		$Sil = mysqli_query($con, "DELETE FROM covid WHERE id=" . $GelenID);
		if($Sil) {
			$message = 'Kayıt silindi:::success';	
		} else {
			$message = 'Kayıt silme başarısız:::danger';
		}
		echo $message;
		break;
}
?>