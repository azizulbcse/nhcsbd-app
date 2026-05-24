var manageResignReasonsInfoTable;

$(document).ready(function() {

	$('#navAccgroup').addClass('active');

	manageResignReasonsInfoTable = $("#manageResignReasonsInfoTable").DataTable({
		'ajax': 'php_action/fetchResignReasonsInfo.php',
		'order': []		
	});

	// submit brand form function
	$("#submitBankInfoForm").unbind('submit').bind('submit', function() {
		// remove the error text
		$(".text-danger").remove();
		// remove the form error
		$('.form-group').removeClass('has-error').removeClass('has-success');			

		var bankName = $("#bankName").val();
		if(bankName == "") {
			$("#bankName").after('<p class="text-danger">Resign Reasons field is required</p>');
			$('#bankName').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#bankName").find('.text-danger').remove();
			// success out for form 
			$("#bankName").closest('.form-group').addClass('has-success');	  	
		}		

		if(bankName) {
			var form = $(this);
			// button loading
			$("#createBankInfoBtn").button('loading');

			$.ajax({
				url : form.attr('action'),
				type: form.attr('method'),
				data: form.serialize(),
				dataType: 'json',
				success:function(response) {
					// button loading
					$("#createBankInfoBtn").button('reset');

					if(response.success == true) {
						// reload the manage member table 
						manageResignReasonsInfoTable.ajax.reload(null, false);						

  	  			// reset the form text
						$("#submitBankInfoForm")[0].reset();
						// remove the error text
						$(".text-danger").remove();
						// remove the form error
						$('.form-group').removeClass('has-error').removeClass('has-success');
  	  			
  	  			$('#add-bankinfo-messages').html('<div class="alert alert-success">'+
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

function editBankInfo(BankId = null) {
	if(BankId) 
	{ 
		// remove hidden brand id text
		$('#BankId').remove();
		// remove the error 
		$('.text-danger').remove();
		// remove the form-error
		$('.form-group').removeClass('has-error').removeClass('has-success');

		// modal loading
		$('.modal-loading').removeClass('div-hide');
		// modal result
		$('.edit-bankinfo-result').addClass('div-hide');
		// modal footer
		$('.editBankInfoFooter').addClass('div-hide');
		$.ajax({
			url: 'php_action/fetchSelectedSetupReResonsInfo.php',
			type: 'post',
			data: {BankId : BankId},
			dataType: 'json',
			success:function(response) {
				// modal loading
				$('.modal-loading').addClass('div-hide');
				// modal result
				$('.edit-bankinfo-result').removeClass('div-hide');
				// modal footer
				$('.editBankInfoFooter').removeClass('div-hide');

				// setting the brand name value 
				$('#editbankName').val(response.resignresons);
				// brand id 
				$(".editBankInfoFooter").after('<input type="hidden" name="BankId" id="BankId" value="'+response.rrid+'" />');

				// update brand form 
				$('#editBankInfoForm').unbind('submit').bind('submit', function() {

					// remove the error text
					$(".text-danger").remove();
					// remove the form error
					$('.form-group').removeClass('has-error').removeClass('has-success');			

					var bankName = $('#editbankName').val();

					if(bankName == "") {
						$("#editbankName").after('<p class="text-danger">Resign Reasons field is required</p>');
						$('#editbankName').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editbankName").find('.text-danger').remove();
						// success out for form 
						$("#editbankName").closest('.form-group').addClass('has-success');	  	
					}
					
					if(bankName) {
						var form = $(this);

						// submit btn
						$('#editBankInfoBtn').button('loading');

						$.ajax({
							url: form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {

								if(response.success == true) {
									console.log(response);
									// submit btn
									$('#editBankInfoBtn').button('reset');

									// reload the manage member table 
									manageResignReasonsInfoTable.ajax.reload(null, false);								  	  										
									// remove the error text
									$(".text-danger").remove();
									// remove the form error
									$('.form-group').removeClass('has-error').removeClass('has-success');
			  	  			
			  	  			$('#edit-bankinfo-messages').html('<div class="alert alert-success">'+
			            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
			            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
			          '</div>');

			  	  			$(".alert-success").delay(500).show(10, function() {
										$(this).delay(3000).hide(10, function() {
											$(this).remove();
										});
									}); // /.alert
								} // /if
									
							}// /success
						});	 // /ajax												
					} // /if

					return false;
				}); // /update brand form

			} // /success
		}); // ajax function

	} else {
		alert('error!! Refresh the page again');
	}
} // /edit brands function

function removeBankInfo(BankId = null) {
	if(BankId) {
		$('#BankId').remove();
		$.ajax({
			url: 'php_action/fetchSelectedSetupReResonsInfo.php',
			type: 'post',
			data: {BankId : BankId},
			dataType: 'json',
			success:function(response) {
				$('.removeBankInfoFooter').after('<input type="hidden" name="BankId" id="BankId" value="'+response.rrid+'" /> ');

				// click on remove button to remove the brand
				$("#removeBankInfoBtn").unbind('click').bind('click', function() {
					// button loading
					$("#removeBankInfoBtn").button('loading');

					$.ajax({
						url: 'php_action/removeSetupResignResonsInfo.php',
						type: 'post',
						data: {BankId : BankId},
						dataType: 'json',
						success:function(response) {
							console.log(response);
							// button loading
							$("#removeBankInfoBtn").button('reset');
							if(response.success == true) {

								// hide the remove modal 
								$('#removeBankInfo').modal('hide');

								// reload the brand table 
								manageResignReasonsInfoTable.ajax.reload(null, false);
								
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

		$('.removeBankInfoFooter').after();
	} else {
		alert('error!! Refresh the page again');
	}
} // /remove brands function