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
$GelenIdDegeri = $_GET["wtID"];
	$con = mysqli_connect("localhost", "root", "Badem*5361", "denIRE2");
	mysqli_set_charset($con, "UTF8");
	$Sorgu = mysqli_query($con, "SELECT * FROM workingTimes where wtID=" . $GelenIdDegeri);
		if($Sorgu) {
			$KayitSayisi = mysqli_num_rows($Sorgu);
				if($KayitSayisi>0){
					$Kayit = mysqli_fetch_assoc($Sorgu);
				}else {
					header("Location:workingTimes.php");
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
					<form action="wtguncelle.php?wtID=<?php echo $GelenIdDegeri; ?>" method="post">
						<div class="form-group row">
							<label for="employeeID" class="col-sm-2 col-form-label">Çalışan ID</label>
							<div class="col-sm-10">
								<input class="form-control" type="number" name="employeeID" value="<?php echo $Kayit["employeeID"]; ?>" disabled>
							</div>
						</div><br />
						<div class="form-group row">
							<label for="dayID" class="col-sm-2 col-form-label">Gün ID</label>
							<div class="col-sm-10">
								<input class="form-control" value="<?php echo $Kayit["dayID"]; ?>" name="dayID" disabled>
							</div>
						</div><br />
						<div class="form-group row">
							<label for="startTime" class="col-sm-2 col-form-label">Başlangıç Zamanı</label>
							<div class="col-sm-10"><input type="time" class="form-control" name="startTime" value="<?php echo $Kayit["start_Time"]; ?>"></div>
						</div><br />
						<div class="form-group row">
							<label for="finalTime" class="col-sm-2 col-form-label">Bitiş Zamanı</label>
							<div class="col-sm-10"><input type="time" class="form-control" name="finalTime" value="<?php echo $Kayit["final_Time"]; ?>"></div>
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