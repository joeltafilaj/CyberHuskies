<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/CyberHuskies/inc/functions.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['product_id'])) {
        $product_id = test_input($_POST['product_id']);
        require_once $_SERVER['DOCUMENT_ROOT'] . '/CyberHuskies/inc/functions.php';
        $sqlChangeStatus = "UPDATE product SET status = 0 WHERE product_id = $product_id";
        if (mysqli_query($connection, $sqlChangeStatus)) {
            // success
        } else {
            // errorr
        }
        mysqli_close($connection);
    }
}

?>