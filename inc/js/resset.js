$(document).ready(function () {
    
  // Client Side validation for Password Resset
  $("#ressetPasswordForm").submit(function (e) {
    e.preventDefault();
    var validated = true;
    var newPassword = $("#newPassword").val();
    var newPasswordConfirm = $("#newPasswordConfirmation").val();

    // New Password and Confirm New Password validation
    if (newPassword === "") {
      validated = false;
      $("#newPassword").addClass("is-invalid");
      $("#newPasswordConfirmation").removeClass("is-invalid");
      $("#ressetPasswordMessage").text("Enter a password.");
    } else if (newPassword.length < 8) {
      validated = false;
      $("#newPassword").addClass("is-invalid");
      $("#newPasswordConfirmation").removeClass("is-invalid");
      $("#ressetPasswordMessage").text("Create a password at least 8 characters long.");
    } else if (newPassword != "" && newPasswordConfirm != newPassword) {
      validated = false;
      $("#newPasswordConfirmation").addClass("is-invalid");
      $("#newPassword").removeClass("is-invalid");
      $("#ressetPasswordMessage").text(
        "Those passwords didn’t match. Try again."
      );
      $("#newPasswordConfirmation").val("");
    }

    // After validation completed proceed with resset password submition
    if (validated) {
        this.submit();
    }
  });
});
