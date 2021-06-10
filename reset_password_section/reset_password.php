<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location:index.php");
    exit;
}

// echo $_SESSION['email'];
// die();
// Include 

require_once "../database/db.php";

// Define variables and initialize with empty values
$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate new password
    if(empty(trim($_POST["new_password"]))){
        $new_password_err = "Please enter the new password.";     
    } elseif(strlen(trim($_POST["new_password"])) < 6){
        $new_password_err = "Password must have atleast 6 characters.";
    } else{
        $new_password = trim($_POST["new_password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm the password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }

    // Check input errors before updating the database
    if(empty($new_password_err) && empty($confirm_password_err)){
        // Prepare an update statement
        $sql = "UPDATE student_login SET password = ? WHERE email = ?";
       
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);
            
            // Set parameters
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_id = $_SESSION["email"];

            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Password updated successfully. Destroy the session, and redirect to login page
                session_destroy();
                header("location: ../index.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Reset password</title>
    <link rel="stylesheet" type="text/css" href="../styles/reset_pass_new.css">
</head>

<body>
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">Reset Password</h2>
            <p class="card-text">Please fill out this form to reset your password.</p>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <div class="<?php echo (!empty($new_password_err)) ? 'has-error' : ''; ?>">
                    <label for="newPassword">New Password:</label><br><br>
                    <input type="password" id="newPassword" name="new_password" title="New password"
                        placeholder="New Password" value="<?php echo $new_password; ?>" /><br><br>
                    <span class="help-block"><?php echo $new_password_err; ?></span>
                </div>
                <div class=" <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                    <label for="confirmPassword">Confirm Password:</label><br><br>
                    <input type="password" id="confirmPassword" name="confirm_password" title="Confirm new password"
                        placeholder="Confirm Password" /><br><br>
                    <span class="help-block"><?php echo $confirm_password_err; ?></span>
                </div>
                <button type="submit" value="Submit" class="btn-1">Change Password</button>
                <a href="../unsolved_section/fetch_questions.php"><button class="btn-2">Cancel</button></a>

            </form>
        </div>
    </div>



</body>

</html>