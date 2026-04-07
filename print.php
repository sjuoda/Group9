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
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="author" content="Evan Waselkow">
  <meta name="keywords" content="CSU, Computer Science, CS 312, CS312, Cats">
  <meta name="description"
        content="Color coordinator table for our group project">
  <title>Print View - Color Coordinator</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="header">
  <img src="colored-logo.png" alt="Company Logo" class="logo"> 
  
  <h1>Group 9 - Color Coordinator</h1>
</div>

<h2>Table 1</h2>
<?php render_tables($rows, $cols, "cell"); ?>

<h2>Table 2</h2>
<?php render_tables($rows, $cols, "cell2"); ?>
    
</body>
</html>
