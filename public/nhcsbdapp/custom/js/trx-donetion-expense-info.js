var manageTraxExpenseInfoTable;
$(document).ready(function() {
	// top bar active
	$('#navUnit').addClass('active');	
	// manage brand table
	manageTraxExpenseInfoTable = $("#manageTraxExpenseInfoTable").DataTable({
		'ajax': 'php_action/fetchTrxDonetionExpenseInfo.php',
		'order': []		
	});

	// submit brand form function
	$("#submitExpenseInfoForm").unbind('submit').bind('submit', function() {
		// remove the error text
		$(".text-danger").remove();
		// remove the form error
		$('.form-group').removeClass('has-error').removeClass('has-success');			

		var ExpenseDate  = $("#ExpenseDate").val();
		var HeadName     = $("#HeadName").val();
		var PayeeName    = $("#PayeeName").val();
		var PaymentType  = $("#PaymentType").val();
		var Amount       = $("#Amount").val();

		if(ExpenseDate == "") {
			$("#ExpenseDate").after('<p class="text-danger">Expense Date field is required</p>');
			$('#ExpenseDate').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#ExpenseDate").find('.text-danger').remove();
			// success out for form 
			$("#ExpenseDate").closest('.form-group').addClass('has-success');	  	
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

		if(ExpenseDate || HeadName || PayeeName || PaymentType || Amount) {
			var form = $(this);
			// button loading
			$("#createExpenseInfoBtn").button('loading');

			$.ajax({
				url : form.attr('action'),
				type: form.attr('method'),
				data: form.serialize(),
				dataType: 'json',
				success:function(response) {
					// button loading
					$("#createExpenseInfoBtn").button('reset');

					if(response.success == true) {
						// reload the manage member table 
						manageTraxExpenseInfoTable.ajax.reload(null, false);						

  	  			// reset the form text
						$("#submitExpenseInfoForm")[0].reset();
						// remove the error text
						$(".text-danger").remove();
						// remove the form error
						$('.form-group').removeClass('has-error').removeClass('has-success');
  	  			
  	  			$('#add-expense-messages').html('<div class="alert alert-success">'+
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

function editExpenseInfo(trxid = null) {
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
		$('.edit-expenseinfo-result').addClass('div-hide');
		// modal footer
		$('.editExpenseInfoFooter').addClass('div-hide');
		$.ajax({
			url: 'php_action/fetchSelectedTrxDoneExpenseInfo.php',
			type: 'post',
			data: {trxid : trxid},
			dataType: 'json',
			success:function(response) {
				// modal loading
				$('.modal-loading').addClass('div-hide');
				// modal result
				$('.edit-expenseinfo-result').removeClass('div-hide');
				// modal footer
				$('.editExpenseInfoFooter').removeClass('div-hide');

				// setting the brand name value 
				$('#editExpenseDate').val(response.expensedate);
				$('#editHeadName').val(response.headname);
				$('#editPayeeName').val(response.payeename);
				$('#editPaymentType').val(response.paymenttype);
				$('#editAmount').val(response.amount);
				// brand id 
				$(".editExpenseInfoFooter").after('<input type="hidden" name="trxid" id="trxid" value="'+response.trxid+'" />');

				// update brand form 
				$('#editExpenseInfoForm').unbind('submit').bind('submit', function() {

					// remove the error text
					$(".text-danger").remove();
					// remove the form error
					$('.form-group').removeClass('has-error').removeClass('has-success');			

					var ExpenseDate = $('#editExpenseDate').val();
					var HeadName    = $('#editHeadName').val();
					var PayeeName   = $('#editPayeeName').val();
					var PaymentType = $('#editPaymentType').val();
					var Amount      = $('#editAmount').val();

					if(ExpenseDate == "") {
						$("#editExpenseDate").after('<p class="text-danger">Edit Expense Date field is required</p>');
						$('#editExpenseDate').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editExpenseDate").find('.text-danger').remove();
						// success out for form 
						$("#editExpenseDate").closest('.form-group').addClass('has-success');	  	
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
					
					if(ExpenseDate || HeadName || PayeeName || PaymentType || Amount) {
						var form = $(this);

						// submit btn
						$('#editExpenseInfoBtn').button('loading');

						$.ajax({
							url: form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {

								if(response.success == true) {
									console.log(response);
									// submit btn
									$('#editExpenseInfoBtn').button('reset');
									//('#editExpenseInfoModel').modal('hide');
									// reload the manage member table 
									manageTraxExpenseInfoTable.ajax.reload(null, false);								  	  										
									// remove the error text
									$(".text-danger").remove();
									// remove the form error
									$('.form-group').removeClass('has-error').removeClass('has-success');
			  	  			
			  	  			$('#edit-expenseinfo-messages').html('<div class="alert alert-success">'+
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
			url: 'php_action/fetchSelectedTrxDoneExpenseInfo.php',
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
						url: 'php_action/postTrxDoneExpenseInfo.php',
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
								manageTraxExpenseInfoTable.ajax.reload(null, false);
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
			url: 'php_action/fetchSelectedTrxDoneExpenseInfo.php',
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
						url: 'php_action/removeTrxDoneExpenseInfo.php',
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
								manageTraxExpenseInfoTable.ajax.reload(null, false);
								
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