<?php 

include "credentials.php";

//create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());    
}

//create table
$sql = 
"CREATE TABLE sabores(
   pkidsabor INT(6) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
   sabor varchar(50) NOT NULL,
   ingredientes varchar(300)
);
";

if(!mysqli_query($conn,$sql)){
die("Connection failed: " . mysqli_error($conn));
}

echo "Connected successfully";
mysqli_close($conn);

?>