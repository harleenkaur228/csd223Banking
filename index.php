<!DOCTYPE HTML>
<html>

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .container {
            width: 50%;
            margin: auto;
            overflow: hidden;
            padding: 10px;
        }

        h2 {
            color: #333;
        }

        form {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin: 8px 0;
        }

        input[type="text"],
        input[type="password"],
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .error {
            color: #FF0000;
        }
    </style>
</head>
<body>  
<?php include('navbar.php'); ?>
<?php
// define variables and set to empty values
$nameErr = $passwordErr = $cpasswordErr = $emailErr = $addressErr = $phoneErr = "";
$name = $password = $cpassword = $email = $address = $phone = "";

$valid = true;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
        $valid = false;
    } else {
        $name = test_input($_POST["name"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
            $nameErr = "Only letters and white space allowed";
            $valid = false;
        }
    }

    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
        $valid = false;
    } else {
        $email = test_input($_POST["email"]);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
            $valid = false;
        }
    }

    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
        $valid = false;
    } else {
        $password = test_input($_POST["password"]);
        // check if e-mail address is well-formed

        if (strlen($password) < 6) {
            $passwordErr = "Please enter at least six characters password";
            $valid = false;
        }
    }

    if (empty($_POST["cpassword"])) {
        $cpasswordErr = "Confirm Password is required";
        $valid = false;
    } else {
        $cpassword = test_input($_POST["cpassword"]);

        if ($cpassword != $password) {
            $cpasswordErr = "Password and Confirm Password Need to be the same";
            $valid = false;
        }
    }

    if (empty($_POST["phone"])) {
        $phoneErr = "Phone number is required";
        $valid = false;
    } else {
        $phone = test_input($_POST["phone"]);
        // You may add additional validation for phone number if needed
    }

    if (empty($_POST["address"])) {
        $addressErr = "Address is required";
        $valid = false;
    } else {
        $address = test_input($_POST["address"]);
    }

    if ($valid) {

        $servername = "localhost";
        $username = "root";
        $db_password = "";
        $dbname = "csd223harleen";

        // Create connection
        $conn = new mysqli($servername, $username, $db_password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "INSERT INTO tbl_user (name, email, password, phone, address) VALUES ('" . $name . "','" . $email . "','" . $password . "','" . $phone . "','" . $address . "')";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<div class="container">
        <h2>Add User</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="name">Name:</label>
            <input type="text" name="name" value="<?php echo $name; ?>">
            <span class="error">* <?php echo $nameErr; ?></span>

            <label for="email">E-mail:</label>
            <input type="text" name="email" value="<?php echo $email; ?>">
            <span class="error">* <?php echo $emailErr; ?></span>

            <label for="password">Password:</label>
            <input type="password" name="password" value="<?php echo $password; ?>">
            <span class="error">* <?php echo $passwordErr; ?></span>

            <label for="cpassword">Confirm Password:</label>
            <input type="password" name="cpassword" value="<?php echo $cpassword; ?>">
            <span class="error">* <?php echo $cpasswordErr; ?></span>

            <label for="phone">Phone Number:</label>
            <input type="text" name="phone" value="<?php echo $phone; ?>">
            <span class="error">* <?php echo $phoneErr; ?></span>

            <label for="address">Address:</label>
            <textarea name="address" rows="5" cols="40"><?php echo $address; ?></textarea>
            <span class="error">* <?php echo $addressErr; ?></span>

            <input type="submit" name="submit" value="Submit">
        </form>
    </div>
</body>

</html>