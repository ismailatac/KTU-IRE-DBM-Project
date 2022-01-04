<script type="text/javascript" src="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css"></script>
<script type="text/javascript" src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<?php $con = mysqli_connect("localhost", "root", "Badem*5361", "denIRE2");
mysqli_set_charset($con, "UTF8");
?>

<script>		
$(document).ready( function () {
    $("#empdisTable").DataTable({
                initComplete: function () {
                    this.api().columns().every(function () {
                        var column = this;
                        var select = $('<select><option value=""></option></select>')
                            .appendTo($(column.footer()).empty())
                            .on('change', function () {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );
                                column
                                    .search(val ? '^' + val + '$' : '', true, false)
                                    .draw();
                            });
                        column.data().unique().sort().each(function (d, j) {
                            select.append('<option value="' + d + '">' + d + '</option>')
                        });
                    });
                },
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Turkish.json"
                },
                "searching": true,
                "ordering": true,
                "paging": true,
                "pagingType": "full_numbers",
                "pageLength": 10,
                "responsive": true
            });
        });
var SITE_URL ="http://20.98.81.237/empdis";
	
function RemoveAll(Operation,empID) {
	if(confirm('Kayıdı silmek istediğinize emin misiniz?')){
		$.get(SITE_URL+'/empdis-ajax.php?page='+Operation,{"ID":empID},function(data){
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
	
function sendForm(FormID,Operation,SendURL="") {
	$(".myload").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
	$("#mysubmit").prop("disabled",true);
	var myData=$("form#"+FormID).serialize();
	$.ajax({
		type:"post",
		url:SITE_URL+'/empdis-ajax.php?page='+Operation,
		data:myData,
		success:function(data){
			$(".myload").html("");
			$("#mysubmit").prop("disabled",false);
			data=data.split(":::",2);
			var message = data[0];
			var mistake = data[1];
			if(mistake == 'warning') {
				$("#result").html('<div class="alert alert-warning">'+message+'</div>');
			}else if(mistake == 'danger') {
				$("#result").html('<div class="alert alert-danger">'+message+'</div>');
			}else if(mistake == 'success') {
				$("#result").html('<div class="alert alert-success">'+message+'</div>');
				setTimeout(function(){
				window.location.href=SITE_URL+'/'+SendURL;
			 	},500);
			}
		}
	});
}
</script>	