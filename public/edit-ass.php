<?php 

    require "login-check.php";

    // include the config file 
    require "../config.php";
    require "common.php";

    // $current_page = "event-page.php?id=" . $_GET['id'];
    // echo $current_page;

    // run when save button is clicked
    if (isset($_POST['submit'])) {
        try {

            $connection = new PDO($dsn, $username, $password, $options);  

            //grab elements from form and set as varaible
            $assignments =[
                "id"             => $_POST['id'], 
                "subjectname"    => $_POST['subjectname'], 
                "assignmentname" => $_POST['assignmentname'],
                "duedate"        => $_POST['duedate'],
                "weighting"      => $_POST['weighting'], 
                "completed"      => $_POST['completed'],
            ];
        
            // create SQL statement
            $sql = "UPDATE `assignments` 
                    SET id = :id,
                        subjectname = :subjectname, 
                        assignmentname = :assignmentname, 
                        duedate = :duedate, 
                        weighting = :weighting, 
                        completed = :completed
                    WHERE id = :id";
        
            //prepare sql statement
            $statement = $connection->prepare($sql);
        
            //execute sql statement
            $statement->execute($assignments);

        } catch(PDOException $error) {

            echo $sql . "<br>" . $error->getMessage();
            
        }
    }
?>

<?php
    // Run when page is first loaded from ID sent in URL
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
            
            // attach the sql statement to the new assignment variable so we can access it in the form
            $assignments = $statement->fetch(PDO::FETCH_ASSOC);
            
        } catch(PDOExcpetion $error) {
            echo $sql . "<br>" . $error->getMessage();
        }

    } else {
        // If no ID, show error
        echo "No ID - Something went wrong";
    }

    include "templates/header.php";

    if (isset($_POST['submit']) && $statement) { ?>
        <div class = "ui form success">
            <p class="ui form sucess message">Assignment successfully updated.</p>
            <?php $_POST['submit'] = ""; ?>
        </div>
    <?php } ?>

    <h2 class="ui dividing header">Edit Assignment</h2>

    <form class= "ui form" method="post">
        <input type="hidden" name="id" id="id" value="<?php echo $assignments['id']; ?>">   
        <div class= "six wide field">
            <label for="subjectname">Subject</label> 
            <input type="text" name="subjectname" id="subjectname" value="<?php echo $assignments['subjectname']; ?>"> 
        </div>
        <div class= "six wide field">
            <label for="assignmentname">Assignment Name</label> 
            <input type="text" name="assignmentname" id="assignmentname" value="<?php echo $assignments['assignmentname']; ?>"> 
        </div>
        <div class= "six wide field">
            <label for="duedate">Due Date</label> 
            <input type="date" name="duedate" id="duedate" value="<?php echo $assignments['duedate']; ?>"> 
        </div>
        <div class= "six wide field">
            <label for="weighting">Weighting</label> 
            <input type="text" name="weighting" id="weighting" value="<?php echo $assignments['weighting']; ?>"> 
        </div>
        <div class= "six wide field">
            <label for="completed">Completion</label>
            <input type="text" name="completed" id="completed" value="<?php echo $assignments['completed']; ?>"> 
        </div>
        <div class="ui checkbox">
            <input type="checkbox" tabindex="0" class="hidden" name = "completed">
            <label>Completed</label>
        </div>
        <a class="ui button" href="event-page.php?id=<?php echo $assignments['id'];?>">Cancel</a>
        <input class= "ui olive button" type="submit" name="submit" value="Save">
    </form>