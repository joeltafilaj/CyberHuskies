<?php

//Deleting sessions after log-out and referencing to log in page
Session_start();
if (isset($_SESSION['username'])) {

//DB Conncetion to make user 'is_active' false and delete 'Cookie' after log out
require_once $_SERVER['DOCUMENT_ROOT'] . '/CyberHuskies/inc/db_connection.php';
$sql = "UPDATE User SET is_active = false WHERE username = '" . $_SESSION['username'] . "'";
if (mysqli_query($connection, $sql)) {
    Session_destroy();
    if (isset($_COOKIE['username'])) {
        setcookie('username', '', time() - 7000000, '/');
        setcookie('verified', '', time() - 7000000, '/');
    }
    $page = $_SERVER['HTTP_REFERER'];
    header('Location:'.$page.'');
} else {
    header('Location:../html/error.html');
}
} else {
    header('Location:../html/error.html');
}
