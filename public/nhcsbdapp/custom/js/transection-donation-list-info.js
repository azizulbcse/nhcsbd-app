var manageTraxDonationInfoTable;
$(document).ready(function() {
	// top bar active
	$('#navUnit').addClass('active');	
	// manage brand table
	manageTraxDonationInfoTable = $("#manageTraxDonationInfoTable").DataTable({
		'ajax': 'php_action/fetchTrxDonationListInfo.php',
		'order': []		
	});
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
				$('#editDonateDate').val(response.depositdate);
				$('#editPaymentType').val(response.payment_type);
				$('#editDonateFrom').val(response.deposit_from);
				$('#editDonateTo').val(response.deposit_to);
				$('#editDonateAmount').val(response.deposit_amount);
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
									manageTraxDonationInfoTable.ajax.reload(null, false);								  	  										
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


function postedDonationInfo(trxid = null) {
	if(trxid) {
		$('#trxid').remove();
		$.ajax({
			url: 'php_action/fetchSelectedTrxDonationEntryInfo.php',
			type: 'post',
			data: {trxid : trxid},
			dataType: 'json',
			success:function(response) {
				$('.postedDepositInfoFooter').after('<input type="hidden" name="trxid" id="trxid" value="'+response.trxdid+'" /> ');

				// click on remove button to remove the brand
				$("#postedDepositInfoBtn").unbind('click').bind('click', function() {
					// button loading
					$("#postedDepositInfoBtn").button('loading');

					$.ajax({
						url: 'php_action/postTrxDonationInfo.php',
						type: 'post',
						data: {trxid : trxid},
						dataType: 'json',
						success:function(response) {

							$.ajax({
								url: 'php_action/send-sms-donation.php',	
								type: 'post',
								data: {trxid : trxid},
								dataType: 'json',
								success:function(response) {
							}});

							console.log(response);
							// button loading
							$("#postedDepositInfoBtn").button('reset');
							if(response.success == true) {

								// hide the remove modal 
								$('#postedDepositInfoModal').modal('hide');

								// reload the brand table 
								manageTraxDonationInfoTable.ajax.reload(null, false);
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

		$('.postedDepositInfoFooter').after();
	} else {
		alert('error!! Refresh the page again');
	}
} // /remove brands function


function removeDonationInfo(trxid = null) {
	if(trxid) {
		$('#removetrxid').remove();
		$.ajax({
			url: 'php_action/fetchSelectedTrxDonationEntryInfo.php',
			type: 'post',
			data: {trxid : trxid},
			dataType: 'json',
			success:function(response) {
				$('.removeDepositInfoFooter').after('<input type="hidden" name="removetrxid" id="removetrxid" value="'+response.trxdid+'" /> ');

				// click on remove button to remove the brand
				$("#removeDepositInfoBtn").unbind('click').bind('click', function() {
					// button loading
					$("#removeDepositInfoBtn").button('loading');

					$.ajax({
						url: 'php_action/removeTrxDonationInfo.php',
						type: 'post',
						data: {trxid : trxid},
						dataType: 'json',
						success:function(response) {
							console.log(response);
							// button loading
							$("#removeDepositInfoBtn").button('reset');
							if(response.success == true) {

								// hide the remove modal 
								$('#removeDepositInfoModal').modal('hide');

								// reload the brand table 
								manageTraxDonationInfoTable.ajax.reload(null, false);
								
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

		$('.removeDepositInfoFooter').after();
	} else {
		alert('error!! Refresh the page again');
	}
} // /remove brands function