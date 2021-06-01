<?php 
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/CyberHuskies/inc/functions.php';
$json = array(
    'success' => false,
    'response' => ''
);
if (isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'costumer') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['product_id'])) {
            $product_id = test_input($_POST['product_id']);
            require_once $_SERVER['DOCUMENT_ROOT'] . '/CyberHuskies/inc/db_connection.php';
            
            // Checking if product is already on the wishlist
            $sqlCheck = "SELECT product_id FROM wishlist WHERE product_id = $product_id AND user_id = ".$_SESSION['costumer_id']."";
            $resultCheck = mysqli_query($connection, $sqlCheck);
            if (mysqli_num_rows($resultCheck) == 0) {
                //Inserting product to the wishlist
                $sqlInsert = "INSERT INTO wishlist VALUES(".$_SESSION['costumer_id'].", $product_id)";
                if (mysqli_query($connection, $sqlInsert)) {
                    //Product inserted
                    $json['success'] = true;
                } else {
                    $json['response'] = 'error2'; // Internal database error
                }
            } else {
                $json ['response'] = 'error3'; // Product is already on the wishlist
            }
            
            //Closing connection with the database
            mysqli_close($connection);
        }
    }
} else {
    $json['response'] = 'error1'; // User has to log in as costumer in order to interact with wishlist
}

echo json_encode($json);
?>