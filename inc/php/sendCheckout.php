<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/CyberHuskies/inc/functions.php';
$json = array(
    'success' => false,
    'response' => ''
);
$validated = true;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Server Side validation
    if (empty($_POST['product_id'])) {
        $json['response'] = 'error1'; // Field is empty
        $validated = false;
    } else {
        $product_id = test_input($_POST['product_id']);
    }

    // After validation completed connect to DB
    if ($validated) {
        require $_SERVER['DOCUMENT_ROOT'] . '/CyberHuskies/inc/db_connection.php';
        
        // Get costumer email and bid information
        $sqlEmail = "SELECT email FROM user WHERE user_id IN(SELECT user_id FROM costumer WHERE costumer_id IN (SELECT highies_bidder FROM product WHERE product_id = $product_id))";
        $resultEmail = mysqli_query($connection, $sqlEmail);
        if (mysqli_num_rows($resultEmail) == 1) {
            while ($rowEmail = mysqli_fetch_assoc($resultEmail)) {
                $sqlBidInfo = "SELECT name, bid_now, sale_end, highies_bidder FROM product WHERE product_id = $product_id";
                $resultBidInfo = mysqli_query($connection, $sqlBidInfo);
                if (mysqli_num_rows($resultBidInfo) == 1) {
                    while ($rowBidInfo = mysqli_fetch_assoc($resultBidInfo)) {
                        
                        // Sending session id token
                        $sqlSessionId = "SELECT * FROM bid WHERE costumer_id = " . $rowBidInfo['highies_bidder'] . " AND product_id = $product_id";
                        $resultSessionId = mysqli_query($connection, $sqlSessionId);
                        if (mysqli_num_rows($resultSessionId) == 1) {
                            while ($rowSessionId = mysqli_fetch_assoc($resultSessionId)) {
                                
                                // Updateing email_checkout status
                                $sqlEmailStatus = "UPDATE product SET email_checkout = 1 WHERE product_id = $product_id";
                                if (mysqli_query($connection, $sqlEmailStatus)) {
                                    
                                    // Sending the biding email
                                    $to = $rowEmail['email'];
                                    $subject = "Cyber Huskies Auction Page";
                                    $message = "<h2 style='font-family: verdana;text-align: center;
                                                    color: black;font-size: 40px;'>We are glad to inform, that you won the auction.</h2> <br>
                                                    <h3 style='text-align: center;
                                                    color: black;font-size: 30px;'><b>Product:</b> " . $rowBidInfo['name'] . " </h3>
                                                    <h3 style='text-align: center;
                                                    color: black;font-size: 30px;'><b>Your winning bid:</b> " . $rowBidInfo['bid_now'] . "&euro; </h3>
                                                    <h3 style='text-align: center;
                                                    color: black;font-size: 30px;'><b>Auction ended at :</b> " . $rowBidInfo['sale_end'] . "</h3>
                                                    <div style='text-align: center;'>
                                                    <a href='http://localhost/CyberHuskies/checkout.php?sessionid=" . $rowSessionId['sessionid'] . "' 
                                                    style='text-decoration: none; background-color: brown; border: 1px solid black; border-radius: 5px;color: white; padding: 10px;'>
                                                    Click here To proceed with Checkout.</a><br><br>
                                                </div>";
                                    $headers = "From: Cyber Huskies <huskiescyber@gmail.com> \r\n";
                                    $headers .= "MIME-Version: 1.0" . "\r\n";
                                    $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
                                    mail($to, $subject, $message, $headers);
                                    $json['success'] = true;
                                } else {
                                    $json['response'] = mysqli_error($connection); // Internal Server Error
                                }
                            }
                        } else {
                            $json['response'] = mysqli_error($connection); // Internal Server Error
                        }
                    }
                }
                $json['response'] = mysqli_error($connection); // Internal Server Error
            }
        } else {
            $json['response'] = mysqli_error($connection); // Internal Server Error
        }
        // Closing DB Connection
        mysqli_close($connection);
    }
}
echo json_encode($json);
