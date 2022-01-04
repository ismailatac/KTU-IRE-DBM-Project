<?php 
	$con = mysqli_connect("localhost", "root", "Badem*5361", "denIRE2");
	mysqli_set_charset($con, "UTF8");
	
	$GelenIdDegeri = $_GET["id"];
	$GelenPozisyonDegeri  	= $_POST["sm1"];
	$GelenMaasDegeri  		= $_POST["sm2"];
	$GelenHobiDegeri  		= $_POST["sm3"];
	$GelenLisansDegeri  	= $_POST["pr"];
	
	
	$Guncelle = mysqli_query($con, "UPDATE employees_and_diseases SET Symptoms_id='$GelenPozisyonDegeri', Symptoms_id2='$GelenMaasDegeri' ,Symptoms_id3='$GelenHobiDegeri' , prescriptionID='$GelenLisansDegeri'   WHERE id=" . $GelenIdDegeri);
		if($Guncelle) {
			header("Location:empdis.php");
		} else {
			echo "Sorgu Hatası";
		}
?>