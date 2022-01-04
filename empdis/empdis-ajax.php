<?php
$con = mysqli_connect("localhost", "root", "Badem*5361", "denIRE2");
mysqli_set_charset($con, "UTF8");

$operation=$_GET["page"];

switch($operation) {
		case 'DelEmpDis':
		$GelenID = $_GET["ID"];
		$Sil = mysqli_query($con, "DELETE FROM employees_and_diseases WHERE ID=" . $GelenID);
		if($Sil) {
			$message = 'Kayıt silindi:::success';	
		} else {
			$message = 'Kayıt silme başarısız:::danger';
		}
		echo $message;
		break;
		
		case 'AddEmpDis':
			$GelenEmployeeID 				= $_POST["empid"];
			$GelenDiseaseID    			= $_POST["dis"];
			$GelendateGetSick 			= $_POST["hast"];
			$GelenSymptoms_id 		= $_POST["sm1"];
			$GelenSymptoms_id2 	=  $_POST["sm2"] ;
			$GelenSymptoms_id3 		= $_POST["sm3"];
			$GelenprescriptionID 		= $_POST["pr"];
		
						$Ekle = mysqli_query($con, "INSERT INTO employees_and_diseases (EmployeeID, DiseaseID, dateGetSick, Symptoms_id, Symptoms_id2, Symptoms_id3, prescriptionID)
						 values ('$GelenEmployeeID', '$GelenDiseaseID', '$GelendateGetSick', '$GelenSymptoms_id', '$GelenSymptoms_id2', '$GelenSymptoms_id3', '$GelenprescriptionID')");
						if($Ekle){
							$message='Kayıt eklendi:::success';
						}else {
							$message='Üzgünüz kayıt eklemede bir hata oluştu:::danger';
						}
		echo $message;
		break;
}
?>