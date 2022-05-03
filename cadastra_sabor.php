<?php
    include "credentials.php";
    require_once 'mysqli_table.php';

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());    
    }

    //
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST["cadastrar-sabor"])){
            $sabor = $_POST["cadastrar-sabor"];
            $ingredientes = $_POST["ingrediente"];

            $sql = 
            "INSERT INTO sabores(sabor,ingredientes) VALUES('{$sabor}','{$ingredientes}');
            ";

            if(!mysqli_query($conn,$sql)){
                die("Insert failed: " . mysqli_error($conn));
            }
            mysqli_close($conn);

        }else if(isset($_POST["editar-sabor"])){
            $id = $_POST["editar-pkidsabor"];
            $sabor = $_POST["editar-sabor"];
            $ingredientes = $_POST["editar-ingredientes"];

            $sql="UPDATE sabores SET sabor='$sabor', ingredientes='$ingredientes' WHERE pkidsabor=$id ";

            if(!mysqli_query($conn,$sql)){
                die("Update failed: " . mysqli_error($conn));
            }
            mysqli_close($conn);
        }
    }else if($_SERVER["REQUEST_METHOD"] == "GET"){
        if(isset($_GET["acao"]) && isset($_GET["id"])){

            $sql="";
            $id=$_GET["id"];
            //fazer tratamento de dados
            
            if($_GET["acao"]=="deletar"){
                $sql="DELETE FROM {$tablename} WHERE pkidsabor={$id} ";

                if(!mysqli_query($conn,$sql)){
                    die("Delete failed: " . mysqli_error($conn));
                }

                mysqli_close($conn);
            }
        }
    }

    //
    

    echo "Connected successfully";
?>

<?php
$conn = new mysqli($servername, $username, $password, $dbname);
$sql = "SELECT pkidsabor,sabor,ingredientes FROM sabores";
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
      echo create_table_mysql($result);
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
