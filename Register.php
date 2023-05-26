<?php
$serverName = "localhost";
$usernameDB = "root";
$passwordDB = "";
$dbname = "finalproject";

$connection = mysqli_connect($serverName, $usernameDB, $passwordDB, $dbname);
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
    }
    
    if (isset($_POST['register'])) {

        $is_all_full=true;


        $firstName=$_POST["fname"];
        $lastName=$_POST["lname"];
        $email=$_POST["email"];
        $password=$_POST["password"];
        $con_password=$_POST["con-password"];
        $full_name="";


        // Check if the user inter all the requerment
        if(strlen($firstName) == 0){
            echo " <br> You  must enter your first name " ; 
            $is_all_full=false;
        }
        if(strlen($lastName) == 0){
            echo "<br>  You  must enter your last name " ; 
            $is_all_full=false;
        }
        if(strlen($email) == 0){
            echo " <br> You  must enter your email " ; 
            $is_all_full=false;
        }
        if(strlen($password) == 0){
            echo "<br> You  must enter your password " ;
            $is_all_full=false; 
        }
        if(strlen($con_password) == 0){
            echo "<br> You  must enter password configuration " ; 
            $is_all_full=false;
        }

        $check;
        if (isset($_POST['confirmcheckbox'])){
            $check=true;
        }else{
            $check=false;
            $is_all_full=false;
            echo "<br> You must agree on our terms and conditions";
        }


        //Check some condition on data
        $all_condition_true=false;
        if($is_all_full){
            $all_condition_true=true;
            $full_name=$firstName." " . $lastName;
            if(strlen($full_name)<6){
                echo "<br> Your name must be more than 6 Chracter ";
                $all_condition_true=false;
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($email)) {
                echo "<br> Enter a valid email";
            }
            if(strlen($password)<8   && preg_match("/^(?=.*\d)[a-zA-Z\d]{8}$/", $password)     ){   
                echo "<br> Enter Strong Password , more thae 8 char and contain nums ";
                $all_condition_true=false;
            }
            if(strcmp($password, $con_password) !== 0){
                echo " Password not match ,  they are not the same";
                $all_condition_true=false;
            }
        }

        if( $all_condition_true){
            // echo  $firstName."  " .$lastName ."  " .$email . "  "  . $password . "  ".$con_password ;
            // prepare and bind
            $stmt = $connection->prepare("INSERT INTO users (name, email, password , role) 
            VALUES (?, ?, ? , 0)");
            // $password=password_hash($password, PASSWORD_DEFAULT);
            $password= md5($password);
            $stmt->bind_param("sss", $full_name, $email, $password);
            $stmt->execute();
            echo  "<h2> Suiiiii Created successfully </h2>";

            $stmt->close();
            $connection->close();

            header("Location: http://localhost/Final%20Project/Login.php");
            exit();
        }
       
  

        
        // echo $check . "   jk  ";

    }


    if (isset($_POST['haveAccount'])) {
        header("Location: http://localhost/Final%20Project/Login.php");
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
</head>

<body>

    <section>
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
                      value="Have An Account" 
                      style="border: none; outline: none" >
                    
                    </button>
                    
                </form>
            
        </div>
        <div class="form">
            <h2>Register form</h2>
            <form action="" method="post">
                <div class="towInputBox">
                    <div class="inputBox">
                        <label for="firstName"> first name</label>
                        <input type="text" name="fname" id='firstName'>
                    </div>
                    <div class="inputBox">
                        <label for="lasttName">last name</label>
                        <input type="text" name="lname" id='lasttName'>
                    </div>
                </div>
                <div class="inputBox">
                    <label for="email"> your email</label>
                    <input type="text" name="email" id='email'>
                </div>
                <div class="towInputBox">
                    <div class="inputBox">
                        <label for="password"> password</label>
                        <input type="password" name="password" id='password'>

                    </div>
                    <div class="inputBox">
                        <label for="con-password">confirm password</label>
                        <input type="password" name="con-password" id='con-password'>

                    </div>
                </div>
                <div class="agree">
                    <input type="checkbox" id="confirm" name='confirmcheckbox'>
                    <label for="confirm"> I agree to the <a href=""> Terms and Conditions</a></label>
                </div>
                <div class="btndiv">
                    <input type="submit" value="Register" name="register" >
                </div>
            </form>
        </div>
    </section>


</body>

</html>