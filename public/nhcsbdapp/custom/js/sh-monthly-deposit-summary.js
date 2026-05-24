var MemberDepositSummaryTable;
$(document).ready(function() {
	// top bar active
	$('#navUnit').addClass('active');	
	// manage brand table
	MemberDepositSummaryTable = $("#MemberDepositSummaryTable").DataTable({
		'ajax': 'php_action/fetchSHMonthlyDepositSummary.php',
		"pageLength": 100,
		'order': []	
	});
});

// print function
function PrintMemberDepositDetails(mid = null) {
	if(mid) {			
		$.ajax({
			url: 'php_action/PrintSHMonthlyDepositDetails.php',
			type: 'post',
			data: {mid: mid},
			dataType: 'text',
			success:function(response) {
				
		var mywindow = window.open('', 'Nurses Health Care Society', 'height=100%,width=100%');
        mywindow.document.write('<html><head><title></title>');        
        mywindow.document.write('</head><body>');
        mywindow.document.write(response);
        mywindow.document.write('</body></html>');

        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10
        mywindow.resizeTo(screen.width, screen.height);
        setTimeout(function() {
        }, 1250);	
			}
		});
	}
}