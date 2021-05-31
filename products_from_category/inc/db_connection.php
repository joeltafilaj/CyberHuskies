<?php
$dbservername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "auction";

//Create connection
$connection = mysqli_connect($dbservername, $dbusername, $dbpassword, $dbname);
//Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
