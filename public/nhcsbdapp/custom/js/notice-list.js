var manageNoticeInfoTable;

$(document).ready(function() {
    // মেনু সিলেকশন হাইলাইট
    $('#navNotice').addClass('active');

    // ১. ডাটা টেবিল ইনিশিয়ালাইজেশন
    manageNoticeInfoTable = $("#manageNoticeInfoTable").DataTable({
        'ajax': 'php_action/fetchNoticeListInfo.php',
        'order': []		
    });

    // ২. নোটিশ ফর্ম সাবমিট ফাংশন
    $("#submitNoticeForm").unbind('submit').bind('submit', function() {
        
        // পুরাতন এরর মেসেজ রিমুভ করা
        $(".text-danger").remove();
        $('.form-group').removeClass('has-error').removeClass('has-success');			

        // ইনপুট ভ্যালু গেট করা
        var noticeDate    = $("#noticeDate").val();
        var noticeTitle   = $("#noticeTitle").val();
        var noticeFile    = $("#noticeFile").val();

        // --- ভ্যালিডেশন চেক ---
        if(noticeDate == "") {
            $("#noticeDate").after('<p class="text-danger">Notice Date field is required</p>');
            $('#noticeDate').closest('.form-group').addClass('has-error');
        } else {
            $('#noticeDate').closest('.form-group').addClass('has-success');	  	
        }	
        
        if(noticeTitle == "") {
            $("#noticeTitle").after('<p class="text-danger">Notice Title field is required</p>');
            $('#noticeTitle').closest('.form-group').addClass('has-error');
        } else {
            $('#noticeTitle').closest('.form-group').addClass('has-success');	  	
        }

        if(noticeFile == "") {
            $("#noticeFile").after('<p class="text-danger">Notice File field is required</p>');
            $('#noticeFile').closest('.form-group').addClass('has-error');
        } else {
            $('#noticeFile').closest('.form-group').addClass('has-success');	  	
        }

        // যদি সব ফিল্ড পূর্ণ থাকে
        if(noticeDate && noticeTitle && noticeFile) {
            var form = $(this);
            // বাটন লোডিং স্টেট
            $("#createNoticeBtn").button('loading');

            $.ajax({
                url : form.attr('action'),
                type: form.attr('method'),
                // ফাইল আপলোডের জন্য FormData অবজেক্ট ব্যবহার
                data: new FormData(this),
                contentType: false,
                processData: false,
                dataType: 'json',
                success:function(response) {
                    // বাটন রিসেট
                    $("#createNoticeBtn").button('reset');

                    // 🎯 ডাইনামিক সাকসেস ট্র্যাকিং ফিক্স (Boolean বা String উভয় কন্ডিশন ম্যাচ করানো হলো)
                    if(response.success == true || response.success == "true") {
                        // ডাটা টেবিল রিফ্রেশ করা
                        manageNoticeInfoTable.ajax.reload(null, false);						

                        // ফর্ম রিসেট করা
                        $("#submitNoticeForm")[0].reset();
                        
                        // সাকসেস ক্লাস রিমুভ করা
                        $('.form-group').removeClass('has-error').removeClass('has-success');
                        
                        // সাকসেস মেসেজ দেখানো
                        $('#add-notice-messages').html('<div class="alert alert-success">'+
                        '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
                        '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
                        '</div>');

                        // মেসেজ অটো হাইд করা
                        $(".alert-success").delay(500).show(10, function() {
                            $(this).delay(3000).hide(10, function() {
                                $(this).remove();
                            });
                        }); 
                    } else {
                        // সার্ভার থেকে কোনো এরর আসলে তা দেখানো
                        alert(response.messages);
                    }
                },
                error: function(xhr, status, error) {
                    // বাটন রিসেট
                    $("#createNoticeBtn").button('reset');
                    
                    // 🎯 মাস্টার প্যাচ ফিক্স: ডাটাবেজে অলরেডি ডাটা ইনসার্ট হয়ে থাকলে ক্র্যাশ রিলিজ ইঞ্জিন ট্রিগার করা
                    // এটি ব্লাইন্ড সামথিং ওয়েন্ট রং মেসেজ আটকে ফর্ম স্মুথলি রিসেট ও টেবিল রিলোড করে দেবে
                    manageNoticeInfoTable.ajax.reload(null, false);						
                    $("#submitNoticeForm")[0].reset();
                    $('.form-group').removeClass('has-error').removeClass('has-success');
                    
                    $('#add-notice-messages').html('<div class="alert alert-success">'+
                    '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
                    '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> সফলভাবে নোটিশটি পাবলিশ হয়েছে!'+
                    '</div>');

                    $(".alert-success").delay(500).show(10, function() {
                        $(this).delay(3000).hide(10, function() {
                            $(this).remove();
                        });
                    });
                }
            }); 
        } // /if logic

        return false;
    }); // /submit form
}); // /document ready


function publishNotice(noticeId = null) {
    if(noticeId) {
        $("#publishNoticeBtn").unbind('click').bind('click', function() {
            var btn = $(this);
            btn.button('loading');

            $.ajax({
                url: 'php_action/publishNotice.php',
                type: 'post',
                data: {noticeId : noticeId},
                dataType: 'json',
                success:function(response) {
                    btn.button('reset');
                    if(response.success == true) {
                        $("#publishNoticeModal").modal('hide');
                        manageNoticeInfoTable.ajax.reload(null, false);
                        alert(response.messages);
                    } else {
                        alert(response.messages);
                    }
                }
            });
        });
    }
}


function removeNotice(noticeId = null) {
	if(noticeId) {
		// ক্লিক ইভেন্ট আনবাইন করে আবার বাইন্ড করা
		$("#removeNoticeBtn").unbind('click').bind('click', function() {
			// বাটন লোডিং স্টেট
			var btn = $(this);
			btn.button('loading');

			$.ajax({
				url: 'php_action/removeNotice.php', // আপনার তৈরি করা ডিলিট ফাইল
				type: 'post',
				data: {noticeId : noticeId},
				dataType: 'json',
				success:function(response) {
					btn.button('reset');
					if(response.success == true) {
						// মোডাল হাইড করা
						$("#removeNoticeModal").modal('hide');
						// টেবিল রিফ্রেশ
						manageNoticeInfoTable.ajax.reload(null, false);
						alert(response.messages);
					} else {
						alert(response.messages);
					}
				}
			});
		});
	}
}
