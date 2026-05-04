<?php
require 'db.php';

$output = "";
$delete_name = null;
$delete_id = null;

if (isset($_POST['add'])) {
    $name = trim($_POST['name']);
    $hex = trim($_POST['hex']);

    $sql = $conn->prepare("SELECT * FROM colors WHERE name = ? OR hex_value = ?");
    $sql->bind_param("ss", $name, $hex);
    $sql->execute();
    $result = $sql->get_result();

    if ($result->num_rows > 0) {
        $output = 'Error: Color "' . $name . '" or hex value already exists in database.';
    } else {
        $sql = $conn->prepare("INSERT INTO colors (name, hex_value) VALUES (?, ?)");
        $sql->bind_param("ss", $name, $hex);
        $sql->execute();
        $output = 'Color "' . $name . '" added successfully!';
    }
}

if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $name = trim($_POST["name"]);
    $hex = trim($_POST["hex"]);

    $sql = $conn->prepare("SELECT * FROM colors WHERE name = ? OR hex_value = ?");
    $sql->bind_param("ss", $name, $hex);
    $sql->execute();
    $result = $sql->get_result();
    
    if ($result->num_rows > 0) {
        $output = 'Error: Color "' . $name . '" or hex value already in database.';
    } else {
        $sql = $conn->prepare("UPDATE colors SET name = ?, hex_value = ? WHERE id = ?");
        $sql->bind_param("ssi", $name, $hex, $id);
        $sql->execute();
        $output = 'Color "' . $name . '" updated successfully!';
    }
}

if (isset($_POST['delete'])) {
    $delete_id = $_POST['id'];

    $sql = $conn->prepare("SELECT name FROM colors WHERE id = ?");
    $sql->bind_param("i", $delete_id);
    $sql->execute();
    $result = $sql->get_result();

    $delete_name = $result->fetch_assoc()['name'];
}

if (isset($_POST['confirm_delete'])) {
    $id = $_POST['id'];

    $sql = $conn->prepare("SELECT name FROM colors WHERE id = ?");
    $sql->bind_param("i", $id);
    $sql->execute();
    $colorName = $sql->get_result()->fetch_assoc()['name'];

    $count = $conn->query("SELECT COUNT(*) AS size FROM colors")->fetch_assoc()['size'];
    
    if ($count <= 2) {
        $output = 'Error: Cannot delete color "' . $colorName . '" from database, must keep at least 2.';
    } else {
        $sql = $conn->prepare("DELETE FROM colors WHERE id = ?");
        $sql->bind_param("i", $id);
        $sql->execute();

        $output = 'Color "' . $colorName . '" successfully deleted!';
    }
}
$colors = $conn->query("SELECT * FROM colors ORDER BY id");
?>

<!DOCTYPE html>
<html>

<head>
    <title>Group 9 - Home</title>
    <meta charset="utf-8">
    <meta name="author" content="Sarunas Juodagalvis ">
    <meta name="keywords" content="CSU, Computer Science, CS 312, CS312, Cats">
    <meta name="description"
        content="Website for group project for cs312 ">
    <link rel="stylesheet" type="text/css" href="style.css" >
</head>

<body id="indexBody">
    <header>
        <h1>COLOR SELECTION</h1>
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
        <p style="color:red;">
        <?php echo $output; ?>
        </p>
        
        <h2>Add a Color</h2>
        <form method='POST' action='colors.php'>
            <p><label>Color Name:</label></p>
            <p><input type="text" name="name" placeholder="e.g. Navy" required></p>
            
            <p><label>Hex Value:</label>
            <p><input type="text" name="hex" placeholder="#815353" required></p>
            
            <p><button type="submit" name="add">Add Color</button></p>
        </form>
        
        <h2>Edit a Color</h2>
        <form method='POST' action='colors.php'>
            <p><label>Select Color:</label></p>
            <p><select name="id" class="colorDropdown" >
            <?php
            $lst = $conn->query("SELECT * FROM colors");
            while ($color = $lst->fetch_assoc()) {
                echo "<option value='" . $color['id'] . "'>" . $color['name'] . " (" . $color['hex_value'] . ")</option>";
            }
            ?>
            </select></p>
            
            </p><label>New Color Name:</label></p>
            </p><input type="text" name="name" required></p>
        
            </p><label>New Hex Value:</label></p>
            </p><input type="text" name="hex" required></p>
            </p><button type="submit" name="edit">Save</button></p>
        </form>

        <h2>Delete a Color</h2>
        <form method='POST' action='colors.php'>
            <p><label>Select Color:</label></p>
            <p><select name="id" class="colorDropdown" >
            <?php
            $lst = $conn->query("SELECT * FROM colors");
            while ($color = $lst->fetch_assoc()) {
                echo "<option value='" . $color['id'] . "'>" . htmlspecialchars($color['name']) . " (" . htmlspecialchars($color['hex_value']) . ")</option>";
            }
            ?>
            </select></p>
            <button type="submit" name="delete">Delete Color</button>
        </form>
        
        <?php if ($delete_id): ?>
            <p>Are you sure you sure you want to delete <?php echo htmlspecialchars($delete_name); ?></p>
            
            <form method="POST" action="colors.php">
                <input type="hidden" name="id" value="<?php echo $delete_id; ?>">
                <button type="submit" name="confirm_delete">Yes, Delete Color</button>
            </form>
        <?php endif; ?>

        <h2>Current Colors</h2>
        <table border="1">
            <tr>
                <th>Name</th>
                <th>Hex Value</th>
                <th>Preview</th>
            </tr>

            <?php
            while ($row = $colors->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['hex_value']) . "</td>";
                echo "<td style='background-color:" . $row['hex_value'] . ";'></td>";
                echo "</tr>";
            }
            ?>
        </table>
    </main>
    <footer>
        <p>&#169 Group 9 Website - CS312 - CSU</p>
    </footer>
</body>

</html>
