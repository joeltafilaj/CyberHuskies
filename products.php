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
    <link rel="stylesheet" type="text/css" href="inc/css/products.css">
    <link rel="stylesheet" type="text/css" href="inc/css/navbar.css">
    <link rel="stylesheet" type="text/css" href="inc/css/footer.css">

    <title>Auction</title>
    <link rel="shortcut icon" href="inc/pictures/cyberhuskies.ico">
</head>

<body class="text-dark" style="padding-top: 78px;">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top navb" style="transition: 0.3s">
        <div class="container-fluid">
            <a class="navbar-brand">CYBER HUSKIES</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link border-top border-light border-2 me-2" aria-current="page"
                            href="home.php">Home</a>
                    </li>
                    <li class="nav-item add-border">
                        <a class="nav-link border-top border-light border-2 me-2" href="home.php">Buy</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link border-top border-light border-2 me-2" href="home.php">Sell</a>
                    </li>
                    <li class="nav-item dropdown border-top border-light border-2 me-2">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Categories
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <!-- DB Connection to get categories-->
                            <?php 
                            require $_SERVER['DOCUMENT_ROOT'] . '/CyberHuskies/inc/db_connection.php';
                            $sqlGetCategories = "SELECT * FROM category";
                            $resultGetCategories = mysqli_query($connection, $sqlGetCategories);
                            if (mysqli_num_rows($resultGetCategories) > 0) {
                                while ($rowGetCategories = mysqli_fetch_assoc($resultGetCategories)) {
                                    echo '<li><a class="dropdown-item text-center" href="list.php?category='.$rowGetCategories['category_name'].'">'.$rowGetCategories['category_name'].'</a></li>';
                                }
                            }
                            ?>
                            <li><hr class="divider"></li>
                            <li><a class="dropdown-item text-center" href="list.php?category=All%20Products">All Products</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link border-top border-light border-2 me-2" href="#footer-section">Contanct Us</a>
                    </li>
                    <form class="d-lg-flex d-grid gap-1 col-lg-5">
                        <input class="form-control me-2" type="search" placeholder="Search products..."
                            aria-label="Search">
                        <button id="searchProduct" class="btn btn-danger d-grid" type="submit">Search</button>
                    </form>
                </ul>
                <ul class="navbar-nav me-right mb-2 mb-lg-0">

                    <!-- Check if any user is logged in -->
                    <?php
                    if (empty($_SESSION['username'])) {
                    ?>

                    <!-- Modal Buttons -->
                    <form class="d-lg-flex d-grid gap-2">
                        <button type="button" class="btn btn-register" data-bs-toggle="modal"
                            data-bs-target="#logInModal"> <i class="fad fa-sign-in-alt"></i> <span
                                class="button-text">Log In</span></button>
                        <button type="button" class="btn btn-register" data-bs-toggle="modal"
                            data-bs-target="#signUpModal"><i class="fas fa-user-plus"></i> <span
                                class="button-text">Sign Up</span></button>
                    </form>
                </ul>
            </div>
        </div>
    </nav> <!-- End Navbar -->
    <!-- Log in Modal -->
    <div class="modal fade" id="logInModal" tabindex="-1" aria-labelledby="logInModal" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h1 class="modal-title w-100 text-success">Log In</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-dark">

                    <!-- Log In Form -->
                    <form id="logInForm" action="php/logIn.php" method="post">
                        <br>
                        <!-- Username -->
                        <div class="form-group row justify-content-center px-lg-5 px-3">

                            <div class="col-12 form-floating">
                                <input type="text" id="usernameLog" placeholder="Username" class="form-control">
                                <label class="ms-2" for="usernameLog">Username</label>

                                <!-- Response for username -->
                                <span id="logInMessageUsername" class="text-danger mt-1"></span>
                            </div>
                        </div><br>

                        <!-- Password -->
                        <div class="form-group row justify-content-center px-lg-5 px-3">
                            <div class="col-12 form-floating">
                                <input type="password" id="passwordLog" placeholder="Password" class="form-control"
                                    aria-label="Password..." aria-describedby="but">
                                <label class="ms-2" for="passwordLog">Password</label>

                                <!-- Response for password -->
                                <span id="logInMessagePassword" class="text-danger mt-1"></span>
                            </div>
                        </div><br>

                        <!-- Remember me -->
                        <div class="form-group row justify-content-center my-1 px-lg-5 px-3">
                            <div class="col-lg-7 col-6">
                                <input class="form-check-input" type="checkbox" id="rememberMeCheck">
                                <label class="form-check-label" for="rememberMeCheck" style="user-select: none;">
                                    Remember me
                                </label>
                            </div>
                            <div class="col-lg-5 col-6 text-end">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#ressetPasswordModal"
                                    data-bs-dismiss="modal" class="text-secondary">Forgot password?</a>
                            </div>
                        </div><br>

                        <!-- Log in Button -->
                        <div class="form-group row justify-content-center px-lg-5 px-3">
                            <div class="col-12">
                                <button type="submit" id="submitLogIn" class="btn btn-success w-100 " form="logInForm"
                                    style="height: 50px;">Log
                                    In</button>
                            </div>
                        </div><br>
                    </form>
                </div>
                <div class="modal-footer justify-content-center">
                    <p class="text-secondary">Don't have an account? <a href="#" class="text-success h6"
                            data-bs-toggle="modal" data-bs-dismiss="modal" data-bs-target="#signUpModal">Create one</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Forget Password Modal -->
    <div class="modal fade" id="ressetPasswordModal" tabindex="-1" aria-labelledby="ressetPasswordModal"
        aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h1 class="modal-title w-100 text-dark" style="font-size: 70px;"><i class="fad fa-lock-alt"></i>
                    </h1>
                </div>
                <div class="modal-body text-dark">

                    <!-- Password Resset Form -->
                    <form id="ressetPasswordForm" action="php/passwordResset.php" method="post">

                        <!-- Username -->
                        <div class="form-group row justify-content-center px-lg-5 px-3">
                            <div class="col-12 text-center mb-1">
                                <span class="h5">Trouble Logging In?</span><br>
                            </div>
                            <div class="col-12 text-center mb-3">
                                <span class="">Enter your username and we'll send you a link to
                                    get back into your account.</span>
                            </div> <br><br>
                            <div class="col-12 form-floating">
                                <input type="text" id="usernameResset" placeholder="Username" class="form-control">
                                <label class="ms-2" for="usernameResset">Username</label>

                            </div>
                        </div><br>

                        <!-- Resset Password Button -->
                        <div class="form-group row justify-content-center px-lg-5 px-3">
                            <div class="col-sm-12">
                                <button type="submit" id="submitRessetPassword" class="btn btn-primary w-100 "
                                    form="ressetPasswordForm" style="height: 50px;">Send Password Resset Link</button>
                            </div>
                        </div><br>

                        <!-- OR create new account-->
                        <div class="form-group row justify-content-center px-lg-5 px-3">
                            <div class="col-5">
                                <hr>
                            </div>
                            <div class="col-2 text-center">
                                <span class="text-secondary"> OR</span>
                            </div>
                            <div class="col-5">
                                <hr>
                            </div>
                            <div class="col-12 text-center">
                                <a href="#" data-bs-toggle="modal" data-bs-dismiss="modal" data-bs-target="#signUpModal"
                                    class="text-dark h6">Create New
                                    Account</a>
                            </div>

                            <!-- Message -->
                            <span id="ressetMessageLink" class="col-sm-12 mt-4 text-center alert d-none"></span>

                        </div> <br>
                    </form>
                </div>

                <!-- Back to log in Button -->
                <a href="#" class="modal-footer justify-content-center text-dark h6 w-100 mb-0 py-3"
                    data-bs-toggle="modal" data-bs-dismiss="modal" data-bs-target="#logInModal"
                    style="background-color: whitesmoke; text-decoration: none;">Back to Login</a>
            </div>
        </div>
    </div>

    <!-- Modal Sign up -->
    <div class="modal fade" id="signUpModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content -->
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h1 class="modal-tittle w-100 text-primary">Sign Up
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-dark">

                    <!-- Sign Up Form -->
                    <form id="signUpForm" action="php/signUp.php" method="post">

                        <!-- First Name Last Name-->
                        <br>
                        <div class="form-group row justify-content-center px-lg-5 px-3">

                            <!-- First name -->
                            <div class="col-lg-6 form-floating">
                                <input type="text" id="first_name" placeholder="First name" class="form-control" />
                                <label for="first_name" class="ms-2">First name</label>

                                <!-- Response for First Name and Last Name -->
                                <span id="signUpMessageName" class="text-danger mt-1"></span>
                            </div>

                            <!-- Last name -->
                            <div class="col-lg-6 form-floating mt-lg-0 mt-4">
                                <input type="text" id="last_name" placeholder="Last name" class="form-control" />
                                <label for="last_name" class="ms-2">Last name</label>
                            </div>
                        </div>
                        <br />

                        <!-- Username -->
                        <div class="form-group row justify-content-center px-lg-5 px-3">
                            <div class="col-12 form-floating">
                                <input type="text" id="usernameSignUp" placeholder="Username" class="form-control" />
                                <label for="usernameSignUp" class="ms-2">Username</label>

                                <!-- Response for username -->
                                <span id="signUpMessageUsername" class="text-danger mt-1"> <span
                                        class="text-secondary ms-2">You can use letters, numbers,
                                        periods &
                                        dash </span> </span>
                            </div>
                        </div>
                        <br />

                        <!-- Email -->
                        <div class="form-group row justify-content-center px-lg-5 px-3">
                            <div class="col-12 form-floating">
                                <input type="text" id="email" placeholder="Email" class="form-control" />
                                <label for="email" class="ms-2">Email</label>

                                <!-- Response for email -->
                                <span id="signUpMessageEmail" class="text-danger mt-1"></span>
                            </div>
                        </div>
                        <br />

                        <!-- Password and Confirm password  -->
                        <div class="form-group row justify-content-center px-lg-5 px-3">

                            <!-- Password -->
                            <div class="col-lg-6 form-floating">
                                <input type="password" id="passSignUp" placeholder="Password" class="form-control" />
                                <label for="passSignUp" class="ms-2">Password</label>
                            </div>

                            <!-- Confirm password -->
                            <div class="col-lg-6 form-floating mt-lg-0 mt-4">
                                <input type="password" id="confirmPassSignUp" placeholder="Confirm"
                                    class="form-control" />
                                <label for="confirmPassSignUp" class="ms-2">Confirm</label>
                            </div>

                            <!-- Response for password -->
                            <div class="col-12">
                                <span id="signUpMessagePassword" class="text-danger mt-1"></span>
                            </div>
                        </div>

                        <!-- Checkbox for show password -->
                        <div class="form-group row px-lg-5 px-3 mt-1">
                            <div class="form-group col-lg-6 col-12">
                                <input class="form-check-input" type="checkbox" id="showPasswordCheck">
                                <label class="form-check-label ms-2" for="showPasswordCheck" style="user-select: none;">
                                    Show password
                                </label>
                            </div>
                        </div><br>

                        <!-- Phone Number -->
                        <div class="form-group row justify-content-center px-lg-5 px-3">
                            <div class="col-12 form-floating">
                                <input type="number" id="phone_number" placeholder="Phone number (Optional)"
                                    class="form-control" />
                                <label for="phone_number" class="ms-2">Phone number (Optional)</label>
                            </div>
                        </div>
                        <br>

                        <!-- Select for user Type -->
                        <div class="form-group row justify-content-center px-lg-5 px-3">
                            <div class="col-12 form-floating">
                                <select class="form-select" id="user_type">
                                    <option value="customer" selected>Customer</option>
                                    <option value="salessman">Salessman</option>
                                </select>
                                <label for="user_type" class="ms-2">Select how you want to register
                                    as</label>
                            </div>
                            <div class="col-12 mb-1 mt-3">
                                <span class="text-dark">By signing up, I agree to the Privacy Policy and
                                    the Terms of Services.</span>
                            </div>
                        </div> <br>

                        <!-- Register button -->
                        <div class="row justify-content-center px-lg-5 px-3">
                            <div class="col-12 form-floating">
                                <button type="submit" form="signUpForm" id="submitSignUp" class="btn btn-primary w-100"
                                    style="height: 50px;">Register</button>
                            </div>
                        </div>
                        <br />
                    </form>
                </div>

                <!-- Modal buttons -->
                <div class="modal-footer justify-content-center">
                    <p class="text-secondary">Already have an account? <a href="#" class="text-primary h6"
                            data-bs-toggle="modal" data-bs-dismiss="modal" data-bs-target="#logInModal">Log In</a> </p>
                </div>
            </div>
        </div>
    </div>
    <!-- If an user is logged in -->
    <?php
    } else {
    ?>
    <li class="nav-item dropdown me-3 border-top border-light border-2">
        <a class="nav-link dropdown-toggle" href="#" id="navbarAccount" role="button" data-bs-toggle="dropdown"
            aria-expanded="false"><span class="button-text"><?php echo $_SESSION['username'] ?></span> <i
                class="fad fa-user-circle"></i></a>
        <ul class="dropdown-menu me-2" aria-labelledby="navbarAccount">
            <li><a class="dropdown-item ps-4" href="#">Profile <i class="fad fa-user-edit"></i></a></li>
            <li><a id="logout" class="dropdown-item ps-4" href="inc/php/logout.php">log out <i
                        class="fad fa-sign-out"></i></a></li>
        </ul>
    </li>
    <li class="nav-item me-2">
        <a class="nav-link" href="#"> <i class="shopping-icon fad fa-shopping-cart"></i></a>
    </li>
    </ul>
    </div>
    </div>
    </nav> <!-- End Navbar -->
    <?php
    }
?>



    <!-- Main Section -->
    <section class="mt-5">
        <!--carousel and product name and a short description-->
        <div class="container-fluid px-lg-5 px-4">
            <div class="row justify-content-evenly px-lg-5 px-0">
                <div id="caruselProduct" class="col-lg-7 col-12 carousel slide" data-bs-ride="carousel"
                    data-bs-interval="false">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#caruselProduct" data-bs-slide-to="0" class="active"
                            aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#caruselProduct" data-bs-slide-to="1"
                            aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#caruselProduct" data-bs-slide-to="2"
                            aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="inc/pictures/products2.jpg" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="inc/pictures/products3.jpg" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="inc/pictures/products4.jpg" class="d-block w-100" alt="...">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#caruselProduct"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#caruselProduct"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                <div class="col-lg-5 col-12 align-self-center">
                    <div class="sections-header mt-lg-0 mt-4 mb-lg-5 mb-0">AN IMPORTANT AND EXTREMELY RARE BLUE AND
                        WHITE 'KUI
                        DRAGON' JAR</div><br>
                    <div class="short-descr text-lg-start text-center">XUANDE SIX-CHARACTER MARK IN UNDERGLAZE BLUE
                        WITHIN A DOUBLE CIRCLE AND OF
                        THE
                        PERIOD (1426-1435)XUANDE SIX-CHARACTER MARK IN UNDERGLAZE BLUE WITHIN A DOUBLE CIRCLE AND OF THE
                        PERIOD (1426-1435)XUANDE SIX-CHARACTER MARK IN UNDERGLAZE BLUE WITHIN A DOUBLE CIRCLE AND OF THE
                        PERIOD (1426-1435)XUANDE SIX-CHARACTER MARK IN UNDERGLAZE BLUE WITHIN A DOUBLE CIRCLE AND OF THE
                        PERIOD (1426-1435)</div><br>
                    <div class="row mt-lg-5 justify-content-center">
                        <div class="col-xl-3 col-lg-4 col-12 mt-4">
                            <button class="btn save-product w-100"><i class="fas fa-heart"></i> SAVE</button>
                        </div>
                        <div class="col-xl-5 col-lg-8 col-12 mt-4">
                            <button class="btn bid-now w-100"><i class="fad fa-bolt"></i> PLACE BID NOW</button>
                        </div>
                    </div>
                </div>
            </div>
        </div> <br><br><br>

        <div class="container-fluid mt-0 mt-lg-5">
            <div class="row">
                <div class="bookmarks col-xl-2 col-lg-3">
                    <div class="row justify-content-center px-lg-5 px-0">
                        <div class="col-lg-12 col-6 text-lg-start text-center">
                            <a class="bookmark" href="#description"><i class="fa fa-arrow-right"></i> Description</a>
                        </div>
                        <div class="col-lg-12 col-6 text-lg-start text-center">
                            <a class="bookmark" href="#details"><i class="fa fa-arrow-right"></i> Auction details</a>
                        </div>
                        <div class="col-lg-12 col-6 text-lg-start text-center">
                            <a class="bookmark" href="#similar"><i class="fa fa-arrow-right"></i> See similar
                                produtcs</a>
                        </div>
                        <div class="col-lg-12 col-6 text-lg-start text-center">
                            <a class="bookmark" href="#how"><i class="fa fa-arrow-right"></i> How auction works</a>
                        </div>
                    </div>
                </div>

                <!-- Description and Details -->
                <div class="col-xl-7 offset-xl-1 col-lg-9 col-12 px-lg-5 px-4 mt-lg-0 mt-5">
                    <div class="row justify-content-center">
                        <section id="tabDescription" class="col-xl-12 ml-xl-3">
                            <!-- 2 nav-tabs -->
                            <ul class="nav nav-tabs justify-content-lg-start justify-content-center" id="tab"
                                role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="description-tab" data-bs-toggle="tab"
                                        href="#description" role="tab" aria-selected="true">Description</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="details-tab" data-bs-toggle="tab" href="#details" role="tab"
                                        aria-selected="false">Details</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="latestTabContent">
                                <br>
                                <!-- Description Tab -->
                                <div class="tab-pane fade show active" id="description" role="tabpanel">
                                    <div class="row">
                                        <div
                                            class="col-lg-6 col-12 border-right border-secondary text-lg-start text-center">
                                            <p class="content-item">Lorem ipsum dolorvitae nam iusto. Eum distinctio,
                                                placeat recusandae
                                                similique reprehenderit voluptas laborum facere
                                                or sit amet coue reprerum facere
                                                or sit
                                                quisquam delectus.</p>
                                        </div>
                                        <div class="col-lg-6 col-12 text-lg-start text-center">
                                            <p class="content-item">Lorem ipsum dold vvitae nam iusto. Eum distinctio,
                                                placeat recusandae
                                                similique reprerum facere
                                                or sit amet consectetur adipisicing elit. Suscipit, dolor illum rem
                                                ipsam
                                                culpa doloribus
                                                id vitae na
                                                quisquam delectus.</p>
                                        </div>
                                    </div>
                                </div> <!-- End Description tab -->
                                <!-- Details Tab -->
                                <div class="tab-pane fade" id="details" role="tabpanel">
                                    <div class="row">
                                        <div
                                            class="col-lg-6 col-12 border-right border-secondary text-lg-start text-center">
                                            <p class="content-item">When clicking the Buy-It-Now button or placing a bid
                                                you automatically enter into a legally binding contract to purchase the
                                                item. Please commit to buy only after you decided to purchase & you are
                                                ready to pay.
                                                A minimum 5% cancellation fee will apply to all orders that are not paid
                                                or returned for non-defective reasons.
                                                There will be no price protection, if the price of an item changes after
                                                purchasing.
                                                We are required to collect state tax from AL state buyers.
                                                </p>
                                        </div>
                                        <div class="col-lg-6 col-12 text-lg-start text-center">
                                            <p class="content-item"><strong>RETURN POLICY</strong>
                                                If you have received wrong or defective item(s), please ensure that
                                                items are returned to us within 30 days in original packaging in brand
                                                new and resalable condition. You will be required to contact us for a
                                                return authorization form before sending anything back to us.
                                                All returns must include original box, original factory packaging (foam
                                                plastic wrappings, etc.) Do not deface original factory cartons or
                                                packaging in any manner. We will not accept a return if the goods are
                                                not in its original condition.
                                                Do not discard box, until equipment has not been tested</p>
                                        </div>
                                    </div>
                                </div> <!-- End Review tab -->
                            </div> <!-- End tab content -->
                        </section> <!-- End section -->
                    </div>
                </div>
            </div>
        </div>
    </section><br><br><br> <!-- End Main Section -->
    <hr>

    <!-- Similar Product Section -->
    <section id="similar">
        <div class="container">
            <h1 class="otherProduct-header text-center">
                Similar Products
            </h1>
            <div class="similar-products-row">
                <div class="me-5 text-center mb-3">
                    <img class="products-img" src="inc/pictures/products.jpg">
                    <i>Product Tittle</i>
                </div>
                <div class="me-5 text-center">
                    <img class="products-img" src="inc/pictures/products4.jpg">
                    <i>Product Tittle</i>
                </div>
                <div class="me-5 text-center">
                    <img class="products-img" src="inc/pictures/products3.jpg">
                    <i>Product Tittle</i>
                </div>
                <div class="me-5 text-center">
                    <img class="products-img" src="inc/pictures/products2.jpg">
                    <i>Product Tittle</i>
                </div>
                <div class="me-5 text-center">
                    <img class="products-img" src="inc/pictures/products.jpg">
                    <i>Product Tittle</i>
                </div>
                <div class="me-5 text-center">
                    <img class="products-img" src="inc/pictures/products3.jpg">
                    <i>Product Tittle</i>
                </div>
            </div>
        </div>
    </section><br><br><br> <!-- End Similar Product Section -->

    <!-- Footer section -->
    <section id="footer-section">
        <br>
        <div class="container">
            <!-- <h2 class="headerLabel-container">Contact Us</h2> -->
            <div class="row">
                <div class="col-lg-4 col-12 text-center">
                    <h2 class="footer-header mb-3">Contact us</h2>
                    <span class="footer-inner"><i class="fad fa-envelope"></i> <strong>Email:</strong> <span
                            class="text-secondary">huskiescyber@gmail.com</span> </span>
                    <br>
                    <span class="footer-inner"><i class="fas fa-phone-plus"></i> <strong>Phone Number:</strong> <span
                            class="text-secondary">+35569678553</span> </span>
                </div>
                <div class="col-lg-4 col-12 mt-5 mt-lg-0 text-center">
                    <h2 class="footer-header mb-3">Location</h2>
                    <span class="footer-inner"><i>'Road xxxx km Y , Albania, Lushnje'</i></span>
                    <br>
                    <span class="h1"><i class="fad fa-map-marked-alt"></i></span>
                </div>
                <div class="col-lg-4 col-12 mt-5 mt-lg-0 text-center">
                    <h2 class="footer-header mb-3">Social media</h2>
                    <a href="#" class="h1 text-primary"><i class="fab fa-facebook-square"></i></a>
                    <a href="#" class="h1 text-danger"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div><br><br><br>
    </section> <!-- End Footer Section -->


    <!-- Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- JS link -->
    <script type="text/javascript" src="inc/js/home.js"></script>
    <script>
    //hide scrollbar when croll down
    var prev_pos = window.pageYOffset;
    window.onscroll = function() {
        var current_pos = window.pageYOffset;
        if (prev_pos > current_pos) {
            document.getElementsByClassName("navb")[0].style.top = "0";
        } else {
            document.getElementsByClassName("navb")[0].style.top = "-80px";
        }
        prev_pos = current_pos;
    }
    </script>
</body>

</html>