var manageTraxDepositInfoTable;
$(document).ready(function() {
	// top bar active
	$('#navUnit').addClass('active');	
	// manage brand table
	manageTraxDepositInfoTable = $("#manageTraxDepositInfoTable").DataTable({
		'ajax': 'php_action/fetchLoanEMIEntryInfo.php?id=1',
		'order': []		
	});

	// submit brand form function
	$("#submitDepositInfoForm").unbind('submit').bind('submit', function() {
		// remove the error text
		$(".text-danger").remove();
		// remove the form error
		$('.form-group').removeClass('has-error').removeClass('has-success');			

		var DepositDate  = $("#DepositDate").val();
		var InstalmentNo = $("#InstalmentNo").val();
		var DepositTo    = $("#DepositTo").val();

		if(DepositDate == "") {
			$("#DepositDate").after('<p class="text-danger">Deposit Date field is required</p>');
			$('#DepositDate').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#DepositDate").find('.text-danger').remove();
			// success out for form 
			$("#DepositDate").closest('.form-group').addClass('has-success');	  	
		}

		if(InstalmentNo == "") {
			$("#InstalmentNo").after('<p class="text-danger">Instalment No field is required</p>');
			$('#InstalmentNo').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#InstalmentNo").find('.text-danger').remove();
			// success out for form 
			$("#InstalmentNo").closest('.form-group').addClass('has-success');	  	
		}

		if(DepositTo == "") {
			$("#DepositTo").after('<p class="text-danger">Deposit To field is required</p>');
			$('#DepositTo').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#DepositTo").find('.text-danger').remove();
			// success out for form 
			$("#DepositTo").closest('.form-group').addClass('has-success');	  	
		}	

		if(DepositDate || InstalmentNo || DepositTo) {
			var form = $(this);
			// button loading
			$("#createDepositInfoBtn").button('loading');

			$.ajax({
				url : form.attr('action'),
				type: form.attr('method'),
				data: form.serialize(),
				dataType: 'json',
				success:function(response) {
					// button loading
					$("#createDepositInfoBtn").button('reset');

					if(response.success == true) {
						// reload the manage member table 
						manageTraxDepositInfoTable.ajax.reload(null, false);						

  	  			// reset the form text
						$("#submitDepositInfoForm")[0].reset();
						// remove the error text
						$(".text-danger").remove();
						// remove the form error
						$('.form-group').removeClass('has-error').removeClass('has-success');
  	  			
  	  			$('#add-deposit-messages').html('<div class="alert alert-success">'+
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

function editDepositEntryInfo(trxid = null) {
	if(trxid) 
	{ 
		// remove hidden brand id text
		$('#trxid').remove();
		// remove the error 
		$('.text-danger').remove();
		// remove the form-error
		$('.form-group').removeClass('has-error').removeClass('has-success');

		// modal loading
		$('.modal-loading').removeClass('div-hide');
		// modal result
		$('.edit-depositentry-result').addClass('div-hide');
		// modal footer
		$('.editDepositEntryInfoFooter').addClass('div-hide');
		$.ajax({
			url: 'php_action/fetchSelectedLoanEMIEntryInfo.php',
			type: 'post',
			data: {trxid : trxid},
			dataType: 'json',
			success:function(response) {
				// modal loading
				$('.modal-loading').addClass('div-hide');
				// modal result
				$('.edit-depositentry-result').removeClass('div-hide');
				// modal footer
				$('.editDepositEntryInfoFooter').removeClass('div-hide');

				// setting the brand name value 
				$('#editDepositDate').val(response.depositdate);
				$('#editDepositTo').val(response.deposit_to);
				$('#editDepositAmount').val(response.deposit_amount);
				$('#editInstalmentNo').val(response.schedule_id);
				// brand id 
				$(".editDepositEntryInfoFooter").after('<input type="hidden" name="trxid" id="trxid" value="'+response.trxdid+'" />');

				// update brand form 
				$('#editDepositEntryInfoForm').unbind('submit').bind('submit', function() {

					// remove the error text
					$(".text-danger").remove();
					// remove the form error
					$('.form-group').removeClass('has-error').removeClass('has-success');			

					var DepositDate   = $('#editDepositDate').val();
					var DepositTo     = $('#editDepositTo').val();
					var InstalmentNo  = $('#editInstalmentNo').val();
					var DepositAmount = $('#editDepositAmount').val();

					if(DepositDate == "") {
						$("#editDepositDate").after('<p class="text-danger">Edit Deposit Date field is required</p>');
						$('#editDepositDate').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editDepositDate").find('.text-danger').remove();
						// success out for form 
						$("#editDepositDate").closest('.form-group').addClass('has-success');	  	
					}					

					if(DepositTo == "") {
						$("#editDepositTo").after('<p class="text-danger">Edit Deposit To field is required</p>');
						$('#editDepositTo').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editDepositTo").find('.text-danger').remove();
						// success out for form 
						$("#editDepositTo").closest('.form-group').addClass('has-success');	  	
					}

					if(InstalmentNo == "") {
						$("#editInstalmentNo").after('<p class="text-danger">Edit Instalment No field is required</p>');
						$('#editInstalmentNo').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editInstalmentNo").find('.text-danger').remove();
						// success out for form 
						$("#editInstalmentNo").closest('.form-group').addClass('has-success');	  	
					}

					if(DepositAmount == "") {
						$("#editDepositAmount").after('<p class="text-danger">Edit Deposit Amount field is required</p>');
						$('#editDepositAmount').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editDepositAmount").find('.text-danger').remove();
						// success out for form 
						$("#editDepositAmount").closest('.form-group').addClass('has-success');	  	
					}
					
					if(DepositDate ||  DepositTo || InstalmentNo || DepositAmount) {
						var form = $(this);

						// submit btn
						$('#editDepositEntryInfoBtn').button('loading');

						$.ajax({
							url: form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {

								if(response.success == true) {
									console.log(response);
									// submit btn
									$('#editDepositEntryInfoBtn').button('reset');

									// reload the manage member table 
									manageTraxDepositInfoTable.ajax.reload(null, false);								  	  										
									// remove the error text
									$(".text-danger").remove();
									// remove the form error
									$('.form-group').removeClass('has-error').removeClass('has-success');
			  	  			
			  	  			$('#edit-depositentry-messages').html('<div class="alert alert-success">'+
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

function getCustomerData1(dropdown) {
		var schedule_id = $("#InstalmentNo").val();		
			$.ajax({
				url: 'php_action/fetchSelectedInstalmentNo.php',
				type: 'post',
				data: {schedule_id : schedule_id},
				dataType: 'json',
				success:function(response) {
					// setting the rate value into the rate input field					
					$("#DepositAmount").val(response.currentdue);
					$("#DepositAmountValue").val(response.currentdue);
					$("#editDepositAmount").val(response.currentdue);
					$("#editDepositAmountValue").val(response.currentdue);
				} // /success
			}); // /ajax function to fetch the product data	
} // /select on Customer data
