<?php
require_once "database/db.php";
 

$name = $password = $confirm_password=$phone=$email = "";
$name_err =$password_err = $confirm_password_err=$phone_err=$email_err  = "";


if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    if(empty(trim($_POST["name"]))){
        $name_err = "Please enter a name.";
    } else{
       
        $sql = "SELECT student_id FROM student_login WHERE name = ?";

        
        if($stmt = mysqli_prepare($link, $sql)){
        
            mysqli_stmt_bind_param($stmt, "s", $param_name);
            
           
            $param_name = trim($_POST["name"]);
            
            
            if(mysqli_stmt_execute($stmt)){
                
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $name_err = "This name is already taken.";
                } else{
                    $name = trim($_POST["name"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            
            mysqli_stmt_close($stmt);
        }
    }


    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }


function validate_mobile($mobile)
{
    return preg_match('/^[6-9]\d{9}$/', $mobile);
}


if (strlen($_POST["phone"]) < 10 || strlen($_POST["phone"]) > 14)
{
     $phone_err="Phone Number Must be  >=10 and <= 14";
}

    if(empty(trim($_POST["phone"]))){
        $phone_err = "Please enter a phone.";
    } else{
     
        $sql = "SELECT student_id FROM student_login WHERE phone = ?";


        if($stmt = mysqli_prepare($link, $sql)){
          
            mysqli_stmt_bind_param($stmt, "s", $param_phone);
            
         
            $param_phone = trim($_POST["phone"]);
            
        
            if(mysqli_stmt_execute($stmt)){
               
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $phone_err = "This phone is already taken.";
                } else{
                    $phone = trim($_POST["phone"]);
                }
            } 
        
            else{
                echo "Oops! Something went wrong. Please try again later.";
            }

           
            mysqli_stmt_close($stmt);
        }
    }
  
 
function email_validation($str) { 
    return (!preg_match( 
"^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $str)) 
        ? FALSE : TRUE; 
} 
  

if(!email_validation($_POST["email"])) { 
    $email_err ="Invalid email address, try with complete formatted email or try  "; 
} 




    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter a email.";
    } else{
        
        $sql = "SELECT student_id FROM student_login WHERE email = ?";
        
        
        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            
            $param_email = trim($_POST["email"]);
            
           
            if(mysqli_stmt_execute($stmt)){
               
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $email_err = "This email is already taken.";
                } else{
                    $email = trim($_POST["email"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            
            mysqli_stmt_close($stmt);
        }
    }



      
  
    if(empty($name_err) && empty($password_err) && empty($confirm_password_err)){
        
       
        $sql = "INSERT INTO student_login (name, password,phone, email) VALUES (?,?,?,?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
        
            mysqli_stmt_bind_param($stmt, "ssss", $param_name,$param_password,$param_phone,$param_email);
            
            
            $param_name = $name;
            $param_password =password_hash($password, PASSWORD_DEFAULT); 
            
            
            $param_phone=$phone;
            $param_email=$email;
            
            
            if(mysqli_stmt_execute($stmt)){
               
                header("location: login.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }

          
            mysqli_stmt_close($stmt);
        }
    }
    
   
    mysqli_close($link);
}
?>


<html>
<head>
    <title>Sign-Up page</title>
    <link rel="stylesheet" href="styles/signup.css">
</head>

<body>
    <form class="signup"action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h1>Register</h1>
        <div class="fname <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
            Name : <input type="text" name="name" placeholder="Please enter your full name" required="" value="<?php echo $name; ?>">
             <span class="help-block"><?php echo $name_err; ?></span>
        </div>
        
        <div class="email <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
            E-mail : <input type="email" name="email" placeholder="E-mail" required value="<?php echo $email; ?>">
            <span class="help-block"><?php echo $email_err; ?></span>
        </div>
        <div class="mno <?php echo (!empty($phone_err)) ? 'has-error' : ''; ?>">
            Mobile No. : <input type="tel" name="phone" placeholder="Mobile Number" required value="<?php echo $phone; ?>">
            <span class="help-block"><?php echo $phone_err; ?></span>
        </div>
        <div class="pswrd  <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
            Password : <input type="password" name="password" placeholder="Set password" value="<?php echo $password; ?>">
            <span class="help-block"><?php echo $password_err; ?></span>
        </div>
        <div class="pswrd <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
            Confirm Password : <input type="password" name="confirm_password" placeholder="Confirm password" value="<?php echo $confirm_password; ?>">
            <span class="help-block"><?php echo $confirm_password_err; ?></span>
        </div>
        <div class="send">
            <input type="submit" name="submit" value="Submit">

        </div>


    </form>
</body>

</html>