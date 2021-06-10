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

            //Check on database if username entered exist
            $sqlCheckUsername = "SELECT username FROM User WHERE username = ?";
            $stmt = mysqli_stmt_init($connection);
            if (!mysqli_stmt_prepare($stmt, $sqlCheckUsername)) {
                $json['usernameError'] = 'error3'; // Username already exist
            } else {
                mysqli_stmt_bind_param($stmt, 's', $username);
                mysqli_stmt_execute($stmt);
                $resultCheckUsername = mysqli_stmt_get_result($stmt);
                if (mysqli_num_rows($resultCheckUsername) == 0) {

                    // Checking on DB if an email already exist
                    $sqlCheckEmail = "SELECT email FROM User WHERE email = ?";
                    $stmt = mysqli_stmt_init($connection);
                    if (!mysqli_stmt_prepare($stmt, $sqlCheckEmail)) {
                        $json['emailError'] = 'error3'; // Email aldready exist
                    } else {
                        mysqli_stmt_bind_param($stmt, 's', $email);
                        mysqli_stmt_execute($stmt);
                        $resultCheckEmail = mysqli_stmt_get_result($stmt);
                        if (mysqli_num_rows($resultCheckEmail) == 0) {
                            
                            // Inserting all info to the User DB
                            $password = hash('sha512', $password); // Encrypting password

                            // Generating verification key
                            $vkey = sha1(mt_rand(1, 90000) . '$username');
                            $vkey = bin2hex($vkey);

                            $sqlInsert = "INSERT INTO User(username, email, vkey, verified, password, user_type, is_active) VALUES(?, ?, ?, 0, ?, ?, 0)";
                            $stmt = mysqli_stmt_init($connection);
                            if (!mysqli_stmt_prepare($stmt, $sqlInsert)) {
                                $json['serverError'] = true;
                            } else {
                                mysqli_stmt_bind_param($stmt, 'sssss', $username, $email, $vkey, $password, $user_type);
                                mysqli_stmt_execute($stmt);

                                //Check on database if username entered exist
                                $sqlGetUserId = "SELECT user_id FROM User WHERE username = ?";
                                $stmt = mysqli_stmt_init($connection);
                                if (!mysqli_stmt_prepare($stmt, $sqlGetUserId)) {
                                    $json['serverError'] = true;
                                } else {
                                    mysqli_stmt_bind_param($stmt, 's', $username);
                                    mysqli_stmt_execute($stmt);
                                    $resultGetUserId = mysqli_stmt_get_result($stmt);
                                    if (mysqli_num_rows($resultGetUserId) == 1) {
                                        while ($rowGetUserId = mysqli_fetch_assoc($resultGetUserId)) {

                                            // Inserting all info to the Costumer/Salessman DB
                                            if ($user_type == 'costumer') {
                                                $sqlInsertCosutmer = "INSERT INTO Costumer(user_id, first_name, last_name, phone_number) 
                                                VALUES(?, ?, ?, ?)";
                                                $stmt = mysqli_stmt_init($connection);
                                                if (!mysqli_stmt_prepare($stmt, $sqlInsertCosutmer)) {
                                                    $json['serverError'] = true;
                                                } else {
                                                    mysqli_stmt_bind_param($stmt, 'isss', $rowGetUserId['user_id'], $first_name, $last_name, $phone_number);
                                                    mysqli_stmt_execute($stmt);

                                                    // Sending verification link to the Person email
                                                    $to = $email;
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

                                                    $json['success'] = true;
                                                }
                                            } elseif ($user_type == 'salessman') {
                                                $sqlInsertSalessman = "INSERT INTO Salessman(user_id, first_name, last_name, phone_number, totalN_products) 
                                                VALUES(?, ?, ?, ?, 0)";
                                                $stmt = mysqli_stmt_init($connection);
                                                if (!mysqli_stmt_prepare($stmt, $sqlInsertSalessman)) {
                                                    $json['serverError'] = true;
                                                } else {
                                                    mysqli_stmt_bind_param($stmt, 'isss', $rowGetUserId['user_id'], $first_name, $last_name, $phone_number);
                                                    mysqli_stmt_execute($stmt);

                                                    // Sending verification link to the Person email
                                                    $to = $email;
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

                                                    $json['success'] = true;

                                                    $json['serverError'] = true;
                                                }
                                            }
                                        }
                                    } else {
                                        $json['serverError'] = true;
                                    }
                                }
                            }
                        } else {
                            $json['emailError'] = 'error3'; // Email aldready exist
                        }
                    }
                } else {
                    $json['usernameError'] = 'error3'; // Username already exist
                }
            }
            mysqli_close($connection);
        }
    }
}
echo json_encode($json);
