var manageYearlyAmountInfoTable;

$(document).ready(function() {
    // মেনু সিলেকশন (লোগো থিমের সাথে মিল রেখে)
    $('#navSetup').addClass('active');

    // ১. স্মার্ট ডাটাটেবিল ইনিশিয়ালাইজেশন
    manageYearlyAmountInfoTable = $("#manageYearlyAmountInfoTable").DataTable({
        'ajax': 'php_action/fetchYearlyAmountInfo.php',
        'order': [],
        'responsive': true,
        'language': {
            'search': "খুঁজুন:",
            'lengthMenu': "দেখান _MENU_ টি এন্ট্রি"
        }
    });

    // ২. সাবমিট ফর্ম ফাংশন (Smart Validation & AJAX)
    $("#submitYearlyAmountInfoForm").off('submit').on('submit', function(e) {
        e.preventDefault(); // পেজ রিলোড আটকানো

        // এরর স্টেট ক্লিয়ার করা
        $(".text-danger").remove();
        $('.form-group').removeClass('has-error has-success');			

        // ইনপুট ভ্যালু নেওয়া
        var depositDate  = $("#DepositDate").val();
        var yearlyAmount = $("#YearlyAmount").val();
        var isValid = true;

        // স্মার্ট ভ্যালিডেশন
        if(!depositDate) {
            $("#DepositDate").after('<p class="text-danger" style="margin-top:5px;">তারিখ প্রদান করা বাধ্যতামূলক!</p>');
            $('#DepositDate').closest('.form-group').addClass('has-error');
            isValid = false;
        } else {
            $('#DepositDate').closest('.form-group').addClass('has-success');
        }	
        
        if(!yearlyAmount || yearlyAmount <= 0) {
            $("#YearlyAmount").after('<p class="text-danger" style="margin-top:5px;">সঠিক অ্যামাউন্ট লিখুন (০ এর বেশি)</p>');
            $('#YearlyAmount').closest('.form-group').addClass('has-error');
            isValid = false;
        } else {
            $('#YearlyAmount').closest('.form-group').addClass('has-success');
        }

        // যদি ভ্যালিডেশন পাস করে
        if(isValid) {
            var form = $(this);
            var btn = $("#createYearlyAmountInfoBtn");
            
            btn.button('loading'); // বাটন লোডিং স্টেট

            $.ajax({
                url : form.attr('action'),
                type: form.attr('method'),
                data: form.serialize(),
                dataType: 'json',
                success:function(response) {
                    btn.button('reset');

                    if(response.success == true) {
                        // টেবিল রিফ্রেশ (পেজিনেশন ঠিক রেখে)
                        manageYearlyAmountInfoTable.ajax.reload(null, false);						

                        // ফর্ম এবং স্টেট রিসেট
                        form[0].reset();
                        $('.form-group').removeClass('has-error has-success');
                        
                        // লোগো কালার (NHCS Green) মেসেজ
                        $('#add-yearamountinfo-messages').html(`
                            <div class="alert alert-success" style="background: var(--nhcs-green); color: #fff; border: none; border-radius: 10px;">
                                <button type="button" class="close" data-dismiss="alert" style="color:#fff; opacity:1;">&times;</button>
                                <strong><i class="fa fa-check-circle"></i></strong> ${response.messages}
                            </div>
                        `);

                        // অটোমেটিক মেসেজ হাইড
                        $(".alert-success").delay(3000).fadeOut(500, function() {
                            $(this).remove();
                        });
                    } else {
                        // এরর মেসেজ হ্যান্ডলিং (NHCS Purple/Dark Style)
                        $('#add-yearamountinfo-messages').html(`
                            <div class="alert alert-danger" style="background: #e74c3c; color: #fff; border: none; border-radius: 10px;">
                                <button type="button" class="close" data-dismiss="alert" style="color:#fff; opacity:1;">&times;</button>
                                <strong><i class="fa fa-exclamation-triangle"></i></strong> ${response.messages}
                            </div>
                        `);
                    }
                },
                error: function() {
                    btn.button('reset');
                    alert("সার্ভার ত্রুটি! দয়া করে আবার চেষ্টা করুন।");
                }
            }); 
        } 

        return false;
    }); 
});

function editYearlyAmountIdInfo(YearlyAmountId = null) {
    if (YearlyAmountId) {
        // ১. ফর্ম এবং এরর স্টেট রিসেট (স্মার্ট ক্লিনআপ)
        $('.text-danger').remove();
        $('.form-group').removeClass('has-error has-success');
        $('#edit-yearlyamountinfo-messages').empty();

        // লোডিং স্টেট দেখানো
        $('.modal-loading').removeClass('div-hide');
        $('.edit-yearlyamountinfo-result, .editYearlyAmountInfoFooter').addClass('div-hide');

        $.ajax({
            url: 'php_action/fetchSelectedSetupYearlyAmountInfo.php',
            type: 'post',
            data: { YearlyAmountId: YearlyAmountId },
            dataType: 'json',
            success: function(response) {
                // ২. লোডিং শেষ, ডাটা দেখানো
                $('.modal-loading').addClass('div-hide');
                $('.edit-yearlyamountinfo-result, .editYearlyAmountInfoFooter').removeClass('div-hide');

                // ইনপুট ফিল্ডে ডাটা সেট করা (Response key অনুযায়ী)
                $('#editDepositDate').val(response.yearlastdate);
                $('#editYearlyAmount').val(response.yearlyamount);

                // আইডি ইনপুট হ্যান্ডলিং (স্মার্টলি চেক করা—না থাকলে তৈরি করবে, থাকলে আপডেট করবে)
                if ($('#YearlyAmountId').length === 0) {
                    $('#editYearlyAmountInfoForm').append(`<input type="hidden" name="YearlyAmountId" id="YearlyAmountId" value="${response.yid}" />`);
                } else {
                    $('#YearlyAmountId').val(response.yid);
                }

                // ৩. আপডেট ফর্ম সাবমিট (আধুনিক .off().on() মেথড)
                $('#editYearlyAmountInfoForm').off('submit').on('submit', function(e) {
                    e.preventDefault(); // ডিফল্ট সাবমিট আটকানো

                    $(".text-danger").remove();
                    $('.form-group').removeClass('has-error has-success');

                    var editDepositDate = $('#editDepositDate').val();
                    var editYearlyAmount = $('#editYearlyAmount').val();
                    var hasError = false;

                    // স্মার্ট ভ্যালিডেশন
                    if (!editDepositDate) {
                        $("#editDepositDate").after('<p class="text-danger">তারিখ প্রদান করা বাধ্যতামূলক!</p>').closest('.form-group').addClass('has-error');
                        hasError = true;
                    }
                    if (!editYearlyAmount || editYearlyAmount <= 0) {
                        $("#editYearlyAmount").after('<p class="text-danger">সঠিক অ্যামাউন্ট লিখুন!</p>').closest('.form-group').addClass('has-error');
                        hasError = true;
                    }

                    if (!hasError) {
                        var form = $(this);
                        var btn = $('#editYearlyAmountInfoBtn');
                        btn.button('loading');

                        $.ajax({
                            url: form.attr('action'),
                            type: form.attr('method'),
                            data: form.serialize(),
                            dataType: 'json',
                            success: function(response) {
                                btn.button('reset');

                                if (response.success === true) {
                                    manageYearlyAmountInfoTable.ajax.reload(null, false);

                                    // লোগো গ্রিন কালারের সাথে মিল রেখে সাকসেস মেসেজ
                                    $('#edit-yearlyamountinfo-messages').html(`
                                        <div class="alert alert-success" style="background: var(--nhcs-green); color: #fff; border: none; border-radius: 10px;">
                                            <button type="button" class="close" data-dismiss="alert" style="color:#fff; opacity:1;">&times;</button>
                                            <strong><i class="fa fa-check-circle"></i></strong> ${response.messages}
                                        </div>
                                    `);

                                    // অটো মেসেজ হাইড এবং মডাল ক্লোজ চাইলে করা যায়
                                    $(".alert-success").delay(3000).fadeOut(500);
                                } else {
                                    // এরর মেসেজ
                                    $('#edit-yearlyamountinfo-messages').html(`<div class="alert alert-danger">${response.messages}</div>`);
                                }
                            },
                            error: function() {
                                btn.button('reset');
                                alert("Update failed! Server error.");
                            }
                        });
                    }
                    return false;
                });
            }
        });
    } else {
        alert('ID missing! Refresh the page.');
    }
}

function postedYearlyAmountIdInfo(YearlyAmountId = null) {
    if (YearlyAmountId) {
        // ১. অপ্রয়োজনীয় ডাটা ফেচিং এড়িয়ে সরাসরি আইডি সেট করা (স্মার্ট মেথড)
        $("#postedYearlyAmountInfoBtn").off('click').on('click', function() {
            var btn = $(this);
            btn.button('loading'); // বাটন লোডিং স্টেট

            // ২. প্রথম ধাপ: ডাটা পোস্টিং
            $.ajax({
                url: 'php_action/postYearlyAmountInfo.php',
                type: 'post',
                data: { YearlyAmountId: YearlyAmountId },
                dataType: 'json',
                success: function(response) {
                    if (response.success == true) {
                        
                        // ৩. দ্বিতীয় ধাপ: এসএমএস পাঠানো (ব্যাকগ্রাউন্ডে কল হবে)
                        $.ajax({
                            url: 'php_action/send-sms-yearly-amount.php',
                            type: 'post',
                            data: { YearlyAmountId: YearlyAmountId },
                            dataType: 'json'
                        });

                        // ৪. ইউআই আপডেট
                        btn.button('reset');
                        $('#postedYearlyAmountInfoModal').modal('hide');
                        manageYearlyAmountInfoTable.ajax.reload(null, false);

                        // ব্র্যান্ড গ্রিন কালারে সাকসেস মেসেজ
                        $('.remove-messages').html(`
                            <div class="alert alert-success" style="background: var(--nhcs-green); color: #fff; border: none; border-radius: 10px;">
                                <button type="button" class="close" data-dismiss="alert" style="color:#fff; opacity:1;">&times;</button>
                                <strong><i class="fa fa-check-circle"></i></strong> ${response.messages} (SMS Sending in Background)
                            </div>
                        `);

                        $(".alert-success").delay(3000).fadeOut(500, function() { $(this).remove(); });

                    } else {
                        btn.button('reset');
                        alert("Posting failed: " + response.messages);
                    }
                },
                error: function() {
                    btn.button('reset');
                    alert("Server Error! Could not complete posting.");
                }
            });
        });
    } else {
        alert('Error!! Refresh the page again');
    }
}

function removeYearlyAmountIdInfo(YearlyAmountId = null) {
    if(YearlyAmountId) {
        // ১. আগের ইভেন্ট ক্লিয়ার করে নতুন ক্লিক ইভেন্ট বাইন্ড করা (স্মার্ট মেথড)
        $("#removeYearlyAmountIdBtn").off('click').on('click', function() {
            
            var btn = $(this);
            btn.button('loading'); // বাটন লোডিং স্টেট

            $.ajax({
                url: 'php_action/removeSetupYearlyAmountInfo.php',
                type: 'post',
                data: { YearlyAmountId: YearlyAmountId }, // সরাসরি আইডি পাঠানো
                dataType: 'json',
                success: function(response) {
                    btn.button('reset');

                    if(response.success == true) {
                        // ২. মোডাল বন্ধ করা (সঠিক আইডি দিয়ে)
                        $("#removeYearlyAmountIdModel").modal('hide'); 

                        // ৩. ডাটাটেবিল রিফ্রেশ করা
                        manageYearlyAmountInfoTable.ajax.reload(null, false);

                        // ৪. লোগো গ্রিন কালারে সাকসেস মেসেজ
                        $('.remove-messages').html(`
                            <div class="alert alert-success" style="background: var(--nhcs-green); color: #fff; border: none; border-radius: 10px;">
                                <button type="button" class="close" data-dismiss="alert" style="color:#fff; opacity:1;">&times;</button>
                                <strong><i class="fa fa-check-circle"></i></strong> ${response.messages}
                            </div>
                        `);

                        // অটো হাইড এলার্ট
                        $(".alert-success").delay(3000).fadeOut(500, function() { $(this).remove(); });
                    } else {
                        alert("Error: " + response.messages);
                    }
                },
                error: function() {
                    btn.button('reset');
                    alert("সার্ভার ত্রুটি! ডাটা রিমুভ করা সম্ভব হয়নি।");
                }
            });
        });
    } else {
        alert('ত্রুটি! অনুগ্রহ করে পেজটি রিফ্রেশ করুন।');
    }
}
