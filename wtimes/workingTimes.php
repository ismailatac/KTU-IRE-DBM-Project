<?php
session_start();

ob_start();
if(!isset($_SESSION["oturum"])) 
{header("Refresh:0;url=../index.php");}
else{
?>
<!doctype html>
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
	$Sorgu = mysqli_query($con,"SELECT wt.*, e.first_name, e.last_name, we.day
		FROM workingTimes as wt
		INNER JOIN employees as e
		INNER JOIN doWeek as we
		ON wt.employeeID = e.id and wt.dayID=we.dID
		ORDER BY wt.wtID");
		if($Sorgu) {
			$KayitSayisi = mysqli_num_rows($Sorgu);
				if($KayitSayisi>0) {
	
	$metin="<div class='container'><div class='row-mt-4'><table id='wtTable' class='table table-striped table-bordered table-hover caption-top table-condensed display' cellspacing='0' width='100%'>
	       <caption>List of working times</caption>
		   <thead>
			<tr style='background-color:#34B6AF'>
			  <th scope='col'>Çalışma zamanı IDsi</th>
			  <th scope='col'>Çalışanlar</th>
			  <th scope='col'>Günler</th>
			  <th scope='col'>Başlangıç Zamanı</th>
			  <th scope='col'>Bitiş Zamanı</th>
			  <th scope='col'><button type='button' class='btn btn-success' data-toggle='modal' data-target='#myModal'>Ekle</button>
			</tr>
			</thead>
		<tbody id='tableResult'>";
		    while($Kayit=mysqli_fetch_assoc($Sorgu)){ 
		$metin.=		
		'<tr style="background-color:#0FD287" id="'.$Kayit['wtID'].'"><th scope="row">'.$Kayit['wtID'].'</th>
			<td scope="row">'.$Kayit['employeeID'].'-'.$Kayit["first_name"].' '.$Kayit["last_name"].'</td>
			<td scope="row">'.$Kayit['dayID'].'-'.$Kayit['day'].'</td>
			<td scope="row">'.$Kayit['start_Time'].'</td>
			<td scope="row">'.$Kayit['final_Time'].'</td>
			<td scope="row"><button class="btn btn-primary" onClick="location.href=\'workingTime-guncelle.php?wtID='.$Kayit["wtID"].'\'">Güncelle</button>
			<button href="javascript:void(0)" class="btn btn-danger" onclick="RemoveAll(\'DelWT\', \''.$Kayit['wtID'].'\')">Sil</button>
			</td>
			</tr>';
			}
			$metin.="		
		</tbody>
		<tfoot>
            <tr>
			  <th scope='col'>Çalışma zamanı IDsi</th>
			  <th scope='col'>Çalışanlar</th>
			  <th scope='col'>Günler</th>
			  <th scope='col'>Başlangıç Zamanı</th>
			  <th scope='col'>Bitiş Zamanı</th>
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
          <h4 class="modal-title">Çalışma Saati Ekle</h4>
        </div>
        <div class="modal-body">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-8">
						<div class="card mt-3">
				  		<div class="card-body">
							<form class="form" method="post" id="FormAddWT">
								<div class="form-group row">
									<label for="employeeID" class="col-sm-2 col-form-label">Çalışan ID</label>
									<div class="col-sm-10">
									<select class="form-control" name="employeeID" id="employeeID">
										<option value="0">Çalışan Seç</option>
										<?php $Sorgu = mysqli_query($con, "SELECT * FROM employees");
											foreach($Sorgu as $item) {
										?>
										<option value="<?php echo $item["id"]; ?>"><?php echo $item["first_name"] . $item["last_name"]; ?></option>
										<?php } ?>
									</select></div>
								</div><br />
								<div class="form-group row">
									<label for="dayID" class="col-sm-2 col-form-label">Gün ID</label>
									<div class="col-sm-10">
									<select class="form-control" name="dayID" id="dayID">
									<option value="0">Gün Seç</option>
									<?php $Sorgu = mysqli_query($con, "SELECT * FROM doweek");
										foreach($Sorgu as $item) {
									?>
									<option value="<?php echo $item["dID"]; ?>"><?php echo $item["day"]; ?></option>
									<?php } ?>
									</select>
									</div>
								</div><br />
								<div class="form-group row">
									<label for="startTime" class="col-sm-2 col-form-label">Başlangıç Zamanı</label>
									<div class="col-sm-10"><input type="time" class="form-control" name="startTime" id="startTime"></div>
								</div><br />
								<div class="form-group row">
									<label for="finalTime" class="col-sm-2 col-form-label">Bitiş Zamanı</label>
									<div class="col-sm-10"><input type="time" class="form-control" name="finalTime" id="finalTime"></div>
								</div><br />
								<div class="form-group row">
									<p id="result"></p>
								</div><br />
								<button type="button" class="btn btn-primary" name="mysubmit" id="mysubmit" onClick="sendForm('FormAddWT', 'AddWT', 'workingTimes.php')">Kaydet <span class="myload"></span></button>
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
require_once"wt-fonk.php";
} 
ob_end_flush();

?>