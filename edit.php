<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "csd223harleen";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the 'id' parameter is set in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Retrieve the existing data for the given 'id'
    $sql = "SELECT * FROM `tbl_user` WHERE `id` = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Display a form with the existing data for editing
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Edit User</title>
        </head>
        <body>
            <h2>Edit User</h2>
            <form action="update.php" method="post">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <label for="name">Name:</label>
                <input type="text" name="name" value="<?php echo $row['name']; ?>"><br>
                <label for="email">Email:</label>
                <input type="text" name="email" value="<?php echo $row['email']; ?>"><br>
                <label for="phone">Phone:</label>
                <input type="text" name="phone" value="<?php echo $row['phone']; ?>"><br>
                <label for="address">Address:</label>
                <input type="text" name="address" value="<?php echo $row['address']; ?>"><br>
                <input type="submit" value="Update">
            </form>
        </body>
        </html>
        <?php
    } else {
        echo "No record found for ID $id.";
    }
} else {
    echo "No 'id' parameter provided.";
}

$conn->close();
?>
