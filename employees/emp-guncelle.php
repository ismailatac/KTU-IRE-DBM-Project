<?php 
	$con = mysqli_connect("localhost", "root", "Badem*5361", "denIRE2");
	mysqli_set_charset($con, "UTF8");
	
	$GelenIdDegeri = $_GET["id"];
	$GelenPozisyonDegeri  	= $_POST["position"];
	$GelenMaasDegeri  		= $_POST["salary"];
	$GelenHobiDegeri  		= $_POST["hobbies"];
	$GelenLisansDegeri  	= $_POST["undergraduate"];
	$GelenYuksekLisansDegeri  = $_POST["graduate"];
	$GelenDoktoraDegeri 	 = $_POST["doctorate"];
	
	$Guncelle = mysqli_query($con, "UPDATE employees SET position='$GelenPozisyonDegeri', salary='$GelenMaasDegeri' ,hobbies='$GelenHobiDegeri' , undergraduate='$GelenLisansDegeri' ,graduate='$GelenYuksekLisansDegeri' ,doctorate='$GelenDoktoraDegeri' WHERE id=" . $GelenIdDegeri);
		if($Guncelle) {
			header("Location:employees.php");
		} else {
			echo "Sorgu Hatası";
		}
	
?>