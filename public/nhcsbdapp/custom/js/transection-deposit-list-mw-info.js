var manageTraxDepositInfoTable;

$(document).ready(function() {
    const urlParams = new URLSearchParams(window.location.search);
    // এখানে 'MemberName' ব্যবহার করুন কারণ আপনার ফর্মে এই নাম দেওয়া আছে
    const selectedMonth = urlParams.get('MemberName'); 

    manageTraxDepositInfoTable = $("#manageTraxDepositInfoTable").DataTable({
        "ajax": {
            "url": "php_action/fetchTrxDepositListMWInfo.php",
            "type": "POST",
            "data": function (d) {
                d.month = selectedMonth; 
            }
        },
        "pageLength": 1000,
        "order": []
    });
});

function postedDepositInfo(trxdid = null) {
	if(trxdid) {
		$('#trxdid').remove();
		$.ajax({
			url: 'php_action/fetchSelectedDepositEntryInfo2.php',
			type: 'post',
			data: {trxdid : trxdid},
			dataType: 'json',
			success:function(response) {
				$('.postedDepositInfoFooter').after('<input type="hidden" name="trxdid" id="trxdid" value="'+response.trxdid+'" /> ');

				// click on remove button to remove the brand
				$("#postedDepositInfoBtn").unbind('click').bind('click', function() {
					// button loading
					$("#postedDepositInfoBtn").button('loading');

					$.ajax({
						url: 'php_action/postTrxDepositInfo2.php',
						type: 'post',
						data: {trxdid : trxdid},
						dataType: 'json',
						success:function(response) {
							
							$.ajax({
								url: 'php_action/send-sms-deposit2.php',	
								type: 'post',
								data: {trxdid : trxdid},
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


function removeDepositInfo(trxdid = null) {
	if(trxdid) {
		$('#removetrxdid').remove();
		$.ajax({
			url: 'php_action/fetchSelectedDepositEntryInfo2.php',
			type: 'post',
			data: {trxdid : trxdid},
			dataType: 'json',
			success:function(response) {
				$('.removeDepositInfoFooter').after('<input type="hidden" name="removetrxdid" id="removetrxdid" value="'+response.trxdid+'" /> ');

				// click on remove button to remove the brand
				$("#removeDepositInfoBtn").unbind('click').bind('click', function() {
					// button loading
					$("#removeDepositInfoBtn").button('loading');

					$.ajax({
						url: 'php_action/removeTrxDepositInfo2.php',
						type: 'post',
						data: {trxdid : trxdid},
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