<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/CyberHuskies/inc/functions.php';
$json = array(
    'usernameError' => '',
    'response' => ''
);
$validated = true;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['submit'])) {
        // Server Side validation
        if (empty($_POST['username'])) {
            $json['usernameError'] = 'error1'; // Field is empty
            $validated = false;
        } else {
            $username = test_input($_POST['username']);
        }

        // After validation completed connect to DB
        if ($validated) {
            $json['usernameError'] = '';
            require_once $_SERVER['DOCUMENT_ROOT'] . '/CyberHuskies/inc/db_connection.php';
            $sqlSearchUser = "SELECT * FROM User WHERE username = ? LIMIT 1";
            // Create prepared statement
            $stmt = mysqli_stmt_init($connection);
            // Prepare the prepared statement
            if (!mysqli_stmt_prepare($stmt, $sqlSearchUser)) {
                $json['usernameError'] = 'error2'; // No username found
            } else {
                // Bind parameters
                mysqli_stmt_bind_param($stmt, 's', $username);
                // Run parameters
                mysqli_stmt_execute($stmt);
                $resultSearchUser = mysqli_stmt_get_result($stmt);
                if (mysqli_num_rows($resultSearchUser) != 0) {
                    while ($rowSearchUser = mysqli_fetch_assoc($resultSearchUser)) {

                        // Check if account requested is verified
                        if ($rowSearchUser['verified'] == 0) {

                            // If account not verified send a new email verification again
                            $vkey = sha1(mt_rand(1, 90000) . '$username');
                            $vkey = bin2hex($vkey);
                            $sqlEmailVerification = "UPDATE User SET vkey = '$vkey' WHERE vkey = " . $rowSearchUser['vkey'] . "";
                            if (mysqli_query($connection, $sqlEmailVerification)) {
                                $to = $rowSearchUser['email'];
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
                                $json['response'] = 'message1'; // Email not verified. In order to resset your password you need to verify your email first. A confirmation email was sent to your mailbox.
                            } else {
                                $json['response'] = 'message2'; // Server error
                            }
                        } else {

                            // Send Password Resset link
                            $vkey = sha1(mt_rand(1, 90000) . '$username');
                            $vkey = bin2hex($vkey);
                            $sqlEmailVerification = "UPDATE User SET vkey = '$vkey' WHERE vkey = " . $rowSearchUser['vkey'] . "";
                            if (mysqli_query($connection, $sqlEmailVerification)) {
                                $to = $rowSearchUser['email'];
                                $subject = "Password Resset";
                                $message = "<h2 style='font-family: verdana;text-align: center;
                                color: black;font-size: 40px;'>Password Resset</h2> <br>
                            <div style='text-align: center;'>
                                <a href='http://localhost/CyberHuskies/accounts/resset.php?token=$vkey' 
                                style='text-decoration: none; background-color: brown; border: 1px solid black; border-radius: 5px;color: white; padding: 10px;'>
                                Click here to resset your password.</a><br><br>
                            </div>";
                                $headers = "From: Cyber Huskies <huskiescyber@gmail.com> \r\n";
                                $headers .= "MIME-Version: 1.0" . "\r\n";
                                $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";

                                mail($to, $subject, $message, $headers);
                                $json['response'] = 'message3'; // Password resset link sent
                            } else {
                                $json['response'] = 'message2'; // Server error
                            }
                        }
                    }
                } else {
                    $json['usernameError'] = 'error2'; // No username found
                }
            }

            // Closing DB Connection
            mysqli_close($connection);
        }
    }
}
echo json_encode($json);
