<?php
session_start();

ob_start();
if(isset($_SESSION["oturum"])) 
{header("Refresh:0;url=index.php");}
else{
?>
<!doctype html>
<html lang="tr-TR">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="./style.css">
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
	$Sorgu = mysqli_query($con,"SELECT e.*, c.cityName
		FROM employees as e
		INNER JOIN cities as c
		ON e.cityofbirth_id = c.cityID 
		ORDER BY e.id");
		if($Sorgu) {
			$KayitSayisi = mysqli_num_rows($Sorgu);
				if($KayitSayisi>0) {
	
	$metin="<div class='container' ><table id='empTable' class='table table-striped table-bordered table-hover caption-top table-condensed display' cellspacing='0'>
	       <caption>List of employees</caption>
		   <thead>
			<tr style='background-color:#F6E00B'>
			  <th scope='col'>ID</th>
			  <th scope='col'>TC No</th>
			  <th scope='col'>İsim</th>
			  <th scope='col'>Soyisim</th>
			  <th scope='col'>Kan grubu</th>
			  <th scope='col'>Doğduğu Şehir</th>
			  <th scope='col'>Pozisyon</th>
			  <th scope='col'>Maaş</th>
			  <th scope='col'>Hobiler</th>
			  <th scope='col'>Lisans</th>
			  <th scope='col'>Yüksek Lisans</th>
			  <th scope='col'>Doktora</th>
			  <th scope='col'><button type='button' class='btn btn-success' data-toggle='modal' data-target='#myModal'>Ekle</button>
			</tr>
			</thead>
		<tbody id='tableResult'>";
		    while($Kayit=mysqli_fetch_assoc($Sorgu)){ 
		$metin.=		
		'<tr style="background-color:#0BF65F" id="'.$Kayit['id'].'"><th scope="row">'.$Kayit['id'].'</th>
			<td scope="row">'.$Kayit['tcno'].'</td>
			<td scope="row">'.$Kayit['first_name'].'</td>
			<td scope="row">'.$Kayit['last_name'].'</td>
			<td scope="row">'.$Kayit['blood_type'].'</td>
			<td scope="row">'.$Kayit['cityofbirth_id'].'-'.$Kayit['cityName'].'</td>
			<td scope="row">'.$Kayit['position'].'</td>
			<td scope="row">'.$Kayit['salary'].'</td>
			<td scope="row">'.$Kayit['hobbies'].'</td>
			<td scope="row">'.$Kayit['undergraduate'].'</td>
			<td scope="row">'.$Kayit['graduate'].'</td>
			<td scope="row">'.$Kayit['doctorate'].'</td>
			<td scope="row"><button class="btn btn-primary" onClick="location.href=\'employee-guncelle.php?id='.$Kayit["id"].'\'">Güncelle</button>
			<button href="javascript:void(0)" class="btn btn-danger" onclick="RemoveAll(\'DelEmp\', \''.$Kayit["id"].'\')">Sil</button>
			</td>
			</tr>';
			}
			$metin.="		
		</tbody>
		<tfoot>
            <tr>
			  <th scope='col'>ID</th>
			  <th scope='col'>TC No</th>
			  <th scope='col'>İsim</th>
			  <th scope='col'>Soyisim</th>
			  <th scope='col'>Kan grubu</th>
			  <th scope='col'>Doğduğu Şehir</th>
			  <th scope='col'>Pozisyon</th>
			  <th scope='col'>Maaş</th>
			  <th scope='col'>Hobiler</th>
			  <th scope='col'>Lisans</th>
			  <th scope='col'>Yüksek Lisans</th>
			  <th scope='col'>Doktora</th>
            </tr>
        </tfoot>
	</table></div>";
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
          <h4 class="modal-title">Yeni Çalışan Ekle</h4>
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
							<label for="tcno" class="col-sm-2 col-form-label">Çalışan TC No</label>
							<div class="col-sm-10">
								<input type="number" name="tcno">
							</div>
						</div><br />
						<div class="form-group row">
							<label for="firstname" class="col-sm-2 col-form-label">İsim</label>
							<div class="col-sm-10">
								<input type="text" name="firstname">
							</div>
						</div><br />
						<div class="form-group row">
							<label for="lastname" class="col-sm-2 col-form-label">Soyisim</label>
							<div class="col-sm-10">
								<input type="text" name="lastname">
							</div>
						</div><br />
						<div class="form-group row">
							<label for="bloodtype" class="col-sm-2 col-form-label">Kan Grubu</label>
							<select class="form-control" name="bloodtype" id="bloodtype">
								<option>Kan Grubu Seç</option>
								<option> 0-</option>
								<option> 0+</option>
								<option> A-</option>
								<option> A+</option>
								<option> B-</option>
								<option> B+</option>
								<option> AB-</option>
								<option> AB+</option>
							</select>
						</div><br />
						<div class="form-group row">
						<label for="cityofbirthid" class="col-sm-2 col-form-label">Şehir</label>
						<div class="col-sm-10">
							<select class="form-control" name="cityofbirthid" id="cityofbirthid">
								<option value="0">Şehir Seç</option>
								<?php $Sorgu = mysqli_query($con, "SELECT * FROM cities");
									foreach($Sorgu as $item) {
								?>
								<option value="<?php echo $item["cityID"]; ?>"><?php echo $item["cityName"]?></option>
								<?php } ?>
							</select>
							</div>
						</div><br />
						<div class="form-group row">
							<label for="position" class="col-sm-2 col-form-label">Pozisyon</label>
							<div class="col-sm-10">
								<input type="text" name="position">
							</div>
						</div><br />
						<div class="form-group row">
							<label for="salary" class="col-sm-2 col-form-label">Maaş</label>
							<div class="col-sm-10">
								<input type="number" name="salary">
							</div>
						</div><br />
						<div class="form-group row">
							<label for="hobbies" class="col-sm-2 col-form-label">Hobiler</label>
							<div class="col-sm-10">
								<input type="text" name="hobbies">
							</div>
						</div><br />
						<div class="form-group row">
							<label for="undergraduate" class="col-sm-2 col-form-label">Lisans</label>
							<div class="col-sm-10">
								<input type="text" name="undergraduate">
							</div>
						</div><br />
						<div class="form-group row">
							<label for="graduate" class="col-sm-2 col-form-label">Yüksek Lisans</label>
							<div class="col-sm-10">
								<input type="text" name="graduate">
							</div>
						</div><br />
						<div class="form-group row">
							<label for="doctorate" class="col-sm-2 col-form-label">Doktora</label>
							<div class="col-sm-10">
								<input type="text" name="doctorate">
							</div>
						</div><br />
								<div class="form-group row">
									<p id="result"></p>
								</div><br />
								<button type="button" class="btn btn-primary" name="mysubmit" id="mysubmit" onClick="sendForm('FormAddEmp', 'AddEmp', 'employees.php')">Kaydet <span class="myload"></span></button>
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
<?php require_once"emp-fonk.php";
} 
ob_end_flush();

?>