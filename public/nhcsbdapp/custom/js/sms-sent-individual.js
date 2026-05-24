var manageSMSIndividualInfoTable;
$(document).ready(function() {
	// top bar active
	$('#navUnit').addClass('active');	
	// manage brand table
	manageSMSIndividualInfoTable = $("#manageSMSIndividualInfoTable").DataTable({
		'ajax': 'php_action/fetchSMSSentIndividual.php',
		'order': []		
	});

	// submit brand form function
	$("#submitSMSIndividualInfoForm").unbind('submit').bind('submit', function() {
		// remove the error text
		$(".text-danger").remove();
		// remove the form error
		$('.form-group').removeClass('has-error').removeClass('has-success');
		
		var MemberName = $("#MemberName").val();
		if(MemberName == "") {
			$("#MemberName").after('<p class="text-danger">Member Name field is required</p>');
			$('#MemberName').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#MemberName").find('.text-danger').remove();
			// success out for form 
			$("#MemberName").closest('.form-group').addClass('has-success');	  	
		}

		var MessageDts = $("#MessageDts").val();
		if(MessageDts == "") {
			$("#MessageDts").after('<p class="text-danger">Message field is required</p>');
			$('#MessageDts').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#MessageDts").find('.text-danger').remove();
			// success out for form 
			$("#MessageDts").closest('.form-group').addClass('has-success');	  	
		}		

		if(MemberName || MessageDts) {
			var form = $(this);
			// button loading
			$("#createIndividualSMSInfoBtn").button('loading');

			$.ajax({
				url : form.attr('action'),
				type: form.attr('method'),
				data: form.serialize(),
				dataType: 'json',
				success:function(response) {
					// button loading
					$("#createIndividualSMSInfoBtn").button('reset');

					if(response.success == true) {
						// reload the manage member table 
						manageSMSIndividualInfoTable.ajax.reload(null, false);						

  	  			// reset the form text
						$("#submitSMSIndividualInfoForm")[0].reset();
						// remove the error text
						$(".text-danger").remove();
						// remove the form error
						$('.form-group').removeClass('has-error').removeClass('has-success');
  	  			
  	  			$('#add-individualsms-messages').html('<div class="alert alert-success">'+
            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
          '</div>');

  	  			$(".alert-success").delay(500).show(10, function() {
							$(this).delay(3000).smside(10, function() {
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

function editIndividualSMSInfo(smsid = null) {
	if(smsid) 
	{ 
		// remove smsidden brand id text
		$('#smsid').remove();
		// remove the error 
		$('.text-danger').remove();
		// remove the form-error
		$('.form-group').removeClass('has-error').removeClass('has-success');

		// modal loading
		$('.modal-loading').removeClass('div-hide');
		// modal result
		$('.edit-individualsms-result').addClass('div-hide');
		// modal footer
		$('.editSMSIndividualFooter').addClass('div-hide');
		$.ajax({
			url: 'php_action/fetchSelectedSMSIndividual.php',
			type: 'post',
			data: {smsid : smsid},
			dataType: 'json',
			success:function(response) {
				// modal loading
				$('.modal-loading').addClass('div-hide');
				// modal result
				$('.edit-individualsms-result').removeClass('div-hide');
				// modal footer
				$('.editSMSIndividualFooter').removeClass('div-hide');

				// setting the brand name value 
				$('#editMemberName').val(response.member_name);
				$('#editMessageDts').val(response.sms);
				// brand id 
				$(".editSMSIndividualFooter").after('<input type="hidden" name="smsid" id="smsid" value="'+response.smsid+'" />');

				// update brand form 
				$('#editIndividualSMSForm').unbind('submit').bind('submit', function() {

					// remove the error text
					$(".text-danger").remove();
					// remove the form error
					$('.form-group').removeClass('has-error').removeClass('has-success');			

					var MemberName   = $('#editMemberName').val();
					var MessageDts  = $('#editMessageDts').val();

					if(MemberName == "") {
						$("#editMemberName").after('<p class="text-danger">Edit Member Name field is required</p>');
						$('#editMemberName').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editMemberName").find('.text-danger').remove();
						// success out for form 
						$("#editMemberName").closest('.form-group').addClass('has-success');	  	
					}

					if(MessageDts == "") {
						$("#editMessageDts").after('<p class="text-danger">Edit Message field is required</p>');
						$('#editMessageDts').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editMessageDts").find('.text-danger').remove();
						// success out for form 
						$("#editMessageDts").closest('.form-group').addClass('has-success');	  	
					}
					
					if(MemberName || MessageDts) {
						var form = $(this);

						// submit btn
						$('#editSMSIndividualBtn').button('loading');

						$.ajax({
							url: form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {

								if(response.success == true) {
									console.log(response);
									// submit btn
									$('#editSMSIndividualBtn').button('reset');

									// reload the manage member table 
									manageSMSIndividualInfoTable.ajax.reload(null, false);								  	  										
									// remove the error text
									$(".text-danger").remove();
									// remove the form error
									$('.form-group').removeClass('has-error').removeClass('has-success');
			  	  			
			  	  			$('#edit-individualsms-messages').html('<div class="alert alert-success">'+
			            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
			            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
			          '</div>');

			  	  			$(".alert-success").delay(500).show(10, function() {
										$(this).delay(3000).smside(10, function() {
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

function postSMSIndividualInfo(smsid = null) {
	if(smsid) {
		$('#smsid').remove();
		$.ajax({
			url: 'php_action/fetchSelectedSMSIndividual.php',
			type: 'post',
			data: {smsid : smsid},
			dataType: 'json',
			success:function(response) {
				$('.postSMSIndividualFooter').after('<input type="hidden" name="smsid" id="smsid" value="'+response.smsid+'" /> ');

				// click on remove button to remove the brand
				$("#postingSMSIndividualBtn").unbind('click').bind('click', function() {
					// button loading
					$("#postingSMSIndividualBtn").button('loading');

					$.ajax({
						
						url: 'php_action/postSMSIndividual.php',                         
						type: 'post',
						data: {smsid : smsid},
						dataType: 'json',
						success:function(response) {
							
						$.ajax({
						url: 'php_action/send-sms-individual.php',	
						type: 'post',
						data: {smsid : smsid},
						dataType: 'json',
						success:function(response) {
						}});
							
							console.log(response);
							// button loading
							$("#postingSMSIndividualBtn").button('reset');
							if(response.success == true) {

								// hide the remove modal 
								$('#postSMSIndividualModel').modal('hide');

								// reload the brand table 
								
								manageSMSIndividualInfoTable.ajax.reload(null, false);
								//location.reload();
								
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

		$('.postSMSIndividualFooter').after();
		//location.reload();
	} else {
		alert('error!! Refresh the page again');
	}
} // /remove brands function

function removeIndividualSMSInfo(smsid = null) {
	if(smsid) {
		$('#removesmsid').remove();
		$.ajax({
			url: 'php_action/fetchSelectedSMSIndividual.php',
			type: 'post',
			data: {smsid : smsid},
			dataType: 'json',
			success:function(response) {
				$('.removeSMSIndividualFooter').after('<input type="hidden" name="removesmsid" id="removesmsid" value="'+response.smsid+'" /> ');

				// click on remove button to remove the brand
				$("#removeSMSIndividualBtn").unbind('click').bind('click', function() {
					// button loading
					$("#removeSMSIndividualBtn").button('loading');

					$.ajax({
						url: 'php_action/removeSMSIndividual.php',
						type: 'post',
						data: {smsid : smsid},
						dataType: 'json',
						success:function(response) {
							console.log(response);
							// button loading
							$("#removeSMSIndividualBtn").button('reset');
							if(response.success == true) {

								// smside the remove modal 
								$('#removeIndividualSMSModel').modal('hide');

								// reload the brand table 
								manageSMSIndividualInfoTable.ajax.reload(null, false);
								
								$('.remove-messages').html('<div class="alert alert-success">'+
			            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
			            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
			          '</div>');

			  	  			$(".alert-success").delay(500).show(10, function() {
										$(this).delay(3000).smside(10, function() {
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

		$('.removeSMSIndividualFooter').after();
	} else {
		alert('error!! Refresh the page again');
	}
} // /remove brands function