<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/CyberHuskies/inc/functions.php';

$json = array(
    'success' => false,
    'response' => ''
);
$validated = true;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //ServerSide validation
    if (empty($_POST['country'])) {
        $json['response'] = 'error1'; // Field is empty
        $validated = false;
    } else {
        $country = test_input($_POST['country']);
    }
    if (empty($_POST['city'])) {
        $json['response'] = 'error1'; // Field is empty
        $validated = false;
    } else {
        $city = test_input($_POST['city']);
    }
    if (empty($_POST['address'])) {
        $json['response'] = 'error1'; // Field is empty
        $validated = false;
    } else {
        $address = test_input($_POST['address']);
    }
    if (empty($_POST['building'])) {
        $json['response'] = 'error1'; // Field is empty
        $validated = false;
    } else {
        $building = test_input($_POST['building']);
    }
    if (empty($_POST['postal'])) {
        $json['response'] = 'error1'; // Field is empty
        $validated = false;
    } else {
        $postal = test_input($_POST['postal']);
    }
    $product_id = $_POST['product_id'];
    // After inputs are validated continue 
    if ($validated) {
        // Insert Shippment info
        require $_SERVER['DOCUMENT_ROOT'] . '/CyberHuskies/inc/db_connection.php';
        $sqlInsertAddress = "INSERT INTO address(country, city, building, zip) VALUES('$country', '$city', '$building', $postal)";
        if (mysqli_query($connection, $sqlInsertAddress)) {
            
            $sqlGetShipping = "SELECT address_id FROM address WHERE country = '$country' AND city = '$city' AND building = '$building' AND zip = $postal LIMIT 1";
            $resultGetShipping = mysqli_query($connection, $sqlGetShipping);
            if (mysqli_num_rows($resultGetShipping) == 1) {
                while ($rowGetShipping = mysqli_fetch_assoc($resultGetShipping)) {
                    // Insert shipping details to bid
                    $sqlInsertShipping = "UPDATE bid SET shippment = ".$rowGetShipping["address_id"].", payed = 1 WHERE product_id = $product_id AND costumer_id = ".$_SESSION['costumer_id']."";
                    if (mysqli_query($connection, $sqlInsertShipping)) {
                         
                        // Sending email
                         $to = $_SESSION['email'];
                         $subject = "Cyber Huskies Auction Page";
                         $message = "<h2 style='font-family: verdana;text-align: center;
                                     color: black;font-size: 40px;'>Thank you for the purchase you made on our website</h2> <br>";
                         $headers = "From: Cyber Huskies <huskiescyber@gmail.com> \r\n";
                         $headers .= "MIME-Version: 1.0" . "\r\n";
                         $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";

                         mail($to, $subject, $message, $headers);
                        $json['success'] = true;
                    } else {
                        $json['response'] = mysqli_error($connection); // Internal error
                    }
                }
            } else {
                $json['response'] = mysqli_error($connection); // Internal error
            }
            
        } else {
            $json['response'] = mysqli_error($connection); // Internal error
        }
        mysqli_close($connection);
    }
}
echo json_encode($json);
?>