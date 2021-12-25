<?php 
	$con = mysqli_connect("localhost", "root", "Badem*5361", "denIRE2");
	mysqli_set_charset($con, "UTF8");
	
	$GelenIdDegeri = $_GET["wtID"];
	$GelenStartTimeDegeri  = $_POST["startTime"];
	$GelenFinalTimeDegeri  = $_POST["finalTime"];
	
		if($GelenStartTime == $GelenFinalTime) {
			echo "Saatleri doğru giriniz";
		}
	$Guncelle = mysqli_query($con, "UPDATE workingTimes SET start_Time='$GelenStartTimeDegeri', final_Time='$GelenFinalTimeDegeri' WHERE wtID=" . $GelenIdDegeri);
		 if($Guncelle) {
			header("Location:workingTimes.php");
		} else {
			echo "Sorgu Hatası";
		}
?>