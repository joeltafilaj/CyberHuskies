<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/CyberHuskies/inc/functions.php';

$json = array(
    'success' => false,
    'firstNameError' => '',
    'lastNameError' => '',
    'usernameError' => '',
    'emailError' => '',
    'passwordError' => '',
    'confirmPasswordError' => '',
    'serverError' => false
);
$validated = true;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['submit'])) {

        // Server side form validation
        if (empty($_POST['first_name'])) {
            $json['firstNameError'] = 'error1'; // Field is empty
            $validated = false;
        } else {
            $first_name = test_input($_POST['first_name']);
        }
        if (empty($_POST['last_name'])) {
            $json['lastNameError'] = 'error1'; // Field is empty
            $validated = false;
        } else {
            $last_name = test_input($_POST['last_name']);
        }
        if (empty($_POST['username'])) {
            $json['usernameError'] = 'error1'; // Field is empty
            $validated = false;
        } else {
            $username = test_input($_POST['username']);
            if (!preg_match("/^[a-zA-Z0-9._]*$/", $username)) {
                $json['usernameError'] = 'error2'; // Username entered is not valid
                $validated = false;
            }
        }
        if (empty($_POST['email'])) {
            $json['emailError'] = 'error1'; // Field is empty
            $validated = false;
        } else {
            $email = test_input($_POST['email']);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $json['emailError'] = 'error2'; // Email entered is not valid
                $validated = false;
            }
        }
        if (empty($_POST['password'])) {
            $json['passwordError'] = 'error1'; // Field is empty
            $validated = false;
        } else {
            $password = test_input($_POST['password']);
            if (strlen($password) < 8) {
                $json['passwordError'] = 'error2'; // Password is to short
                $validated = false;
            }
        }
        if (empty($_POST['confirm_password'])) {
            $json['confirmPasswordError'] = 'error1'; // Field is empty
            $validated = false;
        } else {
            $confirm_password = test_input($_POST['confirm_password']);
            if ($confirm_password != $password) {
                $json['confirmPasswordError'] = 'error2'; // Passwords doesnt match
                $validated = false;
            }
        }
        $phone_number = test_input($_POST['phone_number']);
        $user_type = test_input($_POST['user_type']);

        // After validation completed connect with database
        if ($validated) {
            $json['firstNameError'] = $json['lastNameError'] = $json['usernameError'] = $json['emailError'] = $json['passwordError'] = '';
            require_once $_SERVER['DOCUMENT_ROOT'] . '/CyberHuskies/inc/db_connection.php';

            // Checking on the DB if an username already exist
            $sqlCheckUsername = "SELECT username FROM User WHERE username = '$username'";
            $resultCheckUsername = mysqli_query($connection, $sqlCheckUsername);
            if (mysqli_num_rows($resultCheckUsername) == 0) {

                // Checking on DB if an email already exist
                $sqlCheckEmail = "SELECT email FROM User WHERE email = '$email'";
                $resultCheckEmail = mysqli_query($connection, $sqlCheckEmail);
                if (mysqli_num_rows($resultCheckEmail) == 0) {

                    // Inserting all info to the User DB
                    $password = hash('sha512', $password);

                    // Generating verification key
                    $vkey = sha1(mt_rand(1, 90000) . '$username');
                    $vkey = bin2hex($vkey);

                    $sqlInsert = "INSERT INTO User(username, email, vkey, verified, password, user_type, is_active) VALUES('$username', '$email', '$vkey', 0, '$password', '$user_type', 0)";
                    if (mysqli_query($connection, $sqlInsert)) {
                        $sqlGetUserId = "SELECT user_id FROM User WHERE username = '$username'";
                        $resultGetUserId = mysqli_query($connection, $sqlGetUserId);
                        if (mysqli_num_rows($resultGetUserId) == 1) {
                            while ($rowGetUserId = mysqli_fetch_assoc($resultGetUserId)) {

                                // Inserting all info to the Costumer/Salessman DB
                                if ($user_type == 'costumer') {
                                    $sqlInsertCosutmer = "INSERT INTO Costumer(user_id, first_name, last_name, phone_number) 
                                    VALUES(" . $rowGetUserId['user_id'] . ", '$first_name', '$last_name', '$phone_number')";
                                    if (mysqli_query($connection, $sqlInsertCosutmer)) {

                                        // Sending verification link to the Person email
                                        $to = $email;
                                        $subject = "Email Verification";
                                        $message = "<h2 style='font-family: verdana;text-align: center;
                                          color: black;font-size: 40px;'>Email Verification</h2> <br>
                                        <div style='text-align: center;'>
                                            <a href='http://localhost/CyberHuskies/auctionWeb/authenticate/verified.php?token=$vkey' 
                                            style='text-decoration: none; background-color: brown; border: 1px solid black; border-radius: 5px;color: white; padding: 10px;'>
                                            Click here To verify your email adress.</a><br><br>
                                        </div>";
                                        $headers = "From: Cyber Huskies <huskiescyber@gmail.com> \r\n";
                                        $headers .= "MIME-Version: 1.0" . "\r\n";
                                        $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";

                                        mail($to, $subject, $message, $headers);

                                        $json['success'] = true;
                                    } else {
                                        $json['serverError'] = true;
                                    }
                                } elseif ($user_type == 'salessman') {
                                    $sqlInsertSalessman = "INSERT INTO Salessman(user_id, first_name, last_name, phone_number, totalN_products) 
                                    VALUES(" . $rowGetUserId['user_id'] . ", '$first_name', '$last_name', '$phone_number', 0)";
                                    if (mysqli_query($connection, $sqlInsertSalessman)) {
                                        $json['success'] = true;
                                    } else {
                                        $json['serverError'] = true;
                                    }
                                }
                            }
                        } else {
                            $json['serverError'] = true;
                        }
                    } else {
                        $json['serverError'] = true;
                    }
                } else {
                    $json['emailError'] = 'error3'; // Email aldready exist
                }
            } else {
                $json['usernameError'] = 'error3'; // Username already exist
            }
            mysqli_close($connection);
        }
    }
}
echo json_encode($json);
