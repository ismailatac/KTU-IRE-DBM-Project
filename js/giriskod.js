function Sayi(e) {     //TC Kimlik sayı kontrol

	islem = document.all ? window.event : e;

	karakter = document.all ? islem.keyCode : islem.which;

	if(karakter<48||karakter>57) {

		if(document.all) { islem.returnValue = false; } else { islem.preventDefault(); }

	}

}
function Harf(e) {

	islem = document.all ? window.event : e;

	karakter = document.all ? islem.keyCode : islem.which;

	if(karakter>=48&&karakter<=57) {

		if(document.all) { islem.returnValue = false; } else { islem.preventDefault(); }

	}

}

function uyari(a,b){
	if(a==1){
		$('#uyari').modal();
		$("#uyari").on('shown.bs.modal', function () {
		$('body').keypress(function(e){
			if(e.keyCode==13 && a==1){
			  $("#uyari").modal("hide");
				e.keyCode==0;
			}
			});
    	});
		$("#uyari").on("hidden.bs.modal", function () {
			$(".alert").removeClass(b);
		});
	}
	else 
		$('#uyari').modal({backdrop: "static"});
	
}	
function giris(){
	var tckim=document.getElementById("tc").value;
	var sif=document.getElementById("sif").value;
	if(tckim.length<11) { 
		$('#tc').popover({title: "Hata", content: "T.C. Kimlik Numarası 11 Haneli olmalıdır. Lütfen girdiğiniz numarayı kontrol ediniz...", animation: true, trigger: "focus", placement: "left"});
		$('#tc').focus();
		setTimeout(function(){$('#tc').popover('dispose');} , 3000);			 
		}
	else if(sif.length<8) {
		$('#sif').popover({title: "Hata", content: "Şifre en az 8 karakterden oluşmalıdır. Lütfen girdiğiniz şifreyi kontrol ediniz...", animation: true, trigger: "focus", placement: "left"});
		$('#sif').focus();
		setTimeout(function(){$('#sif').popover('dispose');} , 3000);}
	else{
	$(document).ready(function(){
				$.ajax({
					type: "POST",
					url : "phps/kontrol.php",
					data : { 
					tc: tckim,
					sifre: sif
					},
					success:function(sonuc){
						
						var kontrol=JSON.stringify(sonuc);
						kontrol=kontrol.substring(5,kontrol.length-1);
						if(kontrol=="tc-hata"){
							$("#mesajb").html("Hata");
							$("#mesaj").html("Sistemde böyle bir T.C. Kimlik Numarası bulunmamaktadır...");
							$(".alert").addClass("alert-warning"); uyari(1,"alert-warning");
						}
						else if(kontrol=="hata-sifre"){
							$("#mesajb").html("Hatalı Şifre");
							$("#mesaj").html("Hatalı bir şifre girdiniz.Lütfen tekrar deneyin...");
							$(".alert").addClass("alert-danger"); uyari(1,"alert-danger");
							
							
						}
						else if(kontrol=="dsifre"){
							$("#mesajb").html("Doğrulama Başarılı");
							$("#mesaj").html("Yönetici paneline yönlendiriliyorsunuz...");
							$(".alert").addClass("alert-success"); uyari(2,"alert-success");
							setTimeout(function(){location.href="panel.php"} , 2000);
						}
						else {
							$("#mesajb").html("Hata!");
							$("#mesaj").html("Bilinmeyen bir hata meydane geldi.Lütfen daha sonra tekrar deneyiniz...");
							$(".alert").addClass("alert-danger"); uyari(1,"alert-danger");
							
						}
					}
				});	 
			});	
	}
	
}
