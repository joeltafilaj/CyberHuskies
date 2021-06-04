$(document).ready(function () {
  // Add to wishlist
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
          $(".alert-danger").css("display", "none");
          $(".alert-success").css("display", "none");
          $(".alert-success").css("display", "flex-box");
          $('#alert-success').text('Product added successfully to wishlist!');
          $(".alert-success")
            .fadeTo(2000, 50)
            .slideUp(500, function () {
              $(".alert-success").slideUp(800);
            });
        }
        if (data.response === "error1") {
          //printing response
          $(".alert-danger").css("display", "none");
          $(".alert-success").css("display", "none");
          $(".alert-danger").css("display", "flex-box");
          $("#alert-danger").text("You have to log in as costumer!");
          $(".alert-danger")
            .fadeTo(2000, 50)
            .slideUp(500, function () {
              $(".alert-danger").slideUp(800);
            });
        } else if (data.response === "error2") {
          //printing response
          $(".alert-danger").css("display", "none");
          $(".alert-success").css("display", "none");
          $(".alert-danger").css("display", "flex-box");
          $("#alert-danger").text("505! Internal database error!");
          $(".alert-danger")
            .fadeTo(2000, 50)
            .slideUp(500, function () {
              $(".alert-danger").slideUp(800);
            });
        } else if (data.response === "error3") {
          //printing response
          $(".alert-success").css("display", "none");
          $(".alert-danger").css("display", "none");
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

  var interval;
  // Initialize timer function
  var time = parseInt($("#time").text());
  sale_time(time);

  // countDown function
  function sale_time(time) {
    var number = time;

    //Set new timer
    clockUpdate();
    if (number > 0) {
      interval = setInterval(clockUpdate, 1000);
    }
    //Timer function
    function clockUpdate() {
      // After time ended
      if (number === 0) {
        $("#time").text("");
        $(".time").html('Time ended <i class="fad fa-hourglass-half"></i>');
        $(".bid-now").addClass("disabled");
        $(".bid-input").addClass("d-none");
        $("#confirmModal").modal("hide");
        number--;
      } else if (number === -1) {
        // Break from the loop
        clearInterval(interval);
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
        number--;
      }
    }
  }

  //Showing input on first click than submit on the second
  $(".bid-now").click(function (e) {
    e.preventDefault();
    if ($(".bid-input").hasClass("d-none")) {
      $(".bid-input").removeClass("d-none").hide();
      $(".bid-input").slideDown();

      // Validation input
    } else {
      var bid = $("#bidPrice").val();
      var validated = true;

      if (bid < parseInt($("#bidPrice").attr("min"))) {
        $("#bidResponse").text("* Bid value is below minimum.");
        $("#bidPrice").addClass("is-invalid");
        validated = false;
      } else {
        $("#bidResponse").text("");
        $("#bidPrice").removeClass("is-invalid");
      }

      // After input validation show confirmation modal
      if (validated) {
        // Activate modal
        $("#offer").text(bid);
        $("#confirmModal").modal("show");

        // If clicked confirm proceed with ajax to add bid to the database
        $("#confirmBid").click(function (e) {
          e.preventDefault();
          var product_id = $(".bid-now").attr("id").substring(1);
          // Add Spinner
          $("#confirmBid").html('<i class="fad fa-circle-notch fa-spin"></i>');

          $.ajax({
            type: "post",
            url: "inc/php/addBid.php",
            data: {
              bid: bid,
              product_id: product_id,
            },
            dataType: "json",
            success: function (data) {
              if (data.success === true) {
                // Hide modal after success and show success alert
                $("#confirmModal").modal("hide");
                $(".alert-success").css("display", "none");
                $(".alert-danger").css("display", "none");
                $(".alert-success").css("display", "flex-box");
                $("#alert-success").html(
                  'Offer was made successfully!<br>You Will get notified if you won the item!'
                );
                $(".alert-success")
                  .fadeTo(6000, 50)
                  .slideUp(500, function () {
                    $(".alert-success").slideUp(800);
                  });
                // Remove Spinner
                $("#confirmBid").html(
                  "Confirm offer <i class='fad fa-badge-check'></i>"
                );
              } else if (data.response === "error1") {
                // Hide modal after success and show success alert
                $("#confirmModal").modal("hide");
                $(".alert-success").css("display", "none");
                $(".alert-danger").css("display", "none");
                $(".alert-danger").css("display", "flex-box");
                $("#alert-danger").text(
                  "You already made an offer for this item!"
                );
                $(".alert-danger")
                  .fadeTo(2000, 50)
                  .slideUp(500, function () {
                    $(".alert-danger").slideUp(800);
                  });
                // Remove Spinner
                $("#confirmBid").html(
                  "Confirm offer <i class='fad fa-badge-check'></i>"
                );
              } else {
                // Hide modal after success and show success alert
                $("#confirmModal").modal("hide");
                $(".alert-success").css("display", "none");
                $(".alert-danger").css("display", "none");
                $(".alert-danger").css("display", "flex-box");
                $("#alert-danger").text("505! Internal database error!");
                $(".alert-danger")
                  .fadeTo(2000, 50)
                  .slideUp(500, function () {
                    $(".alert-danger").slideUp(800);
                  });
                // Remove Spinner
                $("#confirmBid").html(
                  "Confirm offer <i class='fad fa-badge-check'></i>"
                );
              }
            },
          });
        });
      }
    }
  });
});
