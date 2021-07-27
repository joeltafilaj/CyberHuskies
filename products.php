<?php
session_start();
if (isset($_COOKIE['username']) && !empty($_COOKIE['username'])) {
    $_SESSION['username'] = $_COOKIE['username'];
}
require $_SERVER['DOCUMENT_ROOT'] . '/CyberHuskies/inc/functions.php';
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

    <title>Auction - Products</title>
    <link rel="shortcut icon" href="inc/pictures/cyberhuskies.ico">
</head>

<body class="text-dark" style="padding-top: 78px;">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top navb" style="transition: 0.3s">
        <div class="container-fluid">
            <a class="navbar-brand"></a>
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
    }
    
    //DB connection to get product on the database
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        if (isset($_GET['pid'])) {
            $product_id = $_GET['pid'];
            if (ctype_digit($product_id)) {
                $sqlGetProduct = "SELECT *, TIMESTAMPDIFF(second,CURTIME(),sale_end) AS time_remaining, TIMESTAMPDIFF(second,sale_start,CURTIME()) AS is_available FROM product WHERE product_id = ? ";
                $stmt = mysqli_stmt_init($connection);
                if (!mysqli_stmt_prepare($stmt, $sqlGetProduct)) {
                    echo '<br><br><br><br><h1 class="otherProduct-header mt-2">No Product Found. <i class="fad fa-frown"></i><br> Check your link again!</h1><br><br><br><br>
                        <br><br><br><br><br>
                        <br><br><br><br>';
                } else {
                    
                    mysqli_stmt_bind_param($stmt, 'i', $product_id);
                    mysqli_stmt_execute($stmt);
                    $resultGetProduct = mysqli_stmt_get_result($stmt);
                    if (mysqli_num_rows($resultGetProduct) == 1) {
                    while ($rowGetProduct = mysqli_fetch_assoc($resultGetProduct)) {
    ?>
    <!-- Main Section -->
    <section class="mt-5">
        <!-- Carousel and product name and a short description-->
        <div class="container-fluid px-lg-5 px-4">
            <!-- Alert message for adding to wishlist -->
            <div class="row justify-content-end fixed-top" style="top:85px; height: 0; right:10px;">
                <div class="col-xl-4 col-lg-6 col-md-9 col-sm-9 col-11">
                    <div class="alert alert-danger alert-danger1 alert-dismissible text-center" data-aos="fade"
                        role="alert" style=" display: none">
                        <i class="fad fa-exclamation-circle"></i> <span id="alert-danger">This product is already in the
                            wishlist!</span>
                    </div>
                </div>
            </div>
            <div class="row justify-content-end fixed-top" style="top:85px; height: 0; right:10px;">
                <div class="col-xl-4 col-lg-6 col-sm-9 col-11">
                    <div class="alert alert-success alert-dismissible text-center" data-aos="fade" role="alert"
                        style=" display: none">
                        <i class="fas fa-check-circle"></i> <span id="alert-success">Product added successfully to
                            wishlist!</span>
                    </div>
                </div>
            </div><!-- End alert mesage -->
            <div class="row justify-content-evenly px-lg-5 px-0">
                <div id="caruselProduct" class="col-lg-7 col-12 carousel carousel-dark slide" data-bs-ride="carousel"
                    data-bs-interval="false">
                    <?php 
                    //DB connection to get product images stored in another table and put it in carousel
                    $sqlGetImages = "SELECT * FROM picture WHERE product_id = ".$rowGetProduct['product_id']."";
                    $resultGetImages = mysqli_query($connection, $sqlGetImages);
                    $countImage = mysqli_num_rows($resultGetImages);
                    echo '<div class="carousel-indicators">';
                        for ($i=0; $i < $countImage; $i++) { 
                            if ($i === 0) {
                                echo '<button type="button" data-bs-target="#caruselProduct" data-bs-slide-to="'.$i.'" class="active"
                                        aria-current="true" aria-label="Slide '.($i+1).'"></button>';
                            } else {
                                echo'<button type="button" data-bs-target="#caruselProduct" data-bs-slide-to="'.$i.'" 
                                aria-label="Slide '.($i+1).'"></button>';
                        }
                    }
                    echo '</div>';
                    if (mysqli_num_rows($resultGetImages) > 0) {
                        $counter = 0;
                        while ($rowGetImages = mysqli_fetch_assoc($resultGetImages)) {
                            if ($counter === 0) {
                                echo '<div class="carousel-inner">';
                                echo   '<div class="carousel-item active">
                                            <img src="inc/pictures/product-picture/'.$rowGetImages['picture_url'].'" class="d-block mx-auto" alt="..." data-bs-toggle="modal" data-bs-target="#imageMax'.$counter.'">
                                        </div>';
                            }else {
                                echo    '<div class="carousel-item">
                                            <img src="inc/pictures/product-picture/'.$rowGetImages['picture_url'].'" class="d-block mx-auto " alt="..." data-bs-toggle="modal" data-bs-target="#imageMax'.$counter.'">
                                        </div>';
                            } 
                    ?>
                    <div class="modal fade" id="imageMax<?php echo $counter; ?>" role="dialoig">
                        <div class="modal-dialog modal-fullscreen p-lg-5 p-3">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <span class="h4 modal-tittle text-primary">Full image</span>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-center">
                                    <image class="img-fluid w-100 h-100"
                                        src="inc/pictures/product-picture/<?php echo $rowGetImages['picture_url']; ?>"
                                        alt="Image"></image>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                            $counter++;
                        }
                    }
                    ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#caruselProduct"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class=""></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#caruselProduct"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class=""></span>
                </button>
            </div>
            <div class="col-lg-5 col-12 align-self-center">
                <div class="sections-header mt-lg-0 mt-5 mb-lg-5 mb-4"><?php echo $rowGetProduct['name']; ?></div>
                <span class="text-lg-start text-center h4"><b>Starting bid:</b> EU
                    <?php echo $rowGetProduct['starting_price']; ?>&euro;</span>
                <div class="text-lg-start text-center mt-4"><?php echo $rowGetProduct['description']; ?></div>
                <?php 
                   
                    // Product's time has ended
                    if ($rowGetProduct['time_remaining'] <= 0) {
                        $response = '';
                        if ($rowGetProduct['bid_now'] != '') {
                            $response = '<i class="fad fa-badge-check"></i> Sold for '.$rowGetProduct['bid_now'].'&euro;';
                        } else {
                            $response = 'Time ended <i class="fad fa-hourglass-half"></i>';
                        }
                        echo "<div class='time text-center mt-3 h2'>$response</div>";
                        echo '<div class="row mt-lg-4 justify-content-center">
                                    <div class="col-xl-3 col-lg-4 col-12 mt-4" id="save">
                                        <button type="submit" class="btn save-product w-100" id="w'.$rowGetProduct['product_id'].'"><i class="fas fa-heart"></i> SAVE</button>
                                    </div>
                                    <div class="col-xl-5 col-lg-8 col-12 mt-4" id="bid">
                                        <button class="btn bid-now w-100 disabled" id="p'.$rowGetProduct['product_id'].'"><i class="fad fa-bolt"></i> PLACE BID NOW</button>
                                    </div>
                                </div>';

                    // Product's time is counting down
                    } else if ($rowGetProduct['time_remaining'] > 0 && $rowGetProduct['is_available'] > 0) {
                        
                        // Check if user logged in is salessman/costumer to check if bids can be made
                        if ((isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'costumer') || !isset($_SESSION['user_type'])) {
                            echo '<div class="time text-center mt-3 h2">Time left : <span id="time">'.$rowGetProduct['time_remaining'].'</span></div>';
                            echo '<div class="row mt-lg-4 justify-content-center">
                                        <div class="col-xl-3 col-lg-4 col-12 mt-4" id="save">
                                            <button type="submit" class="btn save-product w-100" id="w'.$rowGetProduct['product_id'].'"><i class="fas fa-heart"></i> SAVE</button>
                                        </div>
                                        <div class="col-xl-5 col-lg-8 col-12 mt-4" id="bid">
                                            <button class="btn bid-now w-100 disabled" id="p'.$rowGetProduct['product_id'].'"><i class="fad fa-bolt"></i> PLACE BID NOW</button>
                                        </div>
                                    </div>';
                        } else {
                            // Get number of bids for the product
                            $sqlGetNrBids = "SELECT product_id FROM bid WHERE product_id = ".$rowGetProduct['product_id']."";
                            $nrBids = mysqli_num_rows(mysqli_query($connection, $sqlGetNrBids));
                            echo '<div class="time text-center mt-3 h2">Time left : <span id="time">'.$rowGetProduct['time_remaining'].'</span></div>';
                            echo '<div class="row mt-lg-4 justify-content-center">
                                        <div class="col-xl-3 col-lg-4 col-12 mt-4" id="save">
                                            <button type="submit" class="btn save-product w-100" id="w'.$rowGetProduct['product_id'].'"><i class="fas fa-heart"></i> SAVE</button>
                                        </div>
                                        <div class="col-xl-5 col-lg-8 col-12 mt-4" id="bid">
                                            <button type="submit" class="btn bid-now w-100" id="b'.$rowGetProduct['product_id'].'" data-bs-target="#confirmModal" data-bs-toggle="modal"><i class="fad fa-bolt"></i> PLACE BID NOW</button>
                                        </div>
                                    </div>';
                            echo '<br>';
                            echo '<!-- Confirm bid modal -->
                                <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModal"  data-bs-backdrop="static" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h2 class="modal-title"><b>EU '.$rowGetProduct['starting_price'].'&euro; </b><span class="h5 text-secondary ms-2">  '.$nrBids.' bids </span></h2> 
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div id="bidResponse" class="alert alert-danger text-center d-none" role="alert">
                                                
                                            </div>
                                            <h5 class="mb-4">Place your bid</h5> 
                                            <div class="row">
                                                <div class="col-12 form-floating">
                                                    <input type="number" min="'.$rowGetProduct['starting_price'].'" id="bidPrice" placeholder="Place bid value"
                                                    class="form-control">
                                                    <label class="ms-3" for="bidPrice">Place bid value</label>        
                                                </div>
                                                <div class="col-12 mt-3">
                                                    <button id="confirmBid" type="button" class="btn btn-warning d-block w-100" style="height:50px;">Confirm offer <i class="fad fa-badge-check"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <span class="text-center w-100" style="font-size: 13px;">When you <b>bid</b>, it means you are committing to buy this item if you are the winning bidder.</span>
                                        </div>
                                        </div>
                                    </div>
                                </div>';
                        }

                    // Product is not available yet on market
                    } else if ($rowGetProduct['is_available'] <= 0) {
                        echo '<div class="time text-center mt-3 h2">Item not available yet <i class="fad fa-calendar-alt"></i></div>';
                        echo '<div class="row mt-lg-4 justify-content-center">
                                    <div class="col-xl-3 col-lg-4 col-12 mt-4" id="save">
                                        <button type="submit" class="btn save-product w-100" id="w'.$rowGetProduct['product_id'].'"><i class="fas fa-heart"></i> SAVE</button>
                                    </div>
                                    <div class="col-xl-5 col-lg-8 col-12 mt-4" id="bid">
                                        <button class="btn bid-now w-100 disabled" id="b'.$rowGetProduct['product_id'].'"><i class="fad fa-bolt"></i> PLACE BID NOW</button>
                                    </div>
                                </div>';
                    }
                    ?>
            </div>
        </div>
        </div> <br><br><br>

        <div class="container-fluid mt-0 mt-lg-5">
            <div class="row">
                <div class="bookmarks col-xl-2 col-lg-3">
                    <div class="row justify-content-center px-lg-5 px-0">
                        <div class="col-lg-12 col-6 text-lg-start text-center">
                            <a class="bookmark" href="#similar"><i class="fa fa-arrow-right"></i> See similar
                                produtcs</a>
                        </div>
                        <div class="col-lg-12 col-6 text-lg-start text-center">
                            <a class="bookmark" href="inc/auctionRules.pdf" download="auctionRules"><i
                                    class="fa fa-arrow-right"></i> Save Auction Rules</a>
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
                                        <?php
                                    //split text in half
                                    $text = $rowGetProduct['description'];
                                    $splitat = strpos($text, " ", strlen($text) / 2);
                                    $col1 = substr($text, 0, $splitat);
                                    $col2 = substr($text, $splitat);
                                    ?>
                                        <div
                                            class="col-lg-6 col-12 border-right border-secondary text-lg-start text-center">
                                            <p class="content-item"><?php echo $col1;?></p>
                                        </div>
                                        <div class="col-lg-6 col-12 text-lg-start text-center">
                                            <p class="content-item"><?php echo $col2;?></p>
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
                                            <p class="content-item"><strong>RETURN POLICY</strong><br>
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
            <?php
            // DB connection to get similar product from the database
            $sqlGetSimilarProducts = "SELECT picture_cover_url, name, product_id FROM product WHERE category_id = ".$rowGetProduct['category_id']." AND product_id <> ".$rowGetProduct['product_id'].""; 
            $resultGetSimilarProducts = mysqli_query($connection, $sqlGetSimilarProducts);
            $countProduct = mysqli_num_rows($resultGetSimilarProducts);
            if ( $countProduct > 0) {
                if ($countProduct <= 3) {
                    $justify = 'center';
                } else {
                    $justify = 'between';
                }
            echo '<h1 class="otherProduct-header text-center">
                    Similar Products
                </h1>
                <div class="similar-products-row gap-4 d-flex flex-row justify-content-lg-'.$justify.'" justify-content-between>';
                while ($rowGetSimilarProdutcs = mysqli_fetch_assoc($resultGetSimilarProducts)) {
            ?>
            <div class="text-center mb-3">
                <a href="products.php?pid=<?php echo $rowGetSimilarProdutcs['product_id'];?>"><img
                        class="products-img border border-2"
                        src="inc/pictures/product-picture/<?php echo $rowGetSimilarProdutcs['picture_cover_url']; ?>"></a>
                <br><br><i><?php echo $rowGetSimilarProdutcs['name']; ?></i>
            </div>
            <?php
                }
            echo '</div>';
            } else {
            ?>
            <h1 class="otherProduct-header text-center">
                No Similar Product found
            </h1>
            <?php
            }
            ?>

        </div>
    </section><br><br><br> <!-- End Similar Product Section -->
    <?php     
                }
            } else {
                echo '<br><br><br><br><h1 class="otherProduct-header mt-2">No Product Found. <i class="fad fa-frown"></i><br> Check your link again!</h1><br><br>
                <br><br><br><br><br><br>
                <br><br><br><br><br>';   
            }       
     }           
    } else {
        echo '<br><br><br><br><h1 class="otherProduct-header mt-2">No Product Found. <i class="fad fa-frown"></i><br> Check your link again!</h1><br><br><br><br>
        <br><br><br><br><br>
        <br><br><br><br>';
    }
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
    <script type="text/javascript" src="inc/js/products.js"></script>
    <script type="text/javascript" src="inc/js/navbar.js"></script>

</body>

</html>