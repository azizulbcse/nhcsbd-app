$(document).ready(function() {
    // Initialize jQuery UI Datepickers
    // Make sure you have included the jQuery UI CSS and JS files in your HTML head
    $("#startDate").datepicker({
        dateFormat: 'mm/dd/yy' // Match the required display format if using jQuery UI
    });
    $("#endDate").datepicker({
        dateFormat: 'mm/dd/yy'
    });

    $("#getDepositReportForm").unbind('submit').bind('submit', function(event) {
        // Prevent the default form submission that causes a page reload
        event.preventDefault(); 

        var startDate = $("#startDate").val();
        var endDate = $("#endDate").val();
        var isValid = true;

        // --- Validation Logic ---

        // Clear previous error states first
        $(".control-group").removeClass('has-error');
        $(".text-danger").remove();

        if (startDate === "") {
            // Updated selector to match the new HTML structure (control-group)
            $("#startDate").closest('.control-group').addClass('has-error');
            // Using .controls to place error message correctly within the new layout
            $("#startDate").closest('.controls').append('<p class="text-danger mt-1">Start Date is required</p>');
            isValid = false;
        }

        if (endDate === "") {
            $("#endDate").closest('.control-group').addClass('has-error');
            $("#endDate").closest('.controls').append('<p class="text-danger mt-1">End Date is required</p>');
            isValid = false;
        }

        // --- AJAX Submission Logic ---

        if (isValid) {
            var form = $(this);
            // Disable button during processing
            $("#generateReportBtn").prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Generating...');

            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: form.serialize(),
                dataType: 'text',
                success: function(response) {
                    // Re-enable button on success
                    $("#generateReportBtn").prop('disabled', false).html('<i class="fa fa-check"></i> Generate');

                    // Open response in a new window for printing
                    var mywindow = window.open('', '_blank', 'height=800,width=800,scrollbars=yes,resizable=yes');
                    mywindow.document.write('<html><head><title>Deposit Details Report</title>');        
                    // Optional: Add basic print styles to the new window
                    mywindow.document.write('<style>table {width: 100%; border-collapse: collapse;} th, td {border: 1px solid #ddd; padding: 8px; text-align: left;} th {background-color: #f2f2f2;}</style>');
                    mywindow.document.write('</head><body>');
                    mywindow.document.write(response);
                    mywindow.document.write('</body></html>');

                    mywindow.document.close(); // necessary for IE >= 10
                    mywindow.focus(); // necessary for IE >= 10

                    // The user usually prefers to manually click print in the new window,
                    // but you can uncomment the next line if automatic print is desired:
                    // mywindow.print(); 
                },
                error: function() {
                    $("#generateReportBtn").prop('disabled', false).html('<i class="fa fa-check"></i> Generate');
                    alert("An error occurred while generating the report. Check server script.");
                }
            });
        }
    });
});
