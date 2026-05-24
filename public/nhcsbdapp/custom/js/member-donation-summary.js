var MemberDonationSummaryTable;
$(document).ready(function() {
	// top bar active
	$('#navUnit').addClass('active');	
	// manage brand table
	MemberDonationSummaryTable = $("#MemberDonationSummaryTable").DataTable({
		'ajax': 'php_action/fetchMemberDonationSummary.php',
		"pageLength": 100,
		'order': []	
	});
});

// print function
function PrintMemberDonationDetails(mid = null) {
	if(mid) {			
		$.ajax({
			url: 'php_action/printMemberDonationDetails.php',
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