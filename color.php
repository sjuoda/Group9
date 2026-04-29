<!DOCTYPE html>
<html>

<head>
    <title>Color Coordinator</title>
    <meta charset="utf-8">
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
            <li><a href="colors.php">Color Selection</a></li>
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
        $rowscols = $_POST["rowscols"];
        $cols = 2;

        echo "<form action='print.php' method='GET'>";

        echo "<table border='1' id='tb1'>";

        $colorList = ["Red","Orange","Yellow","Green","Blue","Purple","Grey","Brown","Black","Teal"];
        echo "<h2>Color Selection</h2>";
    for ($r = 0; $r < $rows; $r++) {
        $defaultColor = $colorList[$r];

        echo "<tr>";

        $checked = ($r == 0) ? "checked" : "";
        echo "<td style='width:20%;'>";
        echo "<input type='radio' name='activeColor' value='$r' $checked> ";
    
        echo "<select name='color_$r' class='colorDropdown'>";
    foreach ($colorList as $color) {
        $selected = ($color == $defaultColor) ? "selected" : "";
        echo "<option value='$color' $selected>$color</option>";
    }
        echo "</select>";
        echo "</td>";

        echo "<td style='width:80%; background-color: $defaultColor;' class='colorPreview'>";
        echo "</td>";

        echo "</tr>";
        }
        

        echo "</table>";
        echo "<p id='duplicateMessage' style='color:#F8C5BF;'></p>";
        
        $n = $_POST["rowscols"];
        echo "<h2>Coordinate Grid</h2>";
        echo "<table border='1' class='grid'>";

        for ($i = 0; $i <= $n; $i++) {
            echo "<tr>";
            for ($j = 0; $j <= $n; $j++) {
                echo "<td>";
                if ($i == 0 && $j == 0) {
                    echo "";
                }
                elseif($i == 0) {
                    echo chr(64 + $j);
                }
                elseif($j == 0) {
                    echo $i;
                }
                else{
                    $coord = chr(64 + $j) . $i;
                    echo "<span class='paintCell' data-coord='$coord'></span>";
                }
                echo "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";

        
        echo "<input type='hidden' name='rows' value='{$rowscols}'>";
        echo "<input type='hidden' name='cols' value='{$rowscols}'>";
        echo "<button type='submit'>Print View</button>";
        echo "</form>";
    }
    ?>
    
    </main>
    <footer>
        <p>&#169 Group 9 Website - CS312 - CSU</p>
    </footer>

    <script src="errors.js"> </script>

    <script>
    const coordinateMap = {};

    document.querySelectorAll(".colorPreview").forEach((row, i) => {
        coordinateMap[i] = [];
    });

    document.querySelectorAll(".paintCell").forEach(cell => {
        cell.parentElement.addEventListener("click", function () {
            const active = document.querySelector("input[name='activeColor']:checked");
            const rowIndex = active.value;

            const dropdown = document.querySelector(`select[name='color_${rowIndex}']`); 
            const chosenColor = dropdown.value;
            
            this.style.backgroundColor = chosenColor;

            const coord = cell.dataset.coord;

            if (!coordinateMap[rowIndex].includes(coord)) {
                coordinateMap[rowIndex].push(coord);
            }

            coordinateMap[rowIndex].sort((a,b) => {
                const letterA = a.charCodeAt(0);
                const letterB = b.charCodeAt(0);

                if(letterA !== letterB) return letterA - letterB;

                return parseInt(a.slice(1)) - parseInt(b.slice(1));
            });

            const preview = document.querySelectorAll(".colorPreview")[rowIndex];
            preview.textContent = coordinateMap[rowIndex].join(", ");
        });
    });

    // 1.4
    document.querySelectorAll(".colorDropdown").forEach((dropdown, rowIndex) => {
        dropdown.addEventListener("change", function () {
            const updateNewColor = this.value;
            const coords = coordinateMap[rowIndex] || [];

            coords.forEach(coord => {
                const cell = document.querySelector(`[data-coord="${coord}"]`).parentElement;
                cell.style.backgroundColor = updateNewColor;
            });

            const preview = document.querySelectorAll(".colorPreview")[rowIndex];
            preview.style.backgroundColor = updateNewColor;
        });
    });
</script>
</body>

</html>
