<?php 
$host = "localhost";
$username = "root";
$password = "";
$database = "rmr_sys";

$conn = mysqli_connect($host, $username, $password, $database);
if  (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
// echo "<div class='p-3 mb-2 bg-success'></div>";
?>