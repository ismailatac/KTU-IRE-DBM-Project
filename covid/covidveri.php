<?php
	ob_start();
	if(!empty($_POST["id"]))
	{
		$id=$_POST["id"];
		include("../phps/baglan.php");
		$Sorgu = mysqli_query($con,"select * from symptoms") or die("Sorgu Bulunamadı").mysqli_error();
		$veri='<form action="../phps/covidekle.php" method="post">
  <label for="eID">Eleman ID</label>
  <input type="text" id="eID" name="eID" value="'.$id.'" readonly><br><br>
  <label for="cpoz">COVID Positif Tarihi</label>
  <input type="date" id="cpoz" name="cpoz" min="2019-01-01"><br><br>
  <label for="cneg">COVID Negatif Tarihi</label>
  <input type="date" id="cneg" name="cneg" min="2019-01-01"><br><br>
  <label for="sympt1">Symptom 1</label>
  <select id="sympt1" name="sympt1">';
  while($row=mysqli_fetch_assoc($Sorgu)){ 
	$veri.='<option value="'.$row['symptom_id'].'">'.$row['symptom_name'].'</option>';
  }
  $veri.='</select><br><br><label for="sympt2">Symptom 2</label>
  <select id="sympt2" name="sympt2">';
  $Sorgu = mysqli_query($con,"select * from symptoms") or die("Sorgu Bulunamadı").mysqli_error();
  while($row=mysqli_fetch_assoc($Sorgu)){ 
	$veri.='<option value="'.$row['symptom_id'].'">'.$row['symptom_name'].'</option>';
  }
  $veri.='</select><br><br><label for="sympt3">Symptom 3</label>
  <select id="sympt3" name="sympt3">';
  $Sorgu = mysqli_query($con,"select * from symptoms") or die("Sorgu Bulunamadı").mysqli_error();
  while($row=mysqli_fetch_assoc($Sorgu)){ 
	$veri.='<option value="'.$row['symptom_id'].'">'.$row['symptom_name'].'</option>';
  
  }
 $veri.='</select><br><br>
 <label for="asis">Aşı Oldu mu?</label>
  <select id="asis" name="asis" onchange="if (this.value) kontrolasi(this);"><option value=1>Evet</option><option value=0>Hayır</option></select><br><br>
  <div id="ustasi">
 <label for="asi">Olunan aşı</label>';
 $veri.='
 <select id="asi" name="asi">';
  $Sorgu = mysqli_query($con,"select * from vaccines") or die("Sorgu Bulunamadı").mysqli_error();
 while($row=mysqli_fetch_assoc($Sorgu)){ 
	$veri.='<option value="'.$row['vaccine_id'].'">'.$row['vaccine_name'].'</option>';
  
  }
 
 $veri.='
 </select></div><br><br>
 <input type="submit" value="Kaydet">
</form>';
mysqli_close($con); 
echo $veri;
	}
	else header("Refresh:0;url=giris.php");
	ob_end_flush();
?>