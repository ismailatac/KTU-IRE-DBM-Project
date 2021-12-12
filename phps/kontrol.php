<?php
session_start();
try{
	if(!empty($_POST["tc"]) && !empty($_POST["sifre"])){
		$tc=$_POST["tc"];
		$sifree=$_POST["sifre"];
		include("baglan.php");
		
		$sorgu=mysqli_query($con,"SELECT * FROM administrator WHERE tc='".$tc."'");
		if (mysqli_num_rows($sorgu) > 0) {
			$satir = mysqli_fetch_array( $sorgu ); 
			$sifrekont=$satir['p_word'];
			mysqli_close($con);
				if($sifree==$sifrekont){
					$_SESSION["oturum"] = "acik";
					$_SESSION["tc"] = $tc;
					$_SESSION["sifre"] = $sifree;
					echo "dsifre";
				}
				else {
					echo"hata-sifre";
				}
			
		}
		else {
			echo "tc-hata";
		}
	}
	else{
		echo "hata";
	}
}
catch(Exception $e)
{
echo "hata";	
}

?>