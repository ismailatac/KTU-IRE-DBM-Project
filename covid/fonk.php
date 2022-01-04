<script>
var SITE_URL = "http://localhost:8080/a/ae";	
	
function RemoveAll(Operation,empID) {
	if(confirm('Kayıdı silmek istediğinize emin misiniz?')){
		$.get(SITE_URL+'/ajax.php?page='+Operation,{"ID":empID},function(data){
			data=data.split(":::",2);
			var message = data[0];
			var mistake = data[1];
			alert(message);
			if(mistake == 'success') {
				$("#"+empID).remove();
				window.location.reload();
			}
		});
	}
}
</script>