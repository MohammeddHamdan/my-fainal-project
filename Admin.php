<?php

if (isset($_POST['logout'])) {
  header("Location: http://localhost/Final%20Project/Login.php");
  exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 85%;
  margin: auto;
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
/* CSS Styling for the form */
form {
      width: 300px;
      margin: 0 auto;
    }

    label {
      display: block;
      margin-bottom: 5px;
    }

    input[type="text"], select, textarea {
      width: 100%;
      padding: 5px;
      margin-bottom: 10px;
    }

    input[type="submit"] {
      background-color: #4CAF50;
      color: white;
      padding: 10px 15px;
      border: none;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #45a049;
    }
</style>
</head>
<body>
    <h1>Admin</h1>
    <?php 
    $username=  $_COOKIE['username'];
    echo "<h1> Welcome ".  $username    . "</h1>"; 
    ?>
   
    <table id="customers">
  <tr>
    <th>ID</th>
    <th>Email</th>
    <th>User Name</th>
    <th>Created at</th>
  </tr>



<?php 

$username=  $_COOKIE['username'];
$email=$_COOKIE['email'];


$serverName = "localhost";
    $usernameDB = "root";
    $passwordDB = "";
    $dbname = "finalproject";
    $role=1;
    $connection = mysqli_connect($serverName, $usernameDB, $passwordDB, $dbname);
    if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());

    }
    

    $sql="SELECT * From users ";
    $result= $connection->query($sql);
    if($result->num_rows>0){
     
            while($row=$result->fetch_assoc()){
                        echo"<tr>
                        <td>" . $row["id"]. "</td>
                        <td> " . $row["email"]."</td>
                        <td>".$row['name']. "</td>
                        <td>".$row['created_at']. "</td>
                        </tr
                        ";

            }
    }else{ 
    echo "0 results";
    }
    $connection->close();
?>
</table>

<hr>
<div>
<form method="post">

<input type="submit" value="Log out" name='logout' style="margin-top: 20px" >

</form>
</div>


</body>
</html>

