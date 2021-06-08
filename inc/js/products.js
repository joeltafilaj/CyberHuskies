$(document).ready(function () {
  // Add to wishlist
  $("#save button").click(function (e) {
    e.preventDefault();
    var product_id = this.id.substring(1);

    //Making an ajax call to add product to the wishlist
    $.ajax({
      type: "post",
      url: "inc/php/addToWishlist",
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
          $("#alert-success").text("Product added successfully to wishlist!");
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

  // Adding bid 
  $("#confirmBid").click(function (e) {
    e.preventDefault();

    var bid = $("#bidPrice").val();
    var validated = true;

    if (bid < parseInt($("#bidPrice").attr("min"))) {
      $("#bidResponse").removeClass("d-none");
      $("#bidResponse").html(
        '<i class="fad fa-exclamation-circle"></i> You have to bid at least EU ' +
          $("#bidPrice").attr("min") +
          "&euro;."
      );
      validated = false;
    } else {
      $("#bidResponse").addClass("d-none");
    }
    // Add Spinner
    $("#confirmBid").html('<i class="fad fa-circle-notch fa-spin"></i>');

    // After input validation show confirmation modal
    if (validated) {
      var product_id = $(".bid-now").attr("id").substring(1);
      $.ajax({
        type: "post",
        url: "inc/php/addBid",
        data: {
          bid: bid,
          product_id: product_id,
        },
        dataType: "json",
        success: function (data) {
          if (data.success === true) {
            
            // Hide modal after success and show success alert
            $("#confirmModal").modal("hide");
            $("#bidResponse").addClass("d-none");
            $(".alert-success").css("display", "none");
            $(".alert-danger").css("display", "none");
            $(".alert-success").css("display", "flex-box");
            $("#alert-success").html(
              "Offer was made successfully!<br>You Will get notified if you won the item!"
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
            $("#bidResponse").addClass("d-none");
            $(".alert-success").css("display", "none");
            $(".alert-danger").css("display", "none");
            $(".alert-danger").css("display", "flex-box");
            $("#alert-danger").text("You already made an offer for this item!");
            $(".alert-danger")
              .fadeTo(2000, 50)
              .slideUp(500, function () {
                $(".alert-danger").slideUp(800);
              });
            // Remove Spinner
            $("#confirmBid").html(
              "Confirm offer <i class='fad fa-badge-check'></i>"
            );
          } else if (data.response === "error2") {
            // Hide modal after success and show success alert
            $("#confirmModal").modal("hide");
            $("#bidResponse").addClass("d-none");
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
          } else if (data.response === "error3") {
            // Message for email not verified
            $("#alert-danger").text("505! Internal database error!");
            $("#bidResponse").removeClass("d-none");
            $("#bidResponse").html(
              '<i class="fad fa-exclamation-circle"></i> You need to verify your email in order to make a bid.<br> A confirmation email was sent to your mailbox.'
            );
            // Remove Spinner
            $("#confirmBid").html(
              "Confirm offer <i class='fad fa-badge-check'></i>"
            );
          } else if (data.response === 'error4') {
            //  Bid lower than previous one
            $("#confirmModal").modal("hide");
            $("#bidResponse").addClass("d-none");
            $(".alert-success").css("display", "none");
            $(".alert-danger").css("display", "none");
            $(".alert-danger").css("display", "flex-box");
            $("#alert-danger").text("Your bid is lower than the previous one!");
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
    } else {
      // Remove Spinner
      $("#confirmBid").html("Confirm offer <i class='fad fa-badge-check'></i>");
    }
  });
});
