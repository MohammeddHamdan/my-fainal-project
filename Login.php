
<?php
$serverName = "localhost";
$usernameDB = "root";
$passwordDB = "";
$dbname = "finalproject";

$role=0;
$userExist=false;
$connection = mysqli_connect($serverName, $usernameDB, $passwordDB, $dbname);
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
    }
    
    if (isset($_POST['Login'])) {

        $is_all_full=true;


        $email=$_POST["email"];
        $password=$_POST["password"];

        // echo "suiiiiiiii";

        // Check if the user inter all the requerment
        if(strlen($email) == 0){
            echo " <br> You  must enter your email " ; 
            $is_all_full=false;
        }
        if(strlen($password) == 0){
            echo "<br> You  must enter your password " ;
            $is_all_full=false; 
        }


        //Check some condition on data if user exist
        $found=true;
        if($is_all_full){

            $stmt = $connection->prepare("Select * From users 
            where email = ? and  password = ? ");
            // $password=password_hash($password, PASSWORD_DEFAULT);
            $password= md5($password);
            $stmt->bind_param("ss",  $email, $password);
            $stmt->execute();
            $result = $stmt->get_result();
            // echo  "--->> " .$result ;
          

          
            if($result->num_rows>0){
             $userExist=true;

                    while($row=$result->fetch_assoc()){
                                echo"<table border='/1/'>
                                <thead><tr>
                                <th>ID</th><th>Name</th>
                                <th>Salary</th><th>Dep. Name</th>
                                </tr>
                                </thead><tbody><tr>
                                <td>" . $row["id"]. "</td>
                                <td>" . $row["name"]. "</td>
                                <td> " . $row["email"]."</td>
                                <td>".$row['role']. "</td>
                                </tr>
                                </tbody>
                                </table>
                                ";
                                $role=$row['role'];
                                setcookie('username', $row["name"]);
                                setcookie('email', $row["email"]);
                                setcookie('role', $row["role"]);
                                setcookie('id', $row["id"]);
                                setcookie('creat', $row["created_at"]);





                    }
            }else{ 
            echo "0 results";
            }
            $stmt->close();
            $connection->close();

           

        }
        if($userExist){
            if (  $role==0){
                header("Location: http://localhost/Final%20Project/User.php");
                exit();
            }else if($role==1){
                header("Location: http://localhost/Final%20Project/Admin.php");
                exit();
            }
    
        }else{
            echo "User Email or password are not correct";
        }


    }


    
    if (isset($_POST['haveAccount'])) {
        header("Location: http://localhost/Final%20Project/Register.php");
        exit();
        // echo "ghgghghy";
    }
    
    

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="mainStyleSheet.css" type="text/css">
    <title>HTML + CSS Assginment</title>
    <style>
        section{
            margin-top: 120px;
        }
    </style>
</head>

<body>

    <section >
        <div class="info">
            <h2>Information</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                Et molestie ac feugiat sed. Diam volutpat commodo.</p>
            <p> <span>En ultrices:</span> Vitae auctor eu augue ut. Malesuada nunc
                vel risus commodo viverra. Praesent elementum facilisis leo vel. </p>
                <form action="" method="post">
                <button> 
                    <input type="submit"
                     name="haveAccount"
                      value="Don't have An Account" 
                      style="border: none; outline: none" >
                    
                    </button>
                    
                </form>
      
        </div>
        <div class="form">
            <h2>Register form</h2>
            <form action="" method="post">
           
                <div class="inputBox">
                    <label for="email">  Email</label>
                    <input type="text" name="email" id='email'>
                </div>
      
                    <div class="inputBox">
                        <label for="password"> password</label>
                        <input type="password" name="password" id='password'>

                    </div>

         

                <div class="btndiv">
                    <input type="submit" value="Login" name='Login'>
                </div>
            </form>
        </div>
    </section>


</body>

</html>