var manageTraxIncomeInfoTable;
$(document).ready(function() {
	// top bar active
	$('#navUnit').addClass('active');	
	// manage brand table
	manageTraxIncomeInfoTable = $("#manageTraxIncomeInfoTable").DataTable({
		'ajax': 'php_action/fetchTrxIncomeInfo.php?id=2',
		'order': []		
	});

	// submit brand form function
	$("#submitIncomeInfoForm").unbind('submit').bind('submit', function() {
		// remove the error text
		$(".text-danger").remove();
		// remove the form error
		$('.form-group').removeClass('has-error').removeClass('has-success');			

		var IncomeDate  = $("#IncomeDate").val();
		var HeadName     = $("#HeadName").val();
		var PayeeName    = $("#PayeeName").val();
		var PaymentType  = $("#PaymentType").val();
		var Amount       = $("#Amount").val();

		if(IncomeDate == "") {
			$("#IncomeDate").after('<p class="text-danger">Income Date field is required</p>');
			$('#IncomeDate').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#IncomeDate").find('.text-danger').remove();
			// success out for form 
			$("#IncomeDate").closest('.form-group').addClass('has-success');	  	
		}	
		
		if(HeadName == "") {
			$("#HeadName").after('<p class="text-danger">Account Head Name field is required</p>');
			$('#HeadName').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#HeadName").find('.text-danger').remove();
			// success out for form 
			$("#HeadName").closest('.form-group').addClass('has-success');	  	
		}

		if(PayeeName == "") {
			$("#PayeeName").after('<p class="text-danger">Payee Name field is required</p>');
			$('#PayeeName').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#PayeeName").find('.text-danger').remove();
			// success out for form 
			$("#PayeeName").closest('.form-group').addClass('has-success');	  	
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

		if(Amount == "") {
			$("#Amount").after('<p class="text-danger">Amount field is required</p>');
			$('#Amount').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#Amount").find('.text-danger').remove();
			// success out for form 
			$("#Amount").closest('.form-group').addClass('has-success');	  	
		}

		if(IncomeDate || HeadName || PayeeName || PaymentType || Amount) {
			var form = $(this);
			// button loading
			$("#createIncomeInfoBtn").button('loading');

			$.ajax({
				url : form.attr('action'),
				type: form.attr('method'),
				data: form.serialize(),
				dataType: 'json',
				success:function(response) {
					// button loading
					$("#createIncomeInfoBtn").button('reset');

					if(response.success == true) {
						// reload the manage member table 
						manageTraxIncomeInfoTable.ajax.reload(null, false);						

  	  			// reset the form text
						$("#submitIncomeInfoForm")[0].reset();
						// remove the error text
						$(".text-danger").remove();
						// remove the form error
						$('.form-group').removeClass('has-error').removeClass('has-success');
  	  			
  	  			$('#add-income-messages').html('<div class="alert alert-success">'+
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

function editIncomeInfo(trxid = null) {
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
		$('.edit-incomeinfo-result').addClass('div-hide');
		// modal footer
		$('.editIncomeInfoFooter').addClass('div-hide');
		$.ajax({
			url: 'php_action/fetchSelectedTrxIncomeEntryInfo.php',
			type: 'post',
			data: {trxid : trxid},
			dataType: 'json',
			success:function(response) {
				// modal loading
				$('.modal-loading').addClass('div-hide');
				// modal result
				$('.edit-incomeinfo-result').removeClass('div-hide');
				// modal footer
				$('.editIncomeInfoFooter').removeClass('div-hide');

				// setting the brand name value 
				$('#editIncomeDate').val(response.incomedate);
				$('#editHeadName').val(response.headname);
				$('#editPayeeName').val(response.payeename);
				$('#editPaymentType').val(response.paymenttype);
				$('#editAmount').val(response.amount);
				// brand id 
				$(".editIncomeInfoFooter").after('<input type="hidden" name="trxid" id="trxid" value="'+response.trxid+'" />');

				// update brand form 
				$('#editIncomeInfoForm').unbind('submit').bind('submit', function() {

					// remove the error text
					$(".text-danger").remove();
					// remove the form error
					$('.form-group').removeClass('has-error').removeClass('has-success');			

					var IncomeDate = $('#editIncomeDate').val();
					var HeadName    = $('#editHeadName').val();
					var PayeeName   = $('#editPayeeName').val();
					var PaymentType = $('#editPaymentType').val();
					var Amount      = $('#editAmount').val();

					if(IncomeDate == "") {
						$("#editIncomeDate").after('<p class="text-danger">Edit Income Date field is required</p>');
						$('#editIncomeDate').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editIncomeDate").find('.text-danger').remove();
						// success out for form 
						$("#editIncomeDate").closest('.form-group').addClass('has-success');	  	
					}

					if(HeadName == "") {
						$("#editHeadName").after('<p class="text-danger">Edit Head Name field is required</p>');
						$('#editHeadName').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editHeadName").find('.text-danger').remove();
						// success out for form 
						$("#editHeadName").closest('.form-group').addClass('has-success');	  	
					}

					if(PayeeName == "") {
						$("#editPayeeName").after('<p class="text-danger">Edit Payee Name field is required</p>');
						$('#editPayeeName').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editPayeeName").find('.text-danger').remove();
						// success out for form 
						$("#editPayeeName").closest('.form-group').addClass('has-success');	  	
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

					if(Amount == "") {
						$("#editAmount").after('<p class="text-danger">Edit Amount field is required</p>');
						$('#editAmount').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editAmount").find('.text-danger').remove();
						// success out for form 
						$("#editAmount").closest('.form-group').addClass('has-success');	  	
					}
					
					if(IncomeDate || HeadName || PayeeName || PaymentType || Amount) {
						var form = $(this);

						// submit btn
						$('#editIncomeInfoBtn').button('loading');

						$.ajax({
							url: form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {

								if(response.success == true) {
									console.log(response);
									// submit btn
									$('#editIncomeInfoBtn').button('reset');
									//('#editExpenseInfoModel').modal('hide');
									// reload the manage member table 
									manageTraxIncomeInfoTable.ajax.reload(null, false);								  	  										
									// remove the error text
									$(".text-danger").remove();
									// remove the form error
									$('.form-group').removeClass('has-error').removeClass('has-success');
			  	  			
			  	  			$('#edit-incomeinfo-messages').html('<div class="alert alert-success">'+
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

function postedIncomeInfo(trxid = null) {
	if(trxid) {
		$('#trxid').remove();
		$.ajax({
			url: 'php_action/fetchSelectedTrxIncomeEntryInfo.php',
			type: 'post',
			data: {trxid : trxid},
			dataType: 'json',
			success:function(response) {
				$('.postedIncomeInfoFooter').after('<input type="hidden" name="trxid" id="trxid" value="'+response.trxid+'" /> ');

				// click on remove button to remove the brand
				$("#postedIncomeInfoBtn").unbind('click').bind('click', function() {
					// button loading
					$("#postedIncomeInfoBtn").button('loading');

					$.ajax({
						url: 'php_action/postTrxIncomeInfo.php',
						type: 'post',
						data: {trxid : trxid},
						dataType: 'json',
						success:function(response) {

							console.log(response);
							// button loading
							$("#postedIncomeInfoBtn").button('reset');
							if(response.success == true) {

								// hide the remove modal 
								$('#postedIncomeInfoModal').modal('hide');

								// reload the brand table 
								manageTraxIncomeInfoTable.ajax.reload(null, false);
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

		$('.postedIncomeInfoFooter').after();
	} else {
		alert('error!! Refresh the page again');
	}
} // /remove brands function

function removeIncomeInfo(trxid = null) {
	if(trxid) {
		$('#removetrxid').remove();
		$.ajax({
			url: 'php_action/fetchSelectedTrxIncomeEntryInfo.php',
			type: 'post',
			data: {trxid : trxid},
			dataType: 'json',
			success:function(response) {
				$('.removeIncomeInfoFooter').after('<input type="hidden" name="removetrxid" id="removetrxid" value="'+response.trxid+'" /> ');

				// click on remove button to remove the brand
				$("#removeIncomeInfoBtn").unbind('click').bind('click', function() {
					// button loading
					$("#removeIncomeInfoBtn").button('loading');

					$.ajax({
						url: 'php_action/removeTrxIncomeInfo.php',
						type: 'post',
						data: {trxid : trxid},
						dataType: 'json',
						success:function(response) {
							console.log(response);
							// button loading
							$("#removeIncomeInfoBtn").button('reset');
							if(response.success == true) {

								// hide the remove modal 
								$('#removeIncomeInfoModal').modal('hide');

								// reload the brand table 
								manageTraxIncomeInfoTable.ajax.reload(null, false);
								
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

		$('.removeIncomeInfoFooter').after();
	} else {
		alert('error!! Refresh the page again');
	}
} // /remove brands function

  // select on customer data
function getCustomerData(dropdown) {
		var PayeeName = $("#PayeeName").val();		
			$.ajax({
				url: 'php_action/fetchSelectedSUMDeposit.php',
				type: 'post',
				data: {PayeeName : PayeeName},
				dataType: 'json',
				success:function(response) {
					// setting the rate value into the rate input field
					
					$("#DepositAmount").val(response.mda);
					$("#PrevdueValue").val(response.mda);
				} // /success
			}); // /ajax function to fetch the product data	
} // /select on Customer data

function deductamount() {
	var DepositAmount = $("#DepositAmount").val();

	if(DepositAmount) {
		//var dueAmount =Number($("#DepositAmount").val())+ Number($("#Prevdue").val()) - Number($("#paid").val());
		var dueAmount =Number($("#DepositAmount").val()) *0.05;
		dueAmount = dueAmount.toFixed(2);
		$("#Amount").val(dueAmount);
		$("#AmountValue").val(dueAmount);
	} // /if
} // /paid amoutn function