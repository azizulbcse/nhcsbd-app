var manageTraxDepositInfoTable;
$(document).ready(function() {
	// top bar active
	$('#navUnit').addClass('active');	
	// manage brand table
	manageTraxDepositInfoTable = $("#manageTraxDepositInfoTable").DataTable({
		'ajax': 'php_action/fetchDepositSHEntryAllInfo.php?id=2',
		'order': []		
	});

	// submit brand form function
	$("#submitDepositInfoForm").unbind('submit').bind('submit', function() {
		// remove the error text
		$(".text-danger").remove();
		// remove the form error
		$('.form-group').removeClass('has-error').removeClass('has-success');
					
		var DepositDate  = $("#DepositDate").val();
		var DepositForm  = $("#DepositForm").val();
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

		if(DepositForm == "") {
			$("#DepositForm").after('<p class="text-danger">Deposit Form field is required</p>');
			$('#DepositForm').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#DepositForm").find('.text-danger').remove();
			// success out for form 
			$("#DepositForm").closest('.form-group').addClass('has-success');	  	
		}

		if(TrxNo == "") {
			$("#TrxNo").after('<p class="text-danger">Slip No field is required</p>');
			$('#TrxNo').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#TrxNo").find('.text-danger').remove();
			// success out for form 
			$("#TrxNo").closest('.form-group').addClass('has-success');	  	
		}	

		if(DepositDate || DepositForm || TrxNo) {
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
			url: 'php_action/fetchSelectedDepositEntryInfo.php',
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
				$('#editMemberName').val(response.memberid);
				$('#editDepositForm').val(response.deposit_from);
				$('#editDepositAmount').val(response.deposit_amount);
				$('#editTrxNo').val(response.trxno);
				$('#editRemarks').val(response.remarks);
				// brand id 
				$(".editDepositEntryInfoFooter").after('<input type="hidden" name="trxid" id="trxid" value="'+response.trxdid+'" />');

				// update brand form 
				$('#editDepositEntryInfoForm').unbind('submit').bind('submit', function() {

					// remove the error text
					$(".text-danger").remove();
					// remove the form error
					$('.form-group').removeClass('has-error').removeClass('has-success');			

					var DepositDate   = $('#editDepositDate').val();
					var MemberName    = $('#editMemberName').val();
					var DepositForm   = $('#editDepositForm').val();
					var TrxNo         = $('#editTrxNo').val();
					var Remarks       = $('#editRemarks').val();

					if(DepositDate == "") {
						$("#editDepositDate").after('<p class="text-danger">Deposit Date field is required</p>');
						$('#editDepositDate').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editDepositDate").find('.text-danger').remove();
						// success out for form 
						$("#editDepositDate").closest('.form-group').addClass('has-success');	  	
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

					if(DepositForm == "") {
						$("#editDepositForm").after('<p class="text-danger">Edit Deposit Form field is required</p>');
						$('#editDepositForm').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editDepositForm").find('.text-danger').remove();
						// success out for form 
						$("#editDepositForm").closest('.form-group').addClass('has-success');	  	
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

					if(Remarks == "") {
						$("#editRemarks").after('<p class="text-danger">Edit Remarks Date field is required</p>');
						$('#editRemarks').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editRemarks").find('.text-danger').remove();
						// success out for form 
						$("#editRemarks").closest('.form-group').addClass('has-success');	  	
					}
					
					if(DepositDate || MemberName ||  DepositForm || TrxNo || Remarks) {
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