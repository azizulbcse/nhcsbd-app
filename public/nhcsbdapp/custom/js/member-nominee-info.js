var manageNomineeInfoTable;
$(document).ready(function() {
	// top bar active
	$('#navUnit').addClass('active');	
	// manage brand table
	manageNomineeInfoTable = $("#manageNomineeInfoTable").DataTable({
		'ajax': 'php_action/fetchMemberNomineeInfo.php',
		'order': []		
	});
});

function editNomineeInfo(userid = null) {

	if(userid) {
		$("#userid").remove();		
		// remove text-error 
		$(".text-danger").remove();
		// remove from-group error
		$(".form-group").removeClass('has-error').removeClass('has-success');
		// modal spinner
		$('.div-loading').removeClass('div-hide');
		// modal div
		$('.div-result').addClass('div-hide');

		$.ajax({
			url: 'php_action/fetchSelectedApplicantList.php',
			type: 'post',
			data: {userid: userid},
			dataType: 'json',
			success:function(response) {		
			// alert(response.userpic);
				// modal spinner
				$('.div-loading').addClass('div-hide');
				// modal div
				$('.div-result').removeClass('div-hide');				

				$("#getUserImage").attr('src', 'stock/'+response.nomineepic);

				$("#editUserImage").fileinput({		      
				});  

				$(".editMemberFooter").append('<input type="hidden" name="userid" id="userid" value="'+response.mid+'" />');				
				$(".editMemberPhotoFooter").append('<input type="hidden" name="userid" id="userid" value="'+response.mid+'" />');				
				
				
				$("#editNomineeName").val(response.nomineename);
				$("#editNomineeRelation").val(response.nomineerelation);
				$("#editNomineeMobile").val(response.nomineemobile);
				$("#editNomineeAddress").val(response.nomineeaddress);
				$("#editNomineeNID").val(response.nomineenid);

				// update the product data function
				$("#editMemberForm").unbind('submit').bind('submit', function() {
					// form validation					
					var NomineeName      = $("#editNomineeName").val();
					var NomineeRelation  = $("#editNomineeRelation").val();
					var NomineeMobile    = $("#editNomineeMobile").val();
					var NomineeAddress   = $("#editNomineeAddress").val();
					var NomineeNID       = $("#editNomineeNID").val();
					
					if(NomineeName == "") {
						$("#editNomineeName").after('<p class="text-danger"> Nominee Namep field is required</p>');
						$('#editNomineeName').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editNomineeName").find('.text-danger').remove();
						// success out for form 
						$("#editNomineeName").closest('.form-group').addClass('has-success');	  	
					}

					if(NomineeRelation == "") {
						$("#editNomineeRelation").after('<p class="text-danger"> Nominee Relation field is required</p>');
						$('#editNomineeRelation').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editNomineeRelation").find('.text-danger').remove();
						// success out for form 
						$("#editNomineeRelation").closest('.form-group').addClass('has-success');	  	
					}

					if(NomineeMobile == "") {
						$("#editNomineeMobile").after('<p class="text-danger"> Nominee Mobile field is required</p>');
						$('#editNomineeMobile').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editNomineeMobile").find('.text-danger').remove();
						// success out for form 
						$("#editNomineeMobile").closest('.form-group').addClass('has-success');	  	
					}

					if(NomineeAddress == "") {
						$("#editNomineeAddress").after('<p class="text-danger"> Nominee Address field is required</p>');
						$('#editNomineeAddress').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editNomineeAddress").find('.text-danger').remove();
						// success out for form 
						$("#editNomineeAddress").closest('.form-group').addClass('has-success');	  	
					}

					if(NomineeNID == "") {
						$("#editNomineeNID").after('<p class="text-danger"> Nominee NID field is required</p>');
						$('#editNomineeNID').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editNomineeNID").find('.text-danger').remove();
						// success out for form 
						$("#editNomineeNID").closest('.form-group').addClass('has-success');	  	
					}

					if(NomineeName && NomineeRelation && NomineeMobile && NomineeAddress && NomineeNID)  {
						// submit loading button
						$("#editMemberBtn").button('loading');

						var form = $(this);
						var formData = new FormData(this);

						$.ajax({
							url : form.attr('action'),
							type: form.attr('method'),
							data: formData,
							dataType: 'json',
							cache: false,
							contentType: false,
							processData: false,
							success:function(response) {
								console.log(response);
								if(response.success == true) {
									// submit loading button
									$("#editMemberBtn").button('reset');																		

									$("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);
																			
									// shows a successful message after operation
									$('#edit-applicantinfo-messages').html('<div class="alert alert-success">'+
				            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
				            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
				          '</div>');

									// remove the mesages
				          $(".alert-success").delay(500).show(10, function() {
										$(this).delay(3000).hide(10, function() {
											$(this).remove();
										});
									}); // /.alert

				          // reload the manage student table
									manageNomineeInfoTable.ajax.reload(null, true);

									// remove text-error 
									$(".text-danger").remove();
									// remove from-group error
									$(".form-group").removeClass('has-error').removeClass('has-success');

								} // /if response.success
								
							} // /success function
						}); // /ajax function
					}	 // /if validation is ok 					

					return false;
				}); // update the product data function

				// update the product image				
				$("#updateMemberImageForm").unbind('submit').bind('submit', function() {					
					// form validation
					var memberImages = $("#editUserImage").val();					
					
					if(memberImages == "") {
						$("#editUserImage").closest('.center-block').after('<p class="text-danger">Nominee Image field is required</p>');
						$('#editUserImage').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editUserImage").find('.text-danger').remove();
						// success out for form 
						$("#editUserImage").closest('.form-group').addClass('has-success');	  	
					}	// /else

					if(memberImages) {
						// submit loading button
						$("#editUserImageBtn").button('loading');

						var form = $(this);
						var formData = new FormData(this);

						$.ajax({
							url : form.attr('action'),
							type: form.attr('method'),
							data: formData,
							dataType: 'json',
							cache: false,
							contentType: false,
							processData: false,
							success:function(response) {
								
								if(response.success == true) {
									// submit loading button
									$("#editUserImageBtn").button('reset');																		

									$("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);
																			
									// shows a successful message after operation
									$('#edit-memberPhoto-messages').html('<div class="alert alert-success">'+
				            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
				            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
				          '</div>');

									// remove the mesages
				          $(".alert-success").delay(500).show(10, function() {
										$(this).delay(3000).hide(10, function() {
											$(this).remove();
										});
									}); // /.alert

				          // reload the manage student table
									manageNomineeInfoTable.ajax.reload(null, true);

									$(".fileinput-remove-button").click();

									$.ajax({
										url: 'php_action/fetchApplicantNomineePhoto.php?i='+mid,
										type: 'post',
										success:function(response) {
										$("#getUserImage").attr('src', response);		
										}
									});																		

									// remove text-error 
									$(".text-danger").remove();
									// remove from-group error
									$(".form-group").removeClass('has-error').removeClass('has-success');

								} // /if response.success
								
							} // /success function
						}); // /ajax function
					}	 // /if validation is ok 					

					return false;
				}); // /update the product image

			} // /success function
		}); // /ajax to fetch product image

				
	} else {
		alert('error please refresh the page');
	}
} // /edit product function