<?php
session_start();
if (isset($_COOKIE['username']) && !empty($_COOKIE['username'])) {
    $_SESSION['username'] = $_COOKIE['username'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Mulish' rel='stylesheet'>

    <!--Font Awesome -->
    <link rel="stylesheet" type="text/css" href="inc/fontawesome-5-pro-master/css/all.css">

    <!--CSS-->
    <link rel="stylesheet" type="text/css" href="inc/css/checkout.css";

    <title>Auction</title>
    <link rel="shortcut icon" href="inc/pictures/cyberhuskies.ico">
</head>

<body class="text-dark">
    <br><br><br>

    
    

    <!-- Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- JS link -->

</body>

</html>