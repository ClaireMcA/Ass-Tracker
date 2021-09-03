<?php
        if(empty(trim($_POST["username"]))){
            $username_err = "Please enter a username.";
        } else{
            // Prepare a select statement
            $sql = "SELECT id FROM users WHERE username = :username";
            
            if($stmt = $pdo_connection->prepare($sql)){
                // Bind variables to the prepared statement as parameters
                $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
                
                // Set parameters
                $param_username = trim($_POST["username"]);
                
                // Attempt to execute the prepared statement
                if($stmt->execute()){
                    if($stmt->rowCount() == 1){
                        $username_err = "This username is already taken.";
                    } else{
                        $username = trim($_POST["username"]);
                    }
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }
            }
            
            // Close statement
            unset($stmt);
        }

?>


<?php

include "login-check.php";
include "../config.php";

$username = "";
$username_new_err = "";
$username_old_err = "";


// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_old_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }

    if(empty($username_old_err) && empty($username_new_err)){
        // Prepare a select statement
        $sql = "SELECT id, username FROM users WHERE username = :username";
        
        if($stmt = $pdo_connection->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":old_username", $param_old_username, PDO::PARAM_STR);
            
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
                            $password_err = "The username you entered is taken.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_old_err = "No account found with that username.";
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
 

    <div class="wrapper">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>
        <form action="login.php" method="post">
            <div class="form-group <?php echo (!empty($username_old_err)) ? 'has-error' : ''; ?>">
                <label>Old Username</label>
                <input type="text" name="old_username" class="form-control" value="<?php echo $old_username; ?>">
                <span class="help-block"><?php echo $username_old_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($username_ne_err)) ? 'has-error' : ''; ?>">
                <label>New Username</label>
                <input type="text" name="new_username" class="form-control">
                <span class="help-block"><?php echo $username_new_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
                <a class="btn btn-link" href="account.php">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>
