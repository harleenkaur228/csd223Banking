<!DOCTYPE HTML>  
<html>
<head>
  <link rel="stylesheet" type="text/css" href="Style.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    .navbar {
      background-color: #333;
      overflow: hidden;
      position: fixed;
      top: 0;
      width: 100%;
    }

    .navbar a {
      float: right;
      display: block;
      color: white;
      text-align: center;
      padding: 14px 16px;
      text-decoration: none;
    }

    .navbar a:hover {
      background-color: #ddd;
      color: black;
    }

    .content {
      margin-top: 60px; 
      margin-left: 10px; 
    }
  </style>
</head>
<body>

<div class="navbar">
  <a href="dashboard.php">Home</a>
  <a href="login.php">Login</a>
  <a href="index.php">Signup</a>
  <a href="view.php">Database</a>
  <a href="creditordebit.php">Transaction</a>
</div>

</body>
</html>
