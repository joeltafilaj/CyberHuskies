<?php
require $_SERVER['DOCUMENT_ROOT'] . '/CyberHuskies/inc/functions.php';
$response = '';
$validated = true;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Server side validation of each input
    if (empty($_POST['name_input'])) {
        $response = 'Complete name Field';
        $validated = false;
    } else {
        $name = test_input($_POST['name_input']);
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
    if ($image1 != '') {
        $file_type1= $_FILES['photo_input_1']['type']; //returns the mimetype
        $allowed1 = array("image/jpeg", "image/gif", "application/jpg", "application/png");
        if (!in_array($file_type1, $allowed1)) {
            $response = 'Only jpg, gif, png, and jpeg files are allowed1.';
            $validated = false;
        }
    }

    $image2 = $_FILES["photo_input_2"]["name"];
    if ($image2 != '') {
        $file_type2 = $_FILES['photo_input_2']['type']; //returns the mimetype
        $allowed2 = array("image/jpeg", "image/gif", "application/jpg", "application/png");
        if (!in_array($file_type2, $allowed2)) {
            $response = 'Only jpg, gif, png, and jpeg files are allowed2.';
            $validated = false;
        }
    }
    $image3 = $_FILES["photo_input_3"]["name"];
    if ($image3 != '') {
        $file_type3 = $_FILES['photo_input_3']['type']; //returns the mimetype
        $allowed3 = array("image/jpeg", "image/gif", "application/jpg", "application/png");
        if (!in_array($file_type3, $allowed3)) {
            $response = 'Only jpg, gif, png, and jpeg files are allowed3';
            $validated = false;
        }
    }

    if ($validated) {
        //DB connection
        require $_SERVER['DOCUMENT_ROOT'] . '/CyberHuskies/inc/db_connection.php';

        //First we will get category id 
        $sqlGetCategory = "SELECT category_id FROM category WHERE category_name = '$category'";
        $resultGetCategory = mysqli_query($connection, $sqlGetCategory);
        if (mysqli_num_rows($resultGetCategory) == 1) {
            while ($rowGetCategory = mysqli_fetch_assoc($resultGetCategory)) {

                //Inserting values to product database, after checking weather user wants to change cover picture or not
                if ($image1 == '') {
                    $sqlUpload = "UPDATE product SET name = '$name', description = '$description' , category_id = " . $rowGetCategory['category_id'] . " WHERE product_id = $product_id";
                } else {
                    $sqlUpload = "UPDATE product SET name = '$name', description = '$description' , category_id = " . $rowGetCategory['category_id'] . ", picture_cover_url = '$image1' WHERE product_id = $product_id";
                }

                if (mysqli_query($connection, $sqlUpload)) {

                    // Inserting new images if found
                    if ($image2 != '') {
                        $sqlImages = "INSERT INTO picture(product_id, picture_url) VALUES($product_id, '$image2')";
                        if (mysqli_query($connection, $sqlImages)) {
                            $response = 'Product Addedd Successfully';
                        }
                    }
                    if ($image3 != '') {
                        $sqlImages = "INSERT INTO picture(product_id, picture_url) VALUES($product_id, '$image3')";
                        if (mysqli_query($connection, $sqlImages)) {
                            $response = 'Product Addedd Successfully';
                        }
                    }
                    $response = 'Product Addedd Successfully';
                } else {
                    $response = mysqli_error($connection);
                }
            }
        }
    } else {
    }
}
