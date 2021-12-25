<?php
session_start();

ob_start();
if(isset($_SESSION["oturum"])) 
{header("Refresh:0;url=panel.php");}
else{
?>


<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>IRE</title>
  <meta name="generator" content="Google Web Designer 14.0.4.1108">
   <link rel="stylesheet" type="text/css" href="semantic/dist/semantic.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" />
<script
  src="https://code.jquery.com/jquery-3.1.1.min.js"
  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
  crossorigin="anonymous"></script>
<script src="semantic/dist/semantic.min.js"></script> 
  <style type="text/css" id="gwd-text-style">
	  
    p {
      margin: 0px;
    }
    h1 {
      margin: 0px;
    }
    h2 {
      margin: 0px;
    }
    h3 {
      margin: 0px;
    }
  </style>
  <style type="text/css">
    html, body {
      width: 100%;
      height: 100%;
      margin: 0px;
    }
    body {
      background-color: transparent;
      transform: perspective(1400px) matrix3d(1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1);
      transform-style: preserve-3d;
    }
    .baslik {
      position: absolute;
      
      left: 200px;
      top: 26px;
      font-size: 18.72px;
      font-weight: bold;
      text-align: center;
    }
    
    .calis-btn {
      position: absolute;
    
      left: 100px;
      top: 149px;
      font-size: 18.72px;
      font-weight: bold;
      text-align: center;
    }
    .h-ve-r {
      position: absolute;
     
      left: 600px;
      top: 145px;
      font-size: 18.72px;
      font-weight: bold;
      text-align: center;
    }
    .cvd {
      position: absolute;
     
      top: 145px;
      left:1200px;
      font-size: 18.72px;
      font-weight: bold;
      text-align: center;
    }
    .calis-saat {
      position: absolute;
    
      left: 350px;
      top: 300px;
      font-size: 18.72px;
      font-weight: bold;
      text-align: center;
    }
    .list {
      position: absolute;
      
      top: 300px;
      left: 850px;
      font-size: 18.72px;
      font-weight: bold;
      text-align: center;
    }
    
	   .kisi-ad {
      position: absolute;
      left: 1400px;
      top: 26px;
      
    }
	  .cikis-btn {
      position: absolute;
      left: 1350px;
      top: 50px;
      
    }
    .button {
  display: block;
  padding: 15px 25px;
  font-size: 24px;
  cursor: pointer;
  text-align: center;
  text-decoration: none;
  outline: none;
  color: #fff;
  background-color: #462660;
  border: none;
  border-radius: 15px;
  box-shadow: 0 9px #999;
}

	  .button:hover {background-color: #462660}

.button:active {
  background-color: #7E2CAF;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}
	.icr{
	position: absolute;
	left:32%;
	right:30%;
	top:10px;
	height: 80px;
	width: 500px;
	  }
	  .pe{
	font-size: 50px;
	font-weight: bold;
}
html, body {
background-color: white;
background:url("./aaa.jpeg") no-repeat center center fixed;
-webkit-background-size: cover;
-moz-background-size: cover;
-o-background-size: cover;
background-size: cover;

}	  
  </style>
</head>

<body class="htmlNoPages">
	
	
	
	
	
  <a style="color: black" href="anasayfa.php"><div class="icr"><p><span class="pe">IRE   </span> <span class="pe">H</span>ealth   <span class="pe">C</span>enter   of  <span class="pe">E</span >mployees</span></div></a>
  <a style="color: white" href="employees.php"><div class="calis-btn"><button class="button" >ÇALIŞANLAR</button></div></a>
	<a style="color: white" href="employeesanddiseases.php"><div class="h-ve-r"><button  class="button">HASTALIK VE REÇETE</button></div></a>
  <a style="color: white" href="covid.php"><div class="cvd"><button  class="button">COVID</button></div></a>
  <a style="color: white" href="workingtime.php"><div class="calis-saat"><button  class="button">ÇALIŞMA SAATLERİ</button></div></a>
  <a style="color: white" href=""><div class="list"><button  class="button">LİSTELER VE İSTATİSTİKİ BİLGİLER</button></div></a>
	<div class="kisi-ad">Kişi Adı</div>
	<a href=""><div class="cikis-btn"><button style="color: white" class="button">Çıkış yap</button></div></a>
  
</body>

</html>
<?php 
} 
ob_end_flush();

?>