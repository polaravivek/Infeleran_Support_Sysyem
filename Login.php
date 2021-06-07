<?php

session_start();

// if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
//     header("location: unsolved_section/fetch_questions.php");
//     exit;
// }

require_once "database/db.php";

$email = $password = "";
$email_err = $password_err = "";
 

if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter email.";
    } else{
        $email = trim($_POST["email"]);

        
    }
    
    
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);


    }
    
  
    if(empty($email_err) && empty($password_err)){
        
        $sql = "SELECT student_id, email, password FROM student_login WHERE email = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
           
            $param_email = $email;
            
           
            if(mysqli_stmt_execute($stmt)){
              
                mysqli_stmt_store_result($stmt);
                
                
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                  
                    mysqli_stmt_bind_result($stmt, $student_id, $email, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){


                        if(password_verify($password,$hashed_password)){
                        
                          
                            session_start();
                            
                            
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $student_id;
                            $_SESSION["email"] = $email;                            
                         
                            header("location: unsolved_section/fetch_questions.php");
                        } else{
                            
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    
                    $email_err = "No account found with that email.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

           
            mysqli_stmt_close($stmt);
        }
    }
    
    
    mysqli_close($link);
}
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Login page</title>
    <link rel="stylesheet" href="styles/style.css">
</head>

<body>
    <form class="box" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <h1>Login</h1>
        <div <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>> E-mail : <input type="text" name="email" placeholder="type E-mail" required   value="<?php echo $email; ?>">
         <span class="help-block"><?php echo $email_err; ?></span>
        </div>
        <div <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>> Password : <input type="password" name="password" placeholder="password">
           <span class="help-block"><?php echo $password_err; ?></span>
        </div>
        <input type="submit" name="submit" value="Login">
        <div><a href="index.php"><input type="button" name="Back" value="Back"></a>

            </a>
        </div>
    </form>
</body>

</html>