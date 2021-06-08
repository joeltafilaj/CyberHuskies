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
    if ($image2 != '') {
        $file_type = $_FILES['photo_input_2']['type']; //returns the mimetype
        $allowed = array("image/jpeg", "image/gif", "application/jpg", "application/png");
        if (!in_array($file_type, $allowed)) {
            $response = 'Only jpg, gif, png, and jpeg files are allowed.';
            $validated = false;
        }
    }
    $image3 = $_FILES["photo_input_3"]["name"];
    if ($image3 != '') {
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

        // Check if costumer has an verified account
        $sqlVerified = "SELECT verified, username, vkey, email FROM user WHERE user_id = " . $_SESSION['user_id'] . "";
        $resultVerified = mysqli_query($connection, $sqlVerified);
        if (mysqli_num_rows($resultVerified) == 1) {
            while ($rowVerified = mysqli_fetch_assoc($resultVerified)) {

                // If Verified, proceed
                if ($rowVerified['verified'] != 0) {

                    //First we will get category id 
                    $sqlGetCategory = "SELECT category_id FROM category WHERE category_name = ?";
                    // Create prepared statement
                    $stmt = mysqli_stmt_init($connection);
                    // Prepare the prepared statement
                    if (!mysqli_stmt_prepare($stmt, $sqlGetCategory)) {
                    } else {
                        // Bind parameters
                        mysqli_stmt_bind_param($stmt, 's', $category);
                        // Run parameters
                        mysqli_stmt_execute($stmt);
                        $resultGetCategory = mysqli_stmt_get_result($stmt);
                        if (mysqli_num_rows($resultGetCategory) == 1) {
                            while ($rowGetCategory = mysqli_fetch_assoc($resultGetCategory)) {

                                //Inserting values to product database
                                $sqlUpload = "INSERT INTO product(name, salessman_id, starting_price, sale_start, sale_end, description, category_id, picture_cover_url)
                                    VALUES(?, ?, ?, ?, ?, ?, ?, ?) ";
                                // Create prepared statement
                                $stmt = mysqli_stmt_init($connection);
                                // Prepare the prepared statement
                                if (!mysqli_stmt_prepare($stmt, $sqlUpload)) {
                                    $response = mysqli_stmt_error($stmt);
                                } else {
                                    // Bind parameters
                                    mysqli_stmt_bind_param($stmt, 'siisssis', $name, $_SESSION['salessman_id'], $starting_price, $date_available_from, $date_available_to, $description, $rowGetCategory['category_id'], $image1);
                                    // Run parameters
                                    mysqli_stmt_execute($stmt);

                                    // Geting lates added product
                                    $sqlGetLastProductAdded = "SELECT product_id FROM product WHERE product_id IN (SELECT MAX(product_id) FROM product)";
                                    $resultsqlGetLastProductAdded = mysqli_query($connection, $sqlGetLastProductAdded);
                                    if (mysqli_num_rows($resultsqlGetLastProductAdded) == 1) {
                                        while ($rowsqlGetLastProductAdded = mysqli_fetch_assoc($resultsqlGetLastProductAdded)) {
                                            // Inserting all images
                                            $sqlImages = "INSERT INTO picture(product_id, picture_url) VALUES(?, ?)";
                                            // Create prepared statement
                                            $stmt = mysqli_stmt_init($connection);
                                            // Prepare the prepared statement
                                            if (!mysqli_stmt_prepare($stmt, $sqlImages)) {
                                                $response = mysqli_stmt_error($stmt);
                                            } else {
                                                // Bind parameters
                                                mysqli_stmt_bind_param($stmt, 'is', $rowsqlGetLastProductAdded['product_id'], $image1);
                                                // Run parameters
                                                mysqli_stmt_execute($stmt);

                                                if ($image2 != '') {
                                                    $sqlImages = "INSERT INTO picture(product_id, picture_url) VALUES(?, ?)";
                                                    // Create prepared statement
                                                    $stmt = mysqli_stmt_init($connection);
                                                    // Prepare the prepared statement
                                                    if (!mysqli_stmt_prepare($stmt, $sqlImages)) {
                                                        $response = mysqli_stmt_error($stmt);
                                                    } else {
                                                        // Bind parameters
                                                        mysqli_stmt_bind_param($stmt, 'is', $rowsqlGetLastProductAdded['product_id'], $image2);
                                                        // Run parameters
                                                        mysqli_stmt_execute($stmt);
                                                        $response = 'Product Addedd Successfully';
                                                    }
                                                }
                                                if ($image3 != '') {
                                                    $sqlImages = "INSERT INTO picture(product_id, picture_url) VALUES(?, ?)";
                                                    // Create prepared statement
                                                    $stmt = mysqli_stmt_init($connection);
                                                    // Prepare the prepared statement
                                                    if (!mysqli_stmt_prepare($stmt, $sqlImages)) {
                                                        $response = mysqli_stmt_error($stmt);
                                                    } else {
                                                        // Bind parameters
                                                        mysqli_stmt_bind_param($stmt, 'is', $rowsqlGetLastProductAdded['product_id'], $image3);
                                                        // Run parameters
                                                        mysqli_stmt_execute($stmt);
                                                        $response = 'Product Addedd Successfully';
                                                    }
                                                }
                                                $response = 'Product Addedd Successfully';
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                    // If not verified , show error and send verification link
                } else {
                    $vkey = sha1(mt_rand(1, 90000) . '' . $rowVerified['username'] . '');
                    $vkey = bin2hex($vkey);
                    $sqlEmailVerification = "UPDATE User SET vkey = '$vkey' WHERE vkey = " . $rowVerified['vkey'] . "";
                    if (mysqli_query($connection, $sqlEmailVerification)) {
                        $to = $rowVerified['email'];
                        $subject = "Email Verification";
                        $message = "<h2 style='font-family: verdana;text-align: center;
                            color: black;font-size: 40px;'>Email Verification</h2> <br>
                        <div style='text-align: center;'>
                            <a href='http://localhost/CyberHuskies/accounts/verified.php?token=$vkey' 
                            style='text-decoration: none; background-color: brown; border: 1px solid black; border-radius: 5px;color: white; padding: 10px;'>
                            Click here To verify your email adress.</a><br><br>
                        </div>";
                        $headers = "From: Cyber Huskies <huskiescyber@gmail.com> \r\n";
                        $headers .= "MIME-Version: 1.0" . "\r\n";
                        $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";

                        mail($to, $subject, $message, $headers);
                        $response = 'Email not verified. In order to make a bid you need to verify your email first. A confirmation email was sent to your mailbox.';
                    } else {
                        $json['response'] = 'error2'; // Internal Server Error
                    }
                }
            }
        }
    } else {
    }
}
