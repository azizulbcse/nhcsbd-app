var manageResignInfoTable;

$(document).ready(function() {

	$('#navAccgroup').addClass('active');

	manageResignInfoTable = $("#manageResignInfoTable").DataTable({
		'ajax': 'php_action/fetchApplicationResignList.php',
		'order': []		
	});
});


function PresidentApprovedResignInfo(ResignAppId = null) {
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
						url: 'php_action/postApplicationResignPresident.php',
						type: 'post',
						data: {ResignAppId : ResignAppId},
						dataType: 'json',
						success:function(response) {
							
						$.ajax({
						url: 'php_action/send-sms-app-resign-presi.php',	
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
								$('#PresidentApprovedResignInfoModel').modal('hide');

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


function SGApprovedResignInfo(ResignAppId = null) {
	if(ResignAppId) {
		$('#ResignAppId').remove();
		$.ajax({
			url: 'php_action/fetchSelectedApplicationResignInfo.php',
			type: 'post',
			data: {ResignAppId : ResignAppId},
			dataType: 'json',
			success:function(response) {
				$('.postedResignInfoFooterSG').after('<input type="hidden" name="ResignAppId" id="ResignAppId" value="'+response.rid+'" /> ');

				// click on remove button to remove the brand
				$("#postedResignInfoBtnSG").unbind('click').bind('click', function() {
					// button loading
					$("#postedResignInfoBtnSG").button('loading');

					$.ajax({
						url: 'php_action/postApplicationResignSG.php',
						type: 'post',
						data: {ResignAppId : ResignAppId},
						dataType: 'json',
						success:function(response) {							

                        $.ajax({
						url: 'php_action/send-sms-app-resign-sg.php',	
						type: 'post',
						data: {ResignAppId : ResignAppId},
						dataType: 'json',
						success:function(response) {
						}});
							console.log(response);
							// button loading
							$("#postedResignInfoBtnSG").button('reset');
							if(response.success == true) {

								// hide the remove modal 
								$('#SGApprovedResignInfoModel').modal('hide');

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

		$('.postedResignInfoFooterSG').after();
	} else {
		alert('error!! Refresh the page again');
	}
} // /remove brands function

function ACCApprovedResignInfo(ResignAppId = null) {
	if(ResignAppId) {
		$('#ResignAppId').remove();
		$.ajax({
			url: 'php_action/fetchSelectedApplicationResignInfo.php',
			type: 'post',
			data: {ResignAppId : ResignAppId},
			dataType: 'json',
			success:function(response) {
				$('.postedResignInfoFooterACC').after('<input type="hidden" name="ResignAppId" id="ResignAppId" value="'+response.rid+'" /> ');

				// click on remove button to remove the brand
				$("#postedResignInfoBtnACC").unbind('click').bind('click', function() {
					// button loading
					$("#postedResignInfoBtnACC").button('loading');

					$.ajax({
						url: 'php_action/postApplicationResignACC.php',
						type: 'post',
						data: {ResignAppId : ResignAppId},
						dataType: 'json',
						success:function(response) {
							
                        $.ajax({
						url: 'php_action/send-sms-app-resign-acc.php',	
						type: 'post',
						data: {ResignAppId : ResignAppId},
						dataType: 'json',
						success:function(response) {
						}});

							console.log(response);
							// button loading
							$("#postedResignInfoBtnACC").button('reset');
							if(response.success == true) {

								// hide the remove modal 
								$('#ACCApprovedResignInfoModel').modal('hide');

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

		$('.postedResignInfoFooterACC').after();
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