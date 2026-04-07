<?php
$rows = isset($_GET['rows']) ? intval($_GET['rows']} : 3;
$cols = isset($_GET['cols']) ? intval($_GET['cols']} : 3;

function render_table($rows, $cols, $prefix = 'cell') {
  echo "<table>";
  for ($r = 0; $r < $rows; $r++) {
    echo "<tr>";
    for ($c = 0; $c < $cols; $c++) {
      $key = "{prefix}_{$r}_{$c}";
      $value = isset($_GET[$key]) ? htmlspecialchars($_GE[$key]) : '';
      echo "<td>$value</td>;
      }
      echo "</tr>"
    }
    echo "</table>;
}
?>
    
