var manageLoanApplicationInfoTable;
$(document).ready(function() {
	$('#navAccgroup').addClass('active');
	manageLoanApplicationInfoTable = $("#manageLoanApplicationInfoTable").DataTable({
		'ajax': 'php_action/fetchLoanAppList.php',
		'order': []		
	});
});

function removeResignInfo(LoanAppId = null) {
	if(LoanAppId) {
		$('#LoanAppId').remove();
		$.ajax({
			url: 'php_action/fetchSelectedApp4LoanInfo.php',
			type: 'post',
			data: {LoanAppId : LoanAppId},
			dataType: 'json',
			success:function(response) {
				$('.removeResignInfoFooter').after('<input type="hidden" name="LoanAppId" id="LoanAppId" value="'+response.loanappid+'" /> ');

				// click on remove button to remove the brand
				$("#removeResignInfoBtn").unbind('click').bind('click', function() {
					// button loading
					$("#removeResignInfoBtn").button('loading');

					$.ajax({
						url: 'php_action/removeApp4Loan.php',
						type: 'post',
						data: {LoanAppId : LoanAppId},
						dataType: 'json',
						success:function(response) {
							console.log(response);
							// button loading
							$("#removeResignInfoBtn").button('reset');
							if(response.success == true) {

								// hide the remove modal 
								$('#removeBankInfo').modal('hide');

								// reload the brand table 
								manageLoanApplicationInfoTable.ajax.reload(null, false);
								
								$('.remove-messages').html('<div class="alert alert-success">'+
			            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
			            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
			          '</div>');

			  	  			$(".alert-success").delay(500).show(10, function() {
										$(this).delay(3000).hide(10, function() {
											$(this).remove();
										});
									}); // /.alert
							} else {

							} // /else
						} // /response messages
					}); // /ajax function to remove the brand

				}); // /click on remove button to remove the brand

			} // /success
		}); // /ajax

		$('.removeResignInfoFooter').after();
	} else {
		alert('error!! Refresh the page again');
	}
} // /remove brands function

function PresidentApprovedResignInfo(LoanAppId = null) {
	if(LoanAppId) {
		$('#LoanAppId').remove();
		$.ajax({
			url: 'php_action/fetchSelectedApp4LoanInfo.php',
			type: 'post',
			data: {LoanAppId : LoanAppId},
			dataType: 'json',
			success:function(response) {
				$('.postedResignInfoFooter').after('<input type="hidden" name="LoanAppId" id="LoanAppId" value="'+response.loanappid+'" /> ');

				// click on remove button to remove the brand
				$("#postedResignInfoBtn").unbind('click').bind('click', function() {
					// button loading
					$("#postedResignInfoBtn").button('loading');

					$.ajax({
						url: 'php_action/postApp4LoanPresident.php',
						type: 'post',
						data: {LoanAppId : LoanAppId},
						dataType: 'json',
						success:function(response) {
							
						$.ajax({
						url: 'php_action/send-sms-app4loan-presi.php',	
						type: 'post',
						data: {LoanAppId : LoanAppId},
						dataType: 'json',
						success:function(response) {
						}});	

							console.log(response);
							// button loading
							$("#postedResignInfoBtn").button('reset');
							if(response.success == true) {

								// hide the remove modal 
								$('#PresidentApprovedResignInfoModel').modal('hide');

								// reload the brand table 
								manageLoanApplicationInfoTable.ajax.reload(null, false);
								//windows.reload();
								
								$('.remove-messages').html('<div class="alert alert-success">'+
			            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
			            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
			          '</div>');

			  	  			$(".alert-success").delay(500).show(10, function() {
										$(this).delay(3000).hide(10, function() {
											$(this).remove();
										});
									}); // /.alert
							} else {

							} // /else
						} // /response messages
					}); // /ajax function to remove the brand

				}); // /click on remove button to remove the brand

			} // /success
		}); // /ajax

		$('.postedResignInfoFooter').after();
	} else {
		alert('error!! Refresh the page again');
	}
} // /remove brands function


function SGApprovedResignInfo(LoanAppId = null) {
	if(LoanAppId) {
		$('#LoanAppId').remove();
		$.ajax({
			url: 'php_action/fetchSelectedApp4LoanInfo.php',
			type: 'post',
			data: {LoanAppId : LoanAppId},
			dataType: 'json',
			success:function(response) {
				$('.postedResignInfoFooterSG').after('<input type="hidden" name="LoanAppId" id="LoanAppId" value="'+response.loanappid+'" /> ');

				// click on remove button to remove the brand
				$("#postedResignInfoBtnSG").unbind('click').bind('click', function() {
					// button loading
					$("#postedResignInfoBtnSG").button('loading');

					$.ajax({
						url: 'php_action/postApp4LoanSG.php',
						type: 'post',
						data: {LoanAppId : LoanAppId},
						dataType: 'json',
						success:function(response) {							

                        $.ajax({
						url: 'php_action/send-sms-app4loan-sg.php',	
						type: 'post',
						data: {LoanAppId : LoanAppId},
						dataType: 'json',
						success:function(response) {
						}});
							console.log(response);
							// button loading
							$("#postedResignInfoBtnSG").button('reset');
							if(response.success == true) {

								// hide the remove modal 
								$('#SGApprovedResignInfoModel').modal('hide');

								// reload the brand table 
								manageLoanApplicationInfoTable.ajax.reload(null, false);
								//windows.reload();
								
								$('.remove-messages').html('<div class="alert alert-success">'+
			            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
			            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
			          '</div>');

			  	  			$(".alert-success").delay(500).show(10, function() {
										$(this).delay(3000).hide(10, function() {
											$(this).remove();
										});
									}); // /.alert
							} else {

							} // /else
						} // /response messages
					}); // /ajax function to remove the brand

				}); // /click on remove button to remove the brand

			} // /success
		}); // /ajax

		$('.postedResignInfoFooterSG').after();
	} else {
		alert('error!! Refresh the page again');
	}
} // /remove brands function

function ACCApprovedResignInfo(LoanAppId = null) {
	if(LoanAppId) {
		$('#LoanAppId').remove();
		$.ajax({
			url: 'php_action/fetchSelectedApp4LoanInfo.php',
			type: 'post',
			data: {LoanAppId : LoanAppId},
			dataType: 'json',
			success:function(response) {
				$('.postedResignInfoFooterACC').after('<input type="hidden" name="LoanAppId" id="LoanAppId" value="'+response.loanappid+'" /> ');

				// click on remove button to remove the brand
				$("#postedResignInfoBtnACC").unbind('click').bind('click', function() {
					// button loading
					$("#postedResignInfoBtnACC").button('loading');

					$.ajax({
						url: 'php_action/postApp4LoanACC.php',
						type: 'post',
						data: {LoanAppId : LoanAppId},
						dataType: 'json',
						success:function(response) {
							
                        $.ajax({
						url: 'php_action/send-sms-app4Loan-acc.php',	
						type: 'post',
						data: {LoanAppId : LoanAppId},
						dataType: 'json',
						success:function(response) {
						}});

							console.log(response);
							// button loading
							$("#postedResignInfoBtnACC").button('reset');
							if(response.success == true) {

								// hide the remove modal 
								$('#ACCApprovedResignInfoModel').modal('hide');

								// reload the brand table 
								manageLoanApplicationInfoTable.ajax.reload(null, false);
								//windows.reload();
								
								$('.remove-messages').html('<div class="alert alert-success">'+
			            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
			            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
			          '</div>');

			  	  			$(".alert-success").delay(500).show(10, function() {
										$(this).delay(3000).hide(10, function() {
											$(this).remove();
										});
									}); // /.alert
							} else {

							} // /else
						} // /response messages
					}); // /ajax function to remove the brand

				}); // /click on remove button to remove the brand

			} // /success
		}); // /ajax

		$('.postedResignInfoFooterACC').after();
	} else {
		alert('error!! Refresh the page again');
	}
} // /remove brands function
