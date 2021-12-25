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
	$Sorgu = mysqli_query($con, "SELECT * FROM employees where id=" . $GelenIdDegeri);
		if($Sorgu) {
			$KayitSayisi = mysqli_num_rows($Sorgu);
				if($KayitSayisi>0){
					$Kayit = mysqli_fetch_assoc($Sorgu);
				}else {
					header("Location:emplooyees.php");
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
					<form action="emp-guncelle.php?id=<?php echo $GelenIdDegeri; ?>" method="post">
						<div class="form-group row">
							<label for="tcno" class="col-sm-2 col-form-label">Çalışan TC No</label>
							<div class="col-sm-10">
								<input type="number" name="tcno" value="<?php echo $Kayit["tcno"]; ?>" disabled>
							</div>
						</div><br />
						<div class="form-group row">
							<label for="firstname" class="col-sm-2 col-form-label">İsim</label>
							<div class="col-sm-10">
								<input type="text" name="firstname" value="<?php echo $Kayit["first_name"]; ?>" disabled>
							</div>
						</div><br />
						<div class="form-group row">
							<label for="lastname" class="col-sm-2 col-form-label">Soyisim</label>
							<div class="col-sm-10">
								<input type="text" name="lastname" value="<?php echo $Kayit["last_name"]; ?>" disabled>
							</div>
						</div><br />
						<div class="form-group row">
							<label for="bloodtype" class="col-sm-2 col-form-label">Kan Grubu</label>
							<div class="col-sm-10">
								<input type="text" name="bloodtype" value="<?php echo $Kayit["blood_type"]; ?>" disabled>
							</div>
						</div><br />
						<div class="form-group row">
							<label for="cityofbirthid" class="col-sm-2 col-form-label">Doğduğu Şehir</label>
							<div class="col-sm-10">
								<input type="number" name="cityofbirthid" value="<?php echo $Kayit["cityofbirth_id"]; ?>" disabled>
							</div>
						</div><br />
						<div class="form-group row">
							<label for="position" class="col-sm-2 col-form-label">Pozisyon</label>
							<div class="col-sm-10">
								<input type="text" name="position" value="<?php echo $Kayit["position"]; ?>">
							</div>
						</div><br />
						<div class="form-group row">
							<label for="salary" class="col-sm-2 col-form-label">Maaş</label>
							<div class="col-sm-10">
								<input type="number" name="salary" value="<?php echo $Kayit["salary"]; ?>">
							</div>
						</div><br />
						<div class="form-group row">
							<label for="hobbies" class="col-sm-2 col-form-label">Hobiler</label>
							<div class="col-sm-10">
								<input type="text" name="hobbies" value="<?php echo $Kayit["hobbies"]; ?>">
							</div>
						</div><br />
						<div class="form-group row">
							<label for="undergraduate" class="col-sm-2 col-form-label">Lisans</label>
							<div class="col-sm-10">
								<input type="text" name="undergraduate" value="<?php echo $Kayit["undergraduate"]; ?>">
							</div>
						</div><br />
						<div class="form-group row">
							<label for="graduate" class="col-sm-2 col-form-label">Yüksek Lisans</label>
							<div class="col-sm-10">
								<input type="text" name="graduate" value="<?php echo $Kayit["graduate"]; ?>">
							</div>
						</div><br />
						<div class="form-group row">
							<label for="doctorate" class="col-sm-2 col-form-label">Doktora</label>
							<div class="col-sm-10">
								<input type="text" name="doctorate" value="<?php echo $Kayit["doctorate"]; ?>">
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