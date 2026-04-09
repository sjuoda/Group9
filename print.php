<?php
$rows = isset($_GET['rows']) ? intval($_GET['rows']) : 3;
$cols = isset($_GET['cols']) ? intval($_GET['cols']) : 3;

function render_table($rows, $cols, $prefix = 'cell') {
    echo "<table border='1'>";

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
  <img src="blackwhite-logo.png" alt="Company Logo" width="100" class="logo"> 
  <h1>Group 9 - Color Coordinator</h1>
</div>


<h2>Table 1 - Selected Colors</h2>
<?php

function render_color_list() {
    echo "<table border='1'>";
    echo "<tr><th>Selected Colors</th></tr>";

    foreach ($_GET as $key => $value) {
        if (strpos($key, "color_") === 0) {
            echo "<tr><td>" . htmlspecialchars($value) . "</td></tr>";
        }
    }

    echo "</table>";
}

render_color_list();
?>

<h2>Table 2 - Coordinate Grid</h2>
<?php render_table($rows, $cols, "cell"); ?>

</div>
</body>
</html>
