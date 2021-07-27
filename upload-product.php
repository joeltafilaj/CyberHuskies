<?php
session_start();
if (isset($_COOKIE['username']) && !empty($_COOKIE['username'])) {
    $_SESSION['username'] = $_COOKIE['username'];
    $_SESSION['user_type'] = $_COOKIE['user_type'];
    $_SESSION['email'] = $_COOKIE['email'];
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
    <link rel="stylesheet" type="text/css" href="inc/css/homeStyle.css">
    <link rel="stylesheet" type="text/css" href="inc/css/navbar.css">
    <link rel="stylesheet" type="text/css" href="inc/css/footer.css">
    <link rel="stylesheet" type="text/css" href="inc/css/upload-product.css">

    <!-- AOS Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">


    <title>Auction - Sell</title>
    <link rel="shortcut icon" href="inc/pictures/cyberhuskies.ico">
</head>

<body class="text-dark d-flex flex-column justify-content-between" style="padding-top: 78px" >
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top navb" style="transition: 0.3s">
        <div class="container-fluid">
            <a class="navbar-brand" href="home.php"></a>
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
                        <a class="nav-link border-top border-light border-2 me-2"
                            href="list.php?category=All%20Products">Buy</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active border-top border-light border-2 me-2" href="upload-product.php">Sell</a>
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
                            <li>
                                <hr class="divider">
                            </li>
                            <li><a class="dropdown-item text-center" href="list.php?category=All%20Products">All
                                    Products</a></li>
                            <li><a class="dropdown-item text-center" href="list.php?category=Cooming%20Soon">Cooming
                                    Soon</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link border-top border-light border-2 me-2"
                            href="#footer-section">Contact Us</a>
                    </li>
                    <form class="d-lg-flex d-grid gap-1 col-lg-5" action='list.php' method="get">
                        <input class="form-control me-2" type="search" placeholder="Search products..."
                            aria-label="Search" name="search">
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
    <?php 
    require 'inc/php/logInModal.php';
    ?>

    <!-- Forget Password Modal -->
    <?php 
    require 'inc/php/forgetPasswordModal.php';
    ?>

    <!-- Modal Sign up -->
    <?php 
    require 'inc/php/signUpModal.php';
    ?>

    <!-- If an user is logged in -->
    <?php
                    } else {
                    ?>
    <li class="nav-item dropdown me-3 border-top border-light border-2">
        <a class="nav-link dropdown-toggle" href="#" id="navbarAccount" role="button" data-bs-toggle="dropdown"
            aria-expanded="false"><?php echo $_SESSION['username'] ?> <i class="fad fa-user-circle"></i></a>
        <ul class="dropdown-menu me-2" aria-labelledby="navbarAccount">
            <?php
            if ($_SESSION['user_type'] === 'salessman') {
                echo '<li><a class="dropdown-item ps-4" href="accounts/myproducts.php">My products <i class="fad fa-stream"></i></a></li>';
            }
            ?>
            <li><a id="logout" class="dropdown-item ps-4" href="inc/php/logout.php">log out <i
                        class="fad fa-sign-out"></i></a></li>
        </ul>
    </li>
    <li class="nav-item me-2">
        <a class="nav-link" href="mycart.php"> <i class="shopping-icon fad fa-shopping-cart"></i></a>
    </li>
    </ul>
    </div>
    </div>
    </nav> <!-- End Navbar -->
    <?php
                    }
                    ?>

<?php 
if ( isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'salessman') {
    # code...
require_once "inc/php/upload-product-db.php";
?>

    <!-- Form Section for uploading a product -->
    <br><div class="container product-input-container mt-lg-5 mt-2">
        <div class="row justify-content-center">
            <div class="col-lg-8 product-inputs">
                <form id="uploadForm" method="POST" action="upload-product" enctype="multipart/form-data">
                    <div class="row product-input justify-content-center">
                        <span class="col-lg-12 text-center text-danger"></span>
                        <!-- Alert message for adding to wishlist -->
                        <?php 
                            if ($response === 'Product Addedd Successfully') {
                                $display_success = '';
                                $display_danger = 'd-none';
                            } else if($response === '') {
                                $display_danger = 'd-none';
                                $display_success = 'd-none';
                            } else {
                                $display_danger = '';
                                $display_success = 'd-none';
                            }
                        ?>
                            <div class="alert alert-danger alert-dismissible text-center col-lg-7 <?php echo $display_danger; ?>" role="alert">
                                <i class="fad fa-exclamation-circle"></i> <span id="response"><?php echo $response; ?></span>
                            </div>
                            <div class="alert alert-success alert-dismissible text-center col-lg-7 <?php echo $display_success; ?>" role="alert">
                                <i class="fas fa-check-circle"></i> <span id="response"><?php echo $response; ?></span>
                            </div>
                        
                   
                        <div class="col-lg-6">
                            <label for="name_input">Product name:</label>
                            <input type="text" name="name_input" id="name_input" class="form-control">
                        </div>
                    </div>

                    <div class="row product-input justify-content-center">
                        <div class="col-lg-6">
                            <label for="str_price_input">Starting price:</label>
                            <input type="number" name="str_price_input" id="str_price_input" class="form-control" min="0">
                        </div>
                    </div>

                    <div class="row product-input justify-content-center">
                        <div class="col-lg-6">
                            <label for="avl_from_input">Avalilable for auction from:</label>
                            <input type="datetime-local" name="avl_from_input" id="avl_from_input" class="form-control">
                        </div>
                    </div>

                    <div class="row product-input justify-content-center">
                        <div class="col-lg-6">
                            <label for="avl_unt_input">Available at auction until:</label>
                            <input type="datetime-local" name="avl_unt_input" id="avl_unt_input" class="form-control">
                        </div>
                    </div>

                    <div class="row product-input justify-content-center">
                        <div class="col-lg-6">
                            <label for="desc_input">Product description:</label>
                            <textarea name="desc_input" id="desc_input" rows="10" style="resize: none;"
                                class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="row product-input justify-content-center">
                        <div class="col-lg-6">
                            <label for="cat_input">Choose category:</label>
                            <select name="cat_input" id="cat_input" class="form-select">
                                <option value="0" disabled selected value>Select category</option>
                                <?php 
                                $sqlGetCategories = 'SELECT category_name FROM category';
                                $resultGetCategories = mysqli_query($connection, $sqlGetCategories);
                                if (mysqli_num_rows($resultGetCategories) > 0) {
                                    while ($rowGetCategories = mysqli_fetch_assoc($resultGetCategories)) {
                                        echo '<option value="'.$rowGetCategories['category_name'].'">'.$rowGetCategories['category_name'].'</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="row justify-content-center">
                        <div class="col-lg-6 add-photo-input add-photo">
                            <label for="photo_input_1" class="text-secondary mb-2"> Image 1 (Required)</label>
                            <input type="file" name="photo_input_1" id="photo_input_1" class="form-control mb-2">
                            <span class="ms-2 text-secondary"> This will be used as cover picture</span>
                            <br>
                            <label for="photo_input_2" class="text-secondary mb-2 mt-4"> Image 2 (optional)</label>
                            <input type="file" name="photo_input_2" id="photo_input_2" class="form-control mb-2">
                            <label for="photo_input_3" class="text-secondary mb-2"> Image 3 (optional)</label>
                            <input type="file" name="photo_input_3" id="photo_input_3" class="form-control mb-2">
                        </div>
                    </div>
                    <div class="row justify-content-center product-upload">
                        <div class="publish-btn-container col-lg-6">
                            <button type="submit" class="btn publish btn-primary w-100" name="publish-product">Publish product</button>
                        </div>
                    </div><br><br><br>
                </form>
            </div>
        </div>
    </div> <!-- End form upload -->

    <?php
    } else {
        echo '<br><h1 class="otherProduct-header mt-3 text-center">You have to log in as salessman <i class="fad fa-frown"></i><br> Or you can create an free account</h1><br><br>
                '; 
    }
    require_once 'inc/php/footer.php';
    ?>


    <!-- Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <!-- JS link -->
    <script src="inc/js/registration.js"></script>
    <script type="text/javascript" src="inc/js/navbar.js"></script>
    <script type="text/javascript" src="inc/js/upload-product.js"></script>

</body>

</html>