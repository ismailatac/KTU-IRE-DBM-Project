
<?php 

$referer = $_SERVER['HTTP_REFERER']; 
if ($referer == "") 
	echo "Hatalı İşlem";
else{
	$kullanici = "root"; //veritabanı kullanıcı adı
	$sifre = "Badem*5361"; //veritabanı şifresi
	$host = "localhost"; //mysql server
	$vt = "denIRE2"; //veritabanı adı


	$con=mysqli_connect($host,$kullanici,$sifre,$vt);
	mysqli_query($con,"SET NAMES UTF8");
	mysqli_query($con,"SET CHARACTER SET UTF8");
	if (mysqli_connect_errno())
	  {
	  echo "Veritabanı ile bağlantı kurulamadı: " . mysqli_connect_error();
	  } 
}
?>