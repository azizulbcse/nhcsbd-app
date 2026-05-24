var manageDepositMonthInfoTable;

$(document).ready(function() {
    // মেনু সিলেকশন
    $('#navSetup').addClass('active');

    // ১. স্মার্ট ডাটাটেবিল ইনিশিয়ালাইজেশন
    manageDepositMonthInfoTable = $("#manageDepositMonthInfoTable").DataTable({
        'ajax': 'php_action/fetchDepositMonthInfo.php',
        'order': [],
        'responsive': true
    });

    // ২. অ্যাড ফর্ম সাবমিট (Smart Logic)
    $("#submitBankInfoForm").off('submit').on('submit', function(e) {
        e.preventDefault();

        $(".text-danger").remove();
        $('.form-group').removeClass('has-error has-success');			

        var DepositMonth = $("#DepositMonth").val();
        var DepositYear  = $("#DepositYear").val();
        var isValid = true;

        if(!DepositMonth) {
            $("#DepositMonth").after('<p class="text-danger">মাসের নাম প্রয়োজন!</p>').closest('.form-group').addClass('has-error');
            isValid = false;
        }
        if(!DepositYear) {
            $("#DepositYear").after('<p class="text-danger">বছর প্রয়োজন!</p>').closest('.form-group').addClass('has-error');
            isValid = false;
        }

        if(isValid) {
            var form = $(this);
            var btn = $("#createBankInfoBtn");
            btn.button('loading');

            $.ajax({
                url : form.attr('action'),
                type: form.attr('method'),
                data: form.serialize(),
                dataType: 'json',
                success:function(response) {
                    btn.button('reset');
                    if(response.success) {
                        manageDepositMonthInfoTable.ajax.reload(null, false);						
                        form[0].reset();
                        $('.form-group').removeClass('has-error has-success');
                        
                        $('#add-bankinfo-messages').html(`
                            <div class="alert alert-success" style="background: var(--nhcs-green); color: #fff; border: none; border-radius: 10px;">
                                <button type="button" class="close" data-dismiss="alert" style="color:#fff; opacity:1;">&times;</button>
                                <strong><i class="fa fa-check-circle"></i></strong> ${response.messages}
                            </div>
                        `);
                        $(".alert-success").delay(3000).fadeOut(500);
                    }
                }
            });	
        }
        return false;
    });
});

// ৩. স্মার্ট এডিট ফাংশন
function editDepositMonthInfo(MonthId = null) {
    if(MonthId) {
        $('.text-danger').remove();
        $('.form-group').removeClass('has-error has-success');
        $('#edit-bankinfo-messages').empty();

        $('.modal-loading').removeClass('div-hide');
        $('.edit-bankinfo-result, .editBankInfoFooter').addClass('div-hide');

        $.ajax({
            url: 'php_action/fetchSelectedSetupDepositMonthInfo.php',
            type: 'post',
            data: {MonthId : MonthId},
            dataType: 'json',
            success:function(response) {
                $('.modal-loading').addClass('div-hide');
                $('.edit-bankinfo-result, .editBankInfoFooter').removeClass('div-hide');

                $('#editDepositMonth').val(response.mname);
                $('#editDepositYear').val(response.year);

                // আইডি ইনপুট স্মার্টলি হ্যান্ডেল করা
                if ($('#MonthId').length === 0) {
                    $('#editBankInfoForm').append(`<input type="hidden" name="MonthId" id="MonthId" value="${response.mid}" />`);
                } else {
                    $('#MonthId').val(response.mid);
                }

                // আপডেট সাবমিট
                $('#editBankInfoForm').off('submit').on('submit', function(e) {
                    e.preventDefault();
                    var btn = $('#editBankInfoBtn');
                    btn.button('loading');

                    $.ajax({
                        url: $(this).attr('action'),
                        type: $(this).attr('method'),
                        data: $(this).serialize(),
                        dataType: 'json',
                        success:function(response) {
                            btn.button('reset');
                            if(response.success) {
                                manageDepositMonthInfoTable.ajax.reload(null, false);								  	  										
                                $('#edit-bankinfo-messages').html(`
                                    <div class="alert alert-success" style="background: var(--nhcs-green); color: #fff; border: none; border-radius: 10px;">
                                        <button type="button" class="close" data-dismiss="alert" style="color:#fff; opacity:1;">&times;</button>
                                        <strong><i class="fa fa-check-circle"></i></strong> ${response.messages}
                                    </div>
                                `);
                                $(".alert-success").delay(3000).fadeOut(500);
                            }
                        }
                    });
                    return false;
                });
            }
        });
    } else {
        alert('ত্রুটি! অনুগ্রহ করে পেজটি রিফ্রেশ করুন।');
    }
}
