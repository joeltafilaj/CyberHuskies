$(document).ready(function () {
    $('.remove button').click(function (e) { 
        e.preventDefault();
        var product_id = this.id;

        //Making an ajax call to add product to the wishlist
        $.ajax({
            type: "post",
            url: "inc/php/removeFromWishlist",
            data: {
                product_id: product_id
            },
            dataType: "json",
            success: function (data) {
                if (data.success === true) {
                    //printing response
                    $(".alert-success").css("display", "none");
                    $(".alert-danger").css("display", "none");
                    $('.alert-success').css('display', 'flex-box');
                    $(".alert-success").fadeTo(2000, 50).slideUp(500, function() {
                        $(".alert-success").slideUp(800);
                    });
                    //Removing div containing that product
                    $('#row'+product_id).css('display', 'none');
                    if (data.count === 0) {
                        $('.cart-products').css('display', 'none');
                        $('#empty').css('display', 'inline');
                    }
                }
                if (data.response === 'error1') {
                    //printing response
                    $(".alert-success").css("display", "none");
                    $(".alert-danger").css("display", "none");
                    $('.alert-danger').css('display', 'flex-box');
                    $(".alert-danger").fadeTo(2000, 50).slideUp(500, function() {
                        $(".alert-danger").slideUp(800);
                    });
                }
            }
        });
    });
});