var MemberDepositDetailsTable;
$(document).ready(function() {
	// top bar active
	$('#navUnit').addClass('active');	
	// manage brand table
	MemberDepositDetailsTable = $("#MemberDepositDetailsTable").DataTable({
		'ajax': 'php_action/fetchMemberDepositDetails.php',
		//"pageLength": 100,
		'order': []	
	});
});