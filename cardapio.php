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
            $categoria = $_POST["categoria"];

            $sql = 
            "INSERT INTO sabor(sabor,ingredientes,fkidtipo_sabor) VALUES('{$sabor}','{$ingredientes}','{$categoria}');
            ";

            if(!mysqli_query($conn,$sql)){
                die("Insert failed: " . mysqli_error($conn));
            }
            mysqli_close($conn);

        }else if(isset($_POST["editar-sabor"])){
            $id = $_POST["editar-pkidsabor"];
            $sabor = $_POST["editar-sabor"];
            $ingredientes = $_POST["editar-ingredientes"];

            $sql="UPDATE sabor SET sabor='$sabor', ingredientes='$ingredientes' WHERE pkidsabor=$id ";

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
                $sql="DELETE FROM sabor WHERE pkidsabor={$id} ";

                if(!mysqli_query($conn,$sql)){
                    die("Delete failed: " . mysqli_error($conn));
                }

                mysqli_close($conn);
            }
        }
    }
?>

<?php
    
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizzaria - Cardápio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/navbar.css"></head>
<body>
    <header>
            <div class="header-brand container-fluid row align-items-center">
                <div class="col-auto me-auto">
                    <a class="navbar-brand" href="#">
                        <img src="img/dom-da-pizza.png" alt="Dom da Pizza" style="background-color: #fff;">
                    </a>
                </div>
                <div class="col-auto d-none d-md-block">
                    <img src="img/tels.png" alt="" class="img-fluid" style="height: 120px;">
                </div>
            </div>
            <nav class="navbar navbar-expand-lg navbar-light bg-primary">
                <div class="container-fluid">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="index.html">Home</a>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="cardapio.php" id="navbarDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Cardápio
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="cardapio.php#pizzas-salgadas">Pizzas salgadas</a>
                                    </li>
                                    <li><a class="dropdown-item" href="cardapio.php#pizzas-doces">Pizzas doces</a></li>
                                </ul>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="contato.html">Contato</a>
                            </li>

                        </ul>

                    </div>
                </div>
            </nav>
        </header>

        <main>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cadastrar novo sabor</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <form action="<?= $_SERVER['PHP_SELF']?>" method="post">
                            <div class="form-group">
                              <label for="sabor">Sabor</label>
                              <input type="text" class="form-control" name="cadastrar-sabor" id="sabor" aria-describedby="helpId">
                              <label for="ingrediente">Ingredientes</label>
                              <input type="text" class="form-control" name="ingrediente" id="ingrediente" aria-describedby="helpId">
                              <label for="categoria">Categoria do sabor</label>
                              <select class="form-control" name="categoria" id="categoria">
                                <option value="" selected = selected>Selecione uma categoria</option>
                                <?php 
                                    //consertar esse combo box
                                    $conn = new mysqli($servername, $username, $password, $dbname);
                                    $sql = "SELECT pkidtipo_sabor,descricao FROM tipo_sabor";

                                    if(!$result=mysqli_query($conn,$sql)){
                                        die("Select combox failed: " . mysqli_error($conn));
                                    }

                                    $total = mysqli_num_rows($result);
                                    mysqli_close($conn);

                                    $option = "<option>";
                                    if($total>0){
                                        while($line = mysqli_fetch_assoc($result)){
                                            echo "<option value='". $line["pkidtipo_sabor"] ."'>". $line["descricao"] ."</option>";
                                        }
                                    }
                                ?> 
                              </select>
                            </div>
                            <input type="submit" name="cadastrar" class="btn btn-success" value="Cadastrar"/>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>

        <div name="tamanhos">
            <img src="img/tamanhos.png" alt="tamanhos das pizzas" class="img-fluid">
        </div>
        
        <!-- Button modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Cadastrar sabor
        </button>


        <div class="container">
        <?php
            $conn = new mysqli($servername, $username, $password, $dbname);
            $sql = "SELECT sabor.pkidsabor,sabor.sabor,sabor.ingredientes,tipo_sabor.descricao 
                    FROM sabor, tipo_sabor
                    WHERE sabor.fkidtipo_sabor = tipo_sabor.pkidtipo_sabor";
            if(!$result = mysqli_query($conn,$sql)){
                die("Select failed: " . mysqli_error($conn));
            }
            mysqli_close($conn);

            if (mysqli_num_rows($result) > 0) {
                echo create_table_mysql($result);
            } else {
                echo "0 results";
            }
        ?>
        </div>
    </main>


    <footer>
        <nav>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="">Sobre</a></li>
                <li><a href="">Lojas</a></li>
                <li><a href="cardapio.php">Cardápio</a>
                    <ul>
                        <li><a href="cardapio.php#pizzas-salgadas">Pizzas salgadas</a></li>
                        <li><a href="cardapio.php#pizzas-doces">Pizzas doces</a></li>
                    </ul>
                </li>
                <li>
                    <a href="contato.html">Contato</a>
                </li>
            </ul>
        </nav>
        <address>
            <div name="redes-sociais">
                <a href="https://www.facebook.com/Domdapizza">Facebook</a>
                <a href="https://www.instagram.com/domdapizzaoficial/">Instagram</a>
            </div>
            <div name="tel">
                <ul>
                    <li>
                        <p name="loja">Pinhais </p>
                        <a href="tel:+554136011626">3601-1626</a>
                        <p>Avenida Maringá, n° 2845 – Atuba – Pinhais</p>
                    </li>
                    <li>
                        <p name="loja">Curitiba - Bacacheri</p>
                        <a href="tel:+554133561626"> 3356-1626</a>
                        <p>Avenida Erasto Gaertner, n° 2377 – Bacacheri – Curitiba</p>
                    </li>
                </ul>
            </div>
        </address>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
</body>
</html>
