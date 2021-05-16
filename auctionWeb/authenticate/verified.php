<?php
$response = "";
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
        $response = 'Your account has been verified successfully !';
        $valid = 'success';
      } else {
        $response = 'Something went wrong ! :(';
      }
    } else {
      $response = 'Something went wrong ! :(';
    }
    mysqli_close($connection);
  } else {
    $response = 'Something went wrong ! :(';
  }
} else {
  $response = 'Something went wrong ! :(';
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Auction</title>

    <!-- Bootstrap CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6"
      crossorigin="anonymous"
    />

    <!--Jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Bootstrap JavaScript -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf"
      crossorigin="anonymous"
    ></script>

     <!--Font Awesome -->
     <link rel="stylesheet" type="text/css" href="/CyberHuskies/fontawesome-5-pro-master/css/all.css">
    
  </head>
  <body class="bg-<?php echo $valid;?>">
    <div class="container-fluid">
      <div class="row text-center mt-5 text-dark">
        <div class="col-lg-12">
          <h1> <?php echo $response; ?></h1><br><br>
          <a href="../home.php" class="btn btn-dark btn-lg"><i class="fad fa-undo-alt"></i> Return Home</a>
        </div>
      </div>
    </div>
  </body>
</html>
