<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<?php $con = mysqli_connect("localhost", "root", "Badem*5361", "denIRE2");
mysqli_set_charset($con, "UTF8");
?>

<script type="text/javascript">	
$.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {
        var min = parseInt( $('#min').val(), 10 );
        var max = parseInt( $('#max').val(), 10 );
        var salary = parseFloat( data[7] ) || 0;
 
        if ( ( isNaN( min ) && isNaN( max ) ) ||
             ( isNaN( min ) && salary <= max ) ||
             ( min <= salary   && isNaN( max ) ) ||
             ( min <= salary   && salary <= max ) )
        {
            return true;
        }
        return false;
    }
);
</script>
<script type="text/javascript">	
$(document).ready(function () {
    // Setup - add a text input to each footer cell
    $('#empTable thead tr')
        .clone(true)
        .addClass('filters')
        .appendTo('#empTable thead');
	$('#min, #max').keyup( function() {
        table.draw();
    	} );
 
    var table = $('#empTable').DataTable({
        orderCellsTop: true,
        fixedHeader: true,
		language: {
                    url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Turkish.json"
                },
        initComplete: function () {
            var api = this.api();
 
            // For each column
            api
                .columns()
                .eq(0)
                .each(function (colIdx) {
                    // Set the header cell to contain the input element
                    var cell = $('.filters th').eq(
                        $(api.column(colIdx).header()).index()
                    );
                    var title = $(cell).text();
                    $(cell).html('<input type="text" placeholder="' + title + '" />');
 
                    // On every keypress in this input
                    $(
                        'input',
                        $('.filters th').eq($(api.column(colIdx).header()).index())
                    )
                        .off('keyup change')
                        .on('keyup change', function (e) {
                            e.stopPropagation();
 
                            // Get the search value
                            $(this).attr('title', $(this).val());
                            var regexr = '({search})'; //$(this).parents('th').find('select').val();
 
                            var cursorPosition = this.selectionStart;
                            // Search the column for that value
                            api
                                .column(colIdx)
                                .search(
                                    this.value != ''
                                        ? regexr.replace('{search}', '(((' + this.value + ')))')
                                        : '',
                                    this.value != '',
                                    this.value == ''
                                )
                                .draw();
 
                            $(this)
                                .focus()[0]
                                .setSelectionRange(cursorPosition, cursorPosition);
                        });
                });
        },
    });
});
</script>
<script>
var SITE_URL = "http://20.98.81.237/employees";	
	
function RemoveAll(Operation,empID) {
	if(confirm('Kayıdı silmek istediğinize emin misiniz?')){
		$.get(SITE_URL+'/emp-ajax.php?page='+Operation,{"ID":empID},function(data){
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
		url:SITE_URL+'/emp-ajax.php?page='+Operation,
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