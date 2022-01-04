<?php
	ob_start();
	if(!empty($_POST["sorgu"]))
	{
		if(!empty($_POST["dgsken"])){
			$degisken=$_POST["dgsken"];
			
		}
		$sorgu=$_POST["sorgu"];
		if($sorgu==16){
			include("baglan.php");
			$sorgu=mysqli_query($con,"SELECT e.first_name, e.last_name, e.undergraduate, e.graduate, e.doctorate FROM employees as e
			INNER JOIN covid as c
			ON e.id = c.employee_id ")or die("Sorgu Bulunamadı").mysqli_error();
			$veri="<div class='container'><div class='row-mt-4'><table id='empTable' class='table table-striped table-bordered table-hover caption-top table-condensed display' cellspacing='0' width='100%'>
			<caption>COVID ve Eğitim Durumu</caption>
			<thead>
			 <tr style='background-color:#34B6AF'>
			   <th scope='col'>İsim</th>
			   <th scope='col'>Soyisim</th>
			   <th scope='col'>Lisans</th>
			   <th scope='col'>Yüksek Lisans</th>
			   <th scope='col'>Doktora</th>
			 </tr>
			 </thead>
		 <tbody id='tableResult'>";
			while( $row = mysqli_fetch_array( $sorgu ) ) {
				$veri=$veri.'<tr style="background-color:#0FD287">
				<td scope="row">'.$row['first_name'].'</td>
				<td scope="row">'.$row['last_name'].'</td>
				<td scope="row">'.$row['undergraduate'].'</td>
				<td scope="row">'.$row['graduate'].'</td>
				<td scope="row">'.$row['doctorate'].'</td>
				</tr>
				</tbody>';
			}
			$veri.="</table></div></div>";
			mysqli_close($con); 
			echo $veri;
		}
		elseif($sorgu==1){
			include("baglan.php");
			$sorgu=mysqli_query($con,"SELECT COUNT(ed.DiseaseID) as a, d.DiseaseName  FROM employees_and_diseases as ed inner join diseases AS d on ed.DiseaseID=d.DiseaseID GROUP by ed.DiseaseID ORDER BY COUNT(ed.DiseaseID) DESC LIMIT 3")or die("Sorgu Bulunamadı").mysqli_error();
			$veri="<div class='container'><div class='row-mt-4'><table id='empTable' class='table table-striped table-bordered table-hover caption-top table-condensed display'>
			<caption>Elemanlar arasında görülen en yaygın üç hastalık türü</caption>
			<thead>
			 <tr style='background-color:#FFDB12'>
			   <th scope='col'>Hastalık Adı</th>
			   <th scope='col'>Kaç kişide bu hastalık görüldü</th>
			 </tr>
			 </thead>
		 <tbody id='tableResult'>";
			while( $row = mysqli_fetch_array( $sorgu ) ) {
				$veri=$veri.'<tr style="background-color:#e9ffb3">
				<td scope="row">'.$row['DiseaseName'].'</td>
				<td scope="row">'.$row['a'].'</td>
				</tr>
				</tbody>';
			}
			$veri.="</table></div></div>";
			$sorgu=mysqli_query($con,"SELECT e.first_name,e.last_name,e.blood_type,e.position,e.salary,dd.DiseaseName from employees as e inner join employees_and_diseases as ede inner join diseases as dd inner join (SELECT COUNT(ed.DiseaseID), d.DiseaseName  FROM  employees_and_diseases as ed inner join diseases AS d on  ed.DiseaseID=d.DiseaseID GROUP by ed.DiseaseID ORDER BY COUNT(ed.DiseaseID) DESC LIMIT 3) as tablo2 on e.id=ede.EmployeeID and ede.DiseaseID=dd.DiseaseID and dd.DiseaseName=tablo2.DiseaseName")or die("Sorgu Bulunamadı").mysqli_error();
			$veri.="<div class='container'><div class='row-mt-4'><table id='empTable' class='table table-striped table-bordered table-hover caption-top table-condensed display' cellspacing='0' width='40%'>
			<caption>Elemanlar arasında görülen en yaygın üç hastalık türüne sahip olan elemanlar </caption>
			<thead>
			 <tr style='background-color:#FFDB12'>
			   <th scope='col'>İsim</th>
			   <th scope='col'>Soyisim</th>
			   <th scope='col'>Kan grubu</th>
			   <th scope='col'>Pozisyon</th>
			   <th scope='col'>Maaş</th>
			   <th scope='col'>Hastalık Adı</th>
			 </tr>
			 </thead>
		 <tbody id='tableResult'>";
			while( $row = mysqli_fetch_array( $sorgu ) ) {
				$veri=$veri.'<tr style="background-color:#e9ffb3">
				<td scope="row">'.$row['first_name'].'</td>
				<td scope="row">'.$row['last_name'].'</td>
				<td scope="row">'.$row['blood_type'].'</td>
				<td scope="row">'.$row['position'].'</td>
				<td scope="row">'.$row['salary'].'</td>
				<td scope="row">'.$row['DiseaseName'].'</td>
				</tr>
				</tbody>';
			}
			$veri.="</table></div></div>";
			mysqli_close($con); 
			echo $veri;
		}
		else if($sorgu==2){
			include("baglan.php");
			$sorgu=mysqli_query($con,"SELECT d.DiseaseName, COUNT(ed.DiseaseID) as ks FROM employees as e inner join cities as ci inner join employees_and_diseases as ed inner join diseases as d on e.cityofbirth_id=ci.cityID and e.id=ed.EmployeeID and ed.DiseaseID=d.DiseaseID WHERE ci.cityName='".$degisken."' GROUP by ed.DiseaseID ORDER BY COUNT(ed.DiseaseID) DESC LIMIT 3")or die("Sorgu Bulunamadı").mysqli_error();
			$veri="<div class='container'><div class='row-mt-4'><table id='empTable' class='table table-striped table-bordered table-hover caption-top table-condensed display' cellspacing='0' width='40%'>
			<caption>Belirli şehirde doğan elemanlar arasında en sık görülen ilk üç hastalık</caption>
			<thead>
			 <tr style='background-color:#FFDB12'>
			   <th scope='col'>Hastalık Adı</th>
			   <th scope='col'>".$degisken." şehirinde doğup bu hastalığı geçirmiş kişi sayısı  </th>
			 </tr>
			 </thead>
		 <tbody id='tableResult'>";
			while( $row = mysqli_fetch_array( $sorgu ) ) {
				$veri=$veri.'<tr style="background-color:#e9ffb3">
				<td scope="row">'.$row['DiseaseName'].'</td>
				<td scope="row">'.$row['ks'].'</td>
				</tr>
				</tbody>';
			}
			$veri.="</table></div></div>";
			mysqli_close($con); 
			echo $veri;
		}
		elseif($sorgu==3){
			
			include("baglan.php");
			$sorgu=mysqli_query($con,"SELECT m.medicine_name FROM employees_and_diseases as ed inner join prescriptions as p inner JOIN medicines as m on ed.prescriptionID=p.prescriptionID and p.medicineID=m.medicine_id GROUP BY p.medicineID ORDER BY COUNT(p.medicineID) DESC limit 3")or die("Sorgu Bulunamadı").mysqli_error();
			$veri="<div class='container'><div class='row-mt-4'><table id='empTable' class='table table-striped table-bordered table-hover caption-top table-condensed display' cellspacing='0' width='40%'>
			<caption>En yaygın kullanılan ilk üç ilacı </caption>
			<thead>
			 <tr style='background-color:#FFDB12'>
			   <th scope='col'>İlaç İsmi</th>
			 </tr>
			 </thead>
		 <tbody id='tableResult'>";
			while( $row = mysqli_fetch_array( $sorgu ) ) {
				$veri=$veri.'<tr style="background-color:#e9ffb3">
				<td scope="row">'.$row['medicine_name'].'</td>
				</tbody>';
			}
			$veri.="</table></div></div>";
			$sorgu=mysqli_query($con,"SELECT e.first_name,e.last_name,e.position,c.covid_positive_date,c.covid_negative_date FROM employees as e inner join covid as c inner join employees_and_diseases as ed inner join prescriptions as p inner join medicines as m  inner join (SELECT m.medicine_id FROM employees_and_diseases as ed inner join prescriptions as p inner JOIN medicines as m on ed.prescriptionID=p.prescriptionID and p.medicineID=m.medicine_id GROUP BY p.medicineID ORDER BY COUNT(p.medicineID) DESC limit 3) as tablo on e.id=c.employee_id and e.id=ed.EmployeeID and ed.prescriptionID=p.prescriptionID and p.medicineID=m.medicine_id and p.medicineID=tablo.medicine_id GROUP by c.id order by c.employee_id")or die("Sorgu Bulunamadı").mysqli_error();
			$veri.="<div class='container'><div class='row-mt-4'><table id='empTable' class='table table-striped table-bordered table-hover caption-top table-condensed display' cellspacing='0' width='40%'>
			<caption>En yaygın kullanılan ilk üç ilacı kullanan elemanların COVID geçirme durumu</caption>
			<thead>
			 <tr style='background-color:#FFDB12'>
			   <th scope='col'>İsim</th>
			   <th scope='col'>Soyisim</th>
			   <th scope='col'>Pozisyon</th>
			   <th scope='col'>Covid Pozitif Tarihi</th>
			   <th scope='col'>Covid Negatif Tarihi</th>
			 </tr>
			 </thead>
		 <tbody id='tableResult'>";
			while( $row = mysqli_fetch_array( $sorgu ) ) {
				$veri=$veri.'<tr style="background-color:#e9ffb3">
				<td scope="row">'.$row['first_name'].'</td>
				<td scope="row">'.$row['last_name'].'</td>
				<td scope="row">'.$row['position'].'</td>
				<td scope="row">'.$row['covid_negative_date'].'</td>
				<td scope="row">'.$row['covid_negative_date'].'</td>
				</tr>
				</tbody>';
			}
			$veri.="</table></div></div>";
			mysqli_close($con); 
			echo $veri;
		}
		elseif($sorgu==4){
			include("baglan.php");
			$sorgu=mysqli_query($con,"select e.first_name,e.last_name,e.position,c.covid_positive_date,c.covid_negative_date from employees as e inner join covid as c inner join employees_and_diseases as ed inner join prescriptions as p inner JOIN medicines as m on e.id=c.employee_id and e.id=ed.EmployeeID and ed.prescriptionID=p.prescriptionID and p.medicineID=m.medicine_id where m.medicine_name='".$degisken."' GROUP by c.id")or die("Sorgu Bulunamadı").mysqli_error();
			$veri="<div class='container'><div class='row-mt-4'><table id='empTable' class='table table-striped table-bordered table-hover caption-top table-condensed display' cellspacing='0' width='40%'>
			<caption>".$degisken." ilacını kullanan çalışanların COVID geçirme durumları </caption>
			<thead>
			 <tr style='background-color:#FFDB12'>
			   <th scope='col'>İsim</th>
			   <th scope='col'>Soyisim</th>
			   <th scope='col'>Pozisyon</th>
			   <th scope='col'>Covid Pozitif Tarihi</th>
			   <th scope='col'>Covid Negatif Tarihi</th>
			 </tr>
			 </thead>
		 <tbody id='tableResult'>";
			while( $row = mysqli_fetch_array( $sorgu ) ) {
				$veri=$veri.'<tr style="background-color:#e9ffb3">
				<td scope="row">'.$row['first_name'].'</td>
				<td scope="row">'.$row['last_name'].'</td>
				<td scope="row">'.$row['position'].'</td>
				<td scope="row">'.$row['covid_negative_date'].'</td>
				<td scope="row">'.$row['covid_negative_date'].'</td>
				</tr>
				</tbody>';
			}
			$veri.="</table></div></div>";
			mysqli_close($con); 
			echo $veri;
		}
		elseif($sorgu==5){
			
			include("baglan.php");
			$sorgu=mysqli_query($con,"select e.first_name,e.last_name,e.blood_type,e.position,e.salary from employees as e inner join employees_and_diseases as ed inner join covid as c inner join diseases as d on e.id=ed.EmployeeID and ed.EmployeeID=c.employee_id and ed.DiseaseID=d.DiseaseID where c.vaccine_id=1 and d.DiseaseName='".$degisken."' GROUP by e.id")or die("Sorgu Bulunamadı").mysqli_error();
			$veri="<div class='container'><div class='row-mt-4'><table id='empTable' class='table table-striped table-bordered table-hover caption-top table-condensed display' cellspacing='0' width='40%'>
			<caption>Biontech aşısı olup ".$degisken." hastalığını daha önce geçirip COVID'e yakalananlar</caption>
			<thead>
			 <tr style='background-color:#FFDB12'>
			   <th scope='col'>İsim</th>
			   <th scope='col'>Soyisim</th>
			   <th scope='col'>Kan Grubu</th>
			   <th scope='col'>Pozisyon</th>
			   <th scope='col'>Maaş</th>
			 </tr>
			 </thead>
		 <tbody id='tableResult'>";
			while( $row = mysqli_fetch_array( $sorgu ) ) {
				$veri=$veri.'<tr style="background-color:#e9ffb3">
				<td scope="row">'.$row['first_name'].'</td>
				<td scope="row">'.$row['last_name'].'</td>
				<td scope="row">'.$row['blood_type'].'</td>
				<td scope="row">'.$row['position'].'</td>
				<td scope="row">'.$row['salary'].'</td>
				</tr>
				</tbody>';
			}
			$veri.="</table></div></div>";
			mysqli_close($con); 
			echo $veri;
		}
		elseif($sorgu==6){
			include("baglan.php");
			$sorgu=mysqli_query($con,"SELECT COUNT(vaccinated_before)/(SELECT COUNT(*) FROM covid) as oran FROM covid WHERE vaccinated_before='1' ")or die("Sorgu Bulunamadı").mysqli_error();
			$veri="<div class='container'><div class='row-mt-4'><table id='empTable' class='table table-striped table-bordered table-hover caption-top table-condensed display' cellspacing='0' width='100%'>
			<caption>Aşı Vurulma Durumuna Göre COVID Olma Sıklığı Oranı</caption>
			<thead>
			 <tr style='background-color:#34B6AF'>
			   <th scope='col'>Oran</th>
			  
			 </tr>
			 </thead>
		 <tbody id='tableResult'>";
			while( $row = mysqli_fetch_array( $sorgu ) ) {
				$veri=$veri.'
				<td scope="row">'.$row['oran'].'</td>
				
				</tr>
				</tbody>';
			}
			
			$veri.="</table></div></div>";
			mysqli_close($con); 
			echo $veri;
			
		}
		elseif($sorgu==7){
			include("baglan.php");
			
			$sorgu=mysqli_query($con,"SELECT e.first_name,e.last_name,DATEDIFF(c.covid_negative_date,c.covid_positive_date) as a FROM covid as c inner join employees as e inner join employees_and_diseases as ed inner join diseases as d on c.employee_id=e.id and e.id=ed.EmployeeID and ed.DiseaseID=d.DiseaseID and ed.DiseaseID=(SELECT DiseaseID FROM diseases WHERE Diseasename='$degisken') ")or die("Sorgu Bulunamadı").mysqli_error();
			$veri="<div class='container'><div class='row-mt-4'><table id='empTable' class='table table-striped table-bordered table-hover caption-top table-condensed display' cellspacing='0' width='100%'>
			<caption>Belirli bir kronik hastalığa göre, çalışanların COVID testinin negatife dönmesi için geçen süre </caption>
			<thead>
			 <tr style='background-color:#34B6AF'>
			   <th scope='col'>İsim</th>
			   <th scope='col'>Soyisim</th>
			   <th scope='col'>Negatife Dönme Süresi</th>
			 </tr>
			 </thead>
		 <tbody id='tableResult'>";
			while( $row = mysqli_fetch_array( $sorgu ) ) {
				$veri=$veri.'<tr style="background-color:#0FD287">
				<td scope="row">'.$row['first_name'].'</td>
				<td scope="row">'.$row['last_name'].'</td>
				<td scope="row">'.$row['a'].'</td>
				</tr>';
			}
			$veri.="
				</tbody></table></div></div>";
			mysqli_close($con); 
			echo $veri;
		}
		elseif($sorgu==8){
			include("baglan.php");
			$sorgu=mysqli_query($con,"SELECT employees.blood_type,COUNT(employees.id) as cesayi FROM covid 
			INNER JOIN employees ON covid.employee_id=employees.id GROUP BY employees.blood_type ")or die("Sorgu Bulunamadı").mysqli_error();
			$veri="<div class='container'><div class='row-mt-4'><table id='empTable' class='table table-striped table-bordered table-hover caption-top table-condensed display' cellspacing='0' width='100%'>
			<caption>Kan Grubuna Göre COVID'e Yakalanma Sıklığı</caption>
			<thead>
			 <tr style='background-color:#34B6AF'>
			   <th scope='col'>Kan Grubu</th>
			   <th scope='col'>Kişi Sayısı</th>
			 </tr>
			 </thead>
		 <tbody id='tableResult'>";
			while( $row = mysqli_fetch_array( $sorgu ) ) {
				$veri=$veri.'<tr style="background-color:#0FD287">
				<td scope="row">'.$row['blood_type'].'</td>
				<td scope="row">'.$row['cesayi'].'</td>
				</tr>';
			}
			$veri.="
				</tbody></table></div></div>";
			mysqli_close($con); 
			echo $veri;
			
		}
		elseif($sorgu==9){
			include("baglan.php");
			$sorgu=mysqli_query($con,"SELECT wt.employeeID,FLOOR(SUM(
				IF(wt.final_Time>wt.start_Time,
				   TIMEDIFF(wt.final_Time,wt.start_Time),
				   ADDTIME(TIMEDIFF('24:00:00',wt.start_Time),wt.final_Time))
			)/10000) as haftalikcs,c.covid_positive_date FROM workingTimes as wt LEFT JOIN covid as c
			ON c.employee_id=wt.employeeID GROUP BY wt.employeeID ")or die("Sorgu Bulunamadı").mysqli_error();
			$veri="<div class='container'><div class='row-mt-4'><table id='empTable' class='table table-striped table-bordered table-hover caption-top table-condensed display' cellspacing='0' width='100%'>
			<caption>Toplam çalışma süresi ile COVID’e yakalanma arasındaki istatistiki bilgi </caption>
			<thead>
			 <tr style='background-color:#34B6AF'>
			   <th scope='col'>Çalışan ID</th>
			   <th scope='col'>Haftalık Çalışma Saati</th>
			   <th scope='col'>Pozitif olma tarihi</th>
			 </tr>
			 </thead>
		 <tbody id='tableResult'>";
			while( $row = mysqli_fetch_array( $sorgu ) ) {
				$veri=$veri.'<tr style="background-color:#0FD287">
				<td scope="row">'.$row['employeeID'].'</td>
				<td scope="row">'.$row['haftalikcs'].'</td>
				<td scope="row">'.$row['covid_positive_date'].'</td>
				</tr>';
			}
			$veri.="
				</tbody></table></div></div>";
			mysqli_close($con); 
			echo $veri;
		}
		elseif($sorgu==10){
			include("baglan.php");
			$Sorgu = mysqli_query($con,"SELECT c.symptom_id, s.symptom_name, COUNT(c.symptom_id) AS sayı FROM covid as c INNER JOIN symptoms as s ON s.symptom_id = c.symptom_id GROUP BY symptom_id ORDER BY sayı DESC LIMIT 3") or die("Sorgu Bulunamadı").mysqli_error();
			$metin="<div class='container'><table class='table table-striped table-bordered table-hover table-responsive caption-top table-condensed display'>
	       <caption>COVID’e yakalananlar arasında görülen en sık karşılaşılan ilk 3 belirti</caption>
		   <thead>
				<tr style='background-color:#34B6AF'>
				  <th scope='col'>Belirti Bilgileri</th>
				  <th scope='col'>Karşılaşılma Sayısı</th>
				</tr>
			</thead>
			
		<tbody id='tableResult'>";
		    while($Kayit=mysqli_fetch_assoc($Sorgu)){ 
		$metin.=		
		'<tr style="background-color:#0BF65F" id="'.$Kayit['symptom_id'].'">
			<td scope="row">'.$Kayit['symptom_id'].'-'.$Kayit["symptom_name"].'</td>
			<td scope="row">'.$Kayit['sayı'].'</td>
			</tr>';
			}
			$metin.="		
		</tbody>
	</table></div>";
			echo $metin;
			mysqli_close($con);
		}
		elseif($sorgu==11){
			include("baglan.php");
			$Sorgu = mysqli_query($con,"SELECT ec.employee_id, e.first_name, e.last_name, COUNT(ec.employee_id) AS temasSayısı FROM employees_in_contact AS ec 
			INNER JOIN employees AS e ON e.id = ec.employee_id GROUP BY employee_id ORDER BY temasSayısı DESC LIMIT 3") or die("Sorgu Bulunamadı").mysqli_error();
			$metin="<div class='container'><table class='table table-striped table-bordered table-hover table-responsive caption-top table-condensed display'>
	       <caption>En fazla temasta bulunmuş ilk 3 çalışan</caption>
		   <thead>
				<tr style='background-color:#34B6AF'>
				  <th scope='col'>Çalışan Bilgileri</th>
				  <th scope='col'>Temas Sayısı</th>
				</tr>
			</thead>
			
		<tbody id='tableResult'>";
		    while($Kayit=mysqli_fetch_assoc($Sorgu)){ 
		$metin.=		
		'<tr style="background-color:#0BF65F" id="'.$Kayit['employee_id'].'">
			<td scope="row">'.$Kayit['employee_id'].'-'.$Kayit["first_name"].' '.$Kayit["last_name"].'</td>
			<td scope="row">'.$Kayit['temasSayısı'].'</td>
			</tr>';
			}
			$metin.="		
		</tbody>
	</table></div>";
			echo $metin;
			mysqli_close($con);
		}
		elseif($sorgu==12){
			include("baglan.php");
			$Sorgu = mysqli_query($con,"SELECT c.employee_id, e.first_name, e.last_name, c.vaccine_id, v.vaccine_name, c.covid_positive_date, c.covid_negative_date, 
			DATEDIFF(c.covid_negative_date,c.covid_positive_date) AS GünSayısı FROM covid AS c INNER JOIN employees as e INNER JOIN vaccines as v 
			ON e.id = c.employee_id AND c.vaccine_id = v.vaccine_id WHERE c.vaccine_id = 1 OR c.vaccine_id= 2") or die("Sorgu Bulunamadı").mysqli_error();
			$metin="<div class='container'><table class='table table-striped table-bordered table-hover table-responsive caption-top table-condensed display'>
	       <caption>COVID geçirme süresi göz önüne alınarak Biontech ve Sinovac aşılarının etkinliği</caption>
		   <thead>
				<tr style='background-color:#34B6AF'>
				  <th scope='col'>Çalışan Bilgileri</th>
				  <th scope='col'>Aşı Bilgileri</th>
				  <th scope='col'>Covid Pozitif Tarihi</th>
				  <th scope='col'>Covid Negatif Tarihi</th>
				  <th scope='col'>Covid Geçirme Gün Sayısı</th>
				</tr>
			</thead>
			
		<tbody id='tableResult'>";
		    while($Kayit=mysqli_fetch_assoc($Sorgu)){ 
		$metin.=		
		'<tr style="background-color:#0BF65F" id="'.$Kayit['employee_id'].'">
			<td scope="row">'.$Kayit['employee_id'].'-'.$Kayit["first_name"].' '.$Kayit["last_name"].'</td>
			<td scope="row">'.$Kayit['vaccine_id'].'-'.$Kayit['vaccine_name'].'</td>
			<td scope="row">'.$Kayit['covid_positive_date'].'</td>
			<td scope="row">'.$Kayit['covid_negative_date'].'</td>
			<td scope="row">'.$Kayit['GünSayısı'].'</td>
			</tr>';
			}
			$metin.="		
		</tbody>
	</table></div>";
			echo $metin;
			mysqli_close($con);
		}
		elseif($sorgu==13){
			include("baglan.php");
			$Sorgu = mysqli_query($con,"SELECT (SELECT COUNT(wt.employeeID) AS HaftaSonuÇalışanToplamKişiSayısı FROM workingTimes as wt 
			INNER JOIN doWeek as we ON wt.dayID=we.dID WHERE we.day='Cumartesi' or we.day='Pazar') AS HaftaSonuÇalışanToplamKişiSayısı,
			(SELECT COUNT(c.employee_id) AS HaftaSonuÇalışıpCovidOlanKişiSayısı
		FROM covid as c
		INNER JOIN workingTimes as wt
		INNER JOIN doWeek as we
		ON c.employee_id = wt.employeeID AND wt.dayID=we.dID WHERE we.day='Cumartesi' or we.day='Pazar') AS HaftaSonuÇalışıpCovidOlanKişiSayısı") or die("Sorgu Bulunamadı").mysqli_error();
			$metin="<div class='container'><table class='table table-striped table-bordered table-hover table-responsive caption-top table-condensed display'>
	       <caption>Haftasonu çalışan kişiler arasında COVID gözükme miktarı</caption>
		   <thead>
				<tr style='background-color:#34B6AF'>
				  <th scope='col'>Haftasonu Çalışan Toplam Kişi Sayısı</th>
				  <th scope='col'>Haftasonu Çalışıp Covid Olan Kişi Sayısı</th>
				</tr>
			</thead>
			
		<tbody id='tableResult'>";
		    while($Kayit=mysqli_fetch_assoc($Sorgu)){ 
		$metin.=		
		'<tr style="background-color:#0BF65F">
			<td scope="row">'.$Kayit['HaftaSonuÇalışanToplamKişiSayısı'].'</td>
			<td scope="row">'.$Kayit['HaftaSonuÇalışıpCovidOlanKişiSayısı'].'</td>
			</tr>';
			}
			$metin.="		
		</tbody>
	</table></div><br />";
			echo $metin;

$Haftasonucalisanlar = mysqli_query($con,"SELECT wt.employeeID, e.first_name, e.last_name, wt.dayID, we.day, wt.start_time, wt.final_time FROM workingTimes as wt INNER JOIN employees as e INNER JOIN doWeek as we ON wt.employeeID = e.id AND wt.dayID=we.dID WHERE we.day='Cumartesi' or we.day='Pazar'")or die("Sorgu Bulunamadı").mysqli_error();
	$Haftasonu="<div class='container'><table class='table table-striped table-bordered table-hover table-responsive caption-top table-condensed display'>
	       <caption>Haftasonu çalışan kişiler</caption>
		   <thead>
				<tr style='background-color:#34B6AF'>
				  <th scope='col'>Çalışan Bilgisi</th>
				  <th scope='col'>Gün Bilgisi</th>
				  <th scope='col'>Çalışma Zamanı Başlangıcı</th>
				  <th scope='col'>Çalışma Zamanı Bitişi</th>
				</tr>
			</thead>
			
		<tbody id='tableResult'>";
		    while($Kayit=mysqli_fetch_assoc($Haftasonucalisanlar)){ 
		$Haftasonu.=		
		'<tr style="background-color:#0BF65F">
			<td scope="row">'.$Kayit['employeeID'].'-'.$Kayit['first_name'].' '.$Kayit['last_name'].'</td>
			<td scope="row">'.$Kayit['dayID'].'-'.$Kayit['day'].'</td>
			<td scope="row">'.$Kayit['start_time'].'</td>
			<td scope="row">'.$Kayit['final_time'].'</td>
			</tr>';
			}
			$Haftasonu.="		
		</tbody>
	</table></div><br />";
			echo $Haftasonu;
			
$Haftasonucalisipcovid = mysqli_query($con,"SELECT c.employee_id, e.first_name, e.last_name, c.covid_positive_date, c.covid_negative_date, wt.dayID, we.day
		FROM covid as c
		INNER JOIN workingTimes as wt
        INNER JOIN employees as e
		INNER JOIN doWeek as we
		ON e.id = c.employee_id AND c.employee_id = wt.employeeID AND wt.dayID=we.dID WHERE we.day='Cumartesi' or we.day='Pazar'")or die("Sorgu Bulunamadı").mysqli_error();
	$Covid="<div class='container'><table class='table table-striped table-bordered table-hover table-responsive caption-top table-condensed display'>
	       <caption>Hafta sonu çalışıp covid olan kişiler</caption>
		   <thead>
				<tr style='background-color:#34B6AF'>
				  <th scope='col'>Çalışan Bilgisi</th>
				  <th scope='col'>Covid Pozitif Tarihi</th>
				  <th scope='col'>Covid Negatif Tarihi</th>
				  <th scope='col'>Gün Bilgisi</th>
				</tr>
			</thead>
			
		<tbody id='tableResult'>";
		    while($Kayit=mysqli_fetch_assoc($Haftasonucalisipcovid)){ 
		$Covid.=		
		'<tr style="background-color:#0BF65F">
			<td scope="row">'.$Kayit['employee_id'].'-'.$Kayit['first_name'].' '.$Kayit['last_name'].'</td>
			<td scope="row">'.$Kayit['covid_positive_date'].'</td>
			<td scope="row">'.$Kayit['covid_negative_date'].'</td>
			<td scope="row">'.$Kayit['dayID'].'-'.$Kayit['day'].'</td>
			</tr>';
			}
			$Covid.="		
		</tbody>
	</table></div>";
			echo $Covid;
			mysqli_close($con);
		}
		elseif($sorgu==14){
			include("baglan.php");
			$Sorgu = mysqli_query($con,"SELECT c.employee_id, e.first_name, e.last_name, c.covid_positive_date, c.covid_negative_date, c.symptom_id,c.symptom_id2,c.symptom_id3, c.vaccinated_before, c.vaccine_id FROM covid AS c INNER JOIN(SELECT ed.EmployeeID, COUNT(ed.EmployeeID) AS HastaOlmaSayısı FROM employees_and_diseases AS ed INNER JOIN diseases AS d ON ed.DiseaseID=d.DiseaseID WHERE d.isChronicDisease=0 GROUP BY ed.EmployeeID ORDER BY HastaOlmaSayısı DESC LIMIT 10) AS EnSıkHasta INNER JOIN employees AS e ON c.employee_id = e.id WHERE c.employee_id=EnSıkHasta.EmployeeID AND c.covid_positive_date >= NOW() - INTERVAL 1 MONTH")or die("Sorgu Bulunamadı").mysqli_error();
				
	$metin="<div class='container'><table class='table table-striped table-bordered table-hover table-responsive caption-top table-condensed display'>
	       <caption>En sık hasta olan ilk 10 kişinin son bir ay içerisinde COVID’e yakalanma durumları</caption>
		   <thead>
				<tr style='background-color:#34B6AF'>
				  <th scope='col'>Çalışan Bilgileri</th>
				  <th scope='col'>Covid Pozitif Tarihi</th>
				  <th scope='col'>Covid Negatif Tarihi</th>
				  <th scope='col'>1.Semptom ID</th>
				  <th scope='col'>2.Semptom ID</th>
				  <th scope='col'>3.Semptom ID</th>
				  <th scope='col'>Daha önce aşı oldunuz mu?</th>
				  <th scope='col'>Aşı ID</th>
				</tr>
			</thead>
			
		<tbody id='tableResult'>";
		    while($Kayit=mysqli_fetch_assoc($Sorgu)){ 
		$metin.=		
		'<tr style="background-color:#0BF65F" id="'.$Kayit['employee_id'].'">
			<td scope="row">'.$Kayit['employee_id'].'-'.$Kayit["first_name"].' '.$Kayit["last_name"].'</td>
			<td scope="row">'.$Kayit['covid_positive_date'].'</td>
			<td scope="row">'.$Kayit['covid_negative_date'].'</td>
			<td scope="row">'.$Kayit['symptom_id'].'</td>
			<td scope="row">'.$Kayit['symptom_id2'].'</td>
			<td scope="row">'.$Kayit['symptom_id3'].'</td>
			<td scope="row">'.$Kayit['vaccinated_before'].'</td>
			<td scope="row">'.$Kayit['vaccine_id'].'</td>
			</tr>';
			}
			$metin.="		
		</tbody>
	</table></div>";
			echo $metin;
			
			$EnsHasta = mysqli_query($con,"SELECT ed.EmployeeID, e.first_name, e.last_name, COUNT(ed.EmployeeID) AS HastaOlmaSayısı FROM employees_and_diseases AS ed INNER JOIN diseases AS d INNER JOIN employees as e ON ed.DiseaseID=d.DiseaseID AND ed.EmployeeID = e.id WHERE d.isChronicDisease=0 GROUP BY ed.EmployeeID ORDER BY HastaOlmaSayısı DESC LIMIT 10")or die("Sorgu Bulunamadı").mysqli_error();
	$EnHasta="<div class='container'><table class='table table-striped table-bordered table-hover table-responsive caption-top table-condensed display'>
	       <caption>En sık hasta olan ilk 10 kişi</caption>
		   <thead>
				<tr style='background-color:#34B6AF'>
				  <th scope='col'>Çalışan Bilgileri</th>
				  <th scope='col'>Hasta Olma Sayısı</th>
				</tr>
			</thead>
			
		<tbody id='tableResult'>";
		    while($Kayit=mysqli_fetch_assoc($EnsHasta)){ 
		$EnHasta.=		
		'<tr style="background-color:#0BF65F">
			<td scope="row">'.$Kayit['EmployeeID'].'-'.$Kayit["first_name"].' '.$Kayit["last_name"].'</td>
			<td scope="row">'.$Kayit['HastaOlmaSayısı'].'</td>
			</tr>';
			}
			$EnHasta.="		
		</tbody>
	</table></div><br />";
			echo $EnHasta;
		}
		elseif($sorgu==15){
			include("baglan.php");
			$Sorgu = mysqli_query($con,"SELECT ed.EmployeeID,e.first_name,e.last_name, ed.DiseaseID,d.DiseaseName, ed.prescriptionID FROM employees_and_diseases AS ed INNER JOIN (SELECT c.employee_id,DATEDIFF(c.covid_negative_date,c.covid_positive_date) AS GünSayısı FROM covid AS c INNER JOIN employees as e ON e.id = c.employee_id WHERE vaccinated_before=0 ORDER BY GünSayısı DESC LIMIT 1) AS enUzun INNER JOIN employees AS e INNER JOIN diseases AS d ON ed.EmployeeID = e.id AND ed.DiseaseID = d.DiseaseID WHERE dateGetSick >= NOW() - INTERVAL 1 YEAR AND ed.EmployeeID=enUzun.employee_id")or die("Sorgu Bulunamadı").mysqli_error();
			
	$metin="<div class='container'><table class='table table-striped table-bordered table-hover table-responsive caption-top table-condensed display'>
	       <caption>Aşı vurulmayanlar arasında, en uzun süre COVID geçiren kişinin, son 1 yılda geçirmiş olduğu hastalıklar ve verilen reçeteler</caption>
		   <thead>
				<tr style='background-color:#34B6AF'>
				  <th scope='col'>Çalışan Bilgileri</th>
				  <th scope='col'>Aşı Bilgileri</th>
				  <th scope='col'>Reçete ID</th>
				</tr>
			</thead>
			
		<tbody id='tableResult'>";
		    while($Kayit=mysqli_fetch_assoc($Sorgu)){ 
		$metin.=		
		'<tr style="background-color:#0BF65F" id="'.$Kayit['EmployeeID'].'">
			<td scope="row">'.$Kayit['EmployeeID'].'-'.$Kayit["first_name"].' '.$Kayit["last_name"].'</td>
			<td scope="row">'.$Kayit['DiseaseID'].'-'.$Kayit['DiseaseName'].'</td>
			<td scope="row">'.$Kayit['prescriptionID'].'</td>
			</tr>';
			}
			$metin.="		
		</tbody>
	</table></div>";
			echo $metin;
		}
		else header("Refresh:0;url=giris.php");
	}
	else header("Refresh:0;url=giris.php");
	ob_end_flush();
?>