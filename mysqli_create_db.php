<?php 

include "credentials.php";

//create connection
$conn = new mysqli($servername, $username, $password);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());    
}

//create database
$sql = "CREATE DATABASE $dbname";
if(!mysqli_query($conn,$sql)){
    die("Connection failed: " . mysqli_error($conn));
}

echo "Connected successfully";
mysqli_close($conn);

?>