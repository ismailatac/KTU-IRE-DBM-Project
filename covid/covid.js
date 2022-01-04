
function covidveri(){
	var emp=document.getElementById("employee").value;
	$(document).ready(function(){
				$.ajax({
					type: "POST",
					url : "covidveri.php",
					data: {
						id:emp
					},
					success:function(sonuc){
							$('.modal-body').html(sonuc);
							
						
					}
				});	 
			});
	
	$("#myModal").modal();
	
	
	
}
function kontrolasi(a){
	if(a.value==0){
		$('#ustasi').hide();
		document.getElementById('asi').value=null;
	}
	else if(a.value==1){
		if($('#ustasi').is(":hidden"))
			$('#ustasi').toggle('slide',500);}
		
		
	}
	

