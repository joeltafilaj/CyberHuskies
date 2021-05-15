<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/CyberHuskies/inc/functions.php';
$validToken = false;
$validatedForm = false;
$message = 'Create a password at least 8 characters long.';

if (isset($_GET['token'])) {

    // Verify token on database
    $vkey = test_input($_GET['token']);
    require_once $_SERVER['DOCUMENT_ROOT'] . '/CyberHuskies/inc/db_connection.php';
    $sqlSearchToken = "SELECT vkey FROM User WHERE vkey = '$vkey' LIMIT 1";
    $resultSearchToken = mysqli_query($connection, $sqlSearchToken);
    if (mysqli_num_rows($resultSearchToken) != 0) {
        $validToken = true;
        // Resset Password Form
        if (isset($_POST['newPassword']) && isset($_POST['newPasswordConfirmation'])) {
            // Server Side validation of fields
            if (empty($_POST['newPassword'])) {
                $message = "Enter a password";
            } else {
                $newPassword = test_input($_POST['newPassword']);
                $passwordConfirmation = test_input($_POST['newPasswordConfirmation']);
                if (strlen($newPassword) < 8) {
                    $message = "Create a password at least 8 characters long.";
                    $validatedForm = false;
                } elseif (!empty($newPassword) && $passwordConfirmation != $newPassword) {
                    $message = "Those passwords didn’t match. Try again.";
                } else {
                    $validatedForm = true;
                    $newPassword = hash('sha512', $newPassword);
                }
            }
            if ($validatedForm) {
                $sqlUpdatePassword = "UPDATE User SET password = '$newPassword' WHERE vkey = '$vkey'";
                if (mysqli_query($connection, $sqlUpdatePassword)) {
                    $message = 'Password changed successfully';
                } else {
                    $validatedForm = false;
                    $message = 'Server Error. Try again later.';
                }
            }
        }
    }
    mysqli_close($connection);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <!--Jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
    </script>

    <!--Font Awesome -->
    <link rel="stylesheet" type="text/css" href="/CyberHuskies/fontawesome-5-pro-master/css/all.css">

    <!--Javascript -->
    <script src="/CyberHuskies/inc/js/resset.js"></script>

    <title>Auction</title>
</head>

<body style="background-color: whitesmoke;">
    <br><br><br><br><br><br>
    <?php
    
    // Checking if token is valid then show the resset password form
    if ($validToken) {
    ?>
        <form id="ressetPasswordForm" action="resset.php<?php echo "?token=".$vkey;?>" method="post" class="row justify-content-center"><br>
            <div class="col-sm-3  bg-light" style="border: 2px solid lightgrey;">

                <!-- New Password -->
                <div class="form-group row justify-content-center px-5 mt-5">
                    <div class="col-sm-12 text-center mb-2">
                        <h2>Password Resset</h2>
                    </div>

                    <!-- Response for password -->
                    <span id="ressetPasswordMessage" class="col-sm-10 mt-4 text-center mb-5 alert 
                    <?php if ($validatedForm === true) {
                        echo 'alert-success';
                    } else {
                        echo 'alert-danger';
                    } ?> mt-1"><?php echo $message ?></span>

                    <div class="col-sm-12 form-floating">
                        <input type="password" id="newPassword" name="newPassword" placeholder="New password" class="form-control">
                        <label class="ms-2" for="newPassword">New password</label>
                    </div>
                </div><br>

                <!-- New Password Confirmation -->
                <div class="form-group row justify-content-center px-5">
                    <div class="col-sm-12 form-floating">
                        <input type="password" id="newPasswordConfirmation" name="newPasswordConfirmation" placeholder="New password confirmation" class="form-control" aria-label="Password..." aria-describedby="but">
                        <label class="ms-2" for="newPasswordConfirmation">New password confirmation</label>
                    </div>
                </div><br>

                <!-- Resset Password Button -->
                <div class="form-group row justify-content-center px-5 mb-5">
                    <div class="col-sm-12">
                        <button type="submit" id="submitRessetPasswordForm" name="submitRessetPasswordForm" class="btn btn-primary w-100" form="ressetPasswordForm" style="height: 50px;"> Resset Password
                        </button>
                    </div>

                </div><br>
            </div>
        </form>
    <?php
    } else {
    ?>
        <h2 class="text-center">Something went wrong! :(</h2>
    <?php
    }
    ?>
</body>

</html>