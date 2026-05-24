var manageLoanApplicationInfoTable;
$(document).ready(function() {
	$('#navAccgroup').addClass('active');
	manageLoanApplicationInfoTable = $("#manageLoanApplicationInfoTable").DataTable({
		'ajax': 'php_action/fetchLoanApplicationInfo.php',
		'order': []		
	});

	// submit brand form function
	$("#submitLoanAppInfoForm").unbind('submit').bind('submit', function() {
		// remove the error text
		$(".text-danger").remove();
		// remove the form error
		$('.form-group').removeClass('has-error').removeClass('has-success');			

		var LoanApplicationDate = $("#LoanApplicationDate").val();
		var GuarantorName       = $("#GuarantorName").val();
		var LoanType            = $("#LoanType").val();
		var LoanAmount          = $("#LoanAmount").val();
		var InterestRate        = $("#InterestRate").val();
		var LoanTenure          = $("#LoanTenure").val();

		if(LoanApplicationDate == "") {
			$("#LoanApplicationDate").after('<p class="text-danger">Application Date field is required</p>');
			$('#LoanApplicationDate').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#LoanApplicationDate").find('.text-danger').remove();
			// success out for form 
			$("#LoanApplicationDate").closest('.form-group').addClass('has-success');	  	
		}	

		if(GuarantorName == "") {
			$("#GuarantorName").after('<p class="text-danger">Guarantor Name field is required</p>');
			$('#GuarantorName').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#GuarantorName").find('.text-danger').remove();
			// success out for form 
			$("#GuarantorName").closest('.form-group').addClass('has-success');	  	
		}
		
		if(LoanType == "") {
			$("#LoanType").after('<p class="text-danger">Loan Type field is required</p>');
			$('#LoanType').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#LoanType").find('.text-danger').remove();
			// success out for form 
			$("#LoanType").closest('.form-group').addClass('has-success');	  	
		}

		if(LoanAmount == "") {
			$("#LoanAmount").after('<p class="text-danger">Loan Amount field is required</p>');
			$('#LoanAmount').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#LoanAmount").find('.text-danger').remove();
			// success out for form 
			$("#LoanAmount").closest('.form-group').addClass('has-success');	  	
		}

		if(InterestRate == "") {
			$("#InterestRate").after('<p class="text-danger">Interest Rate field is required</p>');
			$('#InterestRate').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#InterestRate").find('.text-danger').remove();
			// success out for form 
			$("#InterestRate").closest('.form-group').addClass('has-success');	  	
		}

		if(LoanTenure == "") {
			$("#LoanTenure").after('<p class="text-danger">Loan Tenure field is required</p>');
			$('#LoanTenure').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#LoanTenure").find('.text-danger').remove();
			// success out for form 
			$("#LoanTenure").closest('.form-group').addClass('has-success');	  	
		}

		if(LoanApplicationDate || GuarantorName || LoanType || LoanAmount || InterestRate || LoanTenure) {
			var form = $(this);
			// button loading
			$("#createLoanApplicationInfoBtn").button('loading');

			$.ajax({
				url : form.attr('action'),
				type: form.attr('method'),
				data: form.serialize(),
				dataType: 'json',
				success:function(response) {
					// button loading
					$("#createLoanApplicationInfoBtn").button('reset');

					if(response.success == true) {
						// reload the manage member table 
						manageLoanApplicationInfoTable.ajax.reload(null, false);						

  	  			// reset the form text
						$("#submitLoanAppInfoForm")[0].reset();
						// remove the error text
						$(".text-danger").remove();
						// remove the form error
						$('.form-group').removeClass('has-error').removeClass('has-success');
  	  			
  	  			$('#add-loanappinfo-messages').html('<div class="alert alert-success">'+
            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
          '</div>');

  	  			$(".alert-success").delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						}); // /.alert
					}  // if

				} // /success
			}); // /ajax	
		} // if

		return false;
	}); // /submit brand form function

});

function postedResignInfo(LoanAppId = null) {
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
						url: 'php_action/postApp4Loan.php',
						type: 'post',
						data: {LoanAppId : LoanAppId},
						dataType: 'json',
						success:function(response) {
							
						$.ajax({
						url: 'php_action/send-sms-4loan.php',	
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
								$('#postedResignInfoModel').modal('hide');

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