<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Güncelleme Formu</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="http://code.jquery.com/jquery-1.9.1.min.js" type="text/javascript"></script>
</head>
<body>
<?php
$GelenIdDegeri = $_GET["id"];
	$con = mysqli_connect("localhost", "root", "Badem*5361", "denIRE2");
	mysqli_set_charset($con, "UTF8");
	$Sorgu = mysqli_query($con, "SELECT * FROM employees_and_diseases 
	 where ID=" . $GelenIdDegeri);
		if($Sorgu) {
			$KayitSayisi = mysqli_num_rows($Sorgu);
				if($KayitSayisi>0){
					$Kayit = mysqli_fetch_assoc($Sorgu);
				}else {
					header("Location:empdis.php");
				}
		} else {
			echo "Sorgu hatası";
		}
?>
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-8">
				<div class="card mt-3 bg-light">
				  <div class="card-body">
					<form action="empd-guncelle.php?id=<?php echo $GelenIdDegeri; ?>" method="post">
						
					<div class="form-group row">
									<div class="form-group row">
							<label for="empid" class="col-sm-2 col-form-label">Employee ID</label>
							<div class="col-sm-10">

								<input class="form-control" name="empid" id="empid" value="<?php echo $Kayit['ID'];?>" disabled>
								
							

								
							</div>
						</div><br />
						<div class="form-group row">
							<label for="dis" class="col-sm-2 col-form-label">Hastalık ID</label>
							<div class="col-sm-10">

							<input class="form-control" name="dis" id="dis" value="<?php echo $Kayit['DiseaseID'];?>" disabled>


							</div>
						</div><br />
						<div class="form-group row">
							<label for="hast" class="col-sm-2 col-form-label">Hasta Olduğu Tarih</label>
							<div class="col-sm-10">

								<input type="date" name="hast" id="hast" value="<?php echo $Kayit['dateGetSick'];?>" disabled>

							</div>
						</div><br />
						<div class="form-group row">
							<label for="sm1" class="col-sm-2 col-form-label">Semptom </label>
							<div class="col-sm-10">



								
									

							<select class="form-control" name="sm1" id="sm1">
							    <option value="<?php echo $Kayit['Symptoms_id'];?>"><?php echo $Kayit['Symptoms_id'];?></option>
								<?php $Sorgu = mysqli_query($con, "SELECT symptom_id,symptom_name FROM symptoms");
									foreach($Sorgu as $item) {
								?>
								
								<option value="<?php echo $item['symptom_id'];?>"><?php echo $item["symptom_name"];?></option>
								<?php } ?>
							</select>




							</div>
						</div><br />
						<div class="form-group row">
						<label for="sm2" class="col-sm-2 col-form-label">Semptom</label>
						<div class="col-sm-10">


						<select class="form-control" name="sm2" id="sm2">
							    <option value="<?php echo $Kayit['Symptoms_id2'];?>"><?php echo $Kayit['Symptoms_id2'];?></option>
								<?php $Sorgu = mysqli_query($con, "SELECT symptom_id,symptom_name FROM symptoms");
									foreach($Sorgu as $item) {
								?>
								
								<option value="<?php echo $item['symptom_id'];?>"><?php echo $item["symptom_name"];?></option>
								<?php } ?>
							</select>



							</div>
						</div><br />
						<div class="form-group row">
							<label for="sm3" class="col-sm-2 col-form-label">Semptom</label>
							<div class="col-sm-10">


							<select class="form-control" name="sm3" id="sm3">
							    <option value="<?php echo $Kayit['Symptoms_id3'];?>"><?php echo $Kayit['Symptoms_id3'];?></option>
								<?php $Sorgu = mysqli_query($con, "SELECT symptom_id,symptom_name FROM symptoms");
									foreach($Sorgu as $item) {
								?>
								
								<option value="<?php echo $item['symptom_id'];?>"><?php echo $item["symptom_name"];?></option>
								<?php } ?>
							</select>

							</div>
						</div><br />
						<div class="form-group row">
							<label for="pr" class="col-sm-2 col-form-label">Reçete ID</label>
							<div class="col-sm-10">


							<select class="form-control" name="pr" id="pr">
							<option value="<?php echo $Kayit['prescriptionID'];?>"><?php echo $Kayit['prescriptionID'];?></option>
								<?php $Sorgu = mysqli_query($con, "SELECT prescriptionID FROM prescriptions");
									foreach($Sorgu as $item) {
								?>
								<option value="<?php echo $item["prescriptionID"];?>"><?php echo $item["prescriptionID"];?></option>
								<?php } ?>
							</select>


							</div>
						</div><br />
						<input type="submit" class="btn btn-primary" value="Güncelle">
					</form>
				  </div>
				</div>
			</div>
		</div>
	</div>
</body>
	<?php mysqli_close($con); ?>
</html>