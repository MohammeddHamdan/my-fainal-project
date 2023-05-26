
<?php

if (isset($_POST['Update'])) {
// echo "suiiiiiiiiiii";


$serverName = "localhost";
$usernameDB = "root";
$passwordDB = "";
$dbname = "finalproject";

$role=0;
$userid=$_COOKIE['id'];
$connection = mysqli_connect($serverName, $usernameDB, $passwordDB, $dbname);
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
    }


    $is_all_full=true;


    $email=$_POST["email"];
    $username=$_POST["username"];

        // Check if the user inter all the requerment
        if(strlen($email) == 0){
            echo " <br> You  must enter your email " ; 
            $is_all_full=false;
        }
        if(strlen($username) == 0){
            echo "<br> You  must enter your User Name " ;
            $is_all_full=false; 
        }
    
        $all_condition_true=false;
        if($is_all_full){
            $all_condition_true=true;
            if(strlen($username)<6){
                echo "<br> Your name must be more than 6 Chracter ";
                $all_condition_true=false;
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($email)) {
                echo "<br> Enter a valid email";
            }
        }

        if( $all_condition_true){
            $stmt = $connection->prepare("Update users set email = ?  , name= ? where id =?");
            $stmt->bind_param("sss", $email, $username , $userid);
            $stmt->execute();
            echo  "<h2> Suiiiii Created successfully </h2>";

            $stmt->close();
            $connection->close();
            setcookie('username', $username);
            header("Location: http://localhost/Final%20Project/User.php");
            exit();
        }



}



if (isset($_POST['UpdatePassword'])) {
    header("Location: http://localhost/Final%20Project/UpdatePassword.php");
    exit();
}
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
    <h1>User</h1>
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
$userid=$_COOKIE['id'];


$serverName = "localhost";
    $usernameDB = "root";
    $passwordDB = "";
    $dbname = "finalproject";
    $role=1;
    $connection = mysqli_connect($serverName, $usernameDB, $passwordDB, $dbname);
    if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());

    }
    

    $sql="SELECT * From users where id = " . $userid;
    $result= $connection->query($sql);
    if($result->num_rows>0){
     
            while($row=$result->fetch_assoc()){
                        echo"<tr>
                        <td>" . $row["id"]. "</td>
                        <td> " . $row["email"]."</td>
                        <td>".$row['name']. "</td>
                        <td>".$row['created_at']. "</td>
                        </tr>
                     
                        ";

            }
    }else{ 
    echo "0 results";
    }
    $connection->close();
?>
</table>
<form method='post'>
    
<label for="id">id:</label>
   

   

    <?php  
    $email= $_COOKIE['email'];
    $username= $_COOKIE['username'];
    $created_at= $_COOKIE['creat'];
    $id= $_COOKIE['id'];
    echo' <input type="text" id="id" name="id" readonly  value="'.$id.'" required>';
    echo ' <label for="email">Email:</label>';
     echo "<input  type='text' id='email' name='email' value='" .   $email . "'  required>" ;  
     echo '<label for="username">UserName:</label>';
     echo '<input type="text" id="username" name="username"  value="'.$username.'" required>';
     echo' <label for="created_at">Created at:</label>';
     echo '<input  type="text" id="created_at" name="created_at" readonly  value="'.$created_at.'"   required>';
     ?> 
    

    
    
   
    




    <input type="submit" value="Update" name='Update'>
    <input type="submit" value="Update Password" name='UpdatePassword'>
    <input type="submit" value="Delete" name='delete' id="btndelete">
    <input type="submit" value="Log out" name='logout' style="margin-top: 20px" >


  </form>

  

</body>
<script>
    console.log("message");
    var btndelete=document.getElementById('btndelete')
    btndelete.addEventListener('click', function(event) {
        // event.preventDefault();
    // Code to execute when the button is clicked
    res=false;
    var res=confirm('Button Clicked!');
    console.log(res)

    if(res){
        // btndelete.submit();
        console.log("will be deleted")
        <?php 

            echo "huio";
            $serverName = "localhost";
            $usernameDB = "root";
            $passwordDB = "";
            $dbname = "finalproject";
            $userid=$_COOKIE['id'];
            $connection = mysqli_connect($serverName, $usernameDB, $passwordDB, $dbname);
            if (!$connection) {
                die("Connection failed: " . mysqli_connect_error());
                }

                if (isset($_POST['delete'])) {
                    $sql="DELETE FROM users where id = " . $userid;
                    $result= $connection->query($sql);
                    
                    $connection->close();
                    header("Location: http://localhost/Final%20Project/Register.php");
                    exit();
               
                }
              
        
                   

                 
         
           
            ?>

    }else{

    }


  });
</script>
</html>

