<?php
	ob_start();
	if(!empty($_POST["sorgub"]))
	{
		$sorgub=$_POST["sorgub"];
		if($sorgub==2){
			$veri='<div class="btn-group">
			<input type="text" placeholder="İl seçiniz" id="sorgu2met" onkeyup="arama(this)"/>
			<button type="button" onClick="acma(this)" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" id="dropsorgu2">
			</button><div class="dropdown-menu kmenu" id="sorgu2" aria-labelledby="dropdownMenuReference">';
			include("baglan.php");
			$sorgu=mysqli_query($con,"SELECT * FROM cities")or die("Sorgu Bulunamadı").mysqli_error();
			$i=1;
			while( $row = mysqli_fetch_array( $sorgu ) ) {
				$veri=$veri.'<a class="dropdown-item" onClick="acma2(this)" id="met'.$i.'">'.$row['cityName'].'</a>';
				$i++;
			}
			$veri=$veri."</div></div><div id='altt'></div>";
			mysqli_close($con); 
			echo $veri;
		}
		elseif($sorgub==4){
			$veri='<div class="btn-group">
			<input type="text" placeholder="İlaç seçiniz" id="sorgu2met" onkeyup="arama(this)"/>
			<button type="button" onClick="acma(this)" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" id="dropsorgu2">
			</button><div class="dropdown-menu kmenu" id="sorgu2" aria-labelledby="dropdownMenuReference">';
			include("baglan.php");
			$sorgu=mysqli_query($con,"SELECT * FROM medicines")or die("Sorgu Bulunamadı").mysqli_error();
			$i=1;
			while( $row = mysqli_fetch_array( $sorgu ) ) {
				$veri=$veri.'<a class="dropdown-item" onClick="acma2(this)" id="met'.$i.'">'.$row['medicine_name'].'</a>';
				$i++;
			}
			$veri=$veri."</div></div><div id='altt'></div>";
			mysqli_close($con); 
			echo $veri;
		}
		else if($sorgub==5){
			$veri='<div class="btn-group">
			<input type="text" placeholder="Hastalık seçiniz" id="sorgu2met" onkeyup="arama(this)"/>
			<button type="button" onClick="acma(this)" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" id="dropsorgu2">
			</button><div class="dropdown-menu kmenu" id="sorgu2" aria-labelledby="dropdownMenuReference">';
			include("baglan.php");
			$sorgu=mysqli_query($con,"SELECT * FROM diseases")or die("Sorgu Bulunamadı").mysqli_error();
			$i=1;
			while( $row = mysqli_fetch_array( $sorgu ) ) {
				$veri=$veri.'<a class="dropdown-item" onClick="acma2(this)" id="met'.$i.'">'.$row['DiseaseName'].'</a>';
				$i++;
			}
			$veri=$veri."</div></div><div id='altt'></div>";
			mysqli_close($con); 
			echo $veri;
		}
		else if($sorgub==7){
			$veri='<div class="btn-group">
			<input type="text" placeholder="Kronik hastalık seçiniz" id="sorgu2met" onkeyup="arama(this)"/>
			<button type="button" onClick="acma(this)" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" id="dropsorgu2">
			</button><div class="dropdown-menu kmenu" id="sorgu2" aria-labelledby="dropdownMenuReference">';
			include("baglan.php");
			$sorgu=mysqli_query($con,"SELECT * FROM diseases WHERE isChronicDisease =1")or die("Sorgu Bulunamadı").mysqli_error();
			$i=1;
			while( $row = mysqli_fetch_array( $sorgu ) ) {
				$veri=$veri.'<a class="dropdown-item" onClick="acma2(this)" id="met'.$i.'">'.$row['DiseaseName'].'</a>';
				$i++;
			}
			$veri=$veri."</div></div><div id='altt'></div>";
			mysqli_close($con); 
			echo $veri;
		}
		else header("Refresh:0;url=giris.php");
	}
	else header("Refresh:0;url=giris.php");
	ob_end_flush();
?>