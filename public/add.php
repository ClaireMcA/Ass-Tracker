<?php 
    
    require "login-check.php";

    if (isset($_POST['submit'])) {

        require "../config.php"; 

        try {
            $connection = new PDO($dsn, $username, $password, $options);

            $new_ass = array( 
                "subjectname"    => $_POST['subjectname'], 
                "assignmentname" => $_POST['assignmentname'],
                "duedate"        => $_POST['duedate'],
                "weighting"      => $_POST['weighting'], 
                "completed"      => $_POST['completed'],
            );

            $sql = "INSERT INTO assignments (
                subjectname,
                assignmentname,
                duedate,
                weighting,
                completed
            ) VALUES (
                :subjectname,
                :assignmentname,
                :duedate,
                :weighting,
                :completed
            )";        
        
            $statement = $connection->prepare($sql);
            $statement->execute($new_ass);

        
        } catch (PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
        
        }
    }




include "templates/header.php";

if (isset($_POST['submit']) && $statement) { ?>
    <div class = "ui form success">
        <p class="ui sucess message">Assignment successfully added.</p>
        <?php $_POST['submit'] = ""; ?>
    </div>
<?php } ?>

<h2 class="ui dividing header">Add a New Assignment</h2>

<form class= "ui form" method="post">
    <div class= "six wide field">
        <label for="subjectname">Subject</label> 
        <input type="text" name="subjectname" id="subjectname"> 
    </div>
    <div class= "six wide field">
        <label for="assignmentname">Assignment Name</label> 
        <input type="text" name="assignmentname" id="assignmentname"> 
    </div>
    <div class= "six wide field">
        <label for="duedate">Due Date</label> 
        <input type="date" name="duedate" id="duedate"> 
    </div>
    <div class= "six wide field">
        <label for="weighting">Weighting</label> 
        <input type="text" name="weighting" id="weighting"> 
    </div>
    <div class= "six wide field">
        <label for="completed">How Complete?</label>
        <input type="text" name="completed" id="completed"> 
    </div>
    <a class="ui button" href="index.php">Cancel</a>
    <input class= "ui olive button" type="submit" name="submit" value="Submit">
</form>



<?php include "templates/footer.php"; ?>