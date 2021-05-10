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
                                        <br>
                                        <!-- Username -->
                                        <div class="form-group row justify-content-center">
                                            <label class="col-sm-2 col-form-label" for="usernameLog">Username:</label>
                                            <div class="col-sm-6">
                                                <input type="text" id="usernameLog" placeholder="Username..."
                                                    class="form-control">

                                                <!-- Response for username -->
                                                <span id="logInMessageUsername" class="text-danger mt-1"></span>
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
                                                <span id="logInMessagePassword" class="text-danger mt-1"></span>
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

                                        <!-- First Name Last Name-->
                                        <br>
                                        <div class="form-grop row justify-content-center px-5">

                                            <!-- First name -->
                                            <div class="col-sm-6 form-floating">
                                                <input type="text" id="first_name" placeholder="First name"
                                                    class="form-control" />
                                                <label for="first_name" class="ms-2">First name</label>

                                                <!-- Response for First Name and Last Name -->
                                                <span id="signUpMessageName" class="text-danger mt-1"></span>
                                            </div>

                                            <!-- Last name -->
                                            <div class="col-sm-6 form-floating">
                                                <input type="text" id="last_name" placeholder="Last name"
                                                    class="form-control" />
                                                <label for="last_name" class="ms-2">Last name</label>
                                            </div>
                                        </div>
                                        <br /><br />

                                        <!-- Username -->
                                        <div class="form-grop row justify-content-center px-5">
                                            <div class="col-sm-12 form-floating">
                                                <input type="text" id="usernameSignUp" placeholder="Username"
                                                    class="form-control" />
                                                <label for="usernameSignUp" class="ms-2">Username</label>

                                                <!-- Response for username -->
                                                <span id="signUpMessageUsername" class="text-danger mt-1"> <span
                                                        class="text-secondary">You can use letters, numbers, periods &
                                                        dash </span> </span>
                                            </div>
                                        </div>
                                        <br /><br />

                                        <!-- Email -->
                                        <div class="form-grop row justify-content-center px-5">
                                            <div class="col-sm-12 form-floating">
                                                <input type="text" id="email" placeholder="Email"
                                                    class="form-control" />
                                                <label for="email" class="ms-2">Email</label>

                                                <!-- Response for email -->
                                                <span id="signUpMessageEmail" class="text-danger mt-1"></span>
                                            </div>
                                        </div>
                                        <br /><br />

                                        <!-- Password and Confirm password  -->
                                        <div class="form-grop row justify-content-center px-5">

                                            <!-- Password -->
                                            <div class="col-sm-6 form-floating">
                                                <input type="password" id="passSignUp" placeholder="Password"
                                                    class="form-control" />
                                                <label for="passSignUp" class="ms-2">Password</label>
                                            </div>

                                            <!-- Confirm password -->
                                            <div class="col-sm-6 form-floating">
                                                <input type="password" id="confirmPassSignUp" placeholder="Confirm"
                                                    class="form-control" />
                                                <label for="confirmPassSignUp" class="ms-2">Confirm</label>
                                            </div>

                                            <!-- Response for password -->
                                            <div class="col-sm-12">
                                                <span id="signUpMessagePassword" class="text-danger mt-1"></span>
                                            </div>
                                            <br>

                                            <!-- Checkbox for show password -->
                                            <div class="form-check col-sm-11 ms-1">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="showPasswordCheck" style="font-size: 22px;">
                                                <label class="form-check-label ms-2 mt-1" for="showPasswordCheck" style="font-size: 18px;">
                                                    Show password
                                                </label>
                                            </div>
                                        </div>
                                        <br /><br />

                                        <!-- Phone Number and Radio buttons for user Type -->
                                        <div class="form-grop row justify-content-center px-5">

                                            <!-- Phone Number -->
                                            <div class="col-sm-7 form-floating">
                                                <input type="number" id="phone_number"
                                                    placeholder="Phone number (Optional)" class="form-control" />
                                                <label for="phone_number" class="ms-2">Phone number (Optional)</label>
                                            </div>

                                            <!-- Radio buttons for user Type -->
                                            <div class="col-sm-5 text-center">
                                                <input class="form-check-input" type="radio" name="user_type"
                                                    id="customer" checked value="costumer" />
                                                <label class="form-check-label h5" for="customer">
                                                    Costumer
                                                </label>
                                                <br />
                                                <input class="form-check-input ms-lg-1 ms-0" type="radio"
                                                    name="user_type" id="salessman" value="salessman" />
                                                <label class="form-check-label h5" for="salessman">
                                                    Salessman
                                                </label>
                                            </div>
                                        </div>
                                        <br />
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


    <!--Home Page That will be updated later this week -->
    <div class="container">

    </div>
</body>

</html>