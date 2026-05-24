var manageBankInfoTable;
$(document).ready(function() {
	// top bar active
	$('#navUnit').addClass('active');	
	// manage brand table
	manageBankInfoTable = $("#manageBankInfoTable").DataTable({
		'ajax': 'php_action/fetchMemberBankInfo.php',
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

				$("#getUserImage").attr('src', 'stock/'+response.signature);

				$("#editUserImage").fileinput({		      
				});  

				$(".editMemberFooter").append('<input type="hidden" name="userid" id="userid" value="'+response.mid+'" />');				
				$(".editMemberPhotoFooter").append('<input type="hidden" name="userid" id="userid" value="'+response.mid+'" />');				
				
				
				$("#editBankName").val(response.bankmname);
				$("#editBranchName").val(response.branchname);
				$("#editAccountNo").val(response.acc_no);
				$("#editAccName").val(response.acc_name);
				$("#editMobileBankType").val(response.mobilebanktype);
				$("#editMobileBankNo").val(response.mobilebankno);

				// update the product data function
				$("#editMemberForm").unbind('submit').bind('submit', function() {
					// form validation					
					var BankName         = $("#editBankName").val();
					var BranchName       = $("#editBranchName").val();
					var AccountNo        = $("#editAccountNo").val();
					var AccountName      = $("#editAccName").val();
					var MobileBankType   = $("#editMobileBankType").val();
					var MobileBankNo     = $("#editMobileBankNo").val();
					
					if(BankName == "") {
						$("#editBankName").after('<p class="text-danger"> Bank Name field is required</p>');
						$('#editBankName').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editBankName").find('.text-danger').remove();
						// success out for form 
						$("#editBankName").closest('.form-group').addClass('has-success');	  	
					}

					if(BranchName == "") {
						$("#editBranchName").after('<p class="text-danger"> Branch Name field is required</p>');
						$('#editBranchName').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editBranchName").find('.text-danger').remove();
						// success out for form 
						$("#editBranchName").closest('.form-group').addClass('has-success');	  	
					}

					if(AccountNo == "") {
						$("#editAccountNo").after('<p class="text-danger"> Account No field is required</p>');
						$('#editAccountNo').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editAccountNo").find('.text-danger').remove();
						// success out for form 
						$("#editAccountNo").closest('.form-group').addClass('has-success');	  	
					}

					if(AccountName == "") {
						$("#editAccName").after('<p class="text-danger"> Accounts Name field is required</p>');
						$('#editAccName').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editAccName").find('.text-danger').remove();
						// success out for form 
						$("#editAccName").closest('.form-group').addClass('has-success');	  	
					}

					if(MobileBankType == "") {
						$("#editeditMobileBankType").after('<p class="text-danger"> Mobile Bank Type field is required</p>');
						$('#editeditMobileBankType').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editeditMobileBankType").find('.text-danger').remove();
						// success out for form 
						$("#editeditMobileBankType").closest('.form-group').addClass('has-success');	  	
					}

					if(MobileBankNo == "") {
						$("#editMobileBankNo").after('<p class="text-danger">Mobile Bank No field is required</p>');
						$('#editMobileBankNo').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editMobileBankNo").find('.text-danger').remove();
						// success out for form 
						$("#editMobileBankNo").closest('.form-group').addClass('has-success');	  	
					}

					if(BankName && BranchName && AccountNo && AccountName && MobileBankType && MobileBankNo)  {
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
									manageBankInfoTable.ajax.reload(null, true);

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
						$("#editUserImage").closest('.center-block').after('<p class="text-danger">Signature field is required</p>');
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
									manageBankInfoTable.ajax.reload(null, true);

									$(".fileinput-remove-button").click();

									$.ajax({
										url: 'php_action/fetchApplicantSignature.php?i='+mid,
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