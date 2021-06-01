$(document).ready(function () {
    $('#save button').click(function (e) { 
        e.preventDefault();
        var product_id = this.id.substring(1);

        //Making an ajax call to add product to the wishlist
        $.ajax({
            type: "post",
            url: "inc/php/addToWishlist.php",
            data: {
                product_id: product_id
            },
            dataType: "json",
            success: function (data) {
                if (data.success === true) {
                    //showing alert
                    $('.alert-success').css('display', 'flex-box');
                    $(".alert-success").fadeTo(2000, 50).slideUp(500, function() {
                        $(".alert-success").slideUp(800);
                    });
                }
                if (data.response === 'error1') {
                    //printing response
                    $('.alert-danger').css('display', 'flex-box');
                    $('#alert-danger').text('You have to log in as costumer!');
                    $(".alert-danger").fadeTo(2000, 50).slideUp(500, function() {
                        $(".alert-danger").slideUp(800);
                    });
                } else if (data.response === 'error2') {
                    //printing response
                    $('.alert-danger').css('display', 'flex-box');
                    $('#alert-danger').text('505! Internal database error!');
                    $(".alert-danger").fadeTo(2000, 50).slideUp(500, function() {
                        $(".alert-danger").slideUp(800);
                    });
                } else if (data.response === 'error3') {
                    //printing response
                    $('.alert-danger').css('display', 'flex-box');
                    $('#alert-danger').text('This product is already in the wishlist!');
                    $(".alert-danger").fadeTo(2000, 50).slideUp(500, function() {
                        $(".alert-danger").slideUp(800);
                    });
                }
            }
        });
    });

});