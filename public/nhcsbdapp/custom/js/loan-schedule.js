var manageLoanScheduleInfoTable;
$(document).ready(function() {
	$('#navAccgroup').addClass('active');
	manageLoanScheduleInfoTable = $("#manageLoanScheduleInfoTable").DataTable({
		'ajax': 'php_action/fetchLoanSchedule.php',
		"pageLength": 100, 
		'order': []		
	});
});