$(document).ready(function () {
  // Client side validation for log in form
  $("#logInForm").on("submit", function (e) {
    e.preventDefault();
    var validated = true;
    var username = $("#usernameLog").val();
    var password = $("#passwordLog").val();
    var submit = $("#submitLogIn").val();

    // Username validation
    if (username === "") {
      validated = false;
      $("#usernameLog").addClass("is-invalid");
      $("#logIn-message-username").text("* Please complete this field!");
    } else {
      $("#usernameLog").removeClass("is-invalid");
      $("#logIn-message-username").text("");
    }
    // Password validation
    if (password === "") {
      validated = false;
      $("#passwordLog").addClass("is-invalid");
      $("#logIn-message-password").text("* Please complete this field!");
    } else if (password.length < 8) {
      validated = false;
      $("#passwordLog").addClass("is-invalid");
      $("#logIn-message-password").text("* Password is to short!");
    } else {
      $("#passwordLog").removeClass("is-invalid");
      $("#logIn-message-password").text("");
    }

    // Add loader
    $(".loader").css("display", "inline-flex");
    $("#submitLogIn").css("display", "none");

    // Proceding with ajax after validation completed
    if (validated) {
      $.ajax({
        type: "POST",
        url: "/CyberHuskies/auctionWeb/authenticate/logIn.php",
        data: {
          username: username,
          password: password,
          submit: submit,
        },
        dataType: "json",
        success: function (data) {
          if (data.success === true) {
            // Add loader
            $(".loader").css("display", "inline-flex");
            $("#submitLogIn").css("display", "none");
            location.href = location.href;
          } else {
            // Remove loader
            $(".loader").css("display", "none");
            $("#submitLogIn").css("display", "inline");
          }
          if (data.usernameError === "error1") {
            $("#logIn-message-username").text("* Please complete this field!");
          } else if (data.usernameError === "error2") {
            $("#logIn-message-username").text("* No username was found!");
            $("#usernameLog").addClass("is-invalid");
          } else {
            $("#logIn-message-username").text("");
            $("#usernameLog").removeClass("is-invalid");
          }
          if (data.passwordError === "error1") {
            $("#logIn-message-password").text("* Please complete this field!");
          } else if (data.passwordError === "error2") {
            $("#logIn-message-password").text("* Password is to short!");
          } else if (data.passwordError === "error3") {
            $("#logIn-message-password").text("* Password is not correct!");
            $("#passwordLog").addClass("is-invalid");
          } else {
            $("#logIn-message-password").text("");
            $("#passwordLog").removeClass("is-invalid");
          }
        },
      });
    } else {
      // Remove loader
      $(".loader").css("display", "none");
      $("#submitLogIn").css("display", "inline");
    }
  });

  // Hide/unhide password
  $("#hidePass").click(function (e) {
    if ($("#passwordLog").attr("type") === "password") {
      $("#check").removeClass("fa-eye");
      $("#check").addClass("fa-eye-slash");
      $("#passwordLog").attr("type", "text");
    } else if ($("#passwordLog").attr("type") === "text") {
      $("#check").addClass("fa-eye");
      $("#check").removeClass("fa-eye-slash");
      $("#passwordLog").attr("type", "password");
    }
  });

  // Client side validation of sign up form
  $("#signUpForm").submit(function (e) {
    e.preventDefault();
    var first_name = $("#first_name").val();
    var last_name = $("#last_name").val();
    var username = $("#usernameSignUp").val();
    var email = $("#email").val();
    var password = $("#passSignUp").val();
    var confirm_password = $("#confirmPassSignUp").val();
    var phone_number = $("#phone_number").val();
    var user_type = $("input[name=user_type]:checked", "#signUpForm").val();
    var submit = $("#submitSignUp").val();
    var validated = true;

    // First name validation
    if (first_name === "") {
      validated = false;
      $("#first_name").addClass("is-invalid");
      $("#signUp-message-firstName").text("* Please complete this field!");
    } else {
      $("#first_name").removeClass("is-invalid");
      $("#signUp-message-firstName").text("");
    }
    // last name validation
    if (last_name === "") {
      validated = false;
      $("#last_name").addClass("is-invalid");
      $("#signUp-message-lastName").text("* Please complete this field!");
    } else {
      $("#last_name").removeClass("is-invalid");
      $("#signUp-message-lastName").text("");
    }
    // Username validation
    if (username === "") {
      validated = false;
      $("#usernameSignUp").addClass("is-invalid");
      $("#signUp-message-username").text("* Please complete this field!");
    } else if (!/^[a-z0-9._]+$/i.test(username)) {
      validated = false;
      $("#usernameSignUp").addClass("is-invalid");
      $("#signUp-message-username").text(
        '* Invalid username ("." , "_" , 0-9)'
      );
    } else {
      $("#usernameSignUp").removeClass("is-invalid");
      $("#signUp-message-username").text("");
    }
    // Email validation
    if (email === "") {
      validated = false;
      $("#email").addClass("is-invalid");
      $("#signUp-message-email").text("* Please complete this field!");
    } else if (!/^([\w-\.]+@([\w-]+\.)+[\w-]{2,6})?$/.test(email)) {
      validated = false;
      $("#email").addClass("is-invalid");
      $("#signUp-message-email").text("* Please enter an valid email!");
    } else {
      $("#email").removeClass("is-invalid");
      $("#signUp-message-email").text("");
    }
    // Password validation
    if (password === "") {
      validated = false;
      $("#passSignUp").addClass("is-invalid");
      $("#signUp-message-password").text("* Please complete this field!");
    } else if (password.length < 8) {
      validated = false;
      $("#passSignUp").addClass("is-invalid");
      $("#signUp-message-password").text("* Password is to short!");
    } else {
      $("#passSignUp").removeClass("is-invalid");
      $("#signUp-message-password").text("");
    }
    // Confirm password validation
    if (confirm_password === "") {
      validated = false;
      $("#confirmPassSignUp").addClass("is-invalid");
      $("#signUp-message-confirm").text("* Please complete this field!");
    } else if (confirm_password != password) {
      validated = false;
      $("#confirmPassSignUp").addClass("is-invalid");
      $("#signUp-message-confirm").text("* Passwords must be the same!");
    } else {
      $("#confirmPassSignUp").removeClass("is-invalid");
      $("#signUp-message-confirm").text("");
    }

    // Proceding with ajax after validation completed
    if (validated) {
      $.ajax({
        type: "post",
        url: "/CyberHuskies/auctionWeb/authenticate/signUp.php",
        data: {
          first_name: first_name,
          last_name: last_name,
          username: username,
          email: email,
          password: password,
          phone_number: phone_number,
          user_type: user_type,
          submit: submit,
        },
        dataType: "json",
        success: function (data) {
          if (data.success === true) {
            window.location.assign("../inc/completed.html");
          }
          if (data.usernameError === "error3") {
            $("#usernameSignUp").addClass("is-invalid");
            $("#signUp-message-username").text("* Username already exist!");
          } else {
            $("#usernameSignUp").removeClass("is-invalid");
            $("#signUp-message-username").text("");
          }
          if (data.emailError === "error3") {
            $("#email").addClass("is-invalid");
            $("#signUp-message-email").text("* Email already exist!");
          } else {
            $("#email").removeClass("is-invalid");
            $("#signUp-message-email").text("");
          }
          if (data.serverError === true) {
            window.location = "../inc/error.hmtl";
          }
        },
      });
    }
  });
});
