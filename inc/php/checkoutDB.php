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
        require $_SERVER['DOCUMENT_ROOT'] . '/CyberHuskies/inc/db_connection.php';
        
        // Check if user has an verified emal || send verification email
        $sqlVerified = "SELECT verified, username, vkey, email FROM user WHERE user_id = " . $_SESSION['user_id'] . "";
        $resultVerified = mysqli_query($connection, $sqlVerified);
        if (mysqli_num_rows($resultVerified) == 1) {
            while ($rowVerified = mysqli_fetch_assoc($resultVerified)) {
                if ($rowVerified['verified'] == 0) {
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
                        $json['response'] = 'error2'; // Email not verified. In order to make a bid you need to verify your email first. A confirmation email was sent to your mailbox.
                    } else {
                        $json['response'] = mysqli_error($connection); // Internal Server Error
                    }
                } else {

                    // Check if payment has already been paid
                    $sqlCheckPayment = "SELECT payed FROM bid WHERE product_id = ? AND costumer_id = ?";
                    $stmt = mysqli_stmt_init($connection);
                    if (!mysqli_stmt_prepare($stmt, $sqlCheckPayment)) {
                        $json['response'] = mysqli_stmt_error($stmt); // server error
                    } else {
                        mysqli_stmt_bind_param($stmt, 'ii', $product_id, $_SESSION['costumer_id']);
                        mysqli_stmt_execute($stmt);
                        $resultCheckPayement = mysqli_stmt_get_result($stmt);
                        while ($rowCheckPayment = mysqli_fetch_assoc($resultCheckPayement)) {
                            if ($rowCheckPayment['payed'] == 1) {
                                $json['response'] = 'error3'; // Payment has already been made
                            } else {

                                // Insert Shippment info
                                $sqlInsertAddress = "INSERT INTO address(country, city, building, zip) VALUES(?, ?, ?, ?)";
                                $stmt = mysqli_stmt_init($connection);
                                if (!mysqli_stmt_prepare($stmt, $sqlInsertAddress)) {
                                    $json['response'] = mysqli_stmt_error($stmt); // server error
                                } else {
                                    mysqli_stmt_bind_param($stmt, 'sssi', $country, $city, $building, $postal);
                                    mysqli_stmt_execute($stmt);

                                    // Select the address inserted earlier
                                    $sqlGetShipping = "SELECT address_id FROM address WHERE country = ? AND city = ? AND building = ? AND zip = ? LIMIT 1";
                                    $stmt = mysqli_stmt_init($connection);
                                    if (!mysqli_stmt_prepare($stmt,  $sqlGetShipping)) {
                                        $json['response'] = mysqli_stmt_error($stmt); // server error
                                    } else {
                                        mysqli_stmt_bind_param($stmt, 'sssi', $country, $city, $building, $postal);
                                        mysqli_stmt_execute($stmt);
                                        $resultGetShipping = mysqli_stmt_get_result($stmt);
                                        if (mysqli_num_rows($resultGetShipping) == 1) {
                                            while ($rowGetShipping = mysqli_fetch_assoc($resultGetShipping)) {

                                                // Insert shipping details to bid
                                                $sqlInsertShipping = "UPDATE bid SET shippment = ?, payed = 1 WHERE product_id = ? AND costumer_id = ?";
                                                $stmt = mysqli_stmt_init($connection);
                                                if (!mysqli_stmt_prepare($stmt, $sqlInsertShipping)) {
                                                    $json['response'] = mysqli_stmt_error($stmt); // server error
                                                } else {
                                                    mysqli_stmt_bind_param($stmt, 'iii', $rowGetShipping["address_id"], $product_id, $_SESSION['costumer_id']);
                                                    mysqli_stmt_execute($stmt);

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
                                                }
                                            }
                                        } else {
                                            $json['response'] = mysqli_stmt_error($stmt); // server error
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        mysqli_close($connection);
    }
}
echo json_encode($json);
