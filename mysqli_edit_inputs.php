<?php
function create_inputs_mysql($result){
  $form = "<form action='cadastra_sabor.php' method='POST'>";
  $i = 0;
  while($row = mysqli_fetch_assoc($result)) {
      if($i == 0){
        $i++;
        $form .= "<div class='form-group'>";

        //create labels
        foreach ($row as $key => $value) {
          $form .= "<label for='$value'>$key</label>";
          $form .= "<input type='text' value='$value' class='form-control' name='editar-$key' id='$value' />";
        }
        $form .= "</div>";
      }
  }
  $form .= "<button type='submit' class='btn btn-success'>Confirmar</button>";
  $form .= "</form>";
  return $form;
}
?>