<?php
session_start();
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

    <!--CSS-->
    <link rel="stylesheet" type="text/css" href="/CyberHuskies/inc/css/homeStyle.css">

    <!--Javascript -->
    <script src="/CyberHuskies/inc/js/home.js"></script>

    <title>Auction</title>
    <link rel="shortcut icon" href="/CyberHuskies/inc/pictures/cyberhuskies.ico">
</head>

<body class="bg-dark text-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand">Cyber Huskies <i class="fad fa-gavel"></i></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="home.php">Home</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Categories
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                    <form class="d-lg-flex d-grid gap-2">
                        <input class="form-control me-2" type="search" placeholder="Search products"
                            aria-label="Search">
                        <button class="btn btn-danger d-grid" type="submit">Search</button>
                    </form>
                </ul>
                <ul class="navbar-nav me-right mb-2 mb-lg-0">

                    <!-- Check if any user is logged in -->
                    <?php
                    if (empty($_SESSION['first_name'])) {
                    ?>

                    <!-- Modal Buttons -->
                    <form class="d-lg-flex d-grid gap-2">
                        <button type="button" class="btn btn-success btn-lg me-lg-2 me-0" data-bs-toggle="modal"
                            data-bs-target="#logInModal">Log In</button>
                        <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal"
                            data-bs-target="#signUpModal">Sign Up</button>
                    </form>

                    <!-- Log in Modal -->
                    <div class="modal fade" id="logInModal" tabindex="-1" aria-labelledby="logInModal"
                        aria-hidden="true">
                        <div class="modal-dialog ">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title text-success">Log In</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-dark">

                                    <!-- Log In Form -->
                                    <form id="logInForm" action="authenticate/logIn.php" method="post">

                                        <!-- Username -->
                                        <div class="form-group row justify-content-center">
                                            <label class="col-sm-2 col-form-label" for="usernameLog">Username:</label>
                                            <div class="col-sm-6">
                                                <input type="text" id="usernameLog" placeholder="Username..."
                                                    class="form-control">

                                                <!-- Response for username -->
                                                <span id="logIn-message-username" class="text-danger mt-1"></span>
                                            </div>
                                        </div><br><br>

                                        <!-- Password with 'show password' button-->
                                        <div class="form-group row justify-content-center">
                                            <label class="col-sm-2 col-form-label" for="passwordLog">Password:</label>
                                            <div class="col-sm-6">
                                                <div class="input-group ">
                                                    <input type="password" id="passwordLog" placeholder="Password..."
                                                        class="form-control" aria-label="Password..."
                                                        aria-describedby="but">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-outline-secondary" id="hidePass"
                                                            type="button"><i id="check" class="fad fa-eye"></i></button>
                                                    </div>
                                                </div>

                                                <!-- Response for password -->
                                                <span id="logIn-message-password" class="text-danger mt-1"></span>
                                            </div>

                                        </div><br><br>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" id="submitLogIn" class="btn btn-success" form="logInForm">Log
                                        In</button>
                                    <div class="loader">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Sign up -->
                    <div class="modal fade" id="signUpModal" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content -->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-tittle text-primary text-center">Sign Up
                                    </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-dark">

                                    <!-- Sign Up Form -->
                                    <form id="signUpForm" action="authenticate/signUp.php" method="post">

                                        <!-- First Name -->
                                        <div class="form-grop row justify-content-center">
                                            <label class="col-sm-3 col-form-label" for="first_name">First Name:</label>
                                            <div class="col-sm-7">
                                                <input type="text" id="first_name" placeholder="First Name..."
                                                    class="form-control">

                                                <!-- Response for First Name -->
                                                <span id="signUp-message-firstName" class="text-danger"> </span>
                                            </div>
                                        </div> <br><br>

                                        <!-- Last Name -->
                                        <div class="form-grop row justify-content-center">
                                            <label class="col-sm-3 col-form-label" for="last_name">Last Name:</label>
                                            <div class="col-sm-7">
                                                <input type="text" id="last_name" placeholder="Last Name..."
                                                    class="form-control">

                                                <!-- Response for Last Name -->
                                                <span id="signUp-message-lastName" class="text-danger"> </span>
                                            </div>
                                        </div> <br><br>

                                        <!-- Username -->
                                        <div class="form-grop row justify-content-center">
                                            <label class="col-sm-3 col-form-label"
                                                for="usernameSignUp">Username:</label>
                                            <div class="col-sm-7">
                                                <input type="text" id="usernameSignUp" placeholder="Username..."
                                                    class="form-control">

                                                <!-- Response for username -->
                                                <span id="signUp-message-username" class="text-danger"> </span>
                                            </div>
                                        </div> <br><br>

                                        <!-- Email -->
                                        <div class="form-grop row justify-content-center">
                                            <label class="col-sm-3 col-form-label" for="email">Email:</label>
                                            <div class="col-sm-7">
                                                <input type="text" id="email" placeholder="Email..."
                                                    class="form-control">

                                                <!-- Response for email -->
                                                <span id="signUp-message-email" class="text-danger"> </span>
                                            </div>
                                        </div> <br><br>

                                        <!-- Password -->
                                        <div class="form-grop row justify-content-center">
                                            <label class="col-sm-3 col-form-label" for="passSignUp">Password:</label>
                                            <div class="col-sm-7">
                                                <input type="password" id="passSignUp" placeholder="Password..."
                                                    class="form-control">

                                                <!-- Response for password -->
                                                <span id="signUp-message-password" class="text-danger"></span>
                                            </div>
                                        </div> <br><br>

                                        <!-- Confirm password -->
                                        <div class="form-grop row justify-content-center">
                                            <label class="col-sm-3 col-form-label" for="confirmPassSignUp">Confirm
                                                Pass:</label>
                                            <div class="col-sm-7">
                                                <input type="password" id="confirmPassSignUp"
                                                    placeholder="Confirm password..." class="form-control">

                                                <!-- Response for Confirm password -->
                                                <span id="signUp-message-confirm" class="text-danger"></span>
                                            </div>
                                        </div> <br><br>

                                        <!-- Phone Number -->
                                        <div class="form-grop row justify-content-center">
                                            <label class="col-sm-3 col-form-label" for="phone_number">Tel
                                                number:</label>
                                            <div class="col-sm-7">
                                                <input type="number" id="phone_number" placeholder="(Optional)"
                                                    class="form-control">
                                            </div>
                                        </div> <br>

                                        <!-- Radio button to check if user is costumer or salessman -->
                                        <div class="text-center">
                                            <input class="form-check-input" type="radio" name="user_type" id="customer"
                                                checked value="costumer">
                                            <label class="form-check-label h5" for="customer">
                                                Costumer
                                            </label>
                                            <br>
                                            <input class="form-check-input ms-lg-1 ms-0" type="radio" name="user_type"
                                                id="salessman" value="salessman">
                                            <label class="form-check-label h5" for="salessman">
                                                Salessman
                                            </label>
                                        </div>
                                    </form>
                                </div>

                                <!-- Modal buttons -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" form="signUpForm" id="submitSignUp"
                                        class="btn btn-primary">Complete <i class="fad fa-gavel"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- If an user is logged in -->
                    <?php
                    } else {
                    ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarAccount" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false"><?php echo $_SESSION['username'] ?> <i
                                class="fad fa-user-circle"></i></a>
                        <ul class="dropdown-menu mr-3" aria-labelledby="navbarAccount">
                            <li><a class="dropdown-item" href="#">Profile <i class="fad fa-user-edit"></i></a></li>
                            <li><a class="dropdown-item" href="#">Shoping Cart</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a id="logout" class="nav-link" href="authenticate/logout.php">log out <i
                                class="fad fa-sign-out"></i></a>
                    </li>
                    <?php
                    }
                    ?>

                </ul>

            </div>
        </div>
    </nav> <!-- End Navbar -->


    <!--Home Page -->
    <div class="container">

    </div>
</body>

</html>