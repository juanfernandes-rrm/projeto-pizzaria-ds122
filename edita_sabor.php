<?php
include "credentials.php";
require_once "mysqli_edit_inputs.php";

//edita_sabor.php?id=x
$id = $_GET["id"];
$conn = new mysqli($servername, $username, $password, $dbname);

$sql = "SELECT pkidsabor,sabor,ingredientes FROM sabores WHERE pkidsabor={$id}";
$result = mysqli_query($conn, $sql);
mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
<head>
  <title>Teste PHP</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
  <h1>Sabores</h1>
  <?php
  if (mysqli_num_rows($result) > 0) {
      echo create_inputs_mysql($result);
  } else {
      echo "0 results";
  }
  ?>
  <h2>Teste</h2>
  
  <?php
  //fazer lógica para os sabores cadastrados no banco aparacerem aqui
  ?>
</div>
</body>
</html>