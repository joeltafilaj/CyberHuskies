$(document).ready(function () {
  $("#save button").click(function (e) {
    e.preventDefault();
    var product_id = this.id.substring(1);

    //Making an ajax call to add product to the wishlist
    $.ajax({
      type: "post",
      url: "inc/php/addToWishlist.php",
      data: {
        product_id: product_id,
      },
      dataType: "json",
      success: function (data) {
        if (data.success === true) {
          //showing alert
          $(".alert-success").css("display", "flex-box");
          $(".alert-success")
            .fadeTo(2000, 50)
            .slideUp(500, function () {
              $(".alert-success").slideUp(800);
            });
        }
        if (data.response === "error1") {
          //printing response
          $(".alert-danger").css("display", "flex-box");
          $("#alert-danger").text("You have to log in as costumer!");
          $(".alert-danger")
            .fadeTo(2000, 50)
            .slideUp(500, function () {
              $(".alert-danger").slideUp(800);
            });
        } else if (data.response === "error2") {
          //printing response
          $(".alert-danger").css("display", "flex-box");
          $("#alert-danger").text("505! Internal database error!");
          $(".alert-danger")
            .fadeTo(2000, 50)
            .slideUp(500, function () {
              $(".alert-danger").slideUp(800);
            });
        } else if (data.response === "error3") {
          //printing response
          $(".alert-danger").css("display", "flex-box");
          $("#alert-danger").text("This product is already in the wishlist!");
          $(".alert-danger")
            .fadeTo(2000, 50)
            .slideUp(500, function () {
              $(".alert-danger").slideUp(800);
            });
        }
      },
    });
  });
  //Variable used for interval clear
  var interval;
  // Initialize timer function
  var time = parseInt($("#time").text());
  sale_time(time);

  // countDown function
  function sale_time(time) {
    //Clear previus timer set
    clearInterval(interval);
    var number = time;

    //Set new timer
    clockUpdate();
    if (number > 0) {
      interval = setInterval(clockUpdate, 1000);
    }

    //Timer function
    function clockUpdate() {
      if (number === 0) {
        $("#time").text("");
        $('.time').html('Item Sold <i class="fad fa-check-circle"></i>');
        // var product_id = $('.save-product').attr('id').substring(1);
        // $.ajax({
        //     type: "post",
        //     url: "inc/php/statusChange.php",
        //     data: {
        //         product_id: product_id
        //     },
        //     dataType: "json",
        //     success: function (data) {
        //     }
        // });
      } else {
        var day = parseInt(number / 86400);
        var hours = parseInt((number - day * 86400) / 3600);
        var minutes = parseInt((number - (day * 24 + hours) * 3600) / 60);
        var seconds = number % 60;

        if (day === 0 && hours != 0) {
          $("#time").text(hours + "h : " + minutes + "m : " + seconds + "s");
        } else if (day === 0 && hours === 0 && minutes != 0) {
          $("#time").text(minutes + "m : " + seconds + "s");
        } else if (day === 0 && hours === 0 && minutes === 0) {
          $("#time").text(seconds + "s");
        } else {
          $("#time").text(
            day + "d : " + hours + "h : " + minutes + "m : " + seconds + "s"
          );
        }
        number -= 1;
      }
    }
  }
});
