var manageTraxMemberDepositInfoTable;
$(document).ready(function() {
	// top bar active
	$('#navUnit').addClass('active');	
	// manage brand table
	manageTraxMemberDepositInfoTable = $("#manageTraxMemberDepositInfoTable").DataTable({
		'ajax': 'php_action/fetchTrxMemberDepositEntry.php',
		'order': []		
	});

	// submit brand form function
	$("#submitDepositInfoForm").unbind('submit').bind('submit', function() {
		// remove the error text
		$(".text-danger").remove();
		// remove the form error
		$('.form-group').removeClass('has-error').removeClass('has-success');			

		var DepositDate  = $("#DepositDate").val();
		var PaymentType  = $("#PaymentType").val();
		var FromNo       = $("#FromNo").val();
		var Amount       = $("#Amount").val();
		var TrxNo        = $("#TrxNo").val();

		if(DepositDate == "") {
			$("#DepositDate").after('<p class="text-danger">Deposit Date field is required</p>');
			$('#DepositDate').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#DepositDate").find('.text-danger').remove();
			// success out for form 
			$("#DepositDate").closest('.form-group').addClass('has-success');	  	
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

		if(FromNo == "") {
			$("#FromNo").after('<p class="text-danger">From No field is required</p>');
			$('#FromNo').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#FromNo").find('.text-danger').remove();
			// success out for form 
			$("#FromNo").closest('.form-group').addClass('has-success');	  	
		}

		if(Amount == "") {
			$("#Amount").after('<p class="text-danger">Amount field is required</p>');
			$('#Amount').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#Amount").find('.text-danger').remove();
			// success out for form 
			$("#Amount").closest('.form-group').addClass('has-success');	  	
		}

		if(TrxNo == "") {
			$("#TrxNo").after('<p class="text-danger">TrxNo field is required</p>');
			$('#TrxNo').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#TrxNo").find('.text-danger').remove();
			// success out for form 
			$("#TrxNo").closest('.form-group').addClass('has-success');	  	
		}

		if(DepositDate || PaymentType || FromNo || Amount || TrxNo) {
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
						manageTraxMemberDepositInfoTable.ajax.reload(null, false);						

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

function editDepositInfo(trxid = null) {
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
		$('.edit-depositinfo-result').addClass('div-hide');
		// modal footer
		$('.editDepositInfoFooter').addClass('div-hide');
		$.ajax({
			url: 'php_action/fetchSelectedTrxMemDepositEntry.php',
			type: 'post',
			data: {trxid : trxid},
			dataType: 'json',
			success:function(response) {
				// modal loading
				$('.modal-loading').addClass('div-hide');
				// modal result
				$('.edit-depositinfo-result').removeClass('div-hide');
				// modal footer
				$('.editDepositInfoFooter').removeClass('div-hide');

				// setting the brand name value 
				$('#editDepositDate').val(response.deposit_date);
				$('#editPaymentType').val(response.deposit_type);
				$('#editFromNo').val(response.deposit_from);
				$('#editAmount').val(response.amount);
				$('#editTrxNo').val(response.trx_no);
				$('#editRemarks').val(response.remarks);
				
				// brand id 
				$(".editDepositInfoFooter").after('<input type="hidden" name="trxid" id="trxid" value="'+response.mdid+'" />');

				// update brand form 
				$('#editDepositInfoForm').unbind('submit').bind('submit', function() {

					// remove the error text
					$(".text-danger").remove();
					// remove the form error
					$('.form-group').removeClass('has-error').removeClass('has-success');			

					var DepositDate  = $('#editDepositDate').val();
					var PaymentType  = $('#editPaymentType').val();
					var FromNo       = $('#editFromNo').val();
					var Amount       = $('#editAmount').val();
					var TrxNo        = $('#editTrxNo').val();

					if(DepositDate == "") {
						$("#editDepositDate").after('<p class="text-danger">Edit Deposit Date field is required</p>');
						$('#editDepositDate').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editDepositDate").find('.text-danger').remove();
						// success out for form 
						$("#editDepositDate").closest('.form-group').addClass('has-success');	  	
					}

					if(PaymentType == "") {
						$("#editPaymentType").after('<p class="text-danger">Edit Payment Type field is required</p>');
						$('#editPaymentType').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editPaymentType").find('.text-danger').remove();
						// success out for form 
						$("#editPaymentType").closest('.form-group').addClass('has-success');	  	
					}

					if(FromNo == "") {
						$("#editFromNo").after('<p class="text-danger">Edit From No Name field is required</p>');
						$('#editFromNo').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editFromNo").find('.text-danger').remove();
						// success out for form 
						$("#editFromNo").closest('.form-group').addClass('has-success');	  	
					}

					if(Amount == "") {
						$("#editAmount").after('<p class="text-danger">Edit Amount Type field is required</p>');
						$('#editAmount').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editAmount").find('.text-danger').remove();
						// success out for form 
						$("#editAmount").closest('.form-group').addClass('has-success');	  	
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
					
					if(DepositDate || PaymentType || FromNo || Amount || TrxNo) {
						var form = $(this);

						// submit btn
						$('#editDepostInfoBtn').button('loading');

						$.ajax({
							url: form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {

								if(response.success == true) {
									console.log(response);
									// submit btn
									$('#editDepostInfoBtn').button('reset');
									//('#editDepositInfoModel').modal('hide');
									// reload the manage member table 
									manageTraxMemberDepositInfoTable.ajax.reload(null, false);								  	  										
									// remove the error text
									$(".text-danger").remove();
									// remove the form error
									$('.form-group').removeClass('has-error').removeClass('has-success');
			  	  			
			  	  			$('#edit-depositinfo-messages').html('<div class="alert alert-success">'+
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
			url: 'php_action/fetchSelectedTrxMemDepositEntry.php',
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
								manageTraxMemberDepositInfoTable.ajax.reload(null, false);
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
			url: 'php_action/fetchSelectedTrxMemDepositEntry.php',
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
								manageTraxMemberDepositInfoTable.ajax.reload(null, false);
								
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