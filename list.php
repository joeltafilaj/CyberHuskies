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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Mulish' rel='stylesheet'>

    <!--Font Awesome -->
    <link rel="stylesheet" type="text/css" href="inc/fontawesome-5-pro-master/css/all.css">

    <!--CSS-->
    <link rel="stylesheet" type="text/css" href="inc/css/products.css">
    <link rel="stylesheet" type="text/css" href="inc/css/navbar.css">
    <link rel="stylesheet" type="text/css" href="inc/css/footer.css">
    <link rel="stylesheet" type="text/css" href="inc/css/list.css">

    <title>Auction - Buy</title>
    <link rel="shortcut icon" href="inc/pictures/cyberhuskies.ico">
</head>

<body class="text-dark d-flex flex-column justify-content-between" style="padding-top: 78px;">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top navb" style="transition: 0.3s">
        <div class="container-fluid">
            <a class="navbar-brand" href="home.php"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link border-top border-light border-2 me-2" aria-current="page" href="home.php">Home</a>
                    </li>
                    <li class="nav-item add-border">
                        <a class="nav-link active border-top border-light border-2 me-2" href="list.php?category=All%20Products">Buy</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link border-top border-light border-2 me-2" href="upload-product.php">Sell</a>
                    </li>
                    <li class="nav-item dropdown border-top border-light border-2 me-2">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Categories
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <!-- DB Connection to get categories-->
                            <?php
                            require $_SERVER['DOCUMENT_ROOT'] . '/CyberHuskies/inc/db_connection.php';
                            require $_SERVER['DOCUMENT_ROOT'] . '/CyberHuskies/inc/functions.php';
                            $sqlGetCategories = "SELECT * FROM category";
                            $resultGetCategories = mysqli_query($connection, $sqlGetCategories);
                            if (mysqli_num_rows($resultGetCategories) > 0) {
                                while ($rowGetCategories = mysqli_fetch_assoc($resultGetCategories)) {
                                    echo '<li><a class="dropdown-item text-center" href="list.php?category=' . $rowGetCategories['category_name'] . '">' . $rowGetCategories['category_name'] . '</a></li>';
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
                        <input class="form-control me-2" type="search" placeholder="Search products..." aria-label="Search" name="search">
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
                            <button type="button" class="btn btn-register" data-bs-toggle="modal" data-bs-target="#logInModal"> <i class="fad fa-sign-in-alt"></i> <span class="button-text">Log In</span></button>
                            <button type="button" class="btn btn-register" data-bs-toggle="modal" data-bs-target="#signUpModal"><i class="fas fa-user-plus"></i> <span class="button-text">Sign Up</span></button>
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
        <a class="nav-link dropdown-toggle" href="#" id="navbarAccount" role="button" data-bs-toggle="dropdown" aria-expanded="false"><span class="button-text"><?php echo $_SESSION['username'] ?></span> <i class="fad fa-user-circle"></i></a>
        <ul class="dropdown-menu me-2" aria-labelledby="navbarAccount">
            <?php
                        if ($_SESSION['user_type'] === 'salessman') {
                            echo '<li><a class="dropdown-item ps-4" href="accounts/myproducts.php">My products <i class="fad fa-stream"></i></a></li>';
                        }
            ?>
            <li><a id="logout" class="dropdown-item ps-4" href="inc/php/logout.php">log out <i class="fad fa-sign-out"></i></a></li>
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
                    // Geting category name from user 
                    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                        // User searched with category
                        if (isset($_GET['category'])) {
                            $category_name = test_input($_GET['category']);
                            // Check if category is with letters only
                            if ($category_name === 'All Products') {
                                $sqlProducts = "SELECT name, product_id, picture_cover_url, starting_price, sale_start FROM product";
                                $resultProducts = mysqli_query($connection, $sqlProducts);
                                $countRows = mysqli_num_rows($resultProducts);
                                if ($countRows  > 0) {
                                    if ($countRows >= 4) {
                                        $justify = 'start';
                                    } else {
                                        $justify = 'center';
                                    }
                                    echo '<!-- products from certain category -->
                            <div class="container-fluid products-from-category-container">
                                <div class="row">
                                    <h1 class="col-12 text-center mt-4 mb-lg-3 mb-0">All Products</h1>
                                </div><br><br>
                                <div class="products-from-category row justify-content-' . $justify . '"> ';

                                    while ($rowProducts = mysqli_fetch_assoc($resultProducts)) {
                                        echo '<div class=" col-xl-3 col-lg-5 col-12">
                                    <a href="products.php?pid=' . $rowProducts['product_id'] . '" class="href product row justify-content-center">
                                        <div class="prod-img col-12 text-center">
                                            <img class="img-fluid" src="inc/pictures/product-picture/' . $rowProducts['picture_cover_url'] . '">
                                        </div>
                                        <div class="prod-details col-12">
                                            <div class="prod-name text-center mb-2">' . $rowProducts['name'] . '</div>
                                            <div class="text-center mb-2"><b>At auction starting from </b><br>' . $rowProducts['sale_start'] . '</div>
                                            <div class="min-price text-center"><b>Reserve price: </b> &euro;' . $rowProducts['starting_price'] . '</div>
                                        </div>    
                                    </a>
                                </div> ';
                                    }
                                    echo '</div>
                            </div><!-- End products from certain category -->';
                                }
                            } else if ($category_name === 'Cooming Soon') {
                                $sqlProducts = "SELECT name, product_id, picture_cover_url, starting_price, sale_start FROM product WHERE sale_start > NOW()";
                                $resultProducts = mysqli_query($connection, $sqlProducts);
                                $countRows = mysqli_num_rows($resultProducts);
                                if ($countRows  > 0) {
                                    if ($countRows >= 4) {
                                        $justify = 'start';
                                    } else {
                                        $justify = 'center';
                                    }
                                    echo '<!-- products from cooming soon category -->
                            <div class="container-fluid products-from-category-container">
                                <div class="row">
                                    <h1 class="col-12 text-center mt-4 mb-lg-3 mb-0">Cooming Soon</h1>
                                </div><br><br>
                                <div class="products-from-category row justify-content-' . $justify . '"> ';

                                    while ($rowProducts = mysqli_fetch_assoc($resultProducts)) {
                                        echo '<div class=" col-xl-3 col-lg-5 col-12">
                                    <a href="products.php?pid=' . $rowProducts['product_id'] . '" class="href product row justify-content-center">
                                        <div class="prod-img col-12 text-center">
                                            <img class="img-fluid" src="inc/pictures/product-picture/' . $rowProducts['picture_cover_url'] . '">
                                        </div>
                                        <div class="prod-details col-12">
                                            <div class="prod-name text-center mb-2">' . $rowProducts['name'] . '</div>
                                            <div class="text-center mb-2"><b>At auction starting from </b><br>' . $rowProducts['sale_start'] . '</div>
                                            <div class="min-price text-center"><b>Reserve price: </b> &euro;' . $rowProducts['starting_price'] . '</div>
                                        </div>    
                                    </a>
                                </div> ';
                                    }
                                    echo '</div>
                            </div><!-- End products from cooming soon category -->';
                                } else {
                                    echo '<h1 class="otherProduct-header mt-5">There are no products to come yet. <i class="fad fa-frown"></i></h1>';
                                }
                            } else {
                                $sqlProducts = "SELECT name, product_id, picture_cover_url, starting_price, sale_start FROM product WHERE category_id IN ( SELECT category_id FROM category WHERE category_name = ? )";
                                // Create prepared statement
                                $stmt = mysqli_stmt_init($connection);
                                // Prepare the prepared statement
                                if (!mysqli_stmt_prepare($stmt, $sqlProducts)) {
                                    echo '<h1 class="otherProduct-header mt-5">There are no products under this Category yet. <i class="fad fa-frown"></i></h1>';
                                } else {
                                    // Bind parameters
                                    mysqli_stmt_bind_param($stmt, 's', $category_name);
                                    // Run parameters
                                    mysqli_stmt_execute($stmt);
                                    $resultProducts = mysqli_stmt_get_result($stmt);
                                    $countRows = mysqli_num_rows($resultProducts);
                                    if ($countRows  > 0) {
                                        if ($countRows >= 4) {
                                            $justify = 'start';
                                        } else {
                                            $justify = 'center';
                                        }
                                        echo '<!-- products from certain category -->
                            <div class="container-fluid products-from-category-container">
                                <div class="row">
                                    <h1 class="col-12 text-center mt-4 mb-lg-3 mb-0">' . $category_name . '</h1>
                                </div><br><br>
                                <div class="products-from-category row  justify-content-' . $justify . '"> ';

                                        while ($rowProducts = mysqli_fetch_assoc($resultProducts)) {
                                            echo '<div class=" col-xl-3 col-lg-5 col-12">
                                    <a href="products.php?pid=' . $rowProducts['product_id'] . '" class="href product row justify-content-center">
                                        <div class="prod-img col-12 text-center">
                                            <img class="img-fluid" src="inc/pictures/product-picture/' . $rowProducts['picture_cover_url'] . '">
                                        </div>
                                        <div class="prod-details col-12">
                                            <div class="prod-name text-center mb-2">' . $rowProducts['name'] . '</div>
                                            <div class="text-center mb-2"><b>At auction starting from </b><br>' . $rowProducts['sale_start'] . '</div>
                                            <div class="min-price text-center"><b>Reserve price: </b> &euro;' . $rowProducts['starting_price'] . '</div>
                                        </div>    
                                    </a>
                                </div> ';
                                        }
                                        echo '</div>
                            </div><!-- End products from certain category -->';
                                    } else {
                                        echo '<h1 class="otherProduct-header mt-5">There are no products under this Category yet. <i class="fad fa-frown"></i></h1>';
                                    }
                                }
                            }
                        }

                        // User searched with product name
                        if (isset($_GET['search'])) {
                            if (!empty($_GET['search'])) {
                                $name = test_input($_GET['search']);
                                $sqlSearch = "SELECT name, product_id, picture_cover_url, starting_price, sale_start FROM product WHERE name LIKE CONCAT('%', ?, '%')";
                                // Create prepared statement
                                $stmt = mysqli_stmt_init($connection);
                                // Prepare the prepared statement
                                if (!mysqli_stmt_prepare($stmt, $sqlSearch)) {
                                    echo '<h1 class="otherProduct-header mt-5">No product found. <i class="fad fa-frown"></i><br> <span class="h4">Try searching another product</span></h1>';
                                } else {
                                    // Bind parameters
                                    mysqli_stmt_bind_param($stmt, 's', $name);
                                    // Run parameters
                                    mysqli_stmt_execute($stmt);
                                    $resultSearch = mysqli_stmt_get_result($stmt);

                                    if (mysqli_num_rows($resultSearch) > 0) {
                                        echo '<!-- products from search -->
                            <div class="container-fluid products-from-category-container">
                                <div class="row">
                                    <h1 class="col-12 text-center mt-4 mb-lg-3 mb-0">Search : ' . $name . '</h1>
                                </div><br><br>
                                <div class="products-from-category row justify-content-center"> ';

                                        while ($rowSearch = mysqli_fetch_assoc($resultSearch)) {
                                            echo '<div class=" col-xl-3 col-lg-5 col-12">
                                    <a href="products.php?pid=' . $rowSearch['product_id'] . '" class="href product row justify-content-center">
                                        <div class="prod-img col-12">
                                            <img class="img-fluid" src="inc/pictures/product-picture/' . $rowSearch['picture_cover_url'] . '">
                                        </div>
                                        <div class="prod-details col-12">
                                            <div class="prod-name text-center mb-2">' . $rowSearch['name'] . '</div>
                                            <div class="text-center mb-2"><b>At auction starting from </b><br>' . $rowSearch['sale_start'] . '</div>
                                            <div class="min-price text-center"><b>Reserve price: </b> &euro;' . $rowSearch['starting_price'] . '</div>
                                        </div>    
                                    </a>
                                   </div> ';
                                        }
                                        echo '</div>
                            </div><!-- End products from certain category -->';
                                    } else {
                                        echo '<h1 class="otherProduct-header mt-5">No product found. <i class="fad fa-frown"></i><br> <span class="h4">Try searching another product</span></h1>';
                                    }
                                }
                            } else {
                                echo '<h1 class="otherProduct-header mt-5">No product found. <i class="fad fa-frown"></i><br> <span class="h4">Try searching another product</span></h1>';
                            }
                        }
                        if (!isset($_GET['search']) && !isset($_GET['category'])) {
                            echo '<h1 class="otherProduct-header mt-5">No product found. <i class="fad fa-frown"></i><br> <span class="h4">Try searching another product</span></h1>';
                        }
                    }
require_once 'inc/php/footer.php';
?>

<!-- Script -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- JS link -->
<script src="inc/js/registration.js"></script>
<script type="text/javascript" src="inc/js/navbar.js"></script>

</body>

</html>