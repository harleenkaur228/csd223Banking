<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "csd223harleen";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Receive and sanitize input
$name = mysqli_real_escape_string($conn, $_POST['name']); // assuming name is submitted in the form
$password = mysqli_real_escape_string($conn, $_POST['password']);

// Query the database for the user
$sql = "SELECT * FROM tbl_user WHERE name='$name'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    // Verify password
    if (password_verify($password, $row['password'])) {
        // Password is correct, set session variables and redirect to a logged-in page
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['username'] = $row['name']; // using name as the username
        header("Location: creditordebit.php"); // Redirect to a logged-in page
        exit();
    } else {
        echo "Incorrect password";
    }
} else {
    echo "User not found";
}

$conn->close();
?>
