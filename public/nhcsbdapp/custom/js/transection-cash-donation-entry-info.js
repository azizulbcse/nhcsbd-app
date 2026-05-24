var manageTraxCashInfoTable;
$(document).ready(function() {
	// top bar active
	$('#navUnit').addClass('active');	
	// manage brand table
	manageTraxCashInfoTable = $("#manageTraxCashInfoTable").DataTable({
		'ajax': 'php_action/fetchTrxCashDonationEntryList.php',
		'order': []		
	});

	// submit brand form function
	$("#submitCashReceivedInfoForm").unbind('submit').bind('submit', function() {
		// remove the error text
		$(".text-danger").remove();
		// remove the form error
		$('.form-group').removeClass('has-error').removeClass('has-success');			

		var ReceivedDate   = $("#ReceivedDate").val();
		var MemberName     = $("#MemberName").val();

		if(ReceivedDate == "") {
			$("#ReceivedDate").after('<p class="text-danger">Received Date field is required</p>');
			$('#ReceivedDate').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#ReceivedDate").find('.text-danger').remove();
			// success out for form 
			$("#ReceivedDate").closest('.form-group').addClass('has-success');	  	
		}
		
		if(MemberName == "") {
			$("#MemberName").after('<p class="text-danger">Member Name field is required</p>');
			$('#MemberName').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#MemberName").find('.text-danger').remove();
			// success out for form 
			$("#MemberName").closest('.form-group').addClass('has-success');	  	
		}			

		if(ReceivedDate || MemberName) {
			var form = $(this);
			// button loading
			$("#createCashReceivedInfoBtn").button('loading');

			$.ajax({
				url : form.attr('action'),
				type: form.attr('method'),
				data: form.serialize(),
				dataType: 'json',
				success:function(response) {
					// button loading
					$("#createCashReceivedInfoBtn").button('reset');

					if(response.success == true) {
						// reload the manage member table 
						manageTraxCashInfoTable.ajax.reload(null, false);						

  	  			// reset the form text
						$("#submitCashReceivedInfoForm")[0].reset();
						// remove the error text
						$(".text-danger").remove();
						// remove the form error
						$('.form-group').removeClass('has-error').removeClass('has-success');
  	  			
  	  			$('#add-cashreceived-messages').html('<div class="alert alert-success">'+
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

function editCashReceivedEntryInfo(trxid = null) {
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
		$('.edit-cashreceived-result').addClass('div-hide');
		// modal footer
		$('.editCashReceivedEntryInfoFooter').addClass('div-hide');
		$.ajax({
			url: 'php_action/fetchSelectedTrxCashDepositEntryInfo.php',
			type: 'post',
			data: {trxid : trxid},
			dataType: 'json',
			success:function(response) {
				// modal loading
				$('.modal-loading').addClass('div-hide');
				// modal result
				$('.edit-cashreceived-result').removeClass('div-hide');
				// modal footer
				$('.editCashReceivedEntryInfoFooter').removeClass('div-hide');

				// setting the brand name value 
				$('#editReceivedDate').val(response.donatedate);
				$('#editMemberName').val(response.memberid);
				$('#editReceivedAmount').val(response.donate_amount);
				$('#editRemarks').val(response.remarks);
				// brand id 
				$(".editCashReceivedEntryInfoFooter").after('<input type="hidden" name="trxid" id="trxid" value="'+response.trxdid+'" />');

				// update brand form 
				$('#editCashReceivedEntryInfoForm').unbind('submit').bind('submit', function() {

					// remove the error text
					$(".text-danger").remove();
					// remove the form error
					$('.form-group').removeClass('has-error').removeClass('has-success');			

					var ReceivedDate   = $('#editReceivedDate').val();
					var MemberName     = $('#editMemberName').val();

					if(ReceivedDate == "") {
						$("#editReceivedDate").after('<p class="text-danger">Edit Received Date field is required</p>');
						$('#editReceivedDate').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editReceivedDate").find('.text-danger').remove();
						// success out for form 
						$("#editReceivedDate").closest('.form-group').addClass('has-success');	  	
					}

					if(MemberName == "") {
						$("#editMemberName").after('<p class="text-danger">Edit Member Name field is required</p>');
						$('#editMemberName').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editMemberName").find('.text-danger').remove();
						// success out for form 
						$("#editMemberName").closest('.form-group').addClass('has-success');	  	
					}
					
					if(ReceivedDate || MemberName) {
						var form = $(this);

						// submit btn
						$('#editCashReceivedEntryInfoBtn').button('loading');

						$.ajax({
							url: form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {

								if(response.success == true) {
									console.log(response);
									// submit btn
									$('#editCashReceivedEntryInfoBtn').button('reset');

									// reload the manage member table 
									manageTraxCashInfoTable.ajax.reload(null, false);								  	  										
									// remove the error text
									$(".text-danger").remove();
									// remove the form error
									$('.form-group').removeClass('has-error').removeClass('has-success');
			  	  			
			  	  			$('#edit-cashreceived-messages').html('<div class="alert alert-success">'+
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


function postedCashReceivedInfo(trxid = null) {
	if(trxid) {
		$('#trxid').remove();
		$.ajax({
			url: 'php_action/fetchSelectedTrxCashDepositEntryInfo.php',
			type: 'post',
			data: {trxid : trxid},
			dataType: 'json',
			success:function(response) {
				$('.postedCashReceivedInfoFooter').after('<input type="hidden" name="trxid" id="trxid" value="'+response.trxdid+'" /> ');

				// click on remove button to remove the brand
				$("#postedCashReceivedInfoBtn").unbind('click').bind('click', function() {
					// button loading
					$("#postedCashReceivedInfoBtn").button('loading');

					$.ajax({
						url: 'php_action/postTrxCashDonationInfo.php',
						type: 'post',
						data: {trxid : trxid},
						dataType: 'json',
						success:function(response) {

							console.log(response);
							// button loading
							$("#postedCashReceivedInfoBtn").button('reset');
							if(response.success == true) {

								// hide the remove modal 
								$('#postedCashReceivedInfoModel').modal('hide');

								// reload the brand table 
								manageTraxCashInfoTable.ajax.reload(null, false);
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

		$('.postedCashReceivedInfoFooter').after();
	} else {
		alert('error!! Refresh the page again');
	}
} // /remove brands function


function removeCashReceivedInfo(trxid = null) {
	if(trxid) {
		$('#removetrxid').remove();
		$.ajax({
			url: 'php_action/fetchSelectedTrxCashDepositEntryInfo.php',
			type: 'post',
			data: {trxid : trxid},
			dataType: 'json',
			success:function(response) {
				$('.removeCashReceivedInfoFooter').after('<input type="hidden" name="removetrxid" id="removetrxid" value="'+response.trxdid+'" /> ');

				// click on remove button to remove the brand
				$("#removeCashReceivedInfoBtn").unbind('click').bind('click', function() {
					// button loading
					$("#removeCashReceivedInfoBtn").button('loading');

					$.ajax({
						url: 'php_action/removeTrxCashDonationInfo.php',
						type: 'post',
						data: {trxid : trxid},
						dataType: 'json',
						success:function(response) {
							console.log(response);
							// button loading
							$("#removeCashReceivedInfoBtn").button('reset');
							if(response.success == true) {

								// hide the remove modal 
								$('#removeCashReceivedInfoModel').modal('hide');

								// reload the brand table 
								manageTraxCashInfoTable.ajax.reload(null, false);
								
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

		$('.removeCashReceivedInfoFooter').after();
	} else {
		alert('error!! Refresh the page again');
	}
} // /remove brands function