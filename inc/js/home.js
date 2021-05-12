$(document).ready(function () {
  // Client side validation for log in form
  $("#logInForm").on("submit", function (e) {
    e.preventDefault();
    var validated = true;
    var username = $("#usernameLog").val();
    var password = $("#passwordLog").val();
    var rememberMe = $("#rememberMeCheck").is(":checked");
    var submit = $("#submitLogIn").val();

    // Username validation
    if (username === "") {
      validated = false;
      $("#usernameLog").addClass("is-invalid");
      $("#logInMessageUsername").text("* Enter a username");
    } else {
      $("#usernameLog").removeClass("is-invalid");
      $("#logInMessageUsername").text("");
    }

    // Password validation
    if (password === "") {
      validated = false;
      $("#passwordLog").addClass("is-invalid");
      $("#logInMessagePassword").text("* Enter a password");
    } else if (password.length < 8) {
      validated = false;
      $("#passwordLog").addClass("is-invalid");
      $("#logInMessagePassword").text("* Password is to short.");
    } else {
      $("#passwordLog").removeClass("is-invalid");
      $("#logInMessagePassword").text("");
    }

    // Add Spinner
    $("#submitLogIn").text("");
    $("#submitLogIn").html('<i class="fad fa-circle-notch fa-spin"></i>');

    // Proceding with ajax after validation completed
    if (validated) {
      $.ajax({
        type: "POST",
        url: "/CyberHuskies/auctionWeb/authenticate/logIn.php",
        data: {
          username: username,
          password: password,
          rememberMe: rememberMe,
          submit: submit,
        },
        dataType: "json",
        success: function (data) {
          if (data.success === true) {
            // Add Spinner
            $("#submitLogIn").text("");
            $("#submitLogIn").html(
              '<i class="fad fa-circle-notch fa-spin"></i>'
            );
            location.href = location.href;
          } else {
            // Remove Spinner
            $("#submitLogIn").text("Log In");
          }

          // Server side username validation
          if (data.usernameError === "error1") {
            $("#logInMessageUsername").text("* Enter a username");
          } else if (data.usernameError === "error2") {
            $("#logInMessageUsername").text("* Couldn't find your Account");
            $("#usernameLog").addClass("is-invalid");
          } else {
            $("#logInMessageUsername").text("");
            $("#usernameLog").removeClass("is-invalid");
          }

          // Server side password validation
          if (data.passwordError === "error1") {
            $("#logInMessagePassword").text("* Enter a password");
          } else if (data.passwordError === "error2") {
            $("#logInMessagePassword").text("* Password is to short.");
          } else if (data.passwordError === "error3") {
            $("#logInMessagePassword").text("* Wrong password. Try again.");
            $("#passwordLog").addClass("is-invalid");
          } else {
            $("#logInMessagePassword").text("");
            $("#passwordLog").removeClass("is-invalid");
          }
        },
      });
    } else {
      // Remove Spinner
      $("#submitLogIn").text("Log In");
    }
  });

  // Hide/unhide password for Sign up Form
  $("#showPasswordCheck").click(function (e) {
    if ($("#showPasswordCheck").is(":checked")) {
      $("#passSignUp").attr("type", "text");
      $("#confirmPassSignUp").attr("type", "text");
    } else {
      $("#passSignUp").attr("type", "password");
      $("#confirmPassSignUp").attr("type", "password");
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

    // First name nad Last name validation
    if (first_name === "" && last_name === "") {
      validated = false;
      $("#first_name").addClass("is-invalid");
      $("#last_name").addClass("is-invalid");
      $("#signUpMessageName").text("* Enter first and last names");
    } else if (first_name === "" && last_name != "") {
      validated = false;
      $("#first_name").addClass("is-invalid");
      $("#signUpMessageName").text("* Enter first name");
      $("#last_name").removeClass("is-invalid");
    } else if (first_name != "" && last_name === "") {
      validated = false;
      $("#last_name").addClass("is-invalid");
      $("#signUpMessageName").text("* Enter last name");
      $("#first_name").removeClass("is-invalid");
    } else {
      $("#first_name").removeClass("is-invalid");
      $("#last_name").removeClass("is-invalid");
      $("#signUpMessageName").text("");
    }

    // Username validation
    if (username === "") {
      validated = false;
      $("#usernameSignUp").addClass("is-invalid");
      $("#signUpMessageUsername").text("* Choose a username");
    } else if (!/^[a-z0-9._]+$/i.test(username)) {
      validated = false;
      $("#usernameSignUp").addClass("is-invalid");
      $("#signUpMessageUsername").text(
        "* Sorry, only letters (a-z), numbers (0-9), periods (.), and underscore (_) are allowed."
      );
    } else {
      $("#usernameSignUp").removeClass("is-invalid");
      $("#signUpMessageUsername").text("");
    }

    // Email validation
    if (email === "") {
      validated = false;
      $("#email").addClass("is-invalid");

      $("#signUpMessageEmail").text("* Choose a Email adress");
    } else if (!/^([\w\.]+@([\w-]+\.)+[\w-]{2,6})?$/.test(email)) {
      validated = false;
      $("#email").addClass("is-invalid");
      $("#signUpMessageEmail").text(
        "* Sorry, only letters (a-z), numbers (0-9), periods (.), and underscore (_) are allowed."
      );
    } else {
      $("#email").removeClass("is-invalid");
      $("#signUpMessageEmail").text("");
    }

    // Password nad Confirm password validation
    if (password === "") {
      validated = false;
      $("#passSignUp").addClass("is-invalid");
      $("#confirmPassSignUp").removeClass("is-invalid");
      $("#signUpMessagePassword").text("* Enter a password");
    } else if (password.length < 8) {
      validated = false;
      $("#passSignUp").addClass("is-invalid");
      $("#confirmPassSignUp").removeClass("is-invalid");
      $("#signUpMessagePassword").text(
        "* Use 8 characters or more for your password"
      );
    } else if (password != "" && confirm_password != password) {
      validated = false;
      $("#confirmPassSignUp").addClass("is-invalid");
      $("#passSignUp").removeClass("is-invalid");
      $("#signUpMessagePassword").text(
        "* Those passwords didn’t match. Try again."
      );

      $("#confirmPassSignUp").val("");
    } else {
      $("#passSignUp").removeClass("is-invalid");
      $("#confirmPassSignUp").removeClass("is-invalid");
      $("#signUpMessagePassword").text("");
    }
    // Add Spinner
    $("#submitSignUp").text("");
    $("#submitSignUp").html('<i class="fad fa-circle-notch fa-spin"></i>');

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
          confirm_password: confirm_password,
          phone_number: phone_number,
          user_type: user_type,
          submit: submit,
        },
        dataType: "json",
        success: function (data) {
          if (data.success === true) {
            // Add Spinner
            $("#submitSignUp").text("");
            $("#submitSignUp").html(
              '<i class="fad fa-circle-notch fa-spin"></i>'
            );
            window.location.assign("/CyberHuskies/auctionWeb/authenticate/thankYou.php");
          } else {
            // Remove Spinner
            $("#submitSignUp").text("Register");
          }

          // Server side First name and Last name validation
          if (
            data.firstNameError === "error1" &&
            data.lastNameError === "error1"
          ) {
            $("#first_name").addClass("is-invalid");
            $("#last_name").addClass("is-invalid");
            $("#signUpMessageName").text("* Enter first and last names");
          } else if (
            data.firstNameError === "error1" &&
            data.lastNameError === ""
          ) {
            $("#first_name").addClass("is-invalid");
            $("#signUpMessageName").text("* Enter first name");
            $("#last_name").removeClass("is-invalid");
          } else if (
            data.firstNameError === "" &&
            data.lastNameError === "error1"
          ) {
            $("#last_name").addClass("is-invalid");
            $("#signUpMessageName").text("* Enter last name");
            $("#first_name").removeClass("is-invalid");
          } else {
            $("#first_name").removeClass("is-invalid");
            $("#last_name").removeClass("is-invalid");
            $("#signUpMessageName").text("");
          }

          // Server side username validation
          if (data.usernameError === "error1") {
            $("#usernameSignUp").addClass("is-invalid");
            $("#signUpMessageUsername").text("* Choose a username");
          } else if (data.usernameError === "error2") {
            $("#usernameSignUp").addClass("is-invalid");
            $("#signUpMessageUsername").text(
              "* Sorry, only letters (a-z), numbers (0-9), periods (.), and underscore (_) are allowed."
            );
          } else if (data.usernameError === "error3") {
            $("#usernameSignUp").addClass("is-invalid");
            $("#signUpMessageUsername").text(
              "* That username is taken. Try another."
            );
          } else {
            $("#usernameSignUp").removeClass("is-invalid");
            $("#signUpMessageUsername").text("");
          }

          // Server side email validation
          if (data.emailError === "error1") {
            $("#email").addClass("is-invalid");

            $("#signUp-message-email").text("* Choose a Email adress");
          } else if (data.emailError === "error2") {
            $("#email").addClass("is-invalid");
            $("#signUpMessageEmail").text(
              "* Sorry, only letters (a-z), numbers (0-9), periods (.), and underscore (_) are allowed."
            );
          } else if (data.emailError === "error3") {
            $("#email").addClass("is-invalid");
            $("#signUpMessageEmail").text(
              "* That email is taken. Try another."
            );
          } else {
            $("#email").removeClass("is-invalid");
            $("#signUpMessageEmail").text("");
          }

          // Server side password validation
          if (data.passwordError === "error1") {
            $("#passSignUp").addClass("is-invalid");
            $("#confirmPassSignUp").removeClass("is-invalid");
            $("#signUpMessagePassword").text("* Enter a password");
          } else if (data.passwordError === "error2") {
            $("#passSignUp").addClass("is-invalid");
            $("#confirmPassSignUp").removeClass("is-invalid");
            $("#signUpMessagePassword").text(
              "* Use 8 characters or more for your password"
            );
          } else if (
            data.passwordError === "" &&
            data.confirmPasswordError === "error2"
          ) {
            $("#confirmPassSignUp").addClass("is-invalid");
            $("#passSignUp").removeClass("is-invalid");
            $("#signUpMessagePassword").text(
              "* Those passwords didn’t match. Try again."
            );

            $("#confirmPassSignUp").val("");
          } else {
            $("#password").removeClass("is-invalid");
            $("#signUp-message-password").text("");
          }

          // If some server error ecurs redirect to error page
          if (data.serverError === true) {
            // Add Spinner
            $("#submitSignUp").text("");
            $("#submitSignUp").html(
              '<i class="fad fa-circle-notch fa-spin"></i>'
            );
            window.location = "../inc/error.hmtl";
          }
        },
      });
    } else {
      // Remove Spinner
      $("#submitSignUp").text("Register");
    }
  });
});
