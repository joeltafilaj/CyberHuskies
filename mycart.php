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
    <link rel="stylesheet" type="text/css" href="inc/css/navbar.css">
    <link rel="stylesheet" type="text/css" href="inc/css/footer.css">
    <link rel="stylesheet" type="text/css" href="inc/css/mycart.css">

    <title>Auction - My Cart</title>
    <link rel="shortcut icon" href="inc/pictures/cyberhuskies.ico">
</head>

<body class="text-dark d-flex flex-column justify-content-between" style="padding-top: 78px;">

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
                        <a class="nav-link border-top border-light border-2 me-2" href="list.php?category=All%20Products">Buy</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link border-top border-light border-2 me-2" href="upload-product.php">Sell</a>
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
                            <li><a class="dropdown-item text-center" href="list.php?category=Cooming%20Soon">Cooming Soon</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link border-top border-light border-2 me-2" href="#footer-section">Contact Us</a>
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
    
    <h1 class="otherProduct-header mt-5">You are not signed in. <i class="fad fa-frown"></i><br> <span class="h4">Log-in in order to access this site</span></h1>
        

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
            aria-expanded="false"><span class="button-text"><?php echo $_SESSION['username'] ?></span> <i
                class="fad fa-user-circle"></i></a>
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
    if (isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'costumer') {
    ?>

        <!-- Alert message for adding to wishlist -->
        <div class="row justify-content-end fixed-top" style="top:85px; height: 0; right:10px;">
            <div class="col-xl-4 col-lg-6 col-md-9 col-sm-9 col-11">
                <div class="alert alert-danger alert-dismissible text-center" data-aos="fade" role="alert" style="display: none;">
                    <i class="fad fa-exclamation-circle"></i> <span id="alert-danger">505! Internal database error!</span>
                </div>
            </div>
        </div>
        <div class="row justify-content-end fixed-top" style="top:85px; height: 0; right:10px;">
            <div class="col-xl-4 col-lg-6 col-sm-9 col-11">
                <div class="alert alert-success alert-dismissible text-center" data-aos="fade" role="alert" style="display: none;">
                    <i class="fas fa-check-circle"></i> Product removed from the wishlist!
                </div>
            </div>
        </div><!-- End alert mesage -->
        <?php 
        // DB connection to get all product added to the wishlist
        $sqlWishlistProduct = 'SELECT starting_price, bid_now, picture_cover_url, name, product_id, TIMESTAMPDIFF(second,CURTIME(),sale_end) AS time_remaining, TIMESTAMPDIFF(second,sale_start,CURTIME()) AS is_available FROM product WHERE product_id IN(SELECT product_id FROM wishlist WHERE user_id = '.$_SESSION['costumer_id'].')';
        $resultWishlistProduct = mysqli_query($connection, $sqlWishlistProduct);
        if (mysqli_num_rows($resultWishlistProduct) > 0) {
        ?>
        <!-- products of cart -->
        <div class="container p-5 cart-products">
        <?php 

            // Checking if product are available for sale or not
            while ($rowWishlistProduct = mysqli_fetch_assoc($resultWishlistProduct)) {
                if ($rowWishlistProduct['time_remaining'] <=  0) {
                    // Checking if item is sold or not
                    if ($rowWishlistProduct['bid_now'] != '') {
                        $highiest_bid = '<span><b>Sold for: </b>'.$rowWishlistProduct['bid_now'].'&euro;</span>';
                        $status = 'Item Sold <i class="fad fa-badge-check"></i>';
                    } else {
                        $highiest_bid = '';
                        $status = 'Sale Time Ended <i class="fad fa-hourglass-half"></i>';
                    }
                      
                } else if ($rowWishlistProduct['time_remaining'] > 0 && $rowWishlistProduct['is_available'] > 0) {
                    if ($rowWishlistProduct['bid_now'] == '') {
                        $rowWishlistProduct['bid_now'] = 'No offers made yet';
                    } else {
                        $rowWishlistProduct['bid_now'] .= '&euro;';
                    }
                    $status = 'Available for Sale <i class="fad fa-check-circle"></i>';
                    $highiest_bid = '<span><b>Highiest offer: </b>'.$rowWishlistProduct['bid_now'].'</span>';
                } else if ($rowWishlistProduct['is_available'] <= 0) {
                    $status = 'To be available soon <i class="fad fa-calendar-alt"></i>';
                    $highiest_bid = '';
                }
        ?>
                <div class="row" id="row<?php echo $rowWishlistProduct['product_id']; ?>">
                    <div class="col-lg-4 col-12 text-center">
                        <a href="products.php?pid=<?php echo $rowWishlistProduct['product_id']; ?>"><img src="inc/pictures/product-picture/<?php echo $rowWishlistProduct['picture_cover_url'] ?>" class="products-img img-fluid border border-2"></a>
                    </div>
                    <div class="col-lg-8 align-self-center remove">
                        <div class="row">
                            <div class="col-lg-12">
                                <h2 class="sections-header mt-lg-0 mt-3"><?php echo $rowWishlistProduct['name']; ?></h2> 
                            </div>
                            <div class="col-lg-12 mt-0 text-lg-start text-center">
                                <span><b>Status: </b><?php echo $status; ?></span>
                            </div> 
                            <div class="col-lg-12 mt-4 text-lg-start text-center">
                                <span><b>Offers start at: </b><?php echo $rowWishlistProduct['starting_price']; ?>&euro;</span><br>
                                <?php echo $highiest_bid; ?>
                            </div>
                            <div class="col-lg-12 mt-4">
                                <button id="<?php echo $rowWishlistProduct['product_id']; ?>" type="submit" class="remove-item w-100">Remove from cart <i class="fad fa-trash-alt"></i></button>
                            </div>       
                        </div>
                    </div> 
                    <hr class="mt-3">     
                </div>
            <?php
                }
            ?>
            <br>
            <div class="row justify-content-end">
                <div class="col-lg-3 col-12">
                    <a href="list.php?category=All%20Products"><button class=" btn btn-outline-warning continue-btn w-100"><i class="fad fa-arrow-left"></i> Continue shopping</button></a> 
                </div>
            </div>
        </div><!-- End products of cart -->
        
        <!-- Empty div shows when wishlist is empty -->
        <div id="empty" style="display: none;">
            <h1 class="otherProduct-header mt-5">Cart is empty <i class="fad fa-empty-set"></i></h1>
            
        </div>
            <?php 
            } else {
                echo '<h1 class="otherProduct-header mt-5">Cart is empty <i class="fad fa-empty-set"></i></h1>';
            }
        } else {
            echo '<h1 class="otherProduct-header mt-5">You are not a costumer. <i class="fad fa-frown"></i><br> <span class="h4">Log-in as costumer in order to access this site</span></h1>';
        }
        
    }

require_once 'inc/php/footer.php';
?>

    <!-- Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- JS link -->
    <script src="inc/js/registration.js"></script>
    <script type="text/javascript" src="inc/js/mycart.js"></script>
    <script type="text/javascript" src="inc/js/navbar.js"></script>

</body>

</html>