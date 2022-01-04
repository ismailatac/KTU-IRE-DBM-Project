<?php
$con = mysqli_connect("localhost", "root", "Badem*5361", "denIRE2");
mysqli_set_charset($con, "UTF8");

$operation=$_GET["page"];

switch($operation) {
		case 'DelEmp':
		$GelenID = $_GET["ID"];
		$Sil = mysqli_query($con, "DELETE FROM employees WHERE id=" . $GelenID);
		if($Sil) {
			$message = 'Kayıt silindi:::success';	
		} else {
			$message = 'Kayıt silme başarısız:::danger';
		}
		echo $message;
		break;
		
		case 'AddEmp':
			$GelenTCNo 				= $_POST["tcno"];
			$GelenIsim     			= $_POST["firstname"];
			$GelenSoyIsim  			= $_POST["lastname"];
			$GelenKanGrubu  		= $_POST["bloodtype"];
			$GelenDogulanSehir  	= $_POST["cityofbirthid"];
			$GelenPozisyon  		= $_POST["position"];
			$GelenMaasDegeri  		= $_POST["salary"];
			$GelenHobiDegeri  		= $_POST["hobbies"];
			$GelenLisansDegeri  	= $_POST["undergraduate"];
			$GelenYuksekLisansDegeri  = $_POST["graduate"];
			$GelenDoktoraDegeri 	 = $_POST["doctorate"];
			$Uzunluk = mb_strlen($GelenTCNo);
				if(empty($GelenTCNo)) {
					$message = 'Lütfen TC Kimlik No\'yu boş bırakmayın:::warning';
				}else if(empty($GelenIsim) or empty($GelenSoyIsim)) {
					$message = 'Lütfen isim ve soyisim alanlarını boş bırakmayın:::warning';
				}else if(empty($GelenDogulanSehir)) {
					$message = 'Lütfen doğduğu şehir alanını boş bırakmayın:::warning';
				}else if(empty($GelenPozisyon)) {
					$message = 'Lütfen pozisyon alanını boş bırakmayın:::warning';
				}else if(empty($GelenMaasDegeri)) {
					$message = 'Lütfen maaş alanını boş bırakmayın:::warning';
				}else if($Uzunluk!=11) {
					$message = 'TC Kimlik Numarası 11 Haneli olmalıdır. Lütfen girdiğiniz numarayı kontrol ediniz:::warning';
				}else {
					$isHave = mysqli_query($con,"SELECT id FROM employees WHERE tcno='$GelenTCNo'");
					$have = mysqli_fetch_row($isHave);
					if($have) {
						$message='Bu TC No\'ya sahip kullanıcı girilmiştir:::danger';
					}else {
						$Ekle = mysqli_query($con, "INSERT INTO employees (tcno, first_name, last_name, blood_type, cityofbirth_id, position, salary, hobbies, undergraduate, graduate, doctorate) values ('$GelenTCNo', '$GelenIsim', '$GelenSoyIsim', '$GelenKanGrubu', '$GelenDogulanSehir', '$GelenPozisyon', '$GelenMaasDegeri', '$GelenHobiDegeri', '$GelenLisansDegeri', '$GelenYuksekLisansDegeri', '$GelenDoktoraDegeri')");
						if($Ekle){
							$message='Kayıt eklendi:::success';
						}else {
							$message='Üzgünüz kayıt eklemede bir hata oluştu:::danger';
						}
					}
				}
		echo $message;
		break;
}
?>