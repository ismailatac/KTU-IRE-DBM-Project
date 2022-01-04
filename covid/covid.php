<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>COVID</title>
	

<link rel="stylesheet" href="./style.css">

<script src="../js/popper.js"></script>
<link rel="stylesheet" href="../css/bootstrap.min.css">
<link rel="stylesheet" href="../css/jquery-ui.css">
<link rel="stylesheet" href="../css/jquery-ui.theme.min.css">
<script src="../js/jquery-3.3.1.min.js"></script>
<script src="../js/jquery-ui.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script type="text/javascript" charset="utf8" src="covid.js"></script>
<style>
@charset "utf-8";
*{margin: 0;}
html, body {
height: 1000px; 
background-color: white;
background:url("pic/aaa.jpeg") no-repeat center center fixed;
-webkit-background-size: cover;
-moz-background-size: cover;
-o-background-size: cover;
background-size: cover;
}
html{
overflow-x:hidden;
}
.main{
margin: 0 auto;
position: relative;
padding: 0;	
width: 980px;
height: 100%;   
}

.top{
height: 14%;
padding: 0;
position: relative;	
width: 100%;	
text-align: center;
}	
.menu{
height: 3%;
padding:0;
position: relative;
width: 100%;
background-color: #f7ffb0;

}
.middle{
height: 20%;
padding:0;
position: relative;
width: 100%;
background-color: #ffeb87;
}
.bottom{
height: 63%;
padding:0;
position: relative;
width: 100%;
background-color: #fffec7;
}
.ptop{
font-size: 93px;		
}
	.txt1{
		margin-left:5px!important;
		margin-right:5px!important;
		width: 20%; 
		padding-top: 0;
		font-size: 18px;
	}
	.txt2{
		
		margin-right:5px!important;
		width: 24%; 
		padding-top: 0;
		font-size: 18px;
	}
	.txt3{
		
		margin-right:5px!important;
		width: 24%; 
		padding-top: 0;
		font-size: 18px;
	}
	.txt4{
		width: 29.5%; 
		padding-top: 0;
		font-size: 18px;
	}
</style>
</head>

<body>
	<div class="main">
		<div class="top">
		<p class="ptop">COVID-19</p>
		</div>
		<div class="menu btn-toolbar pull-right">
			<a href="../panel.php"><button type="button" class="txt1 btn btn-outline-success">Ana Sayfa</button></a>
			<a href="../employees/employees.php"><button type="button" class="txt2 btn btn-outline-success" href="/employees/employees.php">Çalışanlar</button></a>
			<a href="../wtimes/workingTimes.php"><button type="button" class="txt3 btn btn-outline-success" href="/wtimes/workingTimes.php">Çalışma Saatleri</button></a>
			<a href="../covid.php"><button type="button" class="txt4 btn btn-outline-success" href="covid.php">Listeler ve İstatiski Bilgiler</button></a>
		</div>
		<div class="middle">
		 <select class="form-select" name="calisan" id="employee">
			<?php
			include("../phps/baglan.php");
			$sorgu=mysqli_query($con,"SELECT e.id,e.first_name,e.last_name FROM employees as e")or die("Sorgu Bulunamadı").mysqli_error();
			while( $row = mysqli_fetch_array( $sorgu ) ) {
				$veri.='
				<option value="'.$row['id'].'">'.$row['id'].'-'.$row['first_name'].' '.$row['last_name'].'</option>';
				
			}
			mysqli_close($con); 
			echo $veri;
			?>
		 
		 </select>
		 </br><button class="buton1" onClick="covidveri()">Veri ekle</button>
		</div>
		<div class="bottom">
			<?php 
			include("../phps/baglan.php");
			$sorgu=mysqli_query($con,"SELECT c.id, e.first_name,e.last_name,c.covid_positive_date,c.covid_negative_date,c.symptom_id ,c.symptom_id2 , c.symptom_id3 FROM employees as e inner join covid as c on e.id=c.employee_id order by e.id")or die("Sorgu Bulunamadı").mysqli_error();
			$veri="<div class='container'><div class='row-mt-4'><table id='covtablo' class='display'>
			<caption>COVID</caption>
			<thead>
			 <tr style='background-color:#34B6AF'>
				<th scope='col'>ID</th>
			   <th scope='col'>İsim</th>
			   <th scope='col'>Soyisim</th>
			   <th scope='col'>Covid Pozitif Tarih</th>
			   <th scope='col'>Covid Negatif Tarih</th>
			   <th scope='col'>Semptom 1</th>
			   <th scope='col'>Semptom 2</th>
			   <th scope='col'>Semptom 3</th>
			 </tr>
			 </thead>
		 <tbody id='tableResult'>";
			while( $row = mysqli_fetch_array( $sorgu ) ) {
				$veri=$veri.'<tr style="background-color:#0FD287">
				<td scope="row">'.$row['id'].'</td>
				<td scope="row">'.$row['first_name'].'</td>
				<td scope="row">'.$row['last_name'].'</td>
				<td scope="row">'.$row['covid_positive_date'].'</td>
				<td scope="row">'.$row['covid_negative_date'].'</td>
				<td scope="row">'.$row['symptom_id'].'</td>
				<td scope="row">'.$row['symptom_id2'].'</td>
				<td scope="row">'.$row['symptom_id3'].'</td>
				<td scope="row"><button class="btn btn-primary" onClick="location.href=\'employee-guncelle.php?id='.$row["id"].'\'">Güncelle</button>
				<button href="javascript:void(0)" class="btn btn-danger" onclick="RemoveAll(\'DelEmp\', \''.$row["id"].'\')">Sil</button>
				</td>
				</tr>
				</tbody>';
			}
			$veri.="</table></div></div>";
			mysqli_close($con); 
			echo $veri;
			?>
		</div>
	</div>	
	<!-- The Modal -->
		<div class="modal" id="myModal">
		  <div class="modal-dialog modal-lg">
			<div class="modal-content">

			  <!-- Modal Header -->
			  <div class="modal-header">
				<h4 class="modal-title">Covid Verisi</h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
			  </div>

			  <!-- Modal body -->
			  <div class="modal-body">
				Modal body..
			  </div>

			  <!-- Modal footer -->
			  <div class="modal-footer">
				<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
			  </div>

			</div>
		  </div>
		</div>
</body>
</html>
<?php require_once"fonk.php" ?>
