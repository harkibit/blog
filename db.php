<?php 
$servername = "localhost";
$username = "root";
$dbname = "blog";
$password = "";

$con = new mysqli($servername, $username, $password, $dbname);
if(mysqli_connect_errno()){
    echo "failed to connect" .mysqli_connect_errno();
}
