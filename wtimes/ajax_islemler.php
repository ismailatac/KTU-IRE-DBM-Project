<?php
$con = mysqli_connect("localhost", "root", "Badem*5361", "denIRE2");
mysqli_set_charset($con, "UTF8");

$operation=$_GET["page"];

switch($operation) {
	case 'AddWT':
			$GelenEmployeeID = $_POST["employeeID"];
			$GelenDayID      = $_POST["dayID"];
			$GelenStartTime  = $_POST["startTime"];
			$GelenFinalTime  = $_POST["finalTime"];
				if(empty($GelenEmployeeID) or empty($GelenDayID) or empty($GelenStartTime) or empty($GelenFinalTime)) {
					$message = 'Lütfen boş alan bırakmayın:::warning';
				} else if($GelenStartTime == $GelenFinalTime) {
					$message = 'Saatleri doğru giriniz:::warning';
				}else {
					$isHave = mysqli_query($con,"SELECT wtID FROM workingTimes WHERE employeeID='$GelenEmployeeID' AND dayID='$GelenDayID'");
					$have = mysqli_fetch_row($isHave);
					if($have) {
						$message='Bu kullanıcı ve gün için çalışma saati girilmiştir:::danger';
					}else {
						$Ekle = mysqli_query($con, "INSERT INTO workingTimes (employeeID, dayID, start_Time, final_Time) values ('$GelenEmployeeID', '$GelenDayID', '$GelenStartTime', '$GelenFinalTime')");
						if($Ekle){
							$message='Kayıt eklendi:::success';
						}else {
							$message='Üzgünüz kayıt eklemede bir hata oluştu:::danger';
						}
					}
				}
		echo $message;
		break;
	
	case 'DelWT':
		$GelenwtID = $_GET["ID"];
		$Sil = mysqli_query($con, "DELETE FROM workingTimes WHERE wtID=" . $GelenwtID);
		if($Sil) {
			$message = 'Kayıt silindi:::success';	
		} else {
			$message = 'Kayıt silme başarısız:::danger';
		}
		echo $message;
		break;
}
?>