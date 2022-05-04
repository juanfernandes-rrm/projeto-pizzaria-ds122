<?php 
include "credentials.php";

//create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());    
}

//create tables
$sql = 
"CREATE TABLE tipo_sabor(
   pkidtipo_sabor INT(6) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
   descricao varchar(50) NOT NULL
)ENGINE = innodb;
";

if(!mysqli_query($conn,$sql)){
    die("Connection failed: " . mysqli_error($conn));
}

$sql = 
"CREATE TABLE sabor(
   pkidsabor INT(6) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
   sabor varchar(50) NOT NULL,
   ingredientes varchar(300),
   fkidtipo_sabor INT UNSIGNED,
   FOREIGN KEY (fkidtipo_sabor) REFERENCES tipo_sabor(pkidtipo_sabor)
);
";

if(!mysqli_query($conn,$sql)){
die("Create failed: " . mysqli_error($conn));
}

echo "Connected successfully";
mysqli_close($conn);

?>