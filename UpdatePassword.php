
<?php

if (isset($_POST['UpdatePassword'])) {
// echo "suiiiiiiiiiii";


$serverName = "localhost";
$usernameDB = "root";
$passwordDB = "";
$dbname = "finalproject";

$role=0;
$userid=$_COOKIE['id'];
$userExist=false;
$connection = mysqli_connect($serverName, $usernameDB, $passwordDB, $dbname);
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
    }


    $is_all_full=true;


    $olldpassword=$_POST["oldpassword"];
    $newpassword=$_POST["newpassword"];
    $conpassword=$_POST["conpassword"];

        // Check if the user inter all the requerment
        if(strlen($olldpassword) == 0){
            echo " <br> You  must enter your Old password " ; 
            $is_all_full=false;
        }
        if(strlen($newpassword) == 0){
            echo "<br> You  must enter your New password " ;
            $is_all_full=false; 
        }
        if(strlen($conpassword) == 0){
            echo "<br> You  must enter your New password Confirm" ;
            $is_all_full=false; 
        }
    
        $all_condition_true=false;
        if($is_all_full){
            $olldpassword=md5($olldpassword);
            $stmt = $connection->prepare("SELECT * From users where password =? and id =?");

           $stmt->bind_param("ss", $olldpassword , $userid);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows>0){
                $userExist=true;
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

            if($userExist){
                $all_condition_true=true;
                if(strlen($newpassword)<8   && preg_match("/^(?=.*\d)[a-zA-Z\d]{8}$/", $newpassword)     ){   
                    echo "<br> Enter Strong Password , more thae 8 char and contain nums ";
                    $all_condition_true=false;
                }
                if(strcmp($newpassword, $conpassword) !== 0){
                    echo " Password not match ,  they are not the same";
                    $all_condition_true=false;
                }

                if( $all_condition_true){
                    $connection = mysqli_connect($serverName, $usernameDB, $passwordDB, $dbname);
                    $stmt = $connection->prepare("Update users set password = ?  where id =?");
                    $newpassword=md5($newpassword);
                    $stmt->bind_param("ss", $newpassword , $userid);
                    $stmt->execute();
                    echo  "<h2> Suiiiii Created successfully </h2>";
        
                    $stmt->close();
                    $connection->close();

                    header("Location: http://localhost/Final%20Project/User.php");
                    exit();
                }
            }
    
            
            }else{
                echo "You entered Wrong password";
            }
   



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
    <h1>User</h1>
    <?php 
    $username=  $_COOKIE['username'];
    echo "<h1> Welcome ".  $username    . "</h1>"; 
    ?>
<form method='post'>
<label for="oldpassword">Old Password:</label>
<input  type='text' id='oldpassword' name='oldpassword'  required>
<label for="newpassword">New Password:</label>
<input type="text" id="newpassword" name="newpassword"   required>
<label for="conpassword">Password confirm:</label>
<input  type="text" id="conpassword" name="conpassword"      required>
<input type="submit" value="Update Password" name='UpdatePassword'>
  </form>

  

</body>
</html>

