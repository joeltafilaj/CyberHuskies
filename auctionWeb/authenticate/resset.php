<?php 
//----------------------------------Continue here--------------------------------------------------------------------------------------
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <!--Jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
    </script>

    <!--Font Awesome -->
    <link rel="stylesheet" type="text/css" href="/CyberHuskies/fontawesome-5-pro-master/css/all.css">

    <title>Auction</title>
</head>

<body style="background-color: whitesmoke;">
    <br><br><br><br><br><br>
    <form id="ressetPasswordForm" action="resset.php" method="post" class="row justify-content-center"><br>
        <div class="col-sm-3  bg-light" style="border: 2px solid lightgrey;">

            <!-- New Password -->
            <div class="form-group row justify-content-center px-5 mt-5">
                <div class="col-sm-12 text-center">
                    <h3>Password Resset</h3>
                </div>

                <!-- Response for password -->
                <div class="col-sm-12 mt-4 text-center mb-5">
                    <span id="logInMessagePassword" class="alert alert-danger mt-1 w-100">Create a password at least 8
                        characters long.</span>
                </div>

                <div class="col-sm-12 form-floating">
                    <input type="password" id="newPassword" placeholder="New password" class="form-control">
                    <label class="ms-2" for="newPassword">New password</label>
                </div>
            </div><br>

            <!-- New Password Confirmation -->
            <div class="form-group row justify-content-center px-5">
                <div class="col-sm-12 form-floating">
                    <input type="password" id="newPasswordConfirmation" placeholder="New password confirmation"
                        class="form-control" aria-label="Password..." aria-describedby="but">
                    <label class="ms-2" for="newPasswordConfirmation">New password confirmation</label>
                </div>
            </div><br>

            <!-- Resset Password Button -->
            <div class="form-group row justify-content-center px-5">
                <div class="col-sm-12">
                    <button type="submit" id="submitRessetPasswordForm" class="btn btn-primary w-100 "
                        form="ressetPasswordForm" style="height: 50px;"> Resset Password
                    </button>
                </div>

            </div><br>
        </div>
    </form>

</body>

</html>