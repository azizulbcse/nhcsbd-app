var manageTraxDepositInfoTable;
$(document).ready(function() {
	// top bar active
	$('#navUnit').addClass('active');	
	// manage brand table
	manageTraxDepositInfoTable = $("#manageTraxDepositInfoTable").DataTable({
		'ajax': 'php_action/fetchLoanInstalmentPaidInfo.php',
		"pageLength": 100,
		'order': []		
	});
});

function postedDepositInfo(trxid = null) {
    if (!trxid) {
        alert('error!! Refresh the page again');
        return;
    }

    // আগের ট্রানজেকশন আইডি মুছে ফেলা
    $('#trxid').remove();

    $.ajax({
        url: 'php_action/fetchSelectedLoanEMIEntryInfo.php',
        type: 'post',
        data: { trxid: trxid },
        dataType: 'json',
        success: function(response) {
            // ফুটারের পরে নতুন আইডি ইনপুট করা
            $('.postedDepositInfoFooter').after('<input type="hidden" name="trxid" id="trxid" value="' + response.trxdid + '" /> ');

            // ক্লিক ইভেন্ট হ্যান্ডলার (Namespace ব্যবহার করে নিরাপদ করা হয়েছে)
            $("#postedDepositInfoBtn").off('click.deposit').on('click.deposit', function() {
                let btn = $(this);
                btn.prop('disabled', true).text('Loading...'); // Loading state

                $.ajax({
                    url: 'php_action/postLoanInstalmentPaidInfo.php',
                    type: 'post',
                    data: { trxid: trxid },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success === true) {
                            // সাকসেস হলে এসএমএস পাঠানো
                            $.post('php_action/send-sms-loanpaid.php', { trxid: trxid });

                            $('#postedDepositInfoModal').modal('hide');
                            manageTraxDepositInfoTable.ajax.reload(null, false);

                            // মেসেজ দেখানো
                            $('.remove-messages').html('<div class="alert alert-success">' +
                                '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                                '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> ' + response.messages +
                                '</div>');

                            $(".alert-success").delay(500).show(10, function() {
                                $(this).delay(3000).fadeOut();
                            });
                        } else {
                            alert(response.messages || "Error occurred!");
                        }
                    },
                    error: function() {
                        alert("Server error! Please try again.");
                    },
                    complete: function() {
                        btn.prop('disabled', false).text('Save Changes'); // Reset button
                    }
                });
            });
        }
    });
}

function removeDepositInfo(trxid = null) {
	if(trxid) {
		$('#removetrxid').remove();
		$.ajax({
			url: 'php_action/fetchSelectedLoanEMIEntryInfo.php',
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
						url: 'php_action/removeLoanInstalmentPaidInfo.php',
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