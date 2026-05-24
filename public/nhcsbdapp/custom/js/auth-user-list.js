var manageUserTable;

$(document).ready(function() {
	// top nav bar 
	$('#topNavUser').addClass('active');
	// manage product data table
	manageUserTable = $('#manageUserTable').DataTable({
		'ajax': 'php_action/fetchAuthUserList.php',
		'order': []
	});

	// add product modal btn clicked
	$("#addUserModalBtn").unbind('click').bind('click', function() {
		// // product form reset
		$("#submitUserForm")[0].reset();		

		// remove text-error 
		$(".text-danger").remove();
		// remove from-group error
		$(".form-group").removeClass('has-error').removeClass('has-success');

		$("#UserPhoto").fileinput({
	      overwriteInitial: true,
		    maxFileSize: 2500,
		    showClose: false,
		    showCaption: false,
		    browseLabel: '',
		    removeLabel: '',
		    browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
		    removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
		    removeTitle: 'Cancel or reset changes',
		    elErrorContainer: '#kv-avatar-errors-1',
		    msgErrorClass: 'alert alert-block alert-danger',
		    defaultPreviewContent: '<img src="assests/images/photo_default.png" alt="Profile Image" style="width:100%;">',
		    layoutTemplates: {main2: '{preview} {remove} {browse}'},								    
	  		allowedFileExtensions: ["jpg", "png", "gif", "JPG", "PNG", "GIF"]
			});   

		// submit product form
		$("#submitUserForm").unbind('submit').bind('submit', function() {
			// form validation
			var UserPhoto = $("#UserPhoto").val();
			var UserFullName = $("#UserFullName").val();
			var UserDesignation = $("#UserDesignation").val();
			var UserType = $("#UserType").val();
			var UserEmail = $("#UserEmail").val();
			var MobileNo = $("#MobileNo").val();
			var UserPassword = $("#UserPassword").val();
			
			if(UserPhoto == "") {
				$("#UserPhoto").closest('.center-block').after('<p class="text-danger">User Photo field is required</p>');
				$('#UserPhoto').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#UserPhoto").find('.text-danger').remove();
				// success out for form 
				$("#UserPhoto").closest('.form-group').addClass('has-success');	  	
			}	// /else
	
			if(UserFullName == "") {
				$("#UserFullName").after('<p class="text-danger">User Full Name field is required</p>');
				$('#UserFullName').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#UserFullName").find('.text-danger').remove();
				// success out for form 
				$("#UserFullName").closest('.form-group').addClass('has-success');	  	
			}	// /else
			
			if(UserDesignation == "") {
				$("#UserDesignation").after('<p class="text-danger">User Designation field is required</p>');
				$('#UserDesignation').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#UserDesignation").find('.text-danger').remove();
				// success out for form 
				$("#UserDesignation").closest('.form-group').addClass('has-success');	  	
			}	// /else
			
			if(UserType == "") {
				$("#UserType").after('<p class="text-danger">User Type field is required</p>');
				$('#UserType').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#UserType").find('.text-danger').remove();
				// success out for form 
				$("#UserType").closest('.form-group').addClass('has-success');	  	
			}
			
			if(UserEmail == "") {
				$("#UserEmail").after('<p class="text-danger">Valid Email Address is required</p>');
				$('#UserEmail').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#UserEmail").find('.text-danger').remove();
				// success out for form 
				$("#UserEmail").closest('.form-group').addClass('has-success');	  	
			}	
			
			if(MobileNo == "") {
				$("#MobileNo").after('<p class="text-danger">Valid Mobile No is required</p>');
				$('#MobileNo').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#MobileNo").find('.text-danger').remove();
				// success out for form 
				$("#MobileNo").closest('.form-group').addClass('has-success');	  	
			}	

			if(UserPassword == "") {
				$("#UserPassword").after('<p class="text-danger">Password field is required</p>');
				$('#UserPassword').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#UserPassword").find('.text-danger').remove();
				// success out for form 
				$("#UserPassword").closest('.form-group').addClass('has-success');	  	
			}	// /else

			
				// /else

			if(UserPassword && UserFullName && MobileNo) {
				// submit loading button
				$("#createUserBtn").button('loading');

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
							$("#createUserBtn").button('reset');
							
							$("#submitUserForm")[0].reset();

							$("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);
																	
							// shows a successful message after operation
							$('#add-user-messages').html('<div class="alert alert-success">'+
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
							manageUserTable.ajax.reload(null, true);

							// remove text-error 
							$(".text-danger").remove();
							// remove from-group error
							$(".form-group").removeClass('has-error').removeClass('has-success');

						} // /if response.success
						
					} // /success function
				}); // /ajax function
			}	 // /if validation is ok 					

			return false;
		}); // /submit product form

	}); // /add product modal btn clicked
	

	// remove product 	

}); // document.ready fucntion

function editUser(userid = null) {

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
			url: 'php_action/fetchSelectedAuthUserList.php',
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

				$(".editMemberFooter").append('<input type="hidden" name="userid" id="userid" value="'+response.user_id+'" />');				
				$(".editMemberPhotoFooter").append('<input type="hidden" name="userid" id="userid" value="'+response.user_id+'" />');				
				
				// product name
				$("#editUserFullName").val(response.fullname);
				// product name
				$("#editDesignation").val(response.designations);
				// mothersName
				$("#editUserType").val(response.usertype);
				$("#editMobileNo").val(response.mobileno);
				// spouse_name				

				// update the product data function
				$("#editMemberForm").unbind('submit').bind('submit', function() {

					// form validation
					var memberImages = $("#editUserImage").val();
					var UserFullName = $("#editUserFullName").val();
					var Designation  = $("#editDesignation").val();
                    var UserType     = $("#editUserType").val();
					var MobileNo     = $("#editMobileNo").val();

					if(UserFullName == "") {
						$("#editUserFullName").after('<p class="text-danger">User Name field is required</p>');
						$('#editUserFullName').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editUserFullName").find('.text-danger').remove();
						// success out for form 
						$("#editUserFullName").closest('.form-group').addClass('has-success');	  	
					}
					
                    if(Designation == "") {
						$("#editDesignation").after('<p class="text-danger">Designation field is required</p>');
						$('#editDesignation').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editDesignation").find('.text-danger').remove();
						// success out for form 
						$("#editDesignation").closest('.form-group').addClass('has-success');	  	
					}
					
					if(UserType == "") {
						$("#editUserType").after('<p class="text-danger">User Type field is required</p>');
						$('#editUserType').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editUserType").find('.text-danger').remove();
						// success out for form 
						$("#editUserType").closest('.form-group').addClass('has-success');	  	
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

					if(UserFullName && Designation && UserType && MobileNo) {
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
									$('#edit-member-messages').html('<div class="alert alert-success">'+
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
									manageUserTable.ajax.reload(null, true);

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
						$("#editUserImage").closest('.center-block').after('<p class="text-danger">Member Image field is required</p>');
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
									manageUserTable.ajax.reload(null, true);

									$(".fileinput-remove-button").click();

									$.ajax({
										url: 'php_action/fetchAuthUserListImageUrl.php?i='+userid,
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

function postedUserInfo(userid = null) {
	if(userid) {
		$('#userid').remove();
		$.ajax({
			url: 'php_action/fetchSelectedAuthUserList.php',
			type: 'post',
			data: {userid : userid},
			dataType: 'json',
			success:function(response) {
				$('.postedUserInfoFooter').after('<input type="hidden" name="userid" id="userid" value="'+response.user_id+'" /> ');

				// click on remove button to remove the brand
				$("#postedUserInfoBtn").unbind('click').bind('click', function() {
					// button loading
					$("#postedUserInfoBtn").button('loading');

					$.ajax({
						url: 'php_action/postAuthUserInfo.php',
						type: 'post',
						data: {userid : userid},
						dataType: 'json',
						success:function(response) {

						$.ajax({
						url: 'php_action/send-sms-userpass.php',	
						type: 'post',
						data: {userid : userid},
						dataType: 'json',
						success:function(response) {
						}});

							console.log(response);
							// button loading
							$("#postedUserInfoBtn").button('reset');
							if(response.success == true) {

								// hide the remove modal 
								$('#postedUserInfoModal').modal('hide');

								// reload the brand table 
								manageUserTable.ajax.reload(null, false);
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

		$('.postedUserInfoFooter').after();
	} else {
		alert('error!! Refresh the page again');
	}
} // /remove brands function

function removeUser(userid = null) {
	if(userid) {
		$('#userid').remove();
		$.ajax({
			url: 'php_action/fetchSelectedAuthUserList.php',
			type: 'post',
			data: {userid : userid},
			dataType: 'json',
			success:function(response) {
				$('.removeUserFooter').after('<input type="hidden" name="userid" id="userid" value="'+response.user_id+'" /> ');

				// click on remove button to remove the brand
				$("#removeUserBtn").unbind('click').bind('click', function() {
					// button loading
					$("#removeUserBtn").button('loading');

					$.ajax({
						url: 'php_action/removeAuthUserInfo.php',
						type: 'post',
						data: {userid : userid},
						dataType: 'json',
						success:function(response) {
							console.log(response);
							// button loading
							$("#removeUserBtn").button('reset');
							if(response.success == true) {

								// hide the remove modal 
								$("#removeUserModal").button('reset');

								// reload the brand table 
								manageUserTable.ajax.reload(null, false);
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

		$('.removeUserFooter').after();
	} else {
		alert('error!! Refresh the page again');
	}
} // /remove brands function