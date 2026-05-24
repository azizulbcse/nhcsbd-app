$(document).ready(function() {
	// main menu
	$("#navSetting").addClass('active');
	// sub manin
	$("#topNavSetting").addClass('active');

	$("#ApplicationForm").unbind('submit').bind('submit', function() {

		var form = $(this);

		$(".text-danger").remove();

		var DonateDate     = $("#DonateDate").val();
		var DonateName     = $("#DonateName").val();
		var MobileNo       = $("#MobileNo").val();
		var DonationAmount = $("#DonationAmount").val();
		var PaymentType    = $("#PaymentType").val();
		var DepositTo      = $("#DepositTo").val();
		var TransactionNo  = $("#TransactionNo").val();


		if(DonateDate == "" || DonateName == "" || MobileNo == "" || DonationAmount == "" || PaymentType == "" || DepositTo == "" || TransactionNo == "") 
		{
		    if(DonateDate == "") {
				$("#DonateDate").after('<p class="text-danger">The Donate Date field is required</p>');
				$("#DonateDate").closest('.form-group').addClass('has-error');
			} else {
				$("#DonateDate").closest('.form-group').removeClass('has-error');
				$(".text-danger").remove();
			}

			if(DonateName == "") {
				$("#DonateName").after('<p class="text-danger">The Donate Name field is required</p>');
				$("#DonateName").closest('.form-group').addClass('has-error');
			} else {
				$("#DonateName").closest('.form-group').removeClass('has-error');
				$(".text-danger").remove();
			}
			
			if(MobileNo == "") {
				$("#MobileNo").after('<p class="text-danger">The Mobile No field is required</p>');
				$("#MobileNo").closest('.form-group').addClass('has-error');
			} else {
				$("#MobileNo").closest('.form-group').removeClass('has-error');
				$(".text-danger").remove();
			}

			if(DonationAmount == "") {
				$("#DonationAmount").after('<p class="text-danger">The Donation Amount field is required</p>');
				$("#DonationAmount").closest('.form-group').addClass('has-error');
			} else {
				$("#DonationAmount").closest('.form-group').removeClass('has-error');
				$(".text-danger").remove();
			}

			if(PaymentType == "") {
				$("#PaymentType").after('<p class="text-danger">The Payment Type field is required</p>');
				$("#PaymentType").closest('.form-group').addClass('has-error');
			} else {
				$("#PaymentType").closest('.form-group').removeClass('has-error');
				$(".text-danger").remove();
			}

			if(DepositTo == "") {
				$("#DepositTo").after('<p class="text-danger">The Deposit To field is required</p>');
				$("#DepositTo").closest('.form-group').addClass('has-error');
			} else {
				$("#DepositTo").closest('.form-group').removeClass('has-error');
				$(".text-danger").remove();
			}

			if(TransactionNo == "") {
				$("#TransactionNo").after('<p class="text-danger">The Transaction No field is required</p>');
				$("#TransactionNo").closest('.form-group').addClass('has-error');
			} else {
				$("#TransactionNo").closest('.form-group').removeClass('has-error');
				$(".text-danger").remove();
			}				

		} else {
			$(".form-group").removeClass('has-error');
			$(".text-danger").remove();

			$.ajax({
				url: form.attr('action'),
				type: form.attr('method'),
				data: form.serialize(),
				dataType: 'json',
				success:function(response) {
					console.log(response);
					if(response.success == true) {
						$('.ApplicationFormMessage').html('<div class="alert alert-success">'+
	            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
	            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
	          '</div>');

						// remove the mesages
	          $(".alert-success").delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						}); // /.alert	    
					} else {

						$('.ApplicationFormMessage').html('<div class="alert alert-warning">'+
	            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
	            '<strong><i class="glyphicon glyphicon-exclamation-sign"></i></strong> '+ response.messages +
	          '</div>');

						// remove the mesages
	          $(".alert-warning").delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						}); // /.alert	          	
					}
				} // /success function
			}); // /ajax function

		} // /else

		return false;
	});
}); // /document