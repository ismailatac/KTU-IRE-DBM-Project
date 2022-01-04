


function sagk(){
	if(!$('.sag').is(":hidden")) $('.sag').hide();
	
	
}



function acma(a){
	
	var kontrol=a.id;
	if(kontrol=="dropsorgu" || kontrol=="sorgumet"){
		if(!$('#sorgu2').is(":hidden")) $('#sorgu2').hide();
		$('#sorgu').toggle('dropdown');
	}
	else if(kontrol=="dropsorgu2" || kontrol=="sorgu2met"){
		$('#sorgu2').toggle('dropdown');
	}
								
}
function acma2(a){
		document.getElementById("sorgu2met").value=a.textContent;
		$('#sorgu2').hide();
		$('#altt').html("<button onClick='temizle()' class='btn btn-info' id='temiz'>Temizle</button> &nbsp;&nbsp;&nbsp;<button class='btn btn-info' onClick='calistir()'>Sorgu Çalıştır</button>");
		$('#altt').hide();
		 $('.sag').hide();
		$('#altt').toggle('slide',500);
	
	
}
function arama(element) {
    var metin, dizi, i, id,did;
	id=element.id;
	
	did=id.substring(0,id.length-3);
	if($('#'+did).is(":hidden"))
		acma(element);
    metin = document.getElementById(id).value.toUpperCase();
    dizi = document.getElementById(did).getElementsByTagName("a");
    for(i = 0; i < dizi.length; i++) {
        if(dizi[i].innerHTML.toUpperCase().indexOf(metin) > -1) 
		{
            dizi[i].style.display = "";
        } 
		else 
		{
            dizi[i].style.display = "none";
        }
    } 
	
}
function temizle(){
	if(!$('#altmenu').is(":hidden"))
		$('#altmenu').toggle('slide',500);
	document.getElementById("sorgumet").value="";
	if(!$('.sag').is(":hidden")) $('.sag').hide();
	
}




var sorg;
function sorgu(a){
	sorg=a;
	document.getElementById("sorgumet").value=document.getElementById("sorguu"+a).textContent;
	if(a==2 || a==4 || a==5 || a==7){
		$(document).ready(function(){
				$.ajax({
					type: "POST",
					url : "phps/butonsorgu.php",
					data: {
						  	sorgub: a
					},
					success:function(sonuc){
						$('#sorgu').hide();
						$('#altmenu').html(sonuc);
						$('#altmenu').hide();
						$('#altmenu').toggle('slide',500);
						
					}
				});	 
			});
	}
	else {
		$('#sorgu').hide();
		$('#altmenu').html("<button onClick='temizle()' class='btn btn-info' id='temiz'>Temizle</button> &nbsp;&nbsp;&nbsp;<button class='btn btn-info' onClick='calistir()'>Sorgu Çalıştır</button>");
		$('#altmenu').hide();
		 $('.sag').hide();
		$('#altmenu').toggle('slide',500);
	}
}
function calistir(){
	
	if(sorg==2 || sorg==4 || sorg==5 || sorg==7){
		var d=document.getElementById("sorgu2met").value;
		$(document).ready(function(){
				$.ajax({
					type: "POST",
					url : "phps/listSorgu.php",
					data: {
						  	sorgu: sorg,
							dgsken: d
					},
					success:function(sonuc){
						$('.sag').html(sonuc);
						$('.sag').hide();
						$('.sag').toggle('slide',500);
						
					}
				});	 
			});
	}
	else {
		if(sorg==0) sorg=16;
		$(document).ready(function(){
				$.ajax({
					type: "POST",
					url : "phps/listSorgu.php",
					data: {
						  	sorgu: sorg
							
					},
					success:function(sonuc){
						$('#sorgu').hide();
						$('.sag').html(sonuc);
						$('.sag').hide();
						$('.sag').toggle('slide',500);
						
					}
				});	 
			});
	}
	
}