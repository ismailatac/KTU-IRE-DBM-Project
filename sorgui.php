
<?php
session_start();

ob_start();
if(!isset($_SESSION["oturum"])) 
{header("Refresh:0;url=index.php");}
else{
	
?>
<!doctype html>
<html>
<head>
<style>
</style>
<meta charset="utf-8">
<link href="css/sorgui.css" rel="stylesheet" />
<script src="js/popper.js"></script>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/jquery-ui.css">
<link rel="stylesheet" href="css/jquery-ui.theme.min.css">
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/sorgui.js"></script>
</head>
<body onLoad="sagk()">
<div class="sol">
	<b><p class="baslik">Listeler ve İstatistiki Bilgiler</p></b> <br/><br/><hr class="he"><div class="kay"><div class="btn-group" id="rek">
    <input type="text" placeholder="Sorgu seçiniz" id="sorgumet" onkeyup="arama(this)"/>
    <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" id="dropsorgu" onClick="acma(this)">
    </button>
    <div class="dropdown-menu kmenu scroll" id="sorgu" aria-labelledby="dropdownMenuReference">
	<a class="dropdown-item"  id="sorguu0" onclick="sorgu(0)">Eğitim durumu ile COVID geçirme arasındaki istatistiki bilgi</a>
	<a class="dropdown-item"  id="sorguu1" onclick="sorgu(1)">Elemanlar arasında görülen en yaygın üç hastalık türü ve hastalığa sahip olan elemanların listesi</a>
	<a class="dropdown-item"  id="sorguu2" onclick="sorgu(2)">Belirli şehirde doğan elemanlar arasında en sık görülen ilk üç hastalık</a>
	<a class="dropdown-item"  id="sorguu3" onclick="sorgu(3)">En yaygın kullanılan ilk üç ilacı kullanan elemanların COVID geçirme durumu </a>
	<a class="dropdown-item"  id="sorguu4" onclick="sorgu(4)">Belirli bir ilacı kullanan çalışanların COVID geçirme durumu</a>
	<a class="dropdown-item"  id="sorguu5" onclick="sorgu(5)">Biontech aşısı olan ve belirli bir hastalığı önceden geçirmiş olan çalışanlardan COVID’e yakalananlar</a>
	<a class="dropdown-item"  id="sorguu6" onclick="sorgu(6)">Aşı vurulma durumuna göre COVID hastalığına yakalanma oranı</a>
	<a class="dropdown-item"  id="sorguu7" onclick="sorgu(7)">Belirli bir kronik hastalığa göre, çalışanların COVID testinin negatife dönmesi için geçen süre</a>
	<a class="dropdown-item"  id="sorguu8" onclick="sorgu(8)">Kan grubuna göre COVID’e yakalanma sıklığı</a>
	<a class="dropdown-item"  id="sorguu9" onclick="sorgu(9)">Toplam çalışma süresi ile COVID’e yakalanma arasındaki istatistiki bilgi </a>
	<a class="dropdown-item"  id="sorguu10" onclick="sorgu(10)">COVID’e yakalananlar arasında görülen en sık karşılaşılan ilk 3 belirti </a>
	<a class="dropdown-item"  id="sorguu11" onclick="sorgu(11)">En fazla temasta bulunmuş ilk 3 çalışan</a>
	<a class="dropdown-item"  id="sorguu12" onclick="sorgu(12)">Biontech ve sinovac aşılarının etkinliğinin, COVID geçirme süresi göz önüne alınarak kıyaslanması</a>
	<a class="dropdown-item"  id="sorguu13" onclick="sorgu(13)">Haftasonu çalışan kişiler arasında COVID gözükme miktarı</a>
	<a class="dropdown-item"  id="sorguu14" onclick="sorgu(14)">En sık hasta olan ilk 10 kişinin son bir ay içerisinde COVID’e yakalanma durumları</a>
	<a class="dropdown-item"  id="sorguu15" onclick="sorgu(15)">Aşı vurulmayanlar arasında, en uzun süre COVID geçiren kişinin, son 1 yılda geçirmiş olduğu hastalıklar ve verilen reçeteler </a>
    </div>
  	</div><br/>
	<div id="altmenu"></div></div>
</div>
<div class="sag" style="overflow-y: scroll;"></div>
</body>
</html>
<?php 
} 
ob_end_flush();

?>