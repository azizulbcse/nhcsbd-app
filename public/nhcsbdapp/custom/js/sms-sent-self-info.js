var manageSMSSentInfoTable;

$(document).ready(function() {
	// top bar active
	$('#navUnit').addClass('active');
	
	// manage brand table
	manageSMSSentInfoTable = $("#manageSMSSentInfoTable").DataTable({
		'ajax': 'php_action/fetchSMSSentSelfInfo.php',
		'order': []		
	});
});