<?php

// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
}
 
// Include config file
require_once "../config.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM users WHERE username = :username";
        
        if($stmt = $pdo_connection->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Check if username exists, if yes then verify password
                if($stmt->rowCount() == 1){
                    if($row = $stmt->fetch()){
                        $id = $row["id"];
                        $username = $row["username"];
                        $hashed_password = $row["password"];
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user to home page
                            header("location: index.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        unset($stmt);
    }
    
    // Close connection
    unset($pdo_connection);
}

include "templates/unauth-header.php";

?>
        <h2 class="ui dividing header">Login</h2>


        <div class="ui placeholder segment">
            <div clss="ui one column very relaxed stackable grid">
                <div class="column">
                    <form class="ui form error" action="login.php" method="post">
                        <h4 class="six wide field <?php echo (!empty($username_err)) ? 'field error message' : ''; ?>">
                            <label for="username">Username</label>
                            <input type="text" name="username" class="form-control" value="">
                            <span class="ui error message"><?php echo $username_err; ?></span>
                        </h4>    
                        <h4 class="six wide field <?php echo (!empty($password_err)) ? 'field error message' : ''; ?>">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control">
                            <span class="ui error message"><?php echo $password_err; ?></span>
                        </h4>
                        <input type="submit" class="ui olive button" value="Login">

                    </form>
                </div>
                <div class="ui horizontal divider">
                    Or
                </div>
                <div class="middle aligned column">
                    <div class="ui big button">
                        <i class="signup icon"></i>
                        <a href="register.php">Sign up now</a>
                    </div>
                </div>
            </div>

        </div>
    </body>
</html>
