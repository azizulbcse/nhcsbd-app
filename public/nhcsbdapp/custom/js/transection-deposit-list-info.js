var manageTraxDepositInfoTable;
$(document).ready(function() {
	// top bar active
	$('#navUnit').addClass('active');	
	// manage brand table
	manageTraxDepositInfoTable = $("#manageTraxDepositInfoTable").DataTable({
		'ajax': 'php_action/fetchTrxDepositListInfo.php?id=1',
		"pageLength": 100,
		'order': []		
	});
});

function postedDepositInfo(trxid = null) {
	if(trxid) {
		$('#trxid').remove();
		$.ajax({
			url: 'php_action/fetchSelectedDepositEntryInfo.php',
			type: 'post',
			data: {trxid : trxid},
			dataType: 'json',
			success:function(response) {
				$('.postedDepositInfoFooter').after('<input type="hidden" name="trxid" id="trxid" value="'+response.trxdid+'" /> ');

				// click on remove button to remove the brand
				$("#postedDepositInfoBtn").unbind('click').bind('click', function() {
					// button loading
					$("#postedDepositInfoBtn").button('loading');

					$.ajax({
						url: 'php_action/postTrxDepositInfo.php',
						type: 'post',
						data: {trxid : trxid},
						dataType: 'json',
						success:function(response) {
							
							$.ajax({
								url: 'php_action/send-sms-deposit.php',	
								type: 'post',
								data: {trxid : trxid},
								dataType: 'json',
								success:function(response) {
							}});


							console.log(response);
							// button loading
							$("#postedDepositInfoBtn").button('reset');
							if(response.success == true) {

								// hide the remove modal 
								$('#postedDepositInfoModal').modal('hide');

								// reload the brand table 
								manageTraxDepositInfoTable.ajax.reload(null, false);
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

		$('.postedDepositInfoFooter').after();
	} else {
		alert('error!! Refresh the page again');
	}
} // /remove brands function


function removeDepositInfo(trxid = null) {
	if(trxid) {
		$('#removetrxid').remove();
		$.ajax({
			url: 'php_action/fetchSelectedDepositEntryInfo.php',
			type: 'post',
			data: {trxid : trxid},
			dataType: 'json',
			success:function(response) {
				$('.removeDepositInfoFooter').after('<input type="hidden" name="removetrxid" id="removetrxid" value="'+response.trxdid+'" /> ');

				// click on remove button to remove the brand
				$("#removeDepositInfoBtn").unbind('click').bind('click', function() {
					// button loading
					$("#removeDepositInfoBtn").button('loading');

					$.ajax({
						url: 'php_action/removeTrxDepositInfo.php',
						type: 'post',
						data: {trxid : trxid},
						dataType: 'json',
						success:function(response) {
							console.log(response);
							// button loading
							$("#removeDepositInfoBtn").button('reset');
							if(response.success == true) {

								// hide the remove modal 
								$('#removeDepositInfoModal').modal('hide');

								// reload the brand table 
								manageTraxDepositInfoTable.ajax.reload(null, false);
								
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

		$('.removeDepositInfoFooter').after();
	} else {
		alert('error!! Refresh the page again');
	}
} // /remove brands function