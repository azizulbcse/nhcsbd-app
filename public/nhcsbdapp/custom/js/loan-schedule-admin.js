var manageLoanScheduleInfoTable;

$(document).ready(function() {
    // URL theke MemberId param ti khuje ber korar jonno
    const urlParams = new URLSearchParams(window.location.search);
    const memberId = urlParams.get('MemberId'); // Apnar select name="MemberId"

    // Jodi MemberId thake tobe URL er sathe query string pathabe
    var ajaxUrl = 'php_action/fetchLoanScheduleAdmin.php';
    if(memberId) {
        ajaxUrl += '?MemberId=' + memberId;
    }

    $('#navAccgroup').addClass('active');

    manageLoanScheduleInfoTable = $("#manageLoanScheduleInfoTable").DataTable({
        'ajax': ajaxUrl,
        "pageLength": 100, 
        'order': []        
    });
});
