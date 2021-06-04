<?php 
session_start();
$json = array(
    'success' => false,
    'response' => ''
);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['bid']) && isset($_POST['product_id'])) {
        $bid = $_POST['bid'];
        $product_id = $_POST['product_id'];

        // Check if costumer already made a bid for this product
        require $_SERVER['DOCUMENT_ROOT'] . '/CyberHuskies/inc/db_connection.php';
        $sqlCheckBid = "SELECT * FROM bid WHERE costumer_id = ".$_SESSION['costumer_id']." AND product_id = $product_id";
        
        if (mysqli_num_rows(mysqli_query($connection, $sqlCheckBid)) == 0) {
            // Inserting this bid to the bid database
            $sqlInsertBid = "INSERT INTO bid VALUES(".$_SESSION['costumer_id'].", $product_id, $bid)";
            
            if (mysqli_query($connection, $sqlInsertBid)) {
                // Checking if new bid is the highiest bid or not
                $sqlCheckHighiest = "SELECT bid_now, name FROM product WHERE product_id = $product_id";
                $resultCheckHighiest = mysqli_query($connection, $sqlCheckHighiest);
                if (mysqli_num_rows($resultCheckHighiest) == 1) {
                    while ($rowCheckHighiest = mysqli_fetch_assoc($resultCheckHighiest)) {

                        // New bid is highier, update our product table
                        if ($rowCheckHighiest['bid_now'] < $bid) {
                            $sqlInsertNewBid = "UPDATE product SET bid_now = $bid, highies_bidder = ".$_SESSION['costumer_id']." WHERE product_id = $product_id";
                            if (mysqli_query($connection, $sqlInsertNewBid)) {
                                // Sending the biding email
                                $to = $_SESSION['email'];
                                $subject = "Cyber Huskies product offer";
                                $message = "<h2 style='font-family: verdana;text-align: center;
                                            color: black;font-size: 40px;'>Thank you for the offer made on our website</h2> <br>
                                    <div style='text-align: center;'>
                                    <h3><b>Product Name:</b> ".$rowCheckHighiest['name']."</h3>
                                    <h3><b>Offer value:</b> $bid&euro;</h3>
                                    <br> <span>You will be notified after the product sale time has ended.</span>
                                        <br><br>
                                    </div>";
                                $headers = "From: Cyber Huskies <huskiescyber@gmail.com> \r\n";
                                $headers .= "MIME-Version: 1.0" . "\r\n";
                                $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";

                                mail($to, $subject, $message, $headers);
                                $json['success'] = true;
                            }
                        } else {
                            // Only send the biding email
                            $to = $_SESSION['email'];
                            $subject = "Cyber Huskies product offer";
                            $message = "<h2 style='font-family: verdana;text-align: center;
                                        color: black;font-size: 40px;'>Thank you for the offer made on our website</h2> <br>
                                <div style='text-align: center;'>
                                <h3><b>Product Name:</b> ".$rowCheckHighiest['name']."</h3>
                                <h3><b>Offer value:</b> $bid&euro;</h3>
                                <br> <span>You will be notified after the product sale time has ended.</span>
                                    <br><br>
                                </div>";
                            $headers = "From: Cyber Huskies <huskiescyber@gmail.com> \r\n";
                            $headers .= "MIME-Version: 1.0" . "\r\n";
                            $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";

                            mail($to, $subject, $message, $headers);
                            $json['success'] = true;
                        }
                    }
                } else {
                    $json['response'] = 'error2'; // Internal Server Error
                }
            } else {
                $json['response'] = 'error2'; // Internal Server Error
            }
            
        } else {
            $json['response'] = 'error1'; // User already made a bid
        }
        mysqli_close($connection);
    }
}
echo json_encode($json);
?>