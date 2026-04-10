<?php
$rows = isset($_GET['rows']) ? intval($_GET['rows']) : 3;
$cols = isset($_GET['cols']) ? intval($_GET['cols']) : 3;

function render_table($rows, $cols, $prefix = 'cell') {
    echo "<table style='display:block;'>";

    echo "<tr><th></th>";
    for ($c = 0; $c < $cols; $c++) {
        echo "<th>" . chr(65 + $c) . "</th>";
    }
    echo "</tr>";

    
    for ($r = 0; $r < $rows; $r++) {
        echo "<tr>";

        echo "<th>" . ($r + 1) . "</th>";

        for ($c = 0; $c < $cols; $c++) {
            $key = "{$prefix}_{$r}_{$c}";
            $value = isset($_GET[$key]) ? htmlspecialchars($_GET[$key]) : '';
            echo "<td>$value</td>";
        }

        echo "</tr>";
    }

    echo "</table>";
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="author" content="Evan Waselkow">
  <meta name="keywords" content="CSU, Computer Science, CS 312">
  <meta name="description" content="Color coordinator print page">
  <title>Print View - Color Coordinator</title>
  <link rel="stylesheet" href="print.css">
</head>
<body>

<div class="print-container">
<div class="header">
  <img src="blackwhite-logo2.png" alt="Company Logo" height="50" width="300" class="logo"> 
  <h1>Cloud 9 Colors</h1>
</div>


<h2>Color Selection</h2>
<?php

function render_color_list() {
    echo "<table border='1' style='width:95%;'>";
    //echo "<tr><th></th></tr>";

    foreach ($_GET as $key => $value) {
        if (strpos($key, "color_") === 0) {
            echo "<tr>";
            echo "<td style='width:20%'>" . htmlspecialchars($value) . "</td>";
            echo "<td style='width:80%'></tr>";
            echo "</tr>";
        }
        
    }
    

    echo "</table>";
}

render_color_list();
?>

<h2>Coordinate Grid</h2>
<?php render_table($rows, $cols, "cell"); ?>

</div>
</body>
</html>
