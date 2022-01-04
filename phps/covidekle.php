<?php
 if(!empty($_POST['eID']) && !empty($_POST['cpoz']) && !empty($_POST['asis']))
 {
		include("baglan.php");
	 $Sorgu = mysqli_query($con,"INSERT INTO covid(employee_id, covid_positive_date,covid_negative_date, symptom_id, symptom_id2, symptom_id3, vaccinated_before, vaccine_id) VALUES (".$_POST['eID'].",'".$_POST['cpoz']."','".$_POST['cneg']."',".$_POST['sympt1'].",".$_POST['sympt2'].",".$_POST['sympt3'].",".$_POST['asis'].",".$_POST['asi'].")") or die("Sorgu Bulunamadı").mysqli_error();
	 echo("basarili");
 }
else{
	echo "hata";
	
}


?>