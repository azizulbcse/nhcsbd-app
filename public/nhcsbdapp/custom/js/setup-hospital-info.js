var manageHospitalInfoTable;

$(document).ready(function() {
    // Top bar active
    $('#navSetup').addClass('active');
    
    // ১. স্মার্ট ডাটা টেবিল লোড
    manageHospitalInfoTable = $("#manageHospitalInfoTable").DataTable({
        'ajax': 'php_action/fetchSetupHospitalInfo.php',
        'order': [],
        'language': {
            'search': "খুঁজুন:",
            'lengthMenu': "দেখান _MENU_ টি ডাটা",
            'zeroRecords': "দুঃখিত, কোনো তথ্য পাওয়া যায়নি",
            'info': "পৃষ্ঠা _PAGE_ এর _PAGES_",
            'infoEmpty': "কোনো ডাটা নেই",
            'paginate': {
                'next': "পরবর্তী",
                'previous': "আগের"
            }
        }
    });

    // ২. হসপিটাল ইনফো সেভ (Unique Check Error সহ)
    $("#submitHospitalInfoForm").unbind('submit').bind('submit', function() {
        $(".text-danger").remove();
        $('.form-group').removeClass('has-error').removeClass('has-success');			

        var HospitalName = $("#HospitalName").val();
        if(HospitalName == "") {
            $("#HospitalName").after('<p class="text-danger" style="margin-top:5px; font-size:12px;">হসপিটালের নাম প্রয়োজন</p>');
            $('#HospitalName').closest('.form-group').addClass('has-error');
        }		

        if(HospitalName) {
            var form = $(this);
            $("#createHospitalInfoBtn").button('loading');

            $.ajax({
                url : form.attr('action'),
                type: form.attr('method'),
                data: form.serialize(),
                dataType: 'json',
                success:function(response) {
                    $("#createHospitalInfoBtn").button('reset');

                    if(response.success == true) {
                        manageHospitalInfoTable.ajax.reload(null, false);						
                        $("#submitHospitalInfoForm")[0].reset();
                        $('.form-group').removeClass('has-error').removeClass('has-success');
                        
                        // লোগোর সবুজ কালার এলার্ট
                        $('#add-hospital-messages').html('<div class="alert alert-success" style="background:#05B262; color:#fff; border:none; border-radius:10px;">'+
                        '<button type="button" class="close" data-dismiss="alert" style="color:#fff; opacity:1;">&times;</button>'+
                        '<strong><i class="fa-solid fa-circle-check"></i></strong> '+ response.messages +
                        '</div>');
                    } else {
                        // ইউনিক চেক এরর (লাল এলার্ট)
                        $('#add-hospital-messages').html('<div class="alert alert-danger" style="background:#e74c3c; color:#fff; border:none; border-radius:10px;">'+
                        '<button type="button" class="close" data-dismiss="alert" style="color:#fff; opacity:1;">&times;</button>'+
                        '<strong><i class="fa-solid fa-triangle-exclamation"></i></strong> '+ response.messages +
                        '</div>');
                    }

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

// ৩. এডিট ফাংশন (মেসেজ ফিক্সসহ)
function editHospitalInfo(hid = null) {
    if(hid) { 
        $('#hid').remove();
        $('.text-danger').remove();
        $('.form-group').removeClass('has-error').removeClass('has-success');
        
        // মোডাল মেসেজ ক্লিয়ার করা
        $('#edit-hospitalinfo-messages').html("");

        $.ajax({
            url: 'php_action/fetchSelectedSetupHospitalInfo.php',
            type: 'post',
            data: {hid : hid},
            dataType: 'json',
            success:function(response) {
                $('#editHospitalName').val(response.hospitalname);
                // hid ইনপুট ফিল্ডটি ফুটারে যুক্ত করা
                $(".editHospitalInfoFooter").after('<input type="hidden" name="hid" id="hid" value="'+response.hid+'" />');

                $('#editHospitalInfoForm').unbind('submit').bind('submit', function() {
                    $(".text-danger").remove();
                    var HospitalName = $('#editHospitalName').val();

                    if(HospitalName) {
                        var form = $(this);
                        $('#editHospitalInfoBtn').button('loading');

                        $.ajax({
                            url: form.attr('action'),
                            type: form.attr('method'),
                            data: form.serialize(),
                            dataType: 'json',
                            success:function(response) {
                                $('#editHospitalInfoBtn').button('reset');

                                // ১. যদি সাকসেস হয় (True)
                                if(response.success == true) {
                                    manageHospitalInfoTable.ajax.reload(null, false);
                                    
                                    $('#edit-hospitalinfo-messages').html('<div class="alert alert-success" style="background:#05B262; color:#fff; border:none; border-radius:10px;">'+
                                    '<button type="button" class="close" data-dismiss="alert" style="color:#fff; opacity:1;">&times;</button>'+
                                    '<strong><i class="fa-solid fa-circle-check"></i></strong> '+ response.messages +
                                    '</div>');
                                } 
                                // ২. যদি ইউনিক না হয় বা কোনো এরর থাকে (False)
                                else {
                                    $('#edit-hospitalinfo-messages').html('<div class="alert alert-danger" style="background:#e74c3c; color:#fff; border:none; border-radius:10px;">'+
                                    '<button type="button" class="close" data-dismiss="alert" style="color:#fff; opacity:1;">&times;</button>'+
                                    '<strong><i class="fa-solid fa-triangle-exclamation"></i></strong> '+ response.messages +
                                    '</div>');
                                }

                                // ৩. ৪ সেকেন্ড পর এলার্ট সরিয়ে ফেলা
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
            }
        });
    }
}


// ৪. রিমুভ ফাংশন
function removeHospitalInfo(hid = null) {
    if(hid) {
        $("#removeHospitalInfoBtn").unbind('click').bind('click', function() {
            $("#removeHospitalInfoBtn").button('loading');
            $.ajax({
                url: 'php_action/removeSetupHospitalInfo.php',
                type: 'post',
                data: {hid : hid},
                dataType: 'json',
                success:function(response) {
                    $("#removeHospitalInfoBtn").button('reset');
                    if(response.success == true) {
                        $('#removeHospitalInfoModal').modal('hide');
                        manageHospitalInfoTable.ajax.reload(null, false);
                    } else {
                        alert(response.messages);
                    }
                }
            });
        });
    }
}
