<!DOCTYPE html>
<html>
<head>
<style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}
</style>
</head>
<body>

<div class="navbar">
    <?php include('navbar.php'); ?>
</div>


<h1>User Detail</h1>

<table id="customers">
  <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Password</th>
    <th>Phone</th>
    <th>Address</th>
    <th>Edit</th>
    <th>Delete</th>
  </tr>

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

  $sql = "SELECT * FROM tbl_user";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      // Display user details in the table
      echo "<tr>";
      echo "<td>".$row["id"]."</td>";
      echo "<td>".$row["name"]."</td>";
      echo "<td>".$row["email"]."</td>";
      echo "<td><input type='text' name='password' value='".$row["password"]."'></td>";
      echo "<td>".$row["phone"]."</td>";
      echo "<td>".$row["address"]."</td>";
      echo "<td><a href='edit.php?id=".$row["id"]."'><button>Edit</button></a></td>";
      echo "<td><a href='delete.php?id=".$row["id"]."'><button>Delete</button></a></td>";
      echo "</tr>";
    }
  } else {
    echo "0 results";
  }
  $conn->close();
  ?>

</table>

</body>
</html>
