<?php

    // link config file
    require "../config.php";

    //Define variables and set as empty strings
    $username = "";
    $password = "";
    $confirm_password = "";
    $username_err = "";
    $password_err = "";
    $confirm_password_err = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
    
        // Validate username
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
        
        // Validate password
        if(empty(trim($_POST["password"]))){
            $password_err = "Please enter a password.";     
        } elseif(strlen(trim($_POST["password"])) < 6){
            $password_err = "Password must have at least 6 characters.";
        } else{
            $password = trim($_POST["password"]);
        }
        
        // Validate confirm password
        if(empty(trim($_POST["confirm_password"]))){
            $confirm_password_err = "Please confirm password.";     
        } else{
            $confirm_password = trim($_POST["confirm_password"]);
            if(empty($password_err) && ($password != $confirm_password)){
                $confirm_password_err = "Password did not match.";
            }
        }
        
        // Check input errors before inserting in database
        if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
            
            // Prepare an insert statement
            $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
            
            if($stmt = $pdo_connection->prepare($sql)){
                // Bind variables to the prepared statement as parameters
                $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
                $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
                
                // Set parameters
                $param_username = $username;
                $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
                
                // Attempt to execute the prepared statement
                if($stmt->execute()){
                    
                    // Redirect to login page
                    header("location: login.php");
                } else{
                    echo "Something went wrong. Please try again later.";
                }
            }
            
            // Close statement
            unset($stmt);
        }
        
        // Close connection
        unset($pdo_connection);
    }
?>

<?php include "templates/unauth-header.php"; ?>


<h2 class="ui dividing header">Create an Account</h2>


<div class="ui placeholder segment">
    <div clss="ui one column very relaxed stackable grid">
        <div class="column">
            <form class="ui form error" action="register.php" method="post">
                <div class="six wide field <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" value="">
                    <span class="ui error message"><?php echo $username_err; ?></span>
                </div>    
                <div class="six wide field <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" value="">
                    <span class="ui error message"><?php echo $password_err; ?></span>
                </div>
                <div class="six wide field <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                    <label>Confirm Password</label>
                    <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                    <span class="ui error message"><?php echo $confirm_password_err; ?></span>
                </div>
                <input type="submit" class="ui olive button" value="Submit">
            </form>
        </div>
        <div class="ui horizontal divider">
            Or
        </div>
        <div class="middle aligned column">
            <h4 class="header">Already have an account?</h4>    
                <div class="ui big button">
                    <i class="sign in icon"></i>
                    <a href="login.php">Login Here</a>
                </div>

        </div>