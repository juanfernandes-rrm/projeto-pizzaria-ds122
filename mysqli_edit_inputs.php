<?php
function create_combobox($value_selected){
  include "credentials.php";
  $conn = new mysqli($servername, $username, $password, $dbname);
  $sql = "SELECT pkidtipo_sabor,descricao FROM tipo_sabor";

  if(!$result=mysqli_query($conn,$sql)){
    die("Select combox failed: " . mysqli_error($conn));
  }

  $total = mysqli_num_rows($result);
  mysqli_close($conn);

  $select = "<div><select class='form-select' >";
  if($total>0){
    while($line = mysqli_fetch_assoc($result)){
      if($line["descricao"] == $value_selected){
        $select .= "<option value='". $line["pkidtipo_sabor"] ."' selected>". $line["descricao"] ." </option>";
      }else{
        $select .= "<option value='". $line["pkidtipo_sabor"] ."'>". $line["descricao"] ."</option>";
      }
    }
  }
  $select .= "</select></div>";
  return $select;
}

function create_inputs_mysql($result){
  $form = "<form action='cardapio.php' method='POST'>";
  $i = 0;
  while($row = mysqli_fetch_assoc($result)) {
      if($i == 0){
        $i++;
        $form .= "<div class='form-group'>";

        //create labels
        foreach ($row as $key => $value) {
          if(!($key == "descricao")){
              if($key == "pkidsabor"){
                $form .= "<input type='hidden' value='$value' class='form-control' name='editar-$key' id='$value'/>";
              }else{
                $form .= "<label for='$value'>$key</label>";
                $form .= "<input type='text' value='$value' class='form-control' name='editar-$key' id='$value' />";
              }
            }else if($key == "descricao"){
              $form .= "<label for='$value'>$key</label>";
              $form .= create_combobox($value);
          }
        }
        $form .= "</div>";
      }
  }
  $form .= "<button type='submit' class='btn btn-success'>Confirmar</button>";
  $form .= "</form>";
  return $form;
}
?>