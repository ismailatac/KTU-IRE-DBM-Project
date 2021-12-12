<?php
session_start();

ob_start();
if(isset($_SESSION["oturum"])) 
{header("Refresh:0;url=panel.php");}
else{
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="index.css" rel="stylesheet" />
<script src="js/popper.js"></script>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/jquery-ui.css">
<link rel="stylesheet" href="css/jquery-ui.theme.min.css">
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/giriskod.js">
</script>

<title>Health Center of Employees</title>
</head>
<body id="body">
	<div class="icr"><span class="pe">H</span>ealth <span class="pe">C</span>enter of <span class="pe">E</span>mployees</div>
	<div class="ic"><div class="form-group t1" style="width:450px;"  >
    <input type="text" class="form-control" onkeypress="Sayi(event)" maxlength="11" id="tc" placeholder="T.C Kimlik numaranızı giriniz" tabindex="1" />
  </div>
  <div class="form-group t2" style="width:450px;height:21px;">
    <input type="password" data-toggle="popover" class="form-control" id="sif" maxlength="12" placeholder="Yönetici Şifrenizi Giriniz" tabindex="2"/>

		</div></br><input onClick="giris()" type="button" value="Giriş" class="buton1" id="buton1"/>
	<div class="container">
		<div class="modal fade" id="uyari" role="dialog">
			<div class="modal-dialog">
				<div class="alert" role="alert" >
				  <h4 class="alert-heading" id="mesajb"></h4>
				  <p id="mesaj"></p>
				</div>
			</div>
  		</div>
	</div>
</div>
</body>
</html>
<?php
} 
ob_end_flush();
?>