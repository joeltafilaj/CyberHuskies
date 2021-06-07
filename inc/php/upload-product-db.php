<?php
require $_SERVER['DOCUMENT_ROOT'] . '/CyberHuskies/inc/functions.php';
$response = '';
$validated = true;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Server Side validation of each input
    if (empty($_POST['name_input'])) {
        $response = 'Complete name Field';
        $validated = false;
    } else {
        $name = test_input($_POST['name_input']);
    }

    if (empty($_POST['str_price_input'])) {
        $response = 'Complete Starting price Field';
        $validated = false;
    } else {
        $starting_price = test_input($_POST['str_price_input']);
    }

    // Converting date into a format sql can understand, and checking if date entered is not older than current date
    if (empty($_POST['avl_from_input'])) {
        $response = 'Complete Available From Field';
        $validated = false;
    } else {
        $date_available_from = date("Y-m-d H:i", strtotime($_POST['avl_from_input']));
        $now = date("Y-m-d H:i", time());
        if ($date_available_from < $now) {
            $validated = false;
            $response = 'Date of product Available  must be after Today"s current date';
        }
    }
    if (empty($_POST['avl_unt_input'])) {
        $response = 'Complete to Field';
        $validated = false;
    } else {
        $date_available_to = date("Y-m-d H:i:s", strtotime($_POST['avl_unt_input']));
        $now = date("Y-m-d H:i", time());
        if ($date_available_to < $now) {
            $validated = false;
            $response = 'Date of product sale End must be after Today"s current date';
        } else if ($date_available_to <= $date_available_from) {
            $validated = false;
            $response = 'Date of product sale End must be after Date of product Available ';
        }
    }

    if (empty($_POST['cat_input'])) {
        $response = 'Complete Category Field';
        $validated = false;
    } else {
        $category = test_input($_POST['cat_input']);
    }

    if (empty($_POST['desc_input'])) {
        $response = 'Complete description Field';
        $validated = false;
    } else {
        $description = test_input($_POST['desc_input']);
    }

    // Checking file type 
    $image1 = $_FILES["photo_input_1"]["name"];
    $file_type = $_FILES['photo_input_1']['type']; //returns the mimetype

    $allowed = array("image/jpeg", "image/gif", "application/jpg", "application/png");
    if (!in_array($file_type, $allowed)) {
        $response = 'Only jpg, gif, png, and jpeg files are allowed.';
        $validated = false;
    }

    $image2 = $_FILES["photo_input_2"]["name"];
    if ($image2 != 'empty') {
        $file_type = $_FILES['photo_input_2']['type']; //returns the mimetype
        $allowed = array("image/jpeg", "image/gif", "application/jpg", "application/png");
        if (!in_array($file_type, $allowed)) {
            $response = 'Only jpg, gif, png, and jpeg files are allowed.';
            $validated = false;
        }
    }
    $image3 = $_FILES["photo_input_3"]["name"];
    if ($image3 != 'empty') {
        $file_type = $_FILES['photo_input_3']['type']; //returns the mimetype
        $allowed = array("image/jpeg", "image/gif", "application/jpg", "application/png");
        if (!in_array($file_type, $allowed)) {
            $response = 'Only jpg, gif, png, and jpeg files are allowed.';
            $validated = false;
        }
    }

    // If inputs are validated
    if ($validated) {
        //DB connection
        require $_SERVER['DOCUMENT_ROOT'] . '/CyberHuskies/inc/db_connection.php';

        //First we will get category id 
        $sqlGetCategory = "SELECT category_id FROM category WHERE category_name = '$category'";
        $resultGetCategory = mysqli_query($connection, $sqlGetCategory);
        if (mysqli_num_rows($resultGetCategory) == 1) {
            while ($rowGetCategory = mysqli_fetch_assoc($resultGetCategory)) {

                //Checking first if any other product has the same picture_cover_url

                //Inserting values to product database
                $sqlUpload = "INSERT INTO product(name, salessman_id, starting_price, sale_start, sale_end, description, category_id, picture_cover_url)
                VALUES('$name', " . $_SESSION['salessman_id'] . ", $starting_price, '$date_available_from', '$date_available_to', '$description', " . $rowGetCategory['category_id'] . ", '$image1') ";
                if (mysqli_query($connection, $sqlUpload)) {

                    // Geting lates added product
                    $sqlGetLastProductAdded = "SELECT product_id FROM product WHERE product_id IN (SELECT MAX(product_id) FROM product)";
                    $resultsqlGetLastProductAdded = mysqli_query($connection, $sqlGetLastProductAdded);
                    if (mysqli_num_rows($resultsqlGetLastProductAdded) == 1) {
                        while ($rowsqlGetLastProductAdded = mysqli_fetch_assoc($resultsqlGetLastProductAdded)) {
                            // Inserting all images
                            $sqlImages = "INSERT INTO picture(product_id, picture_url) VALUES(" . $rowsqlGetLastProductAdded['product_id'] . ", '$image1')";
                            if (mysqli_query($connection, $sqlImages)) {
                                if ($image2 != '') {
                                    $sqlImages = "INSERT INTO picture(product_id, picture_url) VALUES(" . $rowsqlGetLastProductAdded['product_id'] . ", '$image2')";
                                    if (mysqli_query($connection, $sqlImages)) {
                                        $response = 'Product Addedd Successfully';
                                    }
                                }
                                if ($image3 != '') {
                                    $sqlImages = "INSERT INTO picture(product_id, picture_url) VALUES(" . $rowsqlGetLastProductAdded['product_id'] . ", '$image3')";
                                    if (mysqli_query($connection, $sqlImages)) {
                                        $response = 'Product Addedd Successfully';
                                    }
                                }
                                $response = 'Product Addedd Successfully';
                            }
                        }
                    }
                } else {
                    $response = mysqli_error($connection);
                }
            }
        }
    } else {
    }
}
