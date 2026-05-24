var managePayeeInfoTable;

$(document).ready(function() {
	// top bar active
	$('#navUnit').addClass('active');
	
	// manage brand table
	managePayeeInfoTable = $("#managePayeeInfoTable").DataTable({
		'ajax': 'php_action/fetchSetupAccPayeeInfo.php',
		'order': []		
	});

	// submit brand form function
	$("#submitPayeeInfoForm").unbind('submit').bind('submit', function() {
		// remove the error text
		$(".text-danger").remove();
		// remove the form error
		$('.form-group').removeClass('has-error').removeClass('has-success');			

		var PayeeName = $("#PayeeName").val();
		if(PayeeName == "") {
			$("#PayeeName").after('<p class="text-danger">Payee Names field is required</p>');
			$('#PayeeName').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#PayeeName").find('.text-danger').remove();
			// success out for form 
			$("#PayeeName").closest('.form-group').addClass('has-success');	  	
		}		

		if(PayeeName) {
			var form = $(this);
			// button loading
			$("#createPayeeInfoBtn").button('loading');

			$.ajax({
				url : form.attr('action'),
				type: form.attr('method'),
				data: form.serialize(),
				dataType: 'json',
				success:function(response) {
					// button loading
					$("#createPayeeInfoBtn").button('reset');

					if(response.success == true) {
						// reload the manage member table 
						managePayeeInfoTable.ajax.reload(null, false);						

  	  			// reset the form text
						$("#submitPayeeInfoForm")[0].reset();
						// remove the error text
						$(".text-danger").remove();
						// remove the form error
						$('.form-group').removeClass('has-error').removeClass('has-success');
  	  			
  	  			$('#add-payee-messages').html('<div class="alert alert-success">'+
            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
          '</div>');

  	  			$(".alert-success").delay(500).show(10, function() {
							$(this).delay(3000).payeeIde(10, function() {
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

function editPayeeInfo(payeeId = null) {
	if(payeeId) 
	{ 
		// remove payeeIdden brand id text
		$('#payeeId').remove();
		// remove the error 
		$('.text-danger').remove();
		// remove the form-error
		$('.form-group').removeClass('has-error').removeClass('has-success');

		// modal loading
		$('.modal-loading').removeClass('div-hide');
		// modal result
		$('.edit-payeeinfo-result').addClass('div-hide');
		// modal footer
		$('.editPayeeInfoFooter').addClass('div-hide');
		$.ajax({
			url: 'php_action/fetchSelectedSetupPayeeInfo.php',
			type: 'post',
			data: {payeeId : payeeId},
			dataType: 'json',
			success:function(response) {
				// modal loading
				$('.modal-loading').addClass('div-hide');
				// modal result
				$('.edit-payeeinfo-result').removeClass('div-hide');
				// modal footer
				$('.editPayeeInfoFooter').removeClass('div-hide');

				// setting the brand name value 
				$('#editPayeeName').val(response.payeeName);
				// brand id 
				$(".editPayeeInfoFooter").after('<input type="hidden" name="payeeId" id="payeeId" value="'+response.payeeId+'" />');

				// update brand form 
				$('#editPayeeInfoForm').unbind('submit').bind('submit', function() {

					// remove the error text
					$(".text-danger").remove();
					// remove the form error
					$('.form-group').removeClass('has-error').removeClass('has-success');			

					var PayeeName = $('#editPayeeName').val();

					if(PayeeName == "") {
						$("#editPayeeName").after('<p class="text-danger">Edit Payee Name field is required</p>');
						$('#editPayeeName').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editPayeeName").find('.text-danger').remove();
						// success out for form 
						$("#editPayeeName").closest('.form-group').addClass('has-success');	  	
					}
					
					if(PayeeName) {
						var form = $(this);

						// submit btn
						$('#editPayeeInfoBtn').button('loading');

						$.ajax({
							url: form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {

								if(response.success == true) {
									console.log(response);
									// submit btn
									$('#editPayeeInfoBtn').button('reset');

									// reload the manage member table 
									managePayeeInfoTable.ajax.reload(null, false);								  	  										
									// remove the error text
									$(".text-danger").remove();
									// remove the form error
									$('.form-group').removeClass('has-error').removeClass('has-success');
			  	  			
			  	  			$('#edit-payee-messages').html('<div class="alert alert-success">'+
			            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
			            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
			          '</div>');

			  	  			$(".alert-success").delay(500).show(10, function() {
										$(this).delay(3000).payeeIde(10, function() {
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

function removePayeeInfo(payeeId = null) {
	if(payeeId) {
		$('#removepayeeId').remove();
		$.ajax({
			url: 'php_action/fetchSelectedSetupPayeeInfo.php',
			type: 'post',
			data: {payeeId : payeeId},
			dataType: 'json',
			success:function(response) {
				$('.removePayeeInfoFooter').after('<input type="hidden" name="removepayeeId" id="removepayeeId" value="'+response.payeeId+'" /> ');

				// click on remove button to remove the brand
				$("#removePayeeInfoBtn").unbind('click').bind('click', function() {
					// button loading
					$("#removePayeeInfoBtn").button('loading');

					$.ajax({
						url: 'php_action/removeSetupAccPayeeInfo.php',
						type: 'post',
						data: {payeeId : payeeId},
						dataType: 'json',
						success:function(response) {
							console.log(response);
							// button loading
							$("#removePayeeInfoBtn").button('reset');
							if(response.success == true) {

								// payeeIde the remove modal 
								$('#removePayeeInfoModal').modal('hide');

								// reload the brand table 
								managePayeeInfoTable.ajax.reload(null, false);
								
								$('.remove-messages').html('<div class="alert alert-success">'+
			            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
			            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
			          '</div>');

			  	  			$(".alert-success").delay(500).show(10, function() {
										$(this).delay(3000).payeeIde(10, function() {
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

		$('.removePayeeInfoFooter').after();
	} else {
		alert('error!! Refresh the page again');
	}
} // /remove brands function