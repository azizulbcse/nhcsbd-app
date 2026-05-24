var manageApplicantInfoTable;

$(document).ready(function() {
	// top bar active
	$('#navUnit').addClass('active');
	
	// manage brand table
	manageApplicantInfoTable = $("#manageApplicantInfoTable").DataTable({
		'ajax': 'php_action/fetchShareHolderList.php',
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
			$("#HospitalName").after('<p class="text-danger">Hospital Names field is required</p>');
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
						manageApplicantInfoTable.ajax.reload(null, false);						

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

function editApplicantInfo(userid = null) {

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
			url: 'php_action/fetchSelectedShareHolderList.php',
			type: 'post',
			data: {userid: userid},
			dataType: 'json',
			success:function(response) {		
			// alert(response.userpic);
				// modal spinner
				$('.div-loading').addClass('div-hide');
				// modal div
				$('.div-result').removeClass('div-hide');				

				$("#getUserImage").attr('src', 'stock/'+response.userpic);

				$("#editUserImage").fileinput({		      
				});  

				$(".editMemberFooter").append('<input type="hidden" name="userid" id="userid" value="'+response.mid+'" />');				
				$(".editMemberPhotoFooter").append('<input type="hidden" name="userid" id="userid" value="'+response.mid+'" />');				
				
				$("#editApplicantNameBangla").val(response.name_bangla);
				$("#editApplicantNameEnglish").val(response.name_english);
				$("#editFathersName").val(response.fathers_name);
				$("#editMothersName").val(response.mothers_name);
				$("#editGender").val(response.gender);
				$("#editMaritalStatus").val(response.maritalstatus);
				$("#editDateofBirth").val(response.dateofbirth);
				$("#editAge").val(response.age);
				$("#editPresentAddress").val(response.presentaddress);
				$("#editPermanentAddress").val(response.permanentaddress);
				$("#editHospitalName").val(response.hospitalname);
				$("#editMobileNo").val(response.mobileno);
				$("#editAppNID").val(response.nid);
				$("#editEmail").val(response.email);
				$("#editBloodGroup").val(response.bloodgroup);				
				$("#editEmergencyContact").val(response.emergencycontact);
				$("#editBkashNogod").val(response.bkashno);
				$("#editTransactionNo").val(response.trxid);

				// update the product data function
				$("#editMemberForm").unbind('submit').bind('submit', function() {

					// form validation
					var ApplicantNameBangla   = $("#editApplicantNameBangla").val();
					var ApplicantNameEnglish  = $("#editApplicantNameEnglish").val();
                    var FathersName           = $("#editFathersName").val();
					var MothersName           = $("#editMothersName").val();
					var Gender                = $("#editGender").val();
					var MaritalStatus         = $("#editMaritalStatus").val();
					var DateofBirth           = $("#editDateofBirth").val();
					var Age                   = $("#editAge").val();
					var PresentAddress        = $("#editPresentAddress").val();
					var PermanentAddress      = $("#editPermanentAddress").val();
					var HospitalName          = $("#editHospitalName").val();
					var MobileNo              = $("#editMobileNo").val();
					var AppNID                = $("#editAppNID").val();
					var Email                 = $("#editEmail").val();
					var BloodGroup            = $("#editBloodGroup").val();					
					var EmergencyContact      = $("#editEmergencyContact").val();
					var BkashNogod            = $("#editBkashNogod").val();
					var TransactionNo         = $("#editTransactionNo").val();

					if(ApplicantNameBangla == "") {
						$("#editApplicantNameBangla").after('<p class="text-danger">Share Holder Name Bangla field is required</p>');
						$('#editApplicantNameBangla').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editApplicantNameBangla").find('.text-danger').remove();
						// success out for form 
						$("#editApplicantNameBangla").closest('.form-group').addClass('has-success');	  	
					}
					
                    if(ApplicantNameEnglish == "") {
						$("#editApplicantNameEnglish").after('<p class="text-danger">Share Holder Name English field is required</p>');
						$('#editApplicantNameEnglish').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editApplicantNameEnglish").find('.text-danger').remove();
						// success out for form 
						$("#editApplicantNameEnglish").closest('.form-group').addClass('has-success');	  	
					}
					
					if(FathersName == "") {
						$("#editFathersName").after('<p class="text-danger">Fathers Name field is required</p>');
						$('#editFathersName').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editFathersName").find('.text-danger').remove();
						// success out for form 
						$("#editFathersName").closest('.form-group').addClass('has-success');	  	
					}

					if(MothersName == "") {
						$("#editMothersName").after('<p class="text-danger">Mothers Name field is required</p>');
						$('#editMothersName').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editMothersName").find('.text-danger').remove();
						// success out for form 
						$("#editMothersName").closest('.form-group').addClass('has-success');	  	
					}

					if(Gender == "") {
						$("#editGender").after('<p class="text-danger">Gender field is required</p>');
						$('#editGender').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editGender").find('.text-danger').remove();
						// success out for form 
						$("#editGender").closest('.form-group').addClass('has-success');	  	
					}

					if(MaritalStatus == "") {
						$("#editMaritalStatus").after('<p class="text-danger">Marital Status field is required</p>');
						$('#editMaritalStatus').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editMaritalStatus").find('.text-danger').remove();
						// success out for form 
						$("#editMaritalStatus").closest('.form-group').addClass('has-success');	  	
					}

					if(DateofBirth == "") {
						$("#editDateofBirth").after('<p class="text-danger">Date of Birth field is required</p>');
						$('#editDateofBirth').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editDateofBirth").find('.text-danger').remove();
						// success out for form 
						$("#editDateofBirth").closest('.form-group').addClass('has-success');	  	
					}

					if(Age == "") {
						$("#editAge").after('<p class="text-danger">Age field is required</p>');
						$('#editAge').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editAge").find('.text-danger').remove();
						// success out for form 
						$("#editAge").closest('.form-group').addClass('has-success');	  	
					}

					if(PresentAddress == "") {
						$("#editPresentAddress").after('<p class="text-danger">Present Address field is required</p>');
						$('#editPresentAddress').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editPresentAddress").find('.text-danger').remove();
						// success out for form 
						$("#editPresentAddress").closest('.form-group').addClass('has-success');	  	
					}

					if(PermanentAddress == "") {
						$("#editPermanentAddress").after('<p class="text-danger">Permanent Address field is required</p>');
						$('#editPermanentAddress').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editPermanentAddress").find('.text-danger').remove();
						// success out for form 
						$("#editPermanentAddress").closest('.form-group').addClass('has-success');	  	
					}

					if(HospitalName == "") {
						$("#editHospitalName").after('<p class="text-danger">Hospital Name field is required</p>');
						$('#editHospitalName').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editHospitalName").find('.text-danger').remove();
						// success out for form 
						$("#editHospitalName").closest('.form-group').addClass('has-success');	  	
					}

					if(MobileNo == "") {
						$("#editMobileNo").after('<p class="text-danger">Mobile No field is required</p>');
						$('#editMobileNo').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editMobileNo").find('.text-danger').remove();
						// success out for form 
						$("#editMobileNo").closest('.form-group').addClass('has-success');	  	
					}

					if(AppNID == "") {
						$("#editAppNID").after('<p class="text-danger">Applicant NID field is required</p>');
						$('#editAppNID').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editAppNID").find('.text-danger').remove();
						// success out for form 
						$("#editAppNID").closest('.form-group').addClass('has-success');	  	
					}

					if(Email == "") {
						$("#editEmail").after('<p class="text-danger">Email field is required</p>');
						$('#editEmail').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editEmail").find('.text-danger').remove();
						// success out for form 
						$("#editEmail").closest('.form-group').addClass('has-success');	  	
					}

					if(BloodGroup == "") {
						$("#editBloodGroup").after('<p class="text-danger"> Blood Group field is required</p>');
						$('#editBloodGroup').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editBloodGroup").find('.text-danger').remove();
						// success out for form 
						$("#editBloodGroup").closest('.form-group').addClass('has-success');	  	
					}					

					if(EmergencyContact == "") {
						$("#editEmergencyContact").after('<p class="text-danger">Emergency Contact field is required</p>');
						$('#editEmergencyContact').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editEmergencyContact").find('.text-danger').remove();
						// success out for form 
						$("#editEmergencyContact").closest('.form-group').addClass('has-success');	  	
					}

					if(BkashNogod == "") {
						$("#editBkashNogod").after('<p class="text-danger">Bkash Nogod field is required</p>');
						$('#editBkashNogod').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editBkashNogod").find('.text-danger').remove();
						// success out for form 
						$("#editBkashNogod").closest('.form-group').addClass('has-success');	  	
					}

					if(TransactionNo == "") {
						$("#editTransactionNo").after('<p class="text-danger"> Transaction No field is required</p>');
						$('#editTransactionNo').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editTransactionNo").find('.text-danger').remove();
						// success out for form 
						$("#editTransactionNo").closest('.form-group').addClass('has-success');	  	
					}

					if(ApplicantNameBangla && ApplicantNameEnglish && FathersName && MothersName && Gender && MaritalStatus && 
					   DateofBirth && Age && PresentAddress && PermanentAddress && HospitalName && MobileNo && AppNID && Email &&
					   BloodGroup && EmergencyContact && BkashNogod && TransactionNo)  {
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
									manageApplicantInfoTable.ajax.reload(null, true);

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
						$("#editUserImage").closest('.center-block').after('<p class="text-danger">Share Holder Image field is required</p>');
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
									manageApplicantInfoTable.ajax.reload(null, true);

									$(".fileinput-remove-button").click();

									$.ajax({
										url: 'php_action/fetchShareHolderImageUrl.php?i='+mid,
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

function postedApplicantInfo(userid = null) {
	if(userid) {
		$('#userid').remove();
		$.ajax({
			url: 'php_action/fetchSelectedShareHolderList.php',
			type: 'post',
			data: {userid : userid},
			dataType: 'json',
			success:function(response) {
				$('.postedApplicantInfoFooter').after('<input type="hidden" name="userid" id="userid" value="'+response.mid+'" /> ');

				// click on remove button to remove the brand
				$("#postedApplicantInfoBtn").unbind('click').bind('click', function() {
					// button loading
					$("#postedApplicantInfoBtn").button('loading');

					$.ajax({
						url: 'php_action/postShareHolderInfo.php',
						type: 'post',
						data: {userid : userid},
						dataType: 'json',
						success:function(response) {

							$.ajax({
								url: 'php_action/send-sms-approved-sh.php',	
								type: 'post',
								data: {userid : userid},
								dataType: 'json',
								success:function(response) {
								}});

							console.log(response);
							// button loading
							$("#postedApplicantInfoBtn").button('reset');
							if(response.success == true) {

								// hide the remove modal 
								$('#postedApplicantInfoModal').modal('hide');

								// reload the brand table 
								manageApplicantInfoTable.ajax.reload(null, false);
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

		$('.postedApplicantInfoFooter').after();
	} else {
		alert('error!! Refresh the page again');
	}
} // /remove brands function

function removeApplicantInfo(userid = null) {
	if(userid) {
		$('#userid').remove();
		$.ajax({
			url: 'php_action/fetchSelectedShareHolderList.php',
			type: 'post',
			data: {userid : userid},
			dataType: 'json',
			success:function(response) {
				$('.removeApplicantInfoFooter').after('<input type="hidden" name="userid" id="userid" value="'+response.mid+'" /> ');

				// click on remove button to remove the brand
				$("#removeApplicantInfoBtn").unbind('click').bind('click', function() {
					// button loading
					$("#removeApplicantInfoBtn").button('loading');

					$.ajax({
						url: 'php_action/removeShareHolderInfo.php',
						type: 'post',
						data: {userid : userid},
						dataType: 'json',
						success:function(response) {

							$.ajax({
								url: 'php_action/send-sms-canceled-sh.php',	
								type: 'post',
								data: {userid : userid},
								dataType: 'json',
								success:function(response) {
								}});

							console.log(response);
							// button loading
							$("#removeApplicantInfoBtn").button('reset');
							if(response.success == true) {

								// hide the remove modal 

								$('#removeApplicantInfoModal').modal('hide');
								// reload the brand table 
								manageApplicantInfoTable.ajax.reload(null, false);
								//window.reload();
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

		$('.removeApplicantInfoFooter').after();
	} else {
		alert('error!! Refresh the page again');
	}
} // /remove brands function

// print profile
function PrintShareHolderProfile(userid = null) {
	if(userid) {			
		$.ajax({
			url: 'php_action/printShareHolderProfile.php',
			type: 'post',
			data: {userid: userid},
			dataType: 'text',
			success:function(response) {
				
		var mywindow = window.open('', 'Nurses Health Care Society', 'height=100%,width=100%');
        mywindow.document.write('<html><head><title>Share Holder Profile</title>');        
        mywindow.document.write('</head><body>');
        mywindow.document.write(response);
        mywindow.document.write('</body></html>');

        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10
        mywindow.resizeTo(screen.width, screen.height);
setTimeout(function() {

}, 1250);	
			}
		}); 
	} 
} // /print profile