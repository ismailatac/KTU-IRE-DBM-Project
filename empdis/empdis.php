<?php
session_start();

ob_start();
if(!isset($_SESSION["oturum"])) 
{header("Refresh:0;url=../index.php");}
else{
?><!doctype html>
<html lang="tr-TR">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<meta http-equiv="Content-Type" content="text/html" charset="utf-8">
<meta http-equiv="Content-Language" content="tr">
<meta charset="utf-8">
<title>IRE</title>
</head>
<body>
<?php 
$con = mysqli_connect("localhost", "root", "Badem*5361", "denIRE2");
mysqli_set_charset($con, "UTF8");
	
if(mysqli_connect_errno()) {
	echo "Bağlantı Hatası <br />Hata Açıklaması : ". mysqli_connect_error();
	die();
}
	$Sorgu = mysqli_query($con,"SELECT ed.ID,e1.first_name, e1.last_name,d1.DiseaseName,ed.dateGetSick, s1.symptom_name as a,s2.symptom_name as b,s3.symptom_name as c,ed.prescriptionID
	FROM employees_and_diseases as ed
	LEFT JOIN employees as e1
	ON ed.EmployeeID = e1.id
	LEFT JOIN diseases as d1
	ON ed.DiseaseID = d1.DiseaseID
	LEFT JOIN symptoms as s1
	ON ed.Symptoms_id = s1.symptom_id
	LEFT JOIN symptoms as s2
	ON ed.Symptoms_id2 = s2.symptom_id
	LEFT JOIN symptoms as s3
	ON ed.Symptoms_id3 = s3.symptom_id
	ORDER BY ed.ID");
		if($Sorgu) {
			$KayitSayisi = mysqli_num_rows($Sorgu);
				if($KayitSayisi>0) {
	
	$metin="<div class='container-fluid'><div class='row-mt-4'><table id='empdisTable' class='table table-striped table-bordered table-hover caption-top table-condensed display' cellspacing='0' width='100%'>
	       <caption>List of employees and diseases</caption>
		   <thead>
			<tr style='background-color:#34B6AF'>
			  <th scope='col'>ID</th>
			  <th scope='col'>İsim</th>
			  <th scope='col'>Soyisim</th>
			  <th scope='col'>Hastalık Adı</th>
			  <th scope='col'>Hasta Olduğu Tarih</th>
			  <th scope='col'>Semptom1</th>
			  <th scope='col'>Semptom2</th>
			  <th scope='col'>Semptom3</th>
			  <th scope='col'>Reçete ID</th>
			  
			  <th scope='col'><button type='button' class='btn btn-success' data-toggle='modal' data-target='#myModal'>Ekle</button>
			</tr>
			</thead>
		<tbody id='tableResult'>";
		    while($Kayit=mysqli_fetch_assoc($Sorgu)){ 
		$metin.=		
		'<tr style="background-color: #1b9823 " id="'.$Kayit['ID'].'"><th scope="row">'.$Kayit['ID'].'</th>
			<td scope="row">'.$Kayit['first_name'].'</td>
			<td scope="row">'.$Kayit['last_name'].'</td>
			<td scope="row">'.$Kayit['DiseaseName'].'</td>
			<td scope="row">'.$Kayit['dateGetSick'].'</td>
			<td scope="row">'.$Kayit['a'].'</td>
			<td scope="row">'.$Kayit['b'].'</td>
			<td scope="row">'.$Kayit['c'].'</td>
			<td scope="row">'.$Kayit['prescriptionID'].'</td>
			
			<td scope="row"><button class="btn btn-primary" onClick="location.href=\'empdis-guncelle.php?id='.$Kayit["ID"].'\'">Güncelle</button>
			<button href="javascript:void(0)" class="btn btn-danger" onclick="RemoveAll(\'DelEmpDis\', \''.$Kayit["ID"].'\')">Sil</button>
			</td>
			</tr>';
			}
			$metin.="		
		</tbody>
		<tfoot>
            <tr>
			  <th scope='col'>ID</th>
			  <th scope='col'>İsim</th>
			  <th scope='col'>Soyisim</th>
			  <th scope='col'>Hastalık Adı</th>
			  <th scope='col'>Hasta Olduğu Tarih</th>
			  <th scope='col'>Semptom1</th>
			  <th scope='col'>Semptom2</th>
			  <th scope='col'>Semptom3</th>
			  <th scope='col'>Reçete ID</th>
			  
            </tr>
        </tfoot>
	</table></div></div>";
			echo $metin;
		   } else {
					echo "Kayıt Yok";
				}
		} else {
			echo "Sorgu hatası";
		}
?>
<div class="container">
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Yeni Kayıt Ekle</h4>
        </div>
        <div class="modal-body">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-8">
						<div class="card mt-3">
				  		<div class="card-body">
							<form class="form" method="post" id="FormAddEmp">
								<div class="form-group row">
									<div class="form-group row">
							<label for="empid" class="col-sm-2 col-form-label">Employee ID</label>
							<div class="col-sm-10">


								

								<select class="form-control" name="empid" id="empid">
								<option value="0">Çalışan Seç</option>
								<?php $Sorgu = mysqli_query($con, "SELECT id,first_name,last_name FROM employees");
									foreach($Sorgu as $item) {
								?>
								<option value="<?php echo $item['id'];?>"><?php echo $item["first_name"]; echo $item["last_name"]?></option>
								<?php } ?>
							</select>

								
							</div>
						</div><br />
						<div class="form-group row">
							<label for="dis" class="col-sm-2 col-form-label">Hastalık ID</label>
							<div class="col-sm-10">



								<select class="form-control" name="dis" id="dis">
								<option value="0">Hastalık Seç</option>
								<?php $Sorgu = mysqli_query($con, "SELECT DiseaseID,DiseaseName FROM diseases");
									foreach($Sorgu as $item) {
								?>
								<option value="<?php echo $item['DiseaseID'];?>"><?php echo $item["DiseaseName"];?></option>
								<?php } ?>
							</select>



							</div>
						</div><br />
						<div class="form-group row">
							<label for="hast" class="col-sm-2 col-form-label">Hasta Olduğu Tarih</label>
							<div class="col-sm-10">

								<input type="date" name="hast">

							</div>
						</div><br />
						<div class="form-group row">
							<label for="sm1" class="col-sm-2 col-form-label">Semptom </label>
							<div class="col-sm-10">



								
									

								<select class="form-control" name="sm1" id="sm1">
								<option value= >Semptom Seç</option>
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
								<option value="">Semptom Seç</option>
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
								<option value="">Semptom Seç</option>
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
								<option value="">Reçete Seç</option>
								<?php $Sorgu = mysqli_query($con, "SELECT prescriptionID FROM prescriptions");
									foreach($Sorgu as $item) {
								?>
								<option value="<?php echo $item["prescriptionID"];?>"><?php echo $item["prescriptionID"];?></option>
								<?php } ?>
							</select>


							</div>
						</div><br />
						
								<div class="form-group row">
									<p id="result"></p>
								</div><br />
								<button type="button" class="btn btn-primary" name="mysubmit" id="mysubmit" onClick="sendForm('FormAddEmp', 'AddEmpDis', 'empdis.php')">Kaydet <span class="myload"></span></button>
							</form>
				  		</div>
						</div>
					</div>
				</div>
			</div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>
	<?php mysqli_close($con); ?>
</table>
</body>
</html>

<?php 
require_once"empdis-fonk.php";
} 
ob_end_flush();

?>