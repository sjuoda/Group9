<!DOCTYPE html>
<html>

<head>
    <title>Color Coordinator</title>
    <meta charset="utf 8">
    <meta name="author" content="Sarunas Juodagalvis ">
    <meta name="keywords" content="CSU, Computer Science, CS 312, CS312, Cats">
    <meta name="description"
        content="Website for group project for cs312 ">
    <link rel="stylesheet" type="text/css" href="style.css" >
    
</head>

<body>
    
    <header>
        <h1>Color Coordinator</h1>
    </header>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="color.php">Color Coordinator</a></li>
        </ul>
    </nav>
    
    <main>
        <form id="coorForm" action="color.php" method="POST">
            <label for="rowscols"> Rows and Columns (1-26)</label>
            <p>
                <input type="number" name="rowscols" id="rowscols">
                <span id="rowcolError" style="display: none;">Error: Rows/Columns size entered is out of range. Must be between 1 and 26 inclusive.</span> 
            </p>
            <label for="colors"> Number of Colors (1-10)</label>
            <p>
                <input type="number" name="colors" id="colors">
                <span id="colorError" style="display: none;">Error: Colors size entered is out of range. Must be between 1 and 10 inclusive.</span>
            </p>

            <input type="submit">
        </form>

    <?php 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $rows = $_POST["colors"];
        $cols = 2;

        echo "<form action='print.php' method='GET'>";

        echo "<table border='1'>";

        $colorList = ["Red","Orange","Yellow","Green","Blue","Purple","Grey","Brown","Black","Teal"];
        
        for ($r = 0; $r < $rows; $r++) {
            $defaultColor = $colorList[$r];

            echo "<tr>";
            //Left column
            echo "<td style='width:20%;'>";
            echo "<select name='color_$r' class='colorDropdown'>";
            foreach ($colorList as $color) {

                $selected = ($color == $defaultColor) ? "selected" : "";

                echo "<option value='$color' $selected>$color</option>";
            }
            echo "</select>";
            echo "</td>";
            //Right column
            echo "<td style='width:80%;'>";
            echo $defaultColor;
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";

        echo "<p id='duplicateMessage' style='color:red;'></p>";

       echo "<input type='hidden' name='rows' value='{$rows}'>";
       echo "<input type='hidden' name='cols' value='{$cols}'>";
       echo "<button type='submit'>Print View</button>";
       echo "</form>";
    }
    ?>
    
    </main>
    <footer>
        <p>&#169 Group 9 Website - CS312 - CSU</p>
    </footer>

    <script src="errors.js"> </script>
</body>

</html>
