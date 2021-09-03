<?php
    include "login-check.php";

    // include the config file that we created last week
    require "../config.php";
    require "common.php";

    // Check if something has been posted
    if (isset($_GET['del'])) {
            
        try {
            
            // define database connection
            $connection = new PDO($dsn, $username, $password, $options);
            
            // set id variable
            $id = $_GET["del"];
            
            // Create the SQL 
            $sql = "DELETE FROM assignments WHERE id = :id";
    
            // Prepare the SQL
            $statement = $connection->prepare($sql);
            
            // bind the id to the PDO
            $statement->bindValue(':id', $id);
            
            // execute the statement
            $statement->execute();
    
            // Success message
            // $success = "<div class='ui sucess message'>Assignment successfully deleted</div>";
            $sucess = "Assignment Sucessfully Deleted";

            Header('Location:index.php');
    
        } catch(PDOException $error) {
            // if there is an error, tell us what it is
            echo $sql . "<br>" . $error->getMessage();
        }

    }
    

?>

<?php

    if (isset($_GET['id'])) {

        try {
            // standard db connection
            $connection = new PDO($dsn, $username, $password, $options);
            
            // set if as variable
            $id = $_GET['id'];
            
            //select statement to get the right data
            $sql = "SELECT * FROM assignments WHERE id = :id";
            
            // prepare the connection
            $statement = $connection->prepare($sql);
            
            //bind the id to the PDO id
            $statement->bindValue(':id', $id);
            
            // now execute the statement
            $statement->execute();
            
            // attach the sql statement to the new work variable so we can access it in the form
            $assignment = $statement->fetch(PDO::FETCH_ASSOC);
            
        } catch(PDOExcpetion $error) {
            echo $sql . "<br>" . $error->getMessage();
        }

    } else {
        // If no ID, show error
        echo "No Assignment - Something went wrong";
    }

?>

<?php include "templates/header.php"; ?>


<h2 class="ui header dividing"><?php echo $assignment['assignmentname']; ?></h2>


<div class="ui basic label">
    <h3>Subject: <?php echo $assignment['subjectname']; ?></h3>
</div>
<br>
<div class="ui basic label">
    <h3>Due Date: <?php echo date("D, dS F y", strtotime($assignment['duedate'])); ?></h3>
</div>
<br>
<div class="ui basic label">
    <h4>Weighting: <?php echo $assignment['weighting']; ?></h4>
</div>
<br>
<div class="ui basic label">
    <h4>How Complete: <?php echo $assignment['completed']; ?></h4>
</div>


    <h1><a class="ui olive button" name="edit-btn" href="edit-ass.php?id=<?php echo $assignment['id']?>">Edit</a></h1>

<a onClick = "return confirm('Do you really want to delete this Assignment?');"
    class = "ui red simple button" 
    name = "delete-btn" 
    href = "<?php echo $_SERVER['PHP_SELF'] . "?del=" . $assignment['id']; ?>">
        Delete
</a>





<?php   
    include "templates/footer.php";
?>

