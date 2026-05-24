var manageTraxDonateInfoTable;
$(document).ready(function() {
	// top bar active
	$('#navUnit').addClass('active');	
	// manage brand table
	manageTraxDonateInfoTable = $("#manageTraxDonateInfoTable").DataTable({
		'ajax': 'php_action/fetchTrxDonateEntryInfo.php',
		'order': []		
	});

	// submit brand form function
	$("#submitDonationInfoForm").unbind('submit').bind('submit', function() {
		// remove the error text
		$(".text-danger").remove();
		// remove the form error
		$('.form-group').removeClass('has-error').removeClass('has-success');			

		var DonateDate   = $("#DonateDate").val();
		var PaymentType  = $("#PaymentType").val();
		var DonateFrom   = $("#DonateFrom").val();
		var DonateTo     = $("#DonateTo").val();
		var DonateAmount = $("#DonateAmount").val();
		var TrxNo        = $("#TrxNo").val();

		if(DonateDate == "") {
			$("#DonateDate").after('<p class="text-danger">Donate Date field is required</p>');
			$('#DonateDate').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#DonateDate").find('.text-danger').remove();
			// success out for form 
			$("#DonateDate").closest('.form-group').addClass('has-success');	  	
		}
		
		if(PaymentType == "") {
			$("#PaymentType").after('<p class="text-danger">Payment Type field is required</p>');
			$('#PaymentType').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#PaymentType").find('.text-danger').remove();
			// success out for form 
			$("#PaymentType").closest('.form-group').addClass('has-success');	  	
		}	

		if(DonateFrom == "") {
			$("#DonateFrom").after('<p class="text-danger">Donate From field is required</p>');
			$('#DonateFrom').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#DonateFrom").find('.text-danger').remove();
			// success out for form 
			$("#DonateFrom").closest('.form-group').addClass('has-success');	  	
		}	

		if(DonateTo == "") {
			$("#DonateTo").after('<p class="text-danger">Donate To field is required</p>');
			$('#DonateTo').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#DonateTo").find('.text-danger').remove();
			// success out for form 
			$("#DonateTo").closest('.form-group').addClass('has-success');	  	
		}	

		if(DonateAmount == "") {
			$("#DonateAmount").after('<p class="text-danger">Donate Amount field is required</p>');
			$('#DonateAmount').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#DonateAmount").find('.text-danger').remove();
			// success out for form 
			$("#DonateAmount").closest('.form-group').addClass('has-success');	  	
		}
		
		if(TrxNo == "") {
			$("#TrxNo").after('<p class="text-danger">Trx No field is required</p>');
			$('#TrxNo').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#TrxNo").find('.text-danger').remove();
			// success out for form 
			$("#TrxNo").closest('.form-group').addClass('has-success');	  	
		}

		if(DonateDate || PaymentType || DonateFrom || DonateTo || DonateAmount || TrxNo) {
			var form = $(this);
			// button loading
			$("#createDonationInfoBtn").button('loading');

			$.ajax({
				url : form.attr('action'),
				type: form.attr('method'),
				data: form.serialize(),
				dataType: 'json',
				success:function(response) {
					// button loading
					$("#createDonationInfoBtn").button('reset');

					if(response.success == true) {
						// reload the manage member table 
						manageTraxDonateInfoTable.ajax.reload(null, false);						

  	  			// reset the form text
						$("#submitDonationInfoForm")[0].reset();
						// remove the error text
						$(".text-danger").remove();
						// remove the form error
						$('.form-group').removeClass('has-error').removeClass('has-success');
  	  			
  	  			$('#add-donation-messages').html('<div class="alert alert-success">'+
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

function editDonationEntryInfo(trxid = null) {
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
		$('.edit-donationentry-result').addClass('div-hide');
		// modal footer
		$('.editDonationEntryInfoFooter').addClass('div-hide');
		$.ajax({
			url: 'php_action/fetchSelectedTrxDonationEntryInfo.php',
			type: 'post',
			data: {trxid : trxid},
			dataType: 'json',
			success:function(response) {
				// modal loading
				$('.modal-loading').addClass('div-hide');
				// modal result
				$('.edit-donationentry-result').removeClass('div-hide');
				// modal footer
				$('.editDonationEntryInfoFooter').removeClass('div-hide');

				// setting the brand name value 
				$('#editDonateDate').val(response.donatedate);
				$('#editPaymentType').val(response.payment_type);
				$('#editDonateFrom').val(response.donate_from);
				$('#editDonateTo').val(response.donate_to);
				$('#editDonateAmount').val(response.donate_amount);
				$('#editTrxNo').val(response.trxno);
				$('#editRemarks').val(response.remarks);
				// brand id 
				$(".editDonationEntryInfoFooter").after('<input type="hidden" name="trxid" id="trxid" value="'+response.trxdid+'" />');

				// update brand form 
				$('#editDonationEntryInfoForm').unbind('submit').bind('submit', function() {

					// remove the error text
					$(".text-danger").remove();
					// remove the form error
					$('.form-group').removeClass('has-error').removeClass('has-success');			

					var DonateDate   = $('#editDonateDate').val();
					var PaymentType  = $('#editPaymentType').val();
					var DonateFrom   = $('#editDonateFrom').val();
					var DonateTo     = $('#editDonateTo').val();
					var DonateAmount = $('#editDonateAmount').val();
					var TrxNo        = $('#editTrxNo').val();

					if(DonateDate == "") {
						$("#editDonateDate").after('<p class="text-danger">Donate Date field is required</p>');
						$('#editDonateDate').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editDonateDate").find('.text-danger').remove();
						// success out for form 
						$("#editDonateDate").closest('.form-group').addClass('has-success');	  	
					}

					if(PaymentType == "") {
						$("#editPaymentType").after('<p class="text-danger">Edit Donate Date field is required</p>');
						$('#editPaymentType').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editPaymentType").find('.text-danger').remove();
						// success out for form 
						$("#editPaymentType").closest('.form-group').addClass('has-success');	  	
					}

					if(DonateFrom == "") {
						$("#editDonateFrom").after('<p class="text-danger">Edit Donate From field is required</p>');
						$('#editDonateFrom').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editDonateFrom").find('.text-danger').remove();
						// success out for form 
						$("#editDonateFrom").closest('.form-group').addClass('has-success');	  	
					}

					if(DonateTo == "") {
						$("#editDonateTo").after('<p class="text-danger">Edit Donate Date field is required</p>');
						$('#editDonateTo').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editDonateTo").find('.text-danger').remove();
						// success out for form 
						$("#editDonateTo").closest('.form-group').addClass('has-success');	  	
					}

					if(DonateAmount == "") {
						$("#editDonateAmount").after('<p class="text-danger">Edit Donate Amount field is required</p>');
						$('#editDonateAmount').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editDonateAmount").find('.text-danger').remove();
						// success out for form 
						$("#editDonateAmount").closest('.form-group').addClass('has-success');	  	
					}

					if(TrxNo == "") {
						$("#editTrxNo").after('<p class="text-danger">Edit Trx No field is required</p>');
						$('#editTrxNo').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editTrxNo").find('.text-danger').remove();
						// success out for form 
						$("#editTrxNo").closest('.form-group').addClass('has-success');	  	
					}
					
					if(DonateDate || PaymentType || DonateFrom || DonateTo || DonateAmount || TrxNo) {
						var form = $(this);

						// submit btn
						$('#editDonationEntryInfoBtn').button('loading');

						$.ajax({
							url: form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {

								if(response.success == true) {
									console.log(response);
									// submit btn
									$('#editDonationEntryInfoBtn').button('reset');

									// reload the manage member table 
									manageTraxDonateInfoTable.ajax.reload(null, false);								  	  										
									// remove the error text
									$(".text-danger").remove();
									// remove the form error
									$('.form-group').removeClass('has-error').removeClass('has-success');
			  	  			
			  	  			$('#edit-donationentry-messages').html('<div class="alert alert-success">'+
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


function postedExpenseInfo(trxid = null) {
	if(trxid) {
		$('#trxid').remove();
		$.ajax({
			url: 'php_action/fetchSelectedTrxDonationEntryInfo.php',
			type: 'post',
			data: {trxid : trxid},
			dataType: 'json',
			success:function(response) {
				$('.postedExpenseInfoFooter').after('<input type="hidden" name="trxid" id="trxid" value="'+response.trxid+'" /> ');

				// click on remove button to remove the brand
				$("#postedExpenseInfoBtn").unbind('click').bind('click', function() {
					// button loading
					$("#postedExpenseInfoBtn").button('loading');

					$.ajax({
						url: 'php_action/postTrxExpenseInfo.php',
						type: 'post',
						data: {trxid : trxid},
						dataType: 'json',
						success:function(response) {

							console.log(response);
							// button loading
							$("#postedExpenseInfoBtn").button('reset');
							if(response.success == true) {

								// hide the remove modal 
								$('#postedExpenseInfoModal').modal('hide');

								// reload the brand table 
								manageTraxDonateInfoTable.ajax.reload(null, false);
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

		$('.postedExpenseInfoFooter').after();
	} else {
		alert('error!! Refresh the page again');
	}
} // /remove brands function


function removeExpenseInfo(trxid = null) {
	if(trxid) {
		$('#removetrxid').remove();
		$.ajax({
			url: 'php_action/fetchSelectedTrxDonationEntryInfo.php',
			type: 'post',
			data: {trxid : trxid},
			dataType: 'json',
			success:function(response) {
				$('.removeExpenseInfoFooter').after('<input type="hidden" name="removetrxid" id="removetrxid" value="'+response.trxid+'" /> ');

				// click on remove button to remove the brand
				$("#removeExpenseInfoBtn").unbind('click').bind('click', function() {
					// button loading
					$("#removeExpenseInfoBtn").button('loading');

					$.ajax({
						url: 'php_action/removeTrxExpenseInfo.php',
						type: 'post',
						data: {trxid : trxid},
						dataType: 'json',
						success:function(response) {
							console.log(response);
							// button loading
							$("#removeExpenseInfoBtn").button('reset');
							if(response.success == true) {

								// hide the remove modal 
								$('#removeExpenseInfoModal').modal('hide');

								// reload the brand table 
								manageTraxDonateInfoTable.ajax.reload(null, false);
								
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

		$('.removeExpenseInfoFooter').after();
	} else {
		alert('error!! Refresh the page again');
	}
} // /remove brands function