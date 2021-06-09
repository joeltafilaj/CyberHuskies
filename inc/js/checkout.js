$("#checkoutForm").submit(function (e) {
  e.preventDefault();
  var validated = true;
  var country = $("#country").val();
  var city = $("#city").val();
  var address = $("#address").val();
  var building = $("#building").val();
  var postal = $("#postal").val();

  var name_on_card = $("#nameCard").val();
  var card_number = $("#cardNumber").val();
  var valid_through = $("#validThrough").val();
  var cvc_code = $("#cvcCode").val();
  var product_id = $('.pay').attr('id').substring(3);
  // Add Spinner
  $("#pay"+product_id).html('<i class="fad fa-circle-notch fa-spin"></i>');

  //Shipment section validation
  if (
    city === "" ||
    building === "" ||
    country === "" ||
    address === "" ||
    postal === "" ||
    name_on_card === "" ||
    card_number === "" ||
    valid_through === "" ||
    cvc_code === ""
  ) {
    validated = false;
    $(".alert-error").removeClass("d-none");
    $(".alert-done").addClass("d-none");
    $(".alert-danger").html(
      '<i class="fad fa-exclamation-circle"></i> Some fields are not completed'
    );
  } else {
    $(".alert-error").addClass("d-none");
  }
  if (country === "") {
    $("#country").addClass("is-invalid");
  } else {
    $("#country").removeClass("is-invalid");
  }
  if (city === "") {
    $("#city").addClass("is-invalid");
  } else {
    $("#city").removeClass("is-invalid");
  }
  if (postal === "") {
    $("#postal").addClass("is-invalid");
  } else {
    $("#postal").removeClass("is-invalid");
  }
  if (address === "") {
    $("#address").addClass("is-invalid");
  } else {
    $("#address").removeClass("is-invalid");
  }
  if (building === "") {
    $("#building").addClass("is-invalid");
  } else {
    $("#building").removeClass("is-invalid");
  }
  // Payment section validation

  if (name_on_card === "") {
    $("#nameCard").addClass("is-invalid");
  } else {
    $("#nameCard").removeClass("is-invalid");
  }
  if (card_number === "") {
    $("#cardNumber").addClass("is-invalid");
  } else if (card_number.length < 13 || card_number.length > 16) {
    validated = false;
    $("#cardNumber").addClass("is-invalid");
    $(".alert-error").removeClass("d-none");
    $(".alert-danger").html(
      '<i class="fad fa-exclamation-circle"></i> Credit Card number is not valid. Try again.'
    );
  } else {
    $("#cardNumber").removeClass("is-invalid");
  }
  if (valid_through === "") {
    $("#validThrough").addClass("is-invalid");
  } else {
    $("#validThrough").removeClass("is-invalid");
  }
  if (cvc_code === "") {
    $("#cvcCode").addClass("is-invalid");
  } else if (cvc_code.length != 3) {
    validated = false;
    $("#cvcCode").addClass("is-invalid");
    $(".alert-error").removeClass("d-none");
    $(".alert-danger").html(
      '<i class="fad fa-exclamation-circle"></i> CVC Code is not valid. Try again.'
    );
  } else {
    $("#cvcCode").removeClass("is-invalid");
  }

  if (validated) {
    $.ajax({
      type: "post",
      url: "inc/php/checkoutDB",
      data: {
        country: country,
        city: city,
        address: address,
        building: building,
        postal: postal,
        product_id: product_id
      },
      dataType: "json",
      success: function (data) {
        console.log(data.response);
        if (data.success === true) {
          // Remove spinner
          $("#pay"+product_id).html("Pay now");
          $(".alert-error").addClass("d-none");
          $(".alert-done").removeClass("d-none");
        } else if (data.response === 'error4') {
           // Remove spinner
           $("#pay"+product_id).html("Pay now");
           $(".alert-done").addClass("d-none");
           $(".alert-error").removeClass("d-none");
           $(".alert-danger").html(
             '<i class="fad fa-exclamation-circle"></i> Payment has already been completed for this product!'
           );
        } else {
          // Remove spinner
          $("#pay"+product_id).html("Pay now");
          $(".alert-done").addClass("d-none");
          $(".alert-error").removeClass("d-none");
          $(".alert-danger").html(
            '<i class="fad fa-exclamation-circle"></i> Some fields are not completed'
          );
        }
      },
    });
  } else {
    // Remove spinner
    $("#pay"+product_id).html("Pay now");
  }
});
