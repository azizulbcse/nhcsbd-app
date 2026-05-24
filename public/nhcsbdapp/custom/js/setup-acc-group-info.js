var manageAccGrpInfoTable;

$(document).ready(function() {
	// top bar active
	$('#navUnit').addClass('active');
	
	// manage brand table
	manageAccGrpInfoTable = $("#manageAccGrpInfoTable").DataTable({
		'ajax': 'php_action/fetchSetupAccGrpInfo.php',
		'order': []		
	});

	// submit brand form function
	$("#submitHospitalInfoForm").unbind('submit').bind('submit', function() {
		// remove the error text
		$(".text-danger").remove();
		// remove the form error
		$('.form-group').removeClass('has-error').removeClass('has-success');			

		var HospitalName = $("#HospitalName").val();
		if(HospitalName == "") {
			$("#HospitalName").after('<p class="text-danger">Account Group field is required</p>');
			$('#HospitalName').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#HospitalName").find('.text-danger').remove();
			// success out for form 
			$("#HospitalName").closest('.form-group').addClass('has-success');	  	
		}		

		if(HospitalName) {
			var form = $(this);
			// button loading
			$("#createHospitalInfoBtn").button('loading');

			$.ajax({
				url : form.attr('action'),
				type: form.attr('method'),
				data: form.serialize(),
				dataType: 'json',
				success:function(response) {
					// button loading
					$("#createHospitalInfoBtn").button('reset');

					if(response.success == true) {
						// reload the manage member table 
						manageAccGrpInfoTable.ajax.reload(null, false);						

  	  			// reset the form text
						$("#submitHospitalInfoForm")[0].reset();
						// remove the error text
						$(".text-danger").remove();
						// remove the form error
						$('.form-group').removeClass('has-error').removeClass('has-success');
  	  			
  	  			$('#add-hospital-messages').html('<div class="alert alert-success">'+
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

function editHospitalInfo(hid = null) {
	if(hid) 
	{ 
		// remove hidden brand id text
		$('#hid').remove();
		// remove the error 
		$('.text-danger').remove();
		// remove the form-error
		$('.form-group').removeClass('has-error').removeClass('has-success');

		// modal loading
		$('.modal-loading').removeClass('div-hide');
		// modal result
		$('.edit-hospitalinfo-result').addClass('div-hide');
		// modal footer
		$('.editHospitalInfoFooter').addClass('div-hide');
		$.ajax({
			url: 'php_action/fetchSelectedSetupAccGroupInfo.php',
			type: 'post',
			data: {hid : hid},
			dataType: 'json',
			success:function(response) {
				// modal loading
				$('.modal-loading').addClass('div-hide');
				// modal result
				$('.edit-hospitalinfo-result').removeClass('div-hide');
				// modal footer
				$('.editHospitalInfoFooter').removeClass('div-hide');

				// setting the brand name value 
				$('#editHospitalName').val(response.AccGroupName);
				// brand id 
				$(".editHospitalInfoFooter").after('<input type="hidden" name="hid" id="hid" value="'+response.AccGroupId+'" />');

				// update brand form 
				$('#editHospitalInfoForm').unbind('submit').bind('submit', function() {

					// remove the error text
					$(".text-danger").remove();
					// remove the form error
					$('.form-group').removeClass('has-error').removeClass('has-success');			

					var HospitalName = $('#editHospitalName').val();

					if(HospitalName == "") {
						$("#editHospitalName").after('<p class="text-danger">Edit Account Group field is required</p>');
						$('#editHospitalName').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editHospitalName").find('.text-danger').remove();
						// success out for form 
						$("#editHospitalName").closest('.form-group').addClass('has-success');	  	
					}
					
					if(HospitalName) {
						var form = $(this);

						// submit btn
						$('#editHospitalInfoBtn').button('loading');

						$.ajax({
							url: form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {

								if(response.success == true) {
									console.log(response);
									// submit btn
									$('#editHospitalInfoBtn').button('reset');

									// reload the manage member table 
									manageAccGrpInfoTable.ajax.reload(null, false);								  	  										
									// remove the error text
									$(".text-danger").remove();
									// remove the form error
									$('.form-group').removeClass('has-error').removeClass('has-success');
			  	  			
			  	  			$('#edit-hospitalinfo-messages').html('<div class="alert alert-success">'+
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

function removeHospitalInfo(hid = null) {
	if(hid) {
		$('#removehid').remove();
		$.ajax({
			url: 'php_action/fetchSelectedSetupAccGroupInfo.php',
			type: 'post',
			data: {hid : hid},
			dataType: 'json',
			success:function(response) {
				$('.removeHospitalInfoFooter').after('<input type="hidden" name="removehid" id="removehid" value="'+response.AccGroupId+'" /> ');

				// click on remove button to remove the brand
				$("#removeHospitalInfoBtn").unbind('click').bind('click', function() {
					// button loading
					$("#removeHospitalInfoBtn").button('loading');

					$.ajax({
						url: 'php_action/removeSetupAccGroupInfo.php',
						type: 'post',
						data: {hid : hid},
						dataType: 'json',
						success:function(response) {
							console.log(response);
							// button loading
							$("#removeHospitalInfoBtn").button('reset');
							if(response.success == true) {

								// hide the remove modal 
								$('#removeHospitalInfoModal').modal('hide');

								// reload the brand table 
								manageAccGrpInfoTable.ajax.reload(null, false);
								
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

		$('.removeHospitalInfoFooter').after();
	} else {
		alert('error!! Refresh the page again');
	}
} // /remove brands function