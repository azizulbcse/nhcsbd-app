var manageResignInfoTable;

$(document).ready(function() {

	$('#navAccgroup').addClass('active');

	manageResignInfoTable = $("#manageResignInfoTable").DataTable({
		'ajax': 'php_action/fetchApplicationResignInfo.php',
		'order': []		
	});

	// submit brand form function
	$("#submitResignInfoForm").unbind('submit').bind('submit', function() {
		// remove the error text
		$(".text-danger").remove();
		// remove the form error
		$('.form-group').removeClass('has-error').removeClass('has-success');			

		var ResignDate          = $("#ResignDate").val();
		var ResignationReasons  = $("#ResignationReasons").val();

		if(ResignDate == "") {
			$("#ResignDate").after('<p class="text-danger">Resign Date field is required</p>');
			$('#ResignDate').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#ResignDate").find('.text-danger').remove();
			// success out for form 
			$("#ResignDate").closest('.form-group').addClass('has-success');	  	
		}	
		
		if(ResignationReasons == "") {
			$("#ResignationReasons").after('<p class="text-danger">Resignation Reasons field is required</p>');
			$('#ResignationReasons').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#ResignationReasons").find('.text-danger').remove();
			// success out for form 
			$("#ResignationReasons").closest('.form-group').addClass('has-success');	  	
		}

		if(ResignDate || ResignationReasons) {
			var form = $(this);
			// button loading
			$("#createResignApplicationInfoBtn").button('loading');

			$.ajax({
				url : form.attr('action'),
				type: form.attr('method'),
				data: form.serialize(),
				dataType: 'json',
				success:function(response) {
					// button loading
					$("#createResignApplicationInfoBtn").button('reset');

					if(response.success == true) {
						// reload the manage member table 
						manageResignInfoTable.ajax.reload(null, false);						

  	  			// reset the form text
						$("#submitResignInfoForm")[0].reset();
						// remove the error text
						$(".text-danger").remove();
						// remove the form error
						$('.form-group').removeClass('has-error').removeClass('has-success');
  	  			
  	  			$('#add-resigninfo-messages').html('<div class="alert alert-success">'+
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

function editResignInfo(ResignAppId = null) {
	if(ResignAppId) 
	{ 
		// remove hidden brand id text
		$('#ResignAppId').remove();
		// remove the error 
		$('.text-danger').remove();
		// remove the form-error
		$('.form-group').removeClass('has-error').removeClass('has-success');

		// modal loading
		$('.modal-loading').removeClass('div-hide');
		// modal result
		$('.edit-resigninfo-result').addClass('div-hide');
		// modal footer
		$('.editResignInfoFooter').addClass('div-hide');
		$.ajax({
			url: 'php_action/fetchSelectedApplicationResignInfo.php',
			type: 'post',
			data: {ResignAppId : ResignAppId},
			dataType: 'json',
			success:function(response) {
				// modal loading
				$('.modal-loading').addClass('div-hide');
				// modal result
				$('.edit-resigninfo-result').removeClass('div-hide');
				// modal footer
				$('.editResignInfoFooter').removeClass('div-hide');

				// setting the brand name value 
				$('#editResignDate').val(response.resigndate);
				$('#editResignationReasons').val(response.resign_resons);
				// brand id 
				$(".editResignInfoFooter").after('<input type="hidden" name="ResignAppId" id="ResignAppId" value="'+response.rid+'" />');

				// update brand form 
				$('#editResignInfoForm').unbind('submit').bind('submit', function() {

					// remove the error text
					$(".text-danger").remove();
					// remove the form error
					$('.form-group').removeClass('has-error').removeClass('has-success');			

					var ResignDate         = $('#editResignDate').val();
					var ResignationReasons = $('#editResignationReasons').val();

					if(ResignDate == "") {
						$("#editResignDate").after('<p class="text-danger">Resign Date field is required</p>');
						$('#editResignDate').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editResignDate").find('.text-danger').remove();
						// success out for form 
						$("#editResignDate").closest('.form-group').addClass('has-success');	  	
					}

					if(ResignationReasons == "") {
						$("#editResignationReasons").after('<p class="text-danger">Resignation Reasons field is required</p>');
						$('#editResignationReasons').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editResignationReasons").find('.text-danger').remove();
						// success out for form 
						$("#editResignationReasons").closest('.form-group').addClass('has-success');	  	
					}
					
					if(ResignDate || ResignationReasons) {
						var form = $(this);

						// submit btn
						$('#editResignInfoBtn').button('loading');

						$.ajax({
							url: form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {

								if(response.success == true) {
									console.log(response);
									// submit btn
									$('#editResignInfoBtn').button('reset');

									// reload the manage member table 
									manageResignInfoTable.ajax.reload(null, false);								  	  										
									// remove the error text
									$(".text-danger").remove();
									// remove the form error
									$('.form-group').removeClass('has-error').removeClass('has-success');
			  	  			
			  	  			$('#edit-resigninfo-messages').html('<div class="alert alert-success">'+
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

function postedResignInfo(ResignAppId = null) {
	if(ResignAppId) {
		$('#ResignAppId').remove();
		$.ajax({
			url: 'php_action/fetchSelectedApplicationResignInfo.php',
			type: 'post',
			data: {ResignAppId : ResignAppId},
			dataType: 'json',
			success:function(response) {
				$('.postedResignInfoFooter').after('<input type="hidden" name="ResignAppId" id="ResignAppId" value="'+response.rid+'" /> ');

				// click on remove button to remove the brand
				$("#postedResignInfoBtn").unbind('click').bind('click', function() {
					// button loading
					$("#postedResignInfoBtn").button('loading');

					$.ajax({
						url: 'php_action/postApplicationResignInfo.php',
						type: 'post',
						data: {ResignAppId : ResignAppId},
						dataType: 'json',
						success:function(response) {
							
						$.ajax({
						url: 'php_action/send-sms-app-resign.php',	
						type: 'post',
						data: {ResignAppId : ResignAppId},
						dataType: 'json',
						success:function(response) {
						}});

							console.log(response);
							// button loading
							$("#postedResignInfoBtn").button('reset');
							if(response.success == true) {

								// hide the remove modal 
								$('#postedResignInfoModel').modal('hide');

								// reload the brand table 
								manageResignInfoTable.ajax.reload(null, false);
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

		$('.postedResignInfoFooter').after();
	} else {
		alert('error!! Refresh the page again');
	}
} // /remove brands function


function removeResignInfo(ResignAppId = null) {
	if(ResignAppId) {
		$('#ResignAppId').remove();
		$.ajax({
			url: 'php_action/fetchSelectedApplicationResignInfo.php',
			type: 'post',
			data: {ResignAppId : ResignAppId},
			dataType: 'json',
			success:function(response) {
				$('.removeResignInfoFooter').after('<input type="hidden" name="ResignAppId" id="ResignAppId" value="'+response.rid+'" /> ');

				// click on remove button to remove the brand
				$("#removeResignInfoBtn").unbind('click').bind('click', function() {
					// button loading
					$("#removeResignInfoBtn").button('loading');

					$.ajax({
						url: 'php_action/removeApplicationResignInfo.php',
						type: 'post',
						data: {ResignAppId : ResignAppId},
						dataType: 'json',
						success:function(response) {
							console.log(response);
							// button loading
							$("#removeResignInfoBtn").button('reset');
							if(response.success == true) {

								// hide the remove modal 
								$('#removeBankInfo').modal('hide');

								// reload the brand table 
								manageResignInfoTable.ajax.reload(null, false);
								
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

		$('.removeResignInfoFooter').after();
	} else {
		alert('error!! Refresh the page again');
	}
} // /remove brands function