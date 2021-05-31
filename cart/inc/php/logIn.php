<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/CyberHuskies/inc/functions.php';

$json = array(
    'success' => false,
    'usernameError' => '',
    'passwordError' => ''
);
$validated = true;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //if Log in submit button is clicked 
    if (isset($_POST['submit'])) {

        //ServerSide validation
        if (empty($_POST['username'])) {
            $json['usernameError'] = 'error1'; // Field is empty
            $validated = false;
        } else {
            $username = test_input($_POST['username']);
        }
        if (empty($_POST['password'])) {
            $json['passwordError'] = 'error1'; // Field is empty
            $validated = false;
        } else {
            $password = test_input($_POST['password']);
            if (strlen($password) < 8) {
                $json['passwordError'] = 'error2'; // Password is too short
                $validated = false;
            }
        }
        $rememberMe = $_POST['rememberMe'];
        $password = hash('sha512', $password);
        //Connect to DB after input Validated successfully
        if ($validated) {
            $json['usernameError'] = '';
            $json['passwordError'] = '';
            require_once $_SERVER['DOCUMENT_ROOT'] . '/CyberHuskies/inc/db_connection.php';
            
            //Check on database if username entered exist
            $sqlCredentials = "SELECT * FROM user WHERE username = '$username'";
            $resultCredentials = mysqli_query($connection, $sqlCredentials);
            if (mysqli_num_rows($resultCredentials) == 1) {
                while ($rowCredentials = mysqli_fetch_assoc($resultCredentials)) {
                    
                    //check on database if password match for the user
                    if ($rowCredentials['password'] === $password) {
                        
                        //Assisging sessions
                        session_start();
                        $_SESSION['username'] = $rowCredentials['username'];
                        $_SESSION['user_type'] = $rowCredentials['user_type'];

                        //Making user active
                        $sqlActiveStatus = "UPDATE User SET is_active = 1 WHERE user_id = " . $rowCredentials['user_id'] . "";
                        if (mysqli_query($connection, $sqlActiveStatus)) {

                            //Remember me Cookie
                            if ($rememberMe == 'true') {
                                setcookie("username", $username, time() + (86400 * 14), "/");
                                setcookie("verified", $rowCredentials['verified'], time() + (86400 * 14), "/");

                            }
                            $json['success'] = true;
                        }
                    } else {
                        $json['passwordError'] = 'error3'; // Password is not correct
                    }
                }
            } else {
                $json['usernameError'] = 'error2'; // Username not found on DB
            }
            mysqli_close($connection);
        }
    }
}
echo json_encode($json);
