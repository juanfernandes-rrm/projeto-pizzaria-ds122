<?php
function create_table_cell($txt){
  return "<td>$txt</td>";
}

function create_table_row($cells){
  $row = "<tr>";
  foreach ($cells as $key => $value) {
    $row .= create_table_cell($value);
  }
  $row .= "</tr>";
  return $row;
}

function create_table_mysql($result){
  $table = "<table class='table table-hover'>";
  $i = 0;
  while($row = mysqli_fetch_assoc($result)) {
      if($i == 0){
        $i++;
        $table .= "<tr>";
        foreach ($row as $key => $value) {
          $table .= "<th>$key</th>";
        }
        $table .= "</tr>";
      }
      $table .= create_table_row($row);
  }
  $table .= "</table>";
  return $table;
}
?>
