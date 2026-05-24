var manageGalleryTable;

$(document).ready(function() {
    // মেনু সিলেকশন হাইলাইট (আপনার গ্যালারি মেনুর আইডি দিন)
    $('#navGallery').addClass('active'); 

    // ১. ডাটা টেবিল ইনিশিয়ালাইজেশন (fetchGallery.php ব্যবহার করা হয়েছে)
    manageGalleryTable = $("#manageGalleryTable").DataTable({
        'ajax': 'php_action/fetchGallery.php',
        'order': []		
    });

    // ২. গ্যালারি ফর্ম সাবমিট ফাংশন
    $("#submitGalleryForm").unbind('submit').bind('submit', function() {
        
        // পুরাতন এরর মেসেজ রিমুভ করা
        $(".text-danger").remove();
        $('.form-group').removeClass('has-error').removeClass('has-success');			

        // ইনপুট ভ্যালু গেট করা
        var title      = $("#title").val();
        var media_type = $("#media_type").val();
        var mediaFile  = $("#mediaFile").val();

        // --- ভ্যালিডেশন চেক ---
        if(title == "") {
            $("#title").after('<p class="text-danger">শিরোনাম আবশ্যক</p>');
            $('#title').closest('.form-group').addClass('has-error');
        } else {
            $('#title').closest('.form-group').addClass('has-success');	  	
        }	
        
        if(media_type == "") {
            $("#media_type").after('<p class="text-danger">মিডিয়া টাইপ সিলেক্ট করুন</p>');
            $('#media_type').closest('.form-group').addClass('has-error');
        } else {
            $('#media_type').closest('.form-group').addClass('has-success');	  	
        }

        if(mediaFile == "") {
            $("#mediaFile").after('<p class="text-danger">ফাইল সিলেক্ট করা আবশ্যক</p>');
            $('#mediaFile').closest('.form-group').addClass('has-error');
        } else {
            $('#mediaFile').closest('.form-group').addClass('has-success');	  	
        }

        // যদি সব ফিল্ড পূর্ণ থাকে
        if(title && media_type && mediaFile) {
            var form = $(this);
            // বাটন লোডিং স্টেট (Publish/Upload বাটন)
            $("#createGalleryBtn").button('loading');

            $.ajax({
                url : form.attr('action'), // php_action/createGallery.php
                type: form.attr('method'),
                data: new FormData(this),
                contentType: false,
                processData: false,
                dataType: 'json',
                success:function(response) {
                    // বাটন রিসেট
                    $("#createGalleryBtn").button('reset');

                    if(response.success == true) {
                        // ডাটা টেবিল রিফ্রেশ করা
                        manageGalleryTable.ajax.reload(null, false);						

                        // ফর্ম রিসেট করা
                        $("#submitGalleryForm")[0].reset();
                        
                        // সাকসেস ক্লাস রিমুভ করা
                        $('.form-group').removeClass('has-error').removeClass('has-success');
                        
                        // সাকসেস মেসেজ দেখানো (মডালের ভেতর থাকা ডিভ আইডি)
                        $('#add-gallery-messages').html('<div class="alert alert-success">'+
                        '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
                        '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
                        '</div>');

                        // মেসেজ অটো হাইড করা
                        $(".alert-success").delay(500).show(10, function() {
                            $(this).delay(3000).hide(10, function() {
                                $(this).remove();
                            });
                        }); 
                    } else {
                        // সার্ভার থেকে এরর আসলে
                        alert(response.messages);
                    }
                },
                error: function() {
                    $("#createGalleryBtn").button('reset');
                    alert("কিছু একটা সমস্যা হয়েছে। আবার চেষ্টা করুন।");
                }
            }); 
        } // /if logic

        return false;
    }); // /submit form
});

function publishMedia(id = null) {
    if(id) {
        $("#publishBtn").unbind('click').bind('click', function() {
            var btn = $(this);
            btn.button('loading');

            $.ajax({
                url: 'php_action/editGalleryStatus.php',
                type: 'post',
                data: {id: id, status: 2},
                dataType: 'json',
                success:function(response) {
                    btn.button('reset');
                    if(response.success == true) {
                        $("#publishGalleryModal").modal('hide');
                        manageGalleryTable.ajax.reload(null, false);
                        alert(response.messages);
                    }
                }
            });
        });
    }
}

// ২. Remove/Delete Function
function removeGallery(id = null) {
    if(id) {
        $("#removeGalleryBtn").unbind('click').bind('click', function() {
            var btn = $(this);
            btn.button('loading');

            $.ajax({
                url: 'php_action/removeGallery.php',
                type: 'post',
                data: {id: id},
                dataType: 'json',
                success:function(response) {
                    btn.button('reset');
                    if(response.success == true) {
                        $("#removeGalleryModal").modal('hide');
                        manageGalleryTable.ajax.reload(null, false);
                        alert(response.messages);
                    }
                }
            });
        });
    }
}