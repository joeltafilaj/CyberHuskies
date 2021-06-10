<?php 
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/CyberHuskies/inc/functions.php';
$json = array(
    'success' => false,
    'response' => '',
    'count' => 0
);
if (isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'costumer') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['product_id'])) {
            $product_id = test_input($_POST['product_id']);
            require_once $_SERVER['DOCUMENT_ROOT'] . '/CyberHuskies/inc/db_connection.php';
            
            //Inserting product to the wishlist
            $sqlDelete = "DELETE FROM wishlist WHERE product_id = $product_id AND user_id = ".$_SESSION['costumer_id']."";
            if (mysqli_query($connection, $sqlDelete)) {
                
                //Product deleted
                //Counting remaining products in the wishlist
                $sqlCountProduct = "SELECT product_id FROM wishlist WHERE  user_id = ".$_SESSION['costumer_id']."";
                $resultCountProduct = mysqli_query($connection, $sqlCountProduct);
                $json['count'] = mysqli_num_rows($resultCountProduct);
                $json['success'] = true;
            } else {
                $json['response'] = 'error1'; // Internal database error
            }
        }
        //Closing connection with the database
        mysqli_close($connection);
    }
}
echo json_encode($json);
?>