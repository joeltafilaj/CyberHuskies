<?php

//Deleting sessions after log-out and referencing to log in page
Session_start();

//DB Conncetion to make user 'is_active' false after log out
require_once $_SERVER['DOCUMENT_ROOT'].'/CyberHuskies/inc/db_connection.php'; 
$sql = "UPDATE User SET is_active = false WHERE username = '" . $_SESSION['username'] . "'";
if (mysqli_query($connection, $sql)) {
    Session_destroy();
    header('Location:../home.php');
} else {
    header('Location:/CyberHuskies/inc/error.html');
}
