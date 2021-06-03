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
                // Check if this bid is the current highiest bid
                $sqlCheckHighiest = "SELECT bid_now FROM product WHERE product_id = $product_id";
                $resultCheckHighiest = mysqli_query($connection, $sqlCheckHighiest);
                if (mysqli_num_rows($resultCheckHighiest) == 1) {
                    while ($rowCheckHighiest = mysqli_fetch_assoc($resultCheckHighiest)) {
                        // Bid is highier than the current bid
                        if ($rowCheckHighiest['bid_now'] < $bid) {
                            $sqlInsertNewBid = "UPDATE product SET bid_now = $bid, highies_bidder = ".$_SESSION['costumer_id']." WHERE product_id = $product_id";
                            if (mysqli_query($connection, $sqlInsertNewBid)) {
                                // New Bid inserted
                                $json['success'] = true;
                            }

                        } else {
                            // This bid is not highier than the current bid so no changes are made
                            $json['success'] = true;
                        }
                    }

                } else {
                    $json['response'] = mysqli_error($connection); // Internal Server Error
                }
                
            } else {
                $json['response'] = mysqli_error($connection); // Internal Server Error
            }
            
        } else {
            $json['response'] = 'error1'; // User already made a bid
        }
        mysqli_close($connection);
    }
}
echo json_encode($json);
?>