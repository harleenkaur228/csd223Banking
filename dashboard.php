<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Dashboard</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        .content {
            padding: 20px;
            margin: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
        }

        .button-container {
            margin-top: 20px;
        }

        .button-container a {
            text-decoration: none;
            margin: 5px;
        }

        .button-container button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="navbar">
    <?php include('navbar.php'); ?>
</div>

<div class="content">
    <h1>Welcome to Your Dashboard</h1>
    <!-- Your page content goes here -->

    <!-- Add Login and Signup buttons with links -->
    <div class="button-container">
        <a href="login.php"><button>Login</button></a>
        <a href="index.php"><button>Signup</button></a>
    </div>
</div>

</body>
</html>
