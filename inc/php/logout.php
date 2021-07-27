<?php

//Deleting sessions after log-out and referencing to log in page
Session_start();
if (isset($_SESSION['username'])) {

    //DB Conncetion to make user 'is_active' false and delete 'Cookie' after log out
    require_once $_SERVER['DOCUMENT_ROOT'] . '/CyberHuskies/inc/db_connection.php';
    $sql = "UPDATE User SET is_active = false WHERE username = ?";
    $stmt = mysqli_stmt_init($connection);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header('Location:../html/error.html');
    } else {
        mysqli_stmt_bind_param($stmt, 's', $_SESSION['username']);
        mysqli_stmt_execute($stmt);
        Session_destroy();
        if (isset($_COOKIE['username'])) {
            setcookie('username', '', time() - 7000000, '/');
            setcookie('verified', '', time() - 7000000, '/');
            setcookie('user_type', '', time() - 7000000, '/');
            setcookie('email', '', time() - 7000000, '/');
        }
        $page = $_SERVER['HTTP_REFERER'];
        header('Location:' . $page . '');
    }
} else {
    header('Location:../html/error.html');
}
