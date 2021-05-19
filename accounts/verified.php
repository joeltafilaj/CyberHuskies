<?php
$response = $response2 = "";
require_once $_SERVER['DOCUMENT_ROOT'] . '/CyberHuskies/inc/functions.php';
$valid = 'danger';

//Check if email verification key is valid
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  if (isset($_GET['token'])) {
    $vkey = test_input($_GET['token']);

    //DB connection to check if the verification key corresponds to a certain account
    require_once $_SERVER['DOCUMENT_ROOT'] . '/CyberHuskies/inc/db_connection.php';
    $sqlEmailVerification = "SELECT vkey FROM User WHERE vkey = '$vkey' AND verified = 0";
    $resultEmailVerification = mysqli_query($connection, $sqlEmailVerification);
    if (mysqli_num_rows($resultEmailVerification) == 1) {
      $sqlVerified = "UPDATE User SET verified = 1 WHERE vkey = '$vkey'";
      if (mysqli_query($connection, $sqlVerified)) {
        $response = 'Your account has been verified successfully ! <i class="fad fa-smile-beam"></i>';
        $valid = 'success';
      } else {
        $response = 'Email verification failed ! <i class="fad fa-frown"></i>';
        $response2 = 'Either the link had already expired or you did not copy the URL properly.';
      }
    } else {
      $response = 'Email verification failed ! <i class="fad fa-frown"></i>';
      $response2 = 'Either the link had already expired or you did not copy the URL properly.';
    }
    mysqli_close($connection);
  } else {
    $response = 'Email verification failed ! <i class="fad fa-frown"></i>';
    $response2 = 'Either the link had already expired or you did not copy the URL properly.';
  }
} else {
  $response = 'Email verification failed ! <i class="fad fa-frown"></i>';
  $response2 = 'Either the link had already expired or you did not copy the URL properly.';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Auction</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous" />

    <!--Jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
    </script>

    <!--Font Awesome -->
    <link rel="stylesheet" type="text/css" href="../inc/fontawesome-5-pro-master/css/all.css">

</head>

<body style="background-color: lightgrey;"><br><br><br><br><br>
    <div class="container-fluid">
        <div class="row text-center mt-5 text-dark">
            <div class="col-lg-12">
                <h1 style="font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif"> <?php echo $response; ?></h1><br>
            </div>
            <div class="col-lg-12 text-center">
              <span class="h7"><?php echo $response2; ?></span>
            </div>
        </div>
    </div>
</body>

</html>