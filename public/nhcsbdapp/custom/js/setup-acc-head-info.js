var manageAccHeadInfoTable;

$(document).ready(function() {
	// top bar active
	$('#navUnit').addClass('active');
	
	// manage brand table
	manageAccHeadInfoTable = $("#manageAccHeadInfoTable").DataTable({
		'ajax': 'php_action/fetchSetupAccHeadInfo.php',
		'order': []		
	});

	// submit brand form function
	$("#submitAccHeadInfoForm").unbind('submit').bind('submit', function() {
		// remove the error text
		$(".text-danger").remove();
		// remove the form error
		$('.form-group').removeClass('has-error').removeClass('has-success');
		
		var AccGroupName = $("#AccGroupName").val();
		if(AccGroupName == "") {
			$("#AccGroupName").after('<p class="text-danger">Account Group field is required</p>');
			$('#AccGroupName').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#AccGroupName").find('.text-danger').remove();
			// success out for form 
			$("#AccGroupName").closest('.form-group').addClass('has-success');	  	
		}

		var AccountHead = $("#AccountHead").val();
		if(AccountHead == "") {
			$("#AccountHead").after('<p class="text-danger">Account Head field is required</p>');
			$('#AccountHead').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#AccountHead").find('.text-danger').remove();
			// success out for form 
			$("#AccountHead").closest('.form-group').addClass('has-success');	  	
		}		

		if(AccGroupName || AccountHead) {
			var form = $(this);
			// button loading
			$("#createAccountHeadInfoBtn").button('loading');

			$.ajax({
				url : form.attr('action'),
				type: form.attr('method'),
				data: form.serialize(),
				dataType: 'json',
				success:function(response) {
					// button loading
					$("#createAccountHeadInfoBtn").button('reset');

					if(response.success == true) {
						// reload the manage member table 
						manageAccHeadInfoTable.ajax.reload(null, false);						

  	  			// reset the form text
						$("#submitAccHeadInfoForm")[0].reset();
						// remove the error text
						$(".text-danger").remove();
						// remove the form error
						$('.form-group').removeClass('has-error').removeClass('has-success');
  	  			
  	  			$('#add-acchead-messages').html('<div class="alert alert-success">'+
            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
          '</div>');

  	  			$(".alert-success").delay(500).show(10, function() {
							$(this).delay(3000).accHeadIde(10, function() {
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

function editAccountHeadInfo(accHeadId = null) {
	if(accHeadId) 
	{ 
		// remove accHeadIdden brand id text
		$('#accHeadId').remove();
		// remove the error 
		$('.text-danger').remove();
		// remove the form-error
		$('.form-group').removeClass('has-error').removeClass('has-success');

		// modal loading
		$('.modal-loading').removeClass('div-hide');
		// modal result
		$('.edit-acchead-result').addClass('div-hide');
		// modal footer
		$('.editAccountHeadFooter').addClass('div-hide');
		$.ajax({
			url: 'php_action/fetchSelectedSetupAccHeadInfo.php',
			type: 'post',
			data: {accHeadId : accHeadId},
			dataType: 'json',
			success:function(response) {
				// modal loading
				$('.modal-loading').addClass('div-hide');
				// modal result
				$('.edit-acchead-result').removeClass('div-hide');
				// modal footer
				$('.editAccountHeadFooter').removeClass('div-hide');

				// setting the brand name value 
				$('#editAccGroupName').val(response.accGroupId);
				$('#editAccountHead').val(response.accHeadName);
				// brand id 
				$(".editAccountHeadFooter").after('<input type="hidden" name="accHeadId" id="accHeadId" value="'+response.accHeadId+'" />');

				// update brand form 
				$('#editAccHeadInfoForm').unbind('submit').bind('submit', function() {

					// remove the error text
					$(".text-danger").remove();
					// remove the form error
					$('.form-group').removeClass('has-error').removeClass('has-success');			

					var AccountGroup = $('#editAccGroupName').val();
					var AccountHead  = $('#editAccountHead').val();

					if(AccountGroup == "") {
						$("#editAccGroupName").after('<p class="text-danger">Edit Account Group field is required</p>');
						$('#editAccGroupName').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editAccGroupName").find('.text-danger').remove();
						// success out for form 
						$("#editAccGroupName").closest('.form-group').addClass('has-success');	  	
					}

					if(AccountHead == "") {
						$("#editAccountHead").after('<p class="text-danger">Edit Account Head field is required</p>');
						$('#editAccountHead').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editAccountHead").find('.text-danger').remove();
						// success out for form 
						$("#editAccountHead").closest('.form-group').addClass('has-success');	  	
					}
					
					if(AccountGroup || AccountHead) {
						var form = $(this);

						// submit btn
						$('#editAccountHeadBtn').button('loading');

						$.ajax({
							url: form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {

								if(response.success == true) {
									console.log(response);
									// submit btn
									$('#editAccountHeadBtn').button('reset');

									// reload the manage member table 
									manageAccHeadInfoTable.ajax.reload(null, false);								  	  										
									// remove the error text
									$(".text-danger").remove();
									// remove the form error
									$('.form-group').removeClass('has-error').removeClass('has-success');
			  	  			
			  	  			$('#edit-acchead-messages').html('<div class="alert alert-success">'+
			            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
			            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
			          '</div>');

			  	  			$(".alert-success").delay(500).show(10, function() {
										$(this).delay(3000).accHeadIde(10, function() {
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

function removeAccHeadInfo(accHeadId = null) {
	if(accHeadId) {
		$('#removeaccHeadId').remove();
		$.ajax({
			url: 'php_action/fetchSelectedSetupAccHeadInfo.php',
			type: 'post',
			data: {accHeadId : accHeadId},
			dataType: 'json',
			success:function(response) {
				$('.removeAccHeadInfoFooter').after('<input type="hidden" name="removeaccHeadId" id="removeaccHeadId" value="'+response.accHeadId+'" /> ');

				// click on remove button to remove the brand
				$("#removeAccHeadInfoBtn").unbind('click').bind('click', function() {
					// button loading
					$("#removeAccHeadInfoBtn").button('loading');

					$.ajax({
						url: 'php_action/removeSetupAccHeadInfo.php',
						type: 'post',
						data: {accHeadId : accHeadId},
						dataType: 'json',
						success:function(response) {
							console.log(response);
							// button loading
							$("#removeAccHeadInfoBtn").button('reset');
							if(response.success == true) {

								// accHeadIde the remove modal 
								$('#removeAccHeadInfoModal').modal('hide');

								// reload the brand table 
								manageAccHeadInfoTable.ajax.reload(null, false);
								
								$('.remove-messages').html('<div class="alert alert-success">'+
			            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
			            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
			          '</div>');

			  	  			$(".alert-success").delay(500).show(10, function() {
										$(this).delay(3000).accHeadIde(10, function() {
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

		$('.removeAccHeadInfoFooter').after();
	} else {
		alert('error!! Refresh the page again');
	}
} // /remove brands function