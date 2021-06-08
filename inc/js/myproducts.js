$('.send-form').click(function (e) { 
    e.preventDefault();
    var product_id = this.id.substring(1);
    
    // Add Spinner
    $("#p"+product_id).html('<i class="fad fa-circle-notch fa-spin"></i>');
    
    // Send email form through ajax
    $.ajax({
        type: "post",
        url: "../inc/php/sendCheckout",
        data: {
            product_id: product_id
        },
        dataType: "json",
        success: function (data) {
            if (data.success === true) {
               // remove spinner
               $("#p"+product_id).html('Resend Payment Form to the Bidder'); 
               $('.alert-success').removeClass('d-none');
               $('.alert-danger').addClass('d-none');
               $(".alert-success")
              .fadeTo(6000, 50)
              .slideUp(500, function () {
                $(".alert-danger").slideUp(800);
              });
            } else {
               // remove spinner
               $("#p"+product_id).html('Send Payment Form to the Bidder'); 
               $('.alert-success').addClass('d-none');
               $('.alert-danger').removeClass('d-none');
               $(".alert-danger")
              .fadeTo(6000, 50)
              .slideUp(500, function () {
                $(".alert-danger").slideUp(800);
              });
            }
        }
    });

});