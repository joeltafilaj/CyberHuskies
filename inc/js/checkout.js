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

  //Shipment section validation
  if (
    city === "" ||
    building === "" ||
    country === "" ||
    address === "" ||
    postal === ""
  ) {
    validated = false;
    $("#shippmentResponse").text("* Please complete all fields");
  } else {
    $("#shippmentResponse").text("");
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
  if (
    name_on_card === "" ||
    card_number === "" ||
    valid_through === "" ||
    cvc_code === ""
  ) {
    validated = false;
    $("#paymentResponse").text("* Please complete all fields");
  } else {
    $("#paymentResponse").text("");
  }
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
    $("#paymentResponse").text("Credit Card number is not valid. Try again.");
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
    $("#paymentResponse").text("CVC Code is not valid. Try again.");
  } else {
    $("#cvcCode").removeClass("is-invalid");
  }

  if (validated) {
    this.submit();
    /////////////////////////////////////////////////////////////////////////////////////// Prooceeding with ajax later on///////////////////////////////////////////////////
  }
});
