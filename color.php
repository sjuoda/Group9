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
        <form action="color.php" method="POST">
            <p>
                <label for="rows/cols"> Rows and Columns </lable>
                <input type="number" name="size" id="size" min="1" max="26" required> 
            </p>

            <p>
                <label for="colors"> Number of Colors </lable>
                <input type="number" name="color" id="color" min="1" max="10" required>
            </p>

            <input type="submit">
        </form>
    </main>
    <footer>
        <p>&#169 Group 9 Website - CS312 - CSU</p>
    </footer>
</body>

</html>