var manageBankInfoTable;

$(document).ready(function() {
    // মেনু অ্যাক্টিভ করা
	$('#navAccgroup').addClass('active');

	// ১. স্মার্ট ডাটা টেবিল লোড
	manageBankInfoTable = $("#manageBankInfoTable").DataTable({
		'ajax': 'php_action/fetchBankInfo.php',
		'order': [],
        'language': { 'search': "খুঁজুন:" } // স্মার্ট সার্চ
	});

	// ২. ব্যাংক ইনফো সেভ করার ফাংশন
	$("#submitBankInfoForm").unbind('submit').bind('submit', function() {
		$(".text-danger").remove();
		$('.form-group').removeClass('has-error').removeClass('has-success');			

		var bankName = $("#bankName").val();
		if(bankName == "") {
			$("#bankName").after('<p class="text-danger">ব্যাংকের নাম লিখুন</p>');
			$('#bankName').closest('.form-group').addClass('has-error');
		} else {
			$("#bankName").closest('.form-group').addClass('has-success');	  	
		}		

		if(bankName) {
			var form = $(this);
			$("#createBankInfoBtn").button('loading');

			$.ajax({
				url : form.attr('action'),
				type: form.attr('method'),
				data: form.serialize(),
				dataType: 'json',
				success:function(response) {
					$("#createBankInfoBtn").button('reset');

					if(response.success == true) {
						// সাকসেস মেসেজ (সবুজ)
						manageBankInfoTable.ajax.reload(null, false);						
						$("#submitBankInfoForm")[0].reset();
						$('.form-group').removeClass('has-error').removeClass('has-success');
  	  			
  	  			        $('#add-bankinfo-messages').html('<div class="alert alert-success" style="background:#05B262; color:#fff; border:none; border-radius:10px;">'+
                            '<button type="button" class="close" data-dismiss="alert" style="color:#fff; opacity:1;">&times;</button>'+
                            '<strong><i class="fa-solid fa-circle-check"></i></strong> '+ response.messages +
                        '</div>');
					} else {
                        // ইউনিক এরর মেসেজ (লাল এলার্ট) - এটিই আপনার কাজ করছিল না
                        $('#add-bankinfo-messages').html('<div class="alert alert-danger" style="background:#e74c3c; color:#fff; border:none; border-radius:10px;">'+
                            '<button type="button" class="close" data-dismiss="alert" style="color:#fff; opacity:1;">&times;</button>'+
                            '<strong><i class="fa-solid fa-triangle-exclamation"></i></strong> ' + response.messages +
                        '</div>');
                    }

                    // ৪ সেকেন্ড পর এলার্ট সরিয়ে ফেলা
  	  			    $(".alert").delay(500).show(10, function() {
							$(this).delay(4000).hide(10, function() {
								$(this).remove();
							});
					}); 
				} 
			}); 	
		} 
		return false;
	}); 
});

function editBankInfo(BankId = null) {
    if (!BankId) {
        Swal.fire('Error!', 'Refresh the page and try again.', 'error'); // ভালো ইউজার এক্সপেরিয়েন্সের জন্য
        return false;
    }

    // ১. ফর্ম রিসেট এবং লোডিং স্টেট
    $('#editBankInfoForm')[0].reset(); 
    $('.text-danger').remove();
    $('.form-group').removeClass('has-error has-success');
    $('#edit-bankinfo-messages').empty();
    
    $('.modal-loading').removeClass('div-hide');
    $('.edit-bankinfo-result, .editBankInfoFooter').addClass('div-hide');

    // ২. ডাটা ফেচ করা
    $.ajax({
        url: 'php_action/fetchSelectedSetupBankInfo.php',
        type: 'post',
        data: { BankId: BankId },
        dataType: 'json',
        success: function(response) {
            $('.modal-loading').addClass('div-hide');
            $('.edit-bankinfo-result, .editBankInfoFooter').removeClass('div-hide');

            // ডাটা ফিল করা
            $('#editbankName').val(response.bank_name);
            
            // আইডি সেট করার স্মার্ট পদ্ধতি (বারবার ইনপুট রিমুভ-অ্যাড করার দরকার নেই)
            if ($('#editBankId').length == 0) {
                $('#editBankInfoForm').append('<input type="hidden" name="BankId" id="editBankId" value="' + response.bank_id + '" />');
            } else {
                $('#editBankId').val(response.bank_id);
            }

            // ৩. সাবমিট হ্যান্ডলিং (একবারই বাইন্ড হবে)
            handleFormSubmit();
        }
    });
}

function editBankInfo(BankId = null) {
    if(BankId) {
        // ফর্ম এবং এরর ক্লিয়ার করা
        $('#editBankInfoForm')[0].reset();
        $('.text-danger').remove();
        $('.form-group').removeClass('has-error').removeClass('has-success');
        $('#edit-bankinfo-messages').html("");

        $('.modal-loading').removeClass('div-hide');
        $('.edit-bankinfo-result').addClass('div-hide');
        $('.editBankInfoFooter').addClass('div-hide');

        $.ajax({
            url: 'php_action/fetchSelectedSetupBankInfo.php',
            type: 'post',
            data: {BankId : BankId},
            dataType: 'json',
            success:function(response) {
                $('.modal-loading').addClass('div-hide');
                $('.edit-bankinfo-result').removeClass('div-hide');
                $('.editBankInfoFooter').removeClass('div-hide');

                // আইডি এবং নাম সেট করা
                $('#editbankName').val(response.bank_name);
                // যদি আগে থেকে BankId ইনপুট না থাকে তবে অ্যাড করা, থাকলে ভ্যালু সেট করা
                if ($('#BankId').length) {
                    $('#BankId').val(response.bank_id);
                } else {
                    $('#editBankInfoForm').append('<input type="hidden" name="BankId" id="BankId" value="'+response.bank_id+'" />');
                }

                // সাবমিট লজিক (off ব্যবহার করা হয়েছে যাতে বারবার বাইন্ড না হয়)
                $('#editBankInfoForm').off('submit').on('submit', function(e) {
                    e.preventDefault(); // পেজ রিলোড আটকানো

                    var bankName = $('#editbankName').val();
                    if(bankName == "") {
                        $("#editbankName").after('<p class="text-danger">ব্যাংকের নাম লিখুন</p>');
                        $('#editbankName').closest('.form-group').addClass('has-error');
                        return false;
                    }

                    var form = $(this);
                    $('#editBankInfoBtn').button('loading');

                    $.ajax({
                        url: form.attr('action'),
                        type: form.attr('method'),
                        data: form.serialize(),
                        dataType: 'json',
                        success:function(response) {
                            $('#editBankInfoBtn').button('reset');

                            if(response.success == true) {
                                // টেবিল রিলোড
                                if ($.fn.DataTable.isDataTable('#manageBankInfoTable')) {
                                    manageBankInfoTable.ajax.reload(null, false);
                                }
                                
                                $('#edit-bankinfo-messages').html('<div class="alert alert-success" style="background:#05B262; color:#fff; border:none; border-radius:10px;">'+
                                    '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
                                    '<strong><i class="fa-solid fa-circle-check"></i></strong> '+ response.messages +
                                '</div>');

                                // মোডাল অটো বন্ধ করতে চাইলে নিচের লাইনটি ব্যবহার করুন
                                // setTimeout(function(){ $('#editBankInfoModel').modal('hide'); }, 2000);
                            } else {
                                $('#edit-bankinfo-messages').html('<div class="alert alert-danger" style="background:#e74c3c; color:#fff; border:none; border-radius:10px;">'+
                                    '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
                                    '<strong><i class="fa-solid fa-triangle-exclamation"></i></strong> ' + response.messages +
                                '</div>');
                            }

                            $(".alert").delay(3000).fadeOut(500); 
                        }
                    });
                    return false;
                });
            }
        });
    }
}

function removeBankInfo(BankId = null) {
    if(BankId) {
        // ১. আগের যেকোনো ক্লিক ইভেন্ট রিমুভ করা (Memory Leak রোধ করতে)
        $("#removeBankInfoBtn").off('click').on('click', function() {
            
            var btn = $(this);
            btn.button('loading'); // বাটন লোডিং স্টেট

            $.ajax({
                url: 'php_action/removeSetupBankInfo.php',
                type: 'post',
                data: { BankId: BankId }, // সরাসরি আইডি পাঠানো
                dataType: 'json',
                success: function(response) {
                    btn.button('reset');

                    if(response.success == true) {
                        // ২. মোডাল বন্ধ করা
                        $("#removeBankInfoModel").modal('hide'); 

                        // ৩. টেবিল রিলোড করা
                        manageBankInfoTable.ajax.reload(null, false);

                        // ৪. সাকসেস মেসেজ দেখানো (আপনার মেইন পেজের মেসেজ কন্টেইনারে)
                        $('.remove-messages').html('<div class="alert alert-success" style="border-radius:10px;">'+
                            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
                            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
                        '</div>');

                        $(".alert-success").delay(3000).fadeOut(500);
                    } else {
                        alert(response.messages); // এরর মেসেজ দেখালে ভালো
                    }
                },
                error: function() {
                    btn.button('reset');
                    alert("Something went wrong!");
                }
            });
        });
    } else {
        alert('Error!! Refresh the page again');
    }
}
